<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\QuoteBlock;
use App\Entity\TextBlock;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
                'form' => $form->createView(),
            )
        );
    }
}
