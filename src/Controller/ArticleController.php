<?php

namespace App\Controller;

use App\Entity\Archive;
use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends BaseController
{
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
     * @Route("/admin/archive/{archive}/article/new", name="admin_article_new")
     * @param Request $request
     * @param Archive $archive
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function adminNewAction(Request $request, Archive $archive)
    {
        $article = new Article();
        $form = $this->createForm('App\Form\ArticleType', $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setArchive($archive);
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_article_show', array('article' => $article->getId()));
        }
        $form = $form->createView();

        return $this->render(
            'admin/article/new.html.twig',
            compact('form', 'archive')
        );
    }

    /**
     * @Route("/admin/article/{article}/edit", name="admin_article_edit")
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function adminEditAction(Request $request, Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);
        $form = $this->createForm('App\Form\ArticleType', $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_article_show', ['article' => $article->getId()]);
        }

        return $this->render(
            'admin/article/edit.html.twig',
            [
                'article' => $article,
                'form' => $form->createView(),
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * @Route("/admin/article/{id}/delete", name="admin_article_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function adminDeleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('admin_archive_list');
    }

    /**
     * @Route("/archive/{archive}", name="public_article_list")
     * @param Archive $archive
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function publicListAction(Archive $archive)
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('App:Article');
        $articles = $articleRepository->findBy(compact('archive'));

        return $this->render('public/article/index.html.twig', compact('articles', 'archive'));
    }

    /**
     * @Route("/article/{article}", name="public_article_show")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function publicShowAction(Article $article)
    {
        return $this->render('public/article/show.html.twig', compact('article'));
    }

    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_article_delete', ['id' => $article->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
