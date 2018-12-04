<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    /**
     * @Route("/article/new", name="article_new")
     */
    public function add(Request $request): Response
    {

        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('blog_index');
        }
        return $this->render('article/addArticle.html.twig', [  'article' => $article ,
            'form'=> $form->createView(),
        ]);
    }

    /**
     *@Route("/article/{id}", name="article_show")
     */
    public function show(Article $article) : Response
    {
        return $this->render("article/show.html.twig", [
            'article' => $article
        ]);
    }

}
