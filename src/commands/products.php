<?php
// commands/products.php

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Bug;

$dql = "SELECT p.id, p.name, count(b.id) AS openBugs FROM " . Bug::class . " b ".
       "JOIN b.products p WHERE b.status = 'OPEN' GROUP BY p.id";
$productBugs = $entityManager->createQuery($dql)->getScalarResult();

foreach ($productBugs as $productBug) {
    echo $productBug['name']." has " . $productBug['openBugs'] . " open bugs!\n";
}

/*
Doctrine also supports the retrieval of non-entities through DQL. These values 
are called scalar result values and may even be aggregate values using COUNT, 
SUM, MIN, MAX or AVG functions.
*/