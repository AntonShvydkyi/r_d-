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
function getAllMessages(PDO $pdo) : array {
    $data = [];
    $sql = "select * from messages";
    $result = $pdo->query($sql)->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $result->fetch()) {
        $data[] = $row;
    }
    return $data;
}

function addNewMessage(PDO $pdo, string $name, string $message)
{
    $sql = "INSERT INTO messages (name, message) VALUES (:name, :message)";
    $result = $pdo->prepare($sql);
    $params = compact('name', 'message');

    if (!$result->execute($params)) {
        echo 'Someting went wrong';
    }
}

function deleteMessage($pdo, $id)
{
    $sql = "DELETE FROM messages WHERE id=:id";
    $result = $pdo->prerare($sql);

    if (!$result->execute(['id' => $id])){
        echo 'Someting went wrong';
    }
}


