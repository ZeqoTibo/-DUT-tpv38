<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use Psr\Log\LoggerInterface;

use Doctrine\ORM\EntityManagerInterface;

use AppBundle\Entity\Catalogue\Livre;
use AppBundle\Entity\Catalogue\Musique;

class AdminController extends Controller
{
	private $entityManager;
	private $logger;
	
	/*
	Pb with codeanywhere.com
	public function __construct(EntityManagerInterface $entityManager)  {
		$this->entityManager = $entityManager;
	}*/
	
	public function init()  {
		$this->entityManager = $this->container->get('doctrine')->getEntityManager();
		$this->logger = $this->container->get('monolog.logger.php');
	}
	
    /**
     * @Route("/admin/musiques", name="adminMusiques")
     */
    public function adminMusiquesAction(Request $request)
    {
		$this->init() ;
		$query = $this->entityManager->createQuery("SELECT a FROM AppBundle\Entity\Catalogue\Musique a");
		$articles = $query->getResult();
		return $this->render('admin.musiques.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/livres", name="adminLivres")
     */
    public function adminLivresAction(Request $request)
    {
		$this->init() ;
		$query = $this->entityManager->createQuery("SELECT a FROM AppBundle\Entity\Catalogue\Livre a");
		$articles = $query->getResult();
		return $this->render('admin.livres.html.twig', [
            'articles' => $articles,
        ]);
    }
	
    /**
     * @Route("/admin/musiques/supprimer", name="adminMusiquesSupprimer")
     */
    public function adminMusiquesSupprimerAction(Request $request)
    {
		$this->init() ;
		$entityArticle = $this->entityManager->getReference("AppBundle\Entity\Catalogue\Article", $request->query->get("refArticle"));
		if ($entityArticle !== null) {
			$this->entityManager->remove($entityArticle);
			$this->entityManager->flush();
		}
		return $this->redirectToRoute("adminMusiques") ;
    }
	
    /**
     * @Route("/admin/livres/supprimer", name="adminLivresSupprimer")
     */
    public function adminLivresSupprimerAction(Request $request)
    {
		$this->init() ;
		$entityArticle = $this->entityManager->getReference("AppBundle\Entity\Catalogue\Article", $request->query->get("refArticle"));
		if ($entityArticle !== null) {
			$this->entityManager->remove($entityArticle);
			$this->entityManager->flush();
		}
		return $this->redirectToRoute("adminLivres") ;
    }

    /**
     * @Route("/admin/livres/ajouter", name="adminLivresAjouter")
     */
    public function adminLivresAjouterAction(Request $request)
    {
		$this->init() ;
		$entity = new Livre() ;
		$formBuilder = $this->createFormBuilder($entity);
		$formBuilder->add("titre", TextType::class) ;
		$formBuilder->add("auteur", TextType::class) ;
		$formBuilder->add("prix", NumberType::class) ;
		$formBuilder->add("disponibilite", IntegerType::class) ;
		$formBuilder->add("image", TextType::class) ;
		$formBuilder->add("ISBN", TextType::class) ;
		$formBuilder->add("nbPages", IntegerType::class) ;
		$formBuilder->add("dateDeParution", TextType::class) ;
		$formBuilder->add("valider", SubmitType::class) ;
		// Generate form
		$form = $formBuilder->getForm();
		
		$form->handleRequest($request) ;
		
		if ($form->isSubmitted()) {
			$entity = $form->getData() ;
			$entity->setRefArticle(uniqid());
			$this->entityManager->persist($entity);
			$this->entityManager->flush();
			return $this->redirectToRoute("adminLivres") ;
		}
		else {
			return $this->render('admin.form.html.twig', [
				'form' => $form->createView(),
			]);
		}
    }
	
    /**
     * @Route("/admin/musiques/ajouter", name="adminMusiquesAjouter")
     */
    public function adminMusiquesAjouterAction(Request $request)
    {
		$this->init() ;
		$entity = new Musique() ;
		$formBuilder = $this->createFormBuilder($entity);
		$formBuilder->add("titre", TextType::class) ;
		$formBuilder->add("artiste", TextType::class) ;
		$formBuilder->add("prix", NumberType::class) ;
		$formBuilder->add("disponibilite", IntegerType::class) ;
		$formBuilder->add("image", TextType::class) ;
		$formBuilder->add("EAN", TextType::class) ;
		$formBuilder->add("dateDeParution", TextType::class) ;
		$formBuilder->add("valider", SubmitType::class) ;
		// Generate form
		$form = $formBuilder->getForm();
		
		$form->handleRequest($request) ;
		
		if ($form->isSubmitted()) {
			$entity = $form->getData() ;
			$entity->setRefArticle(uniqid());
			$this->entityManager->persist($entity);
			$this->entityManager->flush();
			return $this->redirectToRoute("adminMusiques") ;
		}
		else {
			return $this->render('admin.form.html.twig', [
				'form' => $form->createView(),
			]);
		}
    }

    /**
     * @Route("/admin/livres/modifier", name="adminLivresModifier")
     */
    public function adminLivresModifierAction(Request $request)
    {
		$this->init() ;
		$entity = $this->entityManager->getReference("AppBundle\Entity\Catalogue\Livre", $request->query->get("refArticle"));
		if ($entity === null) 
			$entity = $this->entityManager->getReference("AppBundle\Entity\Catalogue\Livre", $request->request->get("refArticle"));
		if ($entity !== null) {
			$formBuilder = $this->createFormBuilder($entity);
			$formBuilder->add("refArticle", HiddenType::class) ;
			$formBuilder->add("titre", TextType::class) ;
			$formBuilder->add("auteur", TextType::class) ;
			$formBuilder->add("prix", NumberType::class) ;
			$formBuilder->add("disponibilite", IntegerType::class) ;
			$formBuilder->add("image", TextType::class) ;
			$formBuilder->add("ISBN", TextType::class) ;
			$formBuilder->add("nbPages", IntegerType::class) ;
			$formBuilder->add("dateDeParution", TextType::class) ;
			$formBuilder->add("valider", SubmitType::class) ;
			// Generate form
			$form = $formBuilder->getForm();
			
			$form->handleRequest($request) ;
			
			if ($form->isSubmitted()) {
				$entity = $form->getData() ;
				$this->entityManager->persist($entity);
				$this->entityManager->flush();
				return $this->redirectToRoute("adminLivres") ;
			}
			else {
				return $this->render('admin.form.html.twig', [
					'form' => $form->createView(),
				]);
			}
		}
		else {
			return $this->redirectToRoute("adminLivres") ;
		}
    }
	
    /**
     * @Route("/admin/musiques/modifier", name="adminMusiquesModifier")
     */
    public function adminMusiquesModifierAction(Request $request)
    {
		$this->init() ;
		$entity = $this->entityManager->getReference("AppBundle\Entity\Catalogue\Musique", $request->query->get("refArticle"));
		if ($entity === null) 
			$entity = $this->entityManager->getReference("AppBundle\Entity\Catalogue\Musique", $request->request->get("refArticle"));
		if ($entity !== null) {
			$formBuilder = $this->createFormBuilder($entity);
			$formBuilder->add("refArticle", HiddenType::class) ;
			$formBuilder->add("titre", TextType::class) ;
			$formBuilder->add("artiste", TextType::class) ;
			$formBuilder->add("prix", NumberType::class) ;
			$formBuilder->add("disponibilite", IntegerType::class) ;
			$formBuilder->add("image", TextType::class) ;
			$formBuilder->add("EAN", TextType::class) ;
			$formBuilder->add("dateDeParution", TextType::class) ;
			$formBuilder->add("valider", SubmitType::class) ;
			// Generate form
			$form = $formBuilder->getForm();
			
			$form->handleRequest($request) ;
			
			if ($form->isSubmitted()) {
				$entity = $form->getData() ;
				$this->entityManager->persist($entity);
				$this->entityManager->flush();
				return $this->redirectToRoute("adminMusiques") ;
			}
			else {
				return $this->render('admin.form.html.twig', [
					'form' => $form->createView(),
				]);
			}
		}
		else {
			return $this->redirectToRoute("adminMusiques") ;
		}
    }
}
