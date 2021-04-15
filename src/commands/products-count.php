<?php
// commands/products-count.php <product-name>

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Product;

$productName = $argv[1];

$productCount = $entityManager->getRepository(Product::class)->count(['name' => $productName]);

echo $productCount . " products founded.\n";