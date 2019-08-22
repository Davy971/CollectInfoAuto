<?php

namespace C2I\CollectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use C2I\CollectBundle\Entity\Car;
use C2I\CollectBundle\Form\CarType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('C2ICollectBundle:Car');

        $car = $repository->findAll();

        return $this->render('C2ICollectBundle:Car:index.html.twig',array ('car' => $car));
    }
    public function addAction(Request $request)
    {
        $car = new Car();

        $form= $this->get('form.factory')->createBuilder(CarType::class,$car)
            ->add('Valider', SubmitType::class)
            ->getForm();


        if ($request->isMethod('POST')) 
        {
            $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('collect_car_index');
        }
            return $this->render('C2ICollectBundle:Car:add.html.twig',array('form'=>$form->createView(),));

    }
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('C2ICollectBundle:Car')->find($id);

        if (null === $car) {
          throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
        }

        $form=  $this->get('form.factory')->createBuilder(CarType::class,$car)
        ->add('Valider', SubmitType::class)
        ->getForm();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
          $em->flush();

          $request->getSession()->getFlashBag()->add('success', 'La voiture a bien modifiée.');
          return $this->redirectToRoute('collect_car_index');
        }

        return $this->render('C2ICollectBundle:Color:edit.html.twig', array(
          'form'   => $form->createView(),
        ));
    }
    public function deleteAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('C2ICollectBundle:Car')->find($id);
        if (null === $car) 
        {
        throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
        }
        $em->remove($car);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success', 'La voiture a bien été supprimé.');

        return $this->redirectToRoute('collect_car_index');	
    }
}
