<?php
namespace ProjectBundle\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Util\StringUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ProjectBundle\Entity\Project;
use ProjectBundle\Entity\FavoritedProject;
use ProjectBundle\Entity\News;
use ProjectBundle\Form\ProjectType;
use ProjectBundle\Form\NewsType;
use ProjectBundle\Form\SearchType;
use BaseBundle\Entity\Image;


class ProjectController extends Controller
{



    /**
     * @Route("/project/{id}", name="project_show")
     * @ParamConverter("project", class="ProjectBundle:Project")
     * @Template()
     */
    public function showAction(Request $request, Project $project)
    {
        $author = $project->getAuthor();
		$userManager = $this->get('fos_user.user_manager');
		$user = $userManager->findUserByUsername($author);


        // liste des favoris de l'user 
        $testFav = $this->getDoctrine()->getManager()
        ->getRepository('ProjectBundle:FavoritedProject')
        ->findByProjectId($project ->getId());
		
		// Ajout de news
		$em = $this->getDoctrine()->getManager();
		$news = new News();
		$form = $this->get('form.factory')->create(new NewsType(), $news);
            
        if ($this->getRequest()->getMethod() === 'POST')
		{
            $form->bind($this->getRequest());
            if ($form->isValid())
			{
                $news->setProject($project);
				$news->upload();
				$em->persist($news);
				$em->flush();
			}
		}
		
		// Récupération des news
		$listNews = $em
		->getRepository('ProjectBundle:News')
		->findBy(
			array('project' => $project),
			array('date' => 'desc')
		);
		
		
		
		
		
		
		// Ajout d'images pour la galerie
			$image = new Image();
			$formImage = $this->get('form.factory')->createBuilder('form', $image)
			->add('file')
			->add('Ajouter', 'submit')
			->getForm()
			;
		
			if ($formImage -> handleRequest($request)->isValid()) {
					
					if ($image->getFile()==null) { // gestion d'erreur : si l'user clique sur ajouter sans avoir choisi une image,
						$request->getSession()->getFlashBag()->add('erreur', 'Vous ne pouvez pas ajouter aucune image ! Cliquez sur "Choisissez un fichier" et choisissez votre image.'); // alors on envoie un mess d'erreur.
					}
					else {
						
						$em = $this->getDoctrine()->getManager();

						$image->upload();
						$image->setProject($project); // on lie l'image au projet
						$em->persist($image);
						$em->flush();
				}
		
			}
			
			
			
			
			
			
		// Récupération des images de la galerie
		
		$images = $this->getDoctrine()->getManager()
        ->getRepository('BaseBundle:Image')
        ->findByProject($project);
		
		
		
		
		
		
			
		return $this->render('ProjectBundle:Project:show.html.twig', array('project' => $project, 'authorId' => $user->getId(), 'testFav' => $testFav, 'form' => $form->createView(), 'listNews' => $listNews, 'images' => $images, 'formImage' => $formImage->createView()));
    
	}
	
	
	
	
	
	
	
	
	
    /**
     * @Route("/edit/{id}", name="edit")
     * @ParamConverter("project", class="ProjectBundle:Project")
     * @Template()
     */
    public function editAction(Project $project)
    {
		if(!StringUtils::equals($this->getUser()->getUsername(), $project->getAuthor()))
		{
			throw new AccessDeniedException('Vous n\'avez pas la permission d\'éditer ce projet.');
		}
		
        $em = $this -> getDoctrine() -> getEntityManager();

        $form = $this -> createForm(new ProjectType(), $project);

        $request = $this ->getRequest();

        if($request -> isMethod('POST')){

            $form->bindRequest($request);

            if($form->isValid()){
                $p = $form -> getData();
                $em -> persist($p);
                $em -> flush();

                return $this -> redirect( 
                    $this -> generateUrl('/project/{id}', array(
                        'id' => $p -> getId(),
                 ))
                );
            }
        }   

        return $this -> render('ProjectBundle:Project:edit.html.twig', array(
            'id' => $project -> getId(),
            'form' => $form -> createView(),
             ));
    }




    /**
    * @Route("/new-project", name="new-project")
    */
    public function addAction(Request $request){
            $project = new Project();
            $form = $this->get('form.factory')->create(new ProjectType(), $project);
            
            if($form -> handleRequest($request)->isValid()){
                $em = $this -> getDoctrine() -> getManager(); 
				$project->setAuthor($this->getUser()->getUsername());
				$duree = new \DateInterval('P'.$project->getDuree().'D');
				$newDate = new \DateTime();
				$endDate = $newDate->add($duree);
				$project->setEndDate($endDate);
                $project->upload();



                $em -> persist($project);
                $em -> flush();
            return $this->redirect($this->generateUrl('homepage'));
            }
            return $this->render("ProjectBundle:Push:newproject.html.twig", array(
                'form'  =>  $form->createView()));
    }




    /** $project = new Project();
        $form = $this->createForm(new ProjectType(), $project);
        $form->handleRequest($request);
        if($request->isMethod('POST') && $form->isValid) {
            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('homepage'));
        }
        return $this->render("ProjectBundle:Push:newproject.html.twig", [
            'form'  =>  $form->createView()
        ]);**/
    
