<?php
require __DIR__ . '/class/Database.php';
require __DIR__ . '/functions/functions.php';

$pdo = new Database();
$start = $pdo->getInstance();

readData($start);