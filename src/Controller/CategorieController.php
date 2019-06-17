<?php

namespace App\Controller;

Use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;




class CategorieController extends AbstractController
{

    /**
     * @Route("/form", name="form")
     * @IsGranted("ROLE_ADMIN")
     */
	public function add(Request $request, ObjectManager $manager){
		$category = new Category();
		$form = $this->createForm(CategoryType::class, $category);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
	      $data = $form->getData();
	      $manager->persist($data);
	      $manager->flush();
	      // $data contient les données du $_POST
		}
	      return $this->render('blog/form.html.twig',['form'=> $form->createView()]);
	}

	/**
     * @Route("/category", name="category_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {   $category = $categoryRepository->findAll();

        return $this->render('blog/categoryIndex.html.twig', [
            'categories' => $category,
        ]);
    }
}