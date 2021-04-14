<?php
// commands/bug-show.php <id>

require_once "../bugtracker/bootstrap.php";

use Bugtracker\Model\Bug;

$theBugId = $argv[1];

$bug = $entityManager->find(Bug::class, (int)$theBugId);

echo "Bug: ".$bug->getDescription()."\n";
echo "Engineer: ".$bug->getEngineer()->getName()."\n";

/*
Since we only retrieved the bug by primary key both the engineer and reporter 
are not immediately loaded from the database but are replaced by LazyLoading 
proxies. These proxies will load behind the scenes, when the first method is 
called on them.
*/