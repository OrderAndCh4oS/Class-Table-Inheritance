<?php

namespace App\Controller;

use App\Entity\QuoteBlock;
use App\Entity\TextBlock;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SectionController extends BaseController
{
    /**
     * @Route("article/{id}/section/new/{type}", name="section_new")
     * @param Request $request
     * @param $id
     * @param $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postAction(Request $request, $id, $type)
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
                return $this->redirectToRoute('article_show', array('id' => $id));
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $articleRepository = $em->getRepository('App:Article');
            $article = $articleRepository->find($id);
            $article->addSection($section);
            $section->setArticle($article);
            $em->persist($section);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render(
            'admin/section/new.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }
}
