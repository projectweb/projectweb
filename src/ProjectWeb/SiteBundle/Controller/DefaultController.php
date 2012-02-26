<?php

namespace ProjectWeb\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjectWeb\SiteBundle\Entity\Inquiry;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('ProjectWebSiteBundle:Default:index.html.twig');
    }

    public function contactAction(Request $request) {
        $inquiry = new Inquiry;
        $form = $this->createFormbuilder($inquiry)
            ->add(
                'senderName', 'text',
                array('label' => 'Name', 'required' => true)
            )
            ->add(
                'senderEmail', 'email',
                array('label' => 'Email', 'required' => false)
            )
            ->add(
                'subject', 'text',
                array(
                    'label' => 'Subject',
                    'attr' => array('class' => 'fieldFull'), 'required' => false
                )
            )
            ->add(
                'message', 'textarea',
                array('required' => true)
            )
            ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject("[ProjectWeb Inquiry] {$inquiry->getSubject()}")
                    ->setFrom($inquiry->getEmail())
                    ->setTo('team@projectweb.ph')
                    ->setBody(
                        $inquiry->getName() . "\n\n" . $inquiry->getMessage()
                    );
                $this->get('mailer')->send($message);
                return $this->render(
                    'ProjectWebSiteBundle:Default:contact_success.html.twig'
                );
            }
        }
        return $this->render(
            'ProjectWebSiteBundle:Default:contact.html.twig',
            array('form' => $form->createView())
        );
    }
}
