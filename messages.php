<?php

require_once ('db.php');

$pdo = getPDO();

$messages = getAllMessages($pdo);

$pdo = null;

header('content-type: application/json; charset=utf-8');
json_encode(['data' => $messages]);