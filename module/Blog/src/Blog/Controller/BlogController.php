<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{

    public function indexAction()
    {
        $objectManager = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $entry = new \Blog\Model\Entity\Entry();
        $entry->setTitle('First entry');

        $objectManager->persist($entry);
        $objectManager->flush();

        die(var_dump($entry->getId())); // yes, I'm lazy
    }


}

