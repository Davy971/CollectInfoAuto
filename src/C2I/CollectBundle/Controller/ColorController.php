<?php

namespace C2I\CollectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use C2I\CollectBundle\Entity\Color;
use C2I\CollectBundle\Form\ColorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ColorController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()->getManager()->getRepository('C2ICollectBundle:Color');

    	$color = $repository->findAll();

        return $this->render('C2ICollectBundle:Color:index.html.twig',array ('color' => $color));
        
    }
    public function addAction(Request $request)
    {
        $color = new Color();
        
            $form= $this->get('form.factory')->createBuilder(ColorType::class,$color)
                ->add('Valider', SubmitType::class)
                ->getForm();

        
            if ($request->isMethod('POST')) 
            {
                $form->handleRequest($request);

                $em = $this->getDoctrine()->getManager();
                $em->persist($color);
                $em->flush();

                return $this->redirectToRoute('collect_color_index');
            }
            return $this->render('C2ICollectBundle:Color:add.html.twig',array('form'=>$form->createView(),));

    }
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $color = $em->getRepository('C2ICollectBundle:Color')->find($id);

        if (null === $color) {
          throw new NotFoundHttpException("La couleur d'id ".$id." n'existe pas.");
        }

        $form=  $this->get('form.factory')->createBuilder(ColorType::class,$color)
        ->add('Valider', SubmitType::class)
        ->getForm();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
          $em->flush();

          $request->getSession()->getFlashBag()->add('success', 'Couleur bien modifiée.');
          return $this->redirectToRoute('collect_color_index');
        }

        return $this->render('C2ICollectBundle:Color:edit.html.twig', array(
          'form'   => $form->createView(),
        ));

    }
    public function deleteAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $color = $em->getRepository('C2ICollectBundle:Color')->find($id);
        if (null === $color) 
        {
        throw new NotFoundHttpException("La couleur d'id ".$id." n'existe pas.");
        }
        $em->remove($color);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success', 'La couleur a bien été supprimé.');


        return $this->redirectToRoute('collect_color_index');

    }
}
