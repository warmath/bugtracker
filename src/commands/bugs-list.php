<?php
// commands/bugs-list.php

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Bug;
use Doctrine\DBAL\Logging\DebugStack;

$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

$dql = 'SELECT b, e, r FROM ' . Bug::class . ' b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC';

$query = $entityManager->createQuery($dql);
$query->setMaxResults(30);
$bugs = $query->getResult();

foreach ($bugs as $bug) {
    echo $bug->getDescription()." - ".$bug->getCreated()->format('d.m.Y')."\n";
    echo "    Reported by: ".$bug->getReporter()->getName()."\n";
    echo "    Assigned to: ".$bug->getEngineer()->getName()."\n";
    foreach ($bug->getProducts() as $product) {
        echo "    Platform: ".$product->getName()."\n";
    }
    echo "\n";
}

print_r($debugStack);

/*
Uma consulta pontual com muitos relacionamentos pode ser mais interessante com 
DQL em contraponto ao Repository.
*/