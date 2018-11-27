<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategoryController extends AbstractController
{
    /**
     * @Route("/category123", name="category")
     */
    public function index()
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show(Category $category):Response
    {
        return $this->render('category/category.html.twig', ['category'=>$category]);
    }

    /**
     * @Route ("/category" , name = "category_new", methods="Get|POST")
     */

    public function new(Request $request): Response
    {
        $categories = $this->getDoctrine()
                         ->getRepository(Category::class)
                         ->findAll();

        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($category);
           $em->flush();

           return $this->redirectToRoute('blog_index');
        }
        return $this->render('category/allCategory.html.twig', [  'category' => $category ,
                                                                        'form'=> $form->createView(),
                                                                        'categories'=>$categories
        ]);

    }

}
