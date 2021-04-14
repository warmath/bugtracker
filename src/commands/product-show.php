<?php
// /src/commands/product-show.php <id>

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Product;

$id = $argv[1];
$product = $entityManager->find(Product::class, $id);

if ($product === null) {
    echo "No product found.\n";
    exit(1);
}

echo sprintf("-%s\n", $product->getName());