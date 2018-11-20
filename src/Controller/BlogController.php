<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("blog/{slug}",requirements={"slug"="[a-z0-9-]+"}, name="blog")
     */
    public function show($slug = "Article sans titre")
    {
        $slug = str_replace("-", " ", $slug);
        $slug = ucwords($slug);

        return $this->render('blog/index.html.twig', ['slug' => $slug]);

    }

    /**
     * @Route ("blog/category/{category}/all", name ="blog_category")
     */
    public function showAllByCategory(Category $category)
    {

        return $this->render('blog/category.html.twig', ['category' => $category,
        'articles' => $category->getArticles(),
        ]);

    }
}