<?php


function getConnection()
{
    $host = 'localhost';
    $email = 'root';
    $password = 'root';
    $dbName = 'myDB';


    $con = mysqli_connect($host, $email, $password, $dbName);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    return $con;

}


function showAndDie($something)
{
    echo '<pre>';
    Var_dump($something);
    die();
}
function getAllPasswords($con): array
{
    $data = [];
    $sql = "SELECT * FROM email&password";
    $result = $con->query($sql);
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $data[] = $row;
    }
    return $data;
}

function addNewPassword($con, $email, $password)
{
   $sql = "INSERT INTO email&password (email, password) VALUES (\"$email\", \"$password\")";
    if (mysqli_query($con, $sql)) { echo 'New record succesfully created';
} else {
    echo 'Something went wrong'
    }
}

