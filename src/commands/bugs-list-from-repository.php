<?php
// commands/bugs-list-from-repository.php

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Bug;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Logging\DebugStack;

/*
Using EntityRepositories you can avoid coupling your model with specific query 
logic. You can also re-use query logic easily throughout your application.
Ocorre que utilizar repository para questoes complexas, com filtros e joins, 
pode gerar uma cadeia de instrucoes SQL desnecessariamente onerosa. 
Uma forma de verificar isso e deixar o doctrine em modo de desenvolvimento e 
criar um SQL Logger para analisar as queries geradas, observe:
*/
$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

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

print_r($debugStack);

/* 
Com DQL talvez isso pudesse ser otimizado. Ver em bugs-list.php;
*/