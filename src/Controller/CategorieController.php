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




class CategorieController extends AbstractController
{

    /**
     * @Route("/form", name="form")
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
}