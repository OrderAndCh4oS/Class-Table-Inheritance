<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\QuoteBlock;
use App\Entity\SectionAbstract;
use App\Entity\TextBlock;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SectionController extends BaseController
{
    /**
     * @Route("article/{article}/section/new/{type}", name="admin_section_new")
     * @param Request $request
     * @param Article $article
     * @param $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postAction(Request $request, Article $article, $type)
    {
        switch ($type) {
            case 'quote-block':
                $section = new QuoteBlock();
                $form = $this->createForm('App\Form\QuoteBlockType', $section);
                break;
            case 'text-block':
                $section = new TextBlock();
                $form = $this->createForm('App\Form\TextBlockType', $section);
                break;
            default:
                return $this->redirectToRoute('admin_article_show', array('article' => $article->getId()));
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->addSection($section);
            $section->setArticle($article);
            $em->persist($section);
            $em->flush();

            return $this->redirectToRoute('admin_article_show', array('article' => $article->getId()));
        }

        return $this->render(
            'admin/section/new.html.twig',
            array(
                'article' => $article,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/admin/section/{section}/edit", name="admin_section_edit")
     * @param Request $request
     * @param SectionAbstract $section
     * @return \ErrorException|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function adminEditAction(Request $request, SectionAbstract $section)
    {
        $deleteForm = $this->createDeleteForm($section);
        switch ($section::getType()) {
            case "quote_block":
                $form = $this->createForm('App\Form\QuoteBlockType', $section);
                break;
            case "text_block":
                $form = $this->createForm('App\Form\TextBlockType', $section);
                break;
            default:
                return new \ErrorException("Invalid Section Type");
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();

            return $this->redirectToRoute('admin_article_show', ['article' => $section->getArticle()->getId()]);
        }

        return $this->render(
            'admin/section/edit.html.twig',
            [
                'article' => $section->getArticle(),
                'form' => $form->createView(),
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * @Route("/admin/section/{id}/delete", name="admin_section_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param SectionAbstract $section
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function adminDeleteAction(Request $request, SectionAbstract $section)
    {
        $form = $this->createDeleteForm($section);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($section);
            $em->flush();
        }

        return $this->redirectToRoute('admin_article_show', ['article' => $section->getArticle()->getId()]);
    }

    private function createDeleteForm(SectionAbstract $section)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_section_delete', ['id' => $section->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
