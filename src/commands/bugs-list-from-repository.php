<?php
// commands/bugs-list-from-repository.php

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Bug;
use Doctrine\ORM\EntityRepository;

$bugs = $entityManager->getRepository(Bug::class)->findAll();

foreach ($bugs as $bug) {
    echo $bug->getDescription()." - ".$bug->getCreated()->format('d.m.Y')."\n";
    echo "    Reported by: ".$bug->getReporter()->getName()."\n";
    echo "    Assigned to: ".$bug->getEngineer()->getName()."\n";
    foreach ($bug->getProducts() as $product) {
        echo "    Platform: ".$product->getName()."\n";
    }
    echo "\n";
}

/*
Using EntityRepositories you can avoid coupling your model with specific query 
logic. You can also re-use query logic easily throughout your application.
*/