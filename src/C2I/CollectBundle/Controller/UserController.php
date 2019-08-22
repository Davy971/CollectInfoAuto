<?php

namespace C2I\CollectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use C2I\CollectBundle\Entity\User;
use C2I\CollectBundle\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends Controller
{
	public function indexAction()
	{
		$repository = $this->getDoctrine()->getManager()->getRepository('C2ICollectBundle:User');

        $user = $repository->findAll();

        return $this->render('C2ICollectBundle:User:index.html.twig',array ('user' => $user));
	}
	
	public function info_userAction(Request $request)
	{
		$user = new User();

        $form= $this->get('form.factory')->createBuilder(UserType::class,$user)
            ->add('Valider', SubmitType::class)
            ->getForm();


        if ($request->isMethod('POST')) 
        {
            $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        	$request->getSession()->getFlashBag()->add('success', 'Votre formulaire a bien été pris en compte, merci');
            return $this->redirectToRoute('collect_user_info');
        }
            return $this->render('C2ICollectBundle:User:info_user.html.twig',array('form'=>$form->createView(),));
	}
}