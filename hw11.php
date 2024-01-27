<!DOCTYPE html>
<?php


// Підключення до бази даних
$host = 'localhost';
$username = 'root';
$password = 'root';
$dbName = 'myDB';

$con = mysqli_connect($host, $username, $password, $dbName);

    if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        // Користувача знайдено, встановлення сесії
        $_SESSION['is_auth'] = true;
        $_SESSION['email'] = $email;
    }
}

     if (isset($_GET['logout'])) {
         session_destroy();
         header('Location: index.php');
         exit();
     }

      $isAuthorized = isset($_SESSION['is_auth']) && $_SESSION['is_auth'];

     if ($isAuthorized && !empty($_POST['new_message'])) {
          $newMessage = $_POST['new_message'];


         $insertQuery = "INSERT INTO messages (user_email, message) VALUES ('$email', '$newMessage')";
          $con->query($insertQuery);
}


function showAndDie($something)
{
    echo '<pre>';
    Var_dump($something);
    die();
}
      function getAllMessages($con) : array {
$data = [];
$sql = "select * from messages";
$result = $con->query($sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data[] = $row;
}
return $data;
}

showAndDie(getAllMessages($con));

mysqli_close($con);
?>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Сторінка з повідомленнями</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <br><br><br>

        <?php if ($isAuthorized) { ?>
            <div class="alert alert-success" role="alert">
    Ви авторизовані як: <?php echo $_SESSION['email']; ?>
    <a href="?logout">Вийти</a>
</div>

<form method="post">
    <div class="mb-3">
        <label for="newMessage" class="form-label">Нове повідомлення</label>
        <input type="text" class="form-control" name="new_message" required>
    </div>
    <button type="submit" class="btn btn-primary">Додати</button>
</form>
<?php } else { ?>
    <form method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Електронна адреса</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Увійти</button>
    </form>
<?php } ?>

<br><br><br>

<h2>Збережені повідомлення</h2>

<?php while ($row = $resultMessages->fetch_assoc()) { ?>
    <div class="card">
        <div class="card-body">
            <?php echo $row['message']; ?>
        </div>
    </div>
    <br>
<?php } ?>
</div>
</body>
</html>

