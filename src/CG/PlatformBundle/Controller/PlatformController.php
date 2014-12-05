<?php

namespace CG\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use CG\PlatformBundle\Form\EventType;
use CG\PlatformBundle\Entity\Event;

class PlatformController extends Controller
{
    public function homeAction()
    {
    	$repository = $this->getDoctrine()->getRepository('CGPlatformBundle:Event');
        $events = $repository->findByEnabledWithOrder(true);
        return $this->render('CGPlatformBundle:Platform:home.html.twig', array('events', $events));
    }

    public function addEventAction(Request $request)
    {
    	$event = new Event();
        $form = $this->get('form.factory')->create(new EventType(), $event);
        
        if ($form->handleRequest($request)->isValid())
        {
        	$em = $this->getDoctrine()->getManager();

        	$event->setEnabled(true);

            $em->persist($event);
            $em->flush();

            // Traduction
            $translator = $this->get('translator');
            $message = $translator->trans('event.flashbag.created', array(), 'CGPlatformBundle');
            
            $request->getSession()->getFlashBag()->add('success', $message);
            
            return $this->redirect($this->generateUrl('cg_platform_event_view', array('id' => $event->getId())));
        }
        
        return $this->render('CGPlatformBundle:Event:new.html.twig', array('form' => $form->createView()));
    }


    public function showEventAction($id)
    {
    	$repository = $this->getDoctrine()->getRepository('CGPlatformBundle:Event');
        $event = $repository->findOneById($id);
        
        if (null === $event)
        {
            // Traduction
            $translator = $this->get('translator');
            $message = $translator->trans('event.exception.not_found', array(), 'CGPlatformBundle');

            throw new NotFoundHttpException($message);
        }

        return $this->render('CGPlatformBundle:Event:view.html.twig', array('event' => $event));
    }

    public function listEventsAction()
    {
    	$repository = $this->getDoctrine()->getRepository('CGPlatformBundle:Event');
        $events = $repository->findByEnabledWithOrder(true);

        return $this->render('CGPlatformBundle:Event:list.html.twig', array('events' => $events));
    }

    public function showRatingsAction()
    {
    	// Les évènements avec le plus de dons
    	$repository = $this->getDoctrine()->getRepository('CGPlatformBundle:Event');
        $events = $repository->findAllByDonations();
    }

}
