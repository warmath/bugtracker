<?php
// /src/commands/product-create.php <name>

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Product;

$newProductName = $argv[1];

$product = new Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";