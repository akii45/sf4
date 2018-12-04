<?php

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/tag", name="tag")
     */
    public function index()
    {
        return $this->render('tag/index.html.twig', [
            'controller_name' => 'TagController',
        ]);
    }
    /**
     * @Route("/tag/{name}", name="tag_name")
     */
    public function show(Tag $tag) : Response
    {
        return $this->render('tag/show.html.twig', [
           'tag'=>$tag,
        ]);
    }
}
