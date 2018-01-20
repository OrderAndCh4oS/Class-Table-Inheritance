<?php

namespace App\Controller;

use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends BaseController
{
    /**
     * @Route("/article", name="article_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('App:Article');
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', compact('articles'));
    }

    /**
     * @Route("/article/show/{id}", name="article_show")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('App:Article');
        $article = $articleRepository->find($id);

        return $this->render('article/show.html.twig', compact('article'));
    }

    /**
     * @Route("/article/new", name="article_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('App\Form\ArticleType', $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render(
            'article/new.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("article/{id}/sections/", name="section")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sectionsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('App:Article');
        $article = $articleRepository->find($id);

        return $this->render('section/index.html.twig', compact('article'));
    }
}
