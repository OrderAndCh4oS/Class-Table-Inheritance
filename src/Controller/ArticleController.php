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
     * @Route("/admin/article", name="admin_article_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('App:Article');
        $articles = $articleRepository->findAll();

        return $this->render('admin/article/index.html.twig', compact('articles'));
    }

    /**
     * @Route("/admin/article/show/{article}", name="admin_article_show")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminShowAction(Article $article)
    {
        return $this->render('admin/article/show.html.twig', compact('article'));
    }

    /**
     * @Route("/admin/article/new", name="admin_article_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function adminNewAction(Request $request)
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
            'admin/article/new.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/", name="article_list")
     */
    public function publicListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('App:Article');
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', compact('articles'));
    }

    /**
     * @Route("/article/{article}", name="article_show")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function publicShowAction(Article $article)
    {
        return $this->render('article/show.html.twig', compact('article'));
    }
}
