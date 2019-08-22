<?php
// src/C2I/CollectBundle/DataFixtures/ORM/LoadCar.php

namespace C2I\CollectBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use C2I\CollectBundle\Entity\Car;

class LoadCar implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $names = array('Clio', 'Laguna', '206');

    foreach ($names as $name) {
      $car = new Car();
      $car->setName($name);
      $manager->persist($car);
    }
    $manager->flush();
  }
}