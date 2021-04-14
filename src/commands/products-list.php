<?php
// /src/commands/products-list.php

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Product;

$productRepository = $entityManager->getRepository(Product::class);
$products = $productRepository->findAll();

foreach ($products as $product) {
    echo sprintf("-%s\n", $product->getName());
}