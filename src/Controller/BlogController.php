<?php
// src/Controller/BlogController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
	/**
     * @Route("/blog", name="blog_index")
    */
    public function index()
    {
   		 return $this->render('blog/index.html.twig', [
            'owner' => 'Jamy',
    	]);
    }

    /**
     * @Route("/blog/show/{slug}", requirements={"slug"="[0-9a-z\-]+"}, defaults={"slug"="Article sans titre"},  name="blog_slug")
    */
    public function show($slug)
    {
        $replace = str_replace("-"," ",($slug));
        $replace = ucwords($replace);
        return $this->render('blog/show.html.twig', ['infoSlug' => $replace]);
    }


}