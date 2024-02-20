<?php

function getPDO(): PDO
{
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbName = 'myDB';

    $pdo = new PDO("mysql:host=$host;dbName=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;


}
function showAndDie($something)
{
    echo '<pre>';
    var_dump($something);
    echo '</pre>';
    die();

}
function getAllMessages(PDO $pdo): array {
    $data = [];
    $sql = "SELECT * FROM messages";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}


