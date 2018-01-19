<?php

namespace App\Controller;

use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends Controller
{
    /**
     * @Route("/article", name="article_index")
     */
    public function index()
    {
        $this->render('article/index.html.twig');
    }

    /**
     * @Route("/article/{id}", name="article_show")
     * @param $id
     */
    public function get($id)
    {
        $this->render('article/show.html.twig');
    }

    /**
     * @Route("/article/new", name="article_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function post(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('App\Form\ArticleType', $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('slug' => $poll->getSlug()));
        }

        return $this->render(
            'article/new.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }
}
