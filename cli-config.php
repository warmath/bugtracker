<?php
// cli-config.php
require_once "bootstrap.php";

use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet($entityManager);

/*
 Para criar o schema no banco de dados
 
    vendor/bin/doctrine orm:schema-tool:create


 Para recriar o schema no banco de dados

    vendor/bin/doctrine orm:schema-tool:drop --force
    vendor/bin/doctrine orm:schema-tool:create


 Para atualizar o schema no banco de dados

    vendor/bin/doctrine orm:schema-tool:update --force
    ou
    vendor/bin/doctrine orm:schema-tool:update --force --dump-sql

 */