    /**
    * @Route("/favoris", name="favoris")
    */
    public function favorisAction()
    {

        $userId = $this->get('security.token_storage')->getToken()->getUser();

        // liste des favoris de l'user 
        $favorisForUser = $this->getDoctrine()->getManager()
        ->getRepository('ProjectBundle:FavoritedProject')
        ->findByUserId($userId);

        // Création d'un tableau vide
        $favoris = array();

        $id = array();

        foreach ($favorisForUser as $key => $value) {
            $project = $this->getDoctrine()->getManager()
            ->getRepository('ProjectBundle:Project')
            ->findById($value->getProjectId());


            array_push($favoris, $project); 
        }
//        return new Response( var_dump($id) );
        
        return $this->render('ProjectBundle:Back:favproject.html.twig', array(
            'projets' => $favoris
        ));
        
    }









    /**
    * @Route("/myprojects", name="myprojects")
    */
    public function myprojectsAction (){

            $Projects = $this->getDoctrine()->getManager()
                    ->getRepository('ProjectBundle:Project')
                    ->findByAuthor($this->getUser()->getUsername());

        return $this -> render('ProjectBundle:Back:myprojects.html.twig', array(
            'Projects' => $Projects,
            ));
    }



    /**
     * @Route("/desactive/{id}", name="desactive")
     * @ParamConverter("project", class="ProjectBundle:Project")
     */
    public function desactiveAction(Project $project)
    {
        if( $project->getAuthor() == $this->getUser()->getId() ){

            $em = $this->getDoctrine()->getEntityManager();
            $item = $em->getRepository('ProjectBundle:Project')->findOneById($project->getId());
            $item->setActive(0);
            $em->flush();
        }
        return $this -> redirect($this -> generateUrl('myprojects'));

    }

     /**
     * @Route("/ajouter-favoris/{id}", name="ajouter-favoris")
     * @ParamConverter("project", class="ProjectBundle:Project")
     */
    public function ajouterFavorisAction(Project $project)
    {
        if( $this->getUser()->getId() ){

            $currentProjectId = $project->getId();

            $favoris = new FavoritedProject;
            $favoris->setUserId( $this->getUser()->getId() );
            $favoris->setProjectId($currentProjectId);

            $em = $this->getDoctrine()->getManager();
            $em->persist($favoris);

            $em->flush();

        }
        return $this -> redirect($this -> generateUrl('favoris'));

    }


    /**
     * @Route("/remove-favoris/{id}", name="remove-favoris")
     * @ParamConverter("project", class="ProjectBundle:Project")
     */
    public function removeFavorisAction(Project $project)
    {


            $em = $this->getDoctrine()->getEntityManager();
            $item = $em->getRepository('ProjectBundle:FavoritedProject')->findOneByUserId($project->getId());
            $em->remove($item);
            $em->flush();

        return $this -> redirect($this -> generateUrl('favoris'));

    }


    /**
    * @Route("/push", name ="push")
    */
    public function pushAction(Request $request)
    {
        return $this->render("ProjectBundle:Push:push.html.twig");
    }

    /**
    * @Route("/search", name ="search")
    */
    public function postSearch(Request $request)
    {
        $array = [];
        $search = $this->getRequest()->request;
        // On a initialisé notre PUTAIN de tableau (ET oui c'est un putain de trafic)
        if($search->get('Art')){
            array_push($array, 'Art');
        }
        if($search->get('Littérature')){
            array_push($array, 'Littérature');
        }
        if($search->get('Spectacle')){
            array_push($array, 'Spectacle');
        }
        if($search->get('Photographie')){
            array_push($array, 'Photographie');
        }
        if($search->get('Mode')){
            array_push($array, 'Mode');
        }
        if($search->get('Journalisme')){
            array_push($array, 'Journalisme');
        }
        if($search->get('Education')){
            array_push($array, 'Education');
        }
        if($search->get('Ecologie')){
            array_push($array, 'Ecologie');
        }
        if($search->get('Solidarité')){
            array_push($array, 'Solidarité');
        }
        if($search->get('Design')){
            array_push($array, 'Design');
        }
        if($search->get('Invention')){
            array_push($array, 'Invention');
        }
        if($search->get('Film')){
            array_push($array, 'Film');
        }
        if($search->get('Cuisine')){
            array_push($array, 'Cuisine');
        }
        if($search->get('Jeux')){
            array_push($array, 'Jeux');
        }
        if($search->get('Application')){
            array_push($array, 'Application');
        }
        if($search->get('Gadgets')){
            array_push($array, 'Gadgets');
        }


        $projects = $this->getDoctrine()->getManager()
                    ->getRepository('ProjectBundle:Project')
                    ->findBy(
                       array('categorie' => $array )        // $where 
                     );



        return $this->render('ProjectBundle:Push:search.html.twig', array(
            'projects' => $projects
        ));
    }
	
	public function donateAction()
	{
		return $this->render('ProjectBundle:Payment:form_don.html.twig');
	}
}  