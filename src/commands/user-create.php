<?php
// commands/user-create.php <user-name>
require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\User;

$newUsername = $argv[1];

$user = new User();
$user->setName($newUsername);

$entityManager->persist($user);
$entityManager->flush();

echo "Created User with ID " . $user->getId() . "\n";