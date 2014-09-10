<?php

namespace Stasmo\Example\SampleApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    private function getBarList($page = 0)
    {
        $bars = [];
        $pageSize = 10;
        $start = $page * $pageSize;
        for ($i = $start; $i < $start+$pageSize; $i++) {
            $bars[] = [ 'name' => 'bar'.$i ];
        }

        return $bars;
    }

    private function getNumberOfBarPages()
    {
        return 5;
    }

}
