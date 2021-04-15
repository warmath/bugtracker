<?php
// bug-close.php <bug-id>

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Bug;

$theBugId = $argv[1];

$bug = $entityManager->find(Bug::class, (int)$theBugId);
$bug->close();

$entityManager->flush();