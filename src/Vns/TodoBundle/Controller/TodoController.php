<?php

namespace Vns\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Vns\Business\Normalizer\JsonClassHintingNormalizer;
use Vns\TodoBundle\Entity\todoItem;

class TodoController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('VnsTodoBundle:Todolist:index.html.twig');
    }

    public function listAction()
    {
    	
    	$repository = $this->getDoctrine()
                   ->getEntityManager()
                   ->getRepository('VnsTodoBundle:todoItem');

		$list_item = $repository->findAll();
		
		$serializer = new Serializer(array(
	    new JsonClassHintingNormalizer(),
		), array(
    	'json' => new JsonEncoder(),
		));

		$serialized = '[';
		foreach($list_item as $item) 
		{
			$serialized .= $serializer->serialize($item, 'json').',';

		}
		$serialized = substr($serialized,0,strlen($serialized)-1);
		$serialized .= ']';
		$response = new Response($serialized);
		$response->headers->set('Content-Type', 'application/json');
		
		return $response;
    }

    public function saveAction($id)
    {
    	$response = new Response();
    	$request = Request::createFromGlobals();
    	$method =$request->server->get('REQUEST_METHOD');

    	$data = json_decode(file_get_contents('php://input'),true);
		$em = $this->getDoctrine()->getEntityManager();
		if($method != 'DELETE')
		{
			if($id == 0)
			{
	    		$todoitem = new todoItem;
	    	} else {
	    		$todoitem = $em->getRepository('VnsTodoBundle:todoItem')->find($id);
	    	}
	    	$todoitem->setTitle($data['title']);
	    	$todoitem->setDone($data['done']);
	    	$todoitem->setBody($data['body']);
	    	$todoitem->setItemOrder($data['itemOrder']);
	    	$todoitem->setCreateAt();
	    	$todoitem->setUpdateAt();
	    	$em->persist($todoitem);
    	} 
    	  else 
    	{
    		$todoitem = $em->getRepository('VnsTodoBundle:todoItem')->find($id);
    		$em->remove($todoitem);

    	}

    	$em->flush();
        // Ici, nous définissons le « Content-type » pour dire que l'on renvoie du JSON et non du HTML.
        //$response->headers->set('Content-Type', 'application/json');
    	
    	
       	return $response;

    }

    public function deleteAction() {


    }
}
