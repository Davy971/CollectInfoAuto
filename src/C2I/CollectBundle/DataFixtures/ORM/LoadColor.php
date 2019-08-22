<?php
// src/C2I/CollectBundle/DataFixtures/ORM/LoadColor.php

namespace C2I\CollectBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use C2I\CollectBundle\Entity\Color;

class LoadColor implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $names = array('Vert', 'Bleu', 'Grise','Rouge','Blanc','Noir');

    foreach ($names as $name) {
      $color = new Color();
      $color->setName($name);
      $manager->persist($color);
    }
    $manager->flush();
  }
}