<?php

namespace Stasmo\Example\SampleApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Stasmo\Example\SampleApiBundle\Document\Bar;

class AdminController extends Controller
{

    private $numResults;
    const resultsPerPage = 10;

    /**
     * @Route("/admin", name="admin_home")
     */
    public function defaultAction(Request $request)
    {
        $method = $request->getMethod();
        $page = $request->query->get('page');
        return $this->render(
            'StasmoExampleSampleApiBundle:Admin:index.html.twig',
            [ 'bars' => $this->getBarList($page), 'numberOfPages' => $this->getNumberOfBarPages() ]
        );
    }

    /**
     * @Route("/admin/new", name="admin_new")
     */
    public function newBar(Request $request)
    {
        $method = $request->getMethod();
        $bar = new Bar();
        $form = $this->generateBarForm($bar);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->saveBar($bar);
            $this->addSuccessFlash("Created bar");
        }
        return $this->render(
            'StasmoExampleSampleApiBundle:Admin:add.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    /**
     * @Route("/admin/edit/{id}", name="admin_edit")
     */
    public function editBar(Request $request, $id)
    {
        $method = $request->getMethod();
        $bar = $this->get('doctrine_mongodb')
            ->getRepository('StasmoExampleSampleApiBundle:Bar')
            ->find($id);

        if (!$bar) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $form = $this->generateBarForm($bar);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->saveBar($bar);
            $this->addSuccessFlash("Saved bar");
        }

        return $this->render(
            'StasmoExampleSampleApiBundle:Admin:add.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/admin/delete/{id}", name="admin_delete")
     */
    public function deleteBarAction(Request $request, $id)
    {
        $method = $request->getMethod();
        $bar = $this->get('doctrine_mongodb')
            ->getRepository('StasmoExampleSampleApiBundle:Bar')
            ->find($id);

        if (!$bar) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $this->deleteBar($bar);
        $this->addSuccessFlash("Deleted bar");

        return $this->redirect($this->get('router')->generate('admin_home'));
    }

    private function generateBarForm($bar) {
        $form = $this->createFormBuilder($bar)
            ->add('Name', 'text')
            ->add('Price', 'text')
            ->add('Sketchiness', 'text')
            ->add('Website', 'text')
            ->add('Cover', 'text')
            ->add('Hours', 'text')
            ->add('Latitude', 'text')
            ->add('Longtitude', 'text')
            ->add('save', 'submit', array('label' => 'Save Bar'))
            ->getForm();
        return $form;
    }

    private function saveBar($bar) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $bar->setLocation([$bar->getLongtitude(), $bar->getLatitude()]);
        $dm->persist($bar);
        $dm->flush();
    }


    private function deleteBar($bar) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->remove($bar);
        $dm->flush();
    }

    private function getBarList($page = 1)
    {
        if (!$page) {
            $page = 1;
        }

        $dm = $this->get('doctrine_mongodb')->getManager();
        $numSkip = ($page-1) * self::resultsPerPage;
        $bars = $dm->createQueryBuilder('StasmoExampleSampleApiBundle:Bar')
            ->limit(self::resultsPerPage)
            ->skip($numSkip)
            ->getQuery()
            ->execute();

        $this->numResults = count($bars);

        return $bars;
    }

    private function getNumberOfBarPages()
    {
        return ceil($this->numResults/self::resultsPerPage);
    }

    private function addSuccessFlash($message)
    {
        $this->get('session')->getFlashBag()->add('success', $message);
    }

    private function addWarningFlash($message)
    {
        $this->get('session')->getFlashBag()->add('warning', $message);
    }

    private function addErrorFlash($message)
    {
        $this->get('session')->getFlashBag()->add('danger', $message);
    }

}
