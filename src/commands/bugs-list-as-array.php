<?php
// commands/bugs-list-as-array.php

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Bug;

/*
In the bugs-list.php use-case we retrieved the results as their respective object 
instances. We are not limited to retrieving objects only from Doctrine 
however. For a simple list view like the previous one we only need read access 
to our entities and can switch the hydration from objects to simple PHP arrays 
instead.
Hydration can be an expensive process so only retrieving what you need can 
yield considerable performance benefits for read-only requests.
Implementing the same list view as before using array hydration we can rewrite
our code:
*/

$dql = "SELECT b, e, r, p FROM " . Bug::class . " b JOIN b.engineer e ".
       "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";
$query = $entityManager->createQuery($dql);
$bugs = $query->getArrayResult();

foreach ($bugs as $bug) {
    echo $bug['description'] . " - " . $bug['created']->format('d.m.Y')."\n";
    echo "    Reported by: ".$bug['reporter']['name']."\n";
    echo "    Assigned to: ".$bug['engineer']['name']."\n";
    foreach ($bug['products'] as $product) {
        echo "    Platform: ".$product['name']."\n";
    }
    echo "\n";
}