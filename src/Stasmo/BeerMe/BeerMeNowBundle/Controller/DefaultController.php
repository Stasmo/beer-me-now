<?php

namespace Stasmo\BeerMe\BeerMeNowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     */
    public function defaultAction(Request $request)
    {
        $method = $request->getMethod();
        if ($method === "POST") {
            //extract search data from $request object
        }

        return $this->render('StasmoBeerMeBeerMeNowBundle:Default:index.html.twig');
    }

    /**
     * @Route("/search")
     */
    public function searchAction(Request $request)
    {
        $method = $request->getMethod();
        if ("POST" === $method) {
            $searchString = $request->request->get('searchString');
            return $this->geocodeResults($searchString);
        }
    }

    private function geocodeResults($searchString)
    {
        
    }

    /**
     * @Route("/bars/{id}")
     */
    public function barAction($id)
    {
    	//$bar = $this->getDatabase()->getBarById($id);
    	//return $this->respond($bar);
    	return $this->respond('{ location: {}, description: "", rating: 4.5 }');
    }

    /**
     * @Route("/bars")
     * @Route("/bars/")
     */
    public function barsAction()
    {
    	//$bars = $this->getDatabase()->getAllBars();
    	//return $this->respond($bars);
    	return $this->respond('{ bars: [] }');
    }

    private function respond($input)
    {
    	$response = new Response($input);
    	//see http://api.symfony.com/2.5/Symfony/Component/HttpFoundation/Response.html
		$response->setStatusCode(Response::HTTP_OK);
    	$response->headers->set('Content-Type', 'application/json');
    	return $response;
    }
}
