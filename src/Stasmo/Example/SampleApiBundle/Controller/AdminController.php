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

    /**
     * @Route("/admin")
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
     * @Route("/new")
     */
    public function newBar(Request $request)
    {
        $method = $request->getMethod();

        // create a task and give it some dummy data for this example
        $bar = new Bar();

        $form = $this->createFormBuilder($bar)
            ->add('Name', 'text')
            ->add('Price', 'text')
            ->add('Sketchiness', 'text')
            ->add('Cover', 'text')
            ->add('Hours', 'text')
            ->add('Latitude', 'text')
            ->add('Longtitude', 'text')
            ->add('save', 'submit', array('label' => 'Add Bar'))
            ->getForm();

            $form->handleRequest($request);

        if ($form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($bar);
            $dm->flush();
        }
        return $this->render(
            'StasmoExampleSampleApiBundle:Admin:add.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    private function getBarList($page = 0)
    {
        $bars = $this->get('doctrine_mongodb')
            ->getRepository('StasmoExampleSampleApiBundle:Bar')
            ->findAll();
        //$pageSize = 10;
        //$start = $page * $pageSize;
        //for ($i = $start; $i < $start+$pageSize; $i++) {
        //    $bars[] = [ 'name' => 'bar'.$i ];
        //}

        return $bars;
    }

    private function getNumberOfBarPages()
    {
        return 5;
    }

}
