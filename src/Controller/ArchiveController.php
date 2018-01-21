<?php

namespace App\Controller;

use App\Entity\Archive;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArchiveController extends Controller
{
    /**
     * @Route("/admin/archive", name="admin_archive_list")
     */
    public function adminListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $archiveRepository = $em->getRepository('App:Archive');
        $archives = $archiveRepository->findAll();

        return $this->render('admin/archive/index.html.twig', compact('archives'));
    }

    /**
     * @Route("/admin/archive/show/{archive}", name="admin_archive_show")
     * @param Archive $archive
     * @return Response
     */
    public function adminShowAction(Archive $archive)
    {
        return $this->render('admin/archive/show.html.twig', compact('archive'));
    }

    /**
     * @Route("/admin/archive/new", name="admin_archive_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function adminNewAction(Request $request)
    {
        $archive = new Archive();
        $form = $this->createForm('App\Form\ArchiveType', $archive);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($archive);
            $em->flush();

            return $this->redirectToRoute('admin_archive_show', ['archive' => $archive->getId()]);
        }

        return $this->render(
            'admin/archive/new.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/admin/archive/{archive}/edit", name="admin_archive_edit")
     * @param Request $request
     * @param Archive $archive
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function adminEditAction(Request $request, Archive $archive)
    {
        $deleteForm = $this->createDeleteForm($archive);
        $form = $this->createForm('App\Form\ArchiveType', $archive);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($archive);
            $em->flush();

            return $this->redirectToRoute('admin_archive_show', ['archive' => $archive->getId()]);
        }

        return $this->render(
            'admin/archive/edit.html.twig',
            [
                'form' => $form->createView(),
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * @Route("/admin/archive/{id}/delete", name="admin_archive_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Archive $archive
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function adminDeleteAction(Request $request, Archive $archive)
    {
        $form = $this->createDeleteForm($archive);
        $form->handleRequest($request);
//        dump($form);die;
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($archive);
            $em->flush();
        }

        return $this->redirectToRoute('admin_archive_list');
    }

    /**
     * @Route("/", name="public_archive_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function publicListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $archiveRepository = $em->getRepository('App:Archive');
        $archives = $archiveRepository->findBy(compact('archive'));

        return $this->render('public/archive/index.html.twig', compact('archives', 'archive'));
    }

    private function createDeleteForm(Archive $archive)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_archive_delete', ['id' => $archive->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
