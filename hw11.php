<!DOCTYPE html>
<?php

require_once('db.php');

$con = getConnection();


if (!empty($_POST['email']) && !empty($_POST['password'])) {
    addNewPassword($con, $POST['email'], $_POST['password']);
}
$password = getAllPasswords($con);
mysqli_close($con);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">

    <div class="card">
        <div class="card-header">
            Chat
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($password as $password) : ?>
                <li class="list-group-item">
                    <strong><? $password['email'] ?></strong> at
                    <? $password['date'] ?> :
                    <i><? $password['password'] ?></i>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <br><br><br>


    <div class="alert alert-success-alert" role="alert">
        Ви намагались залогінитись з Email:
        <?php
        echo $_POST['email'];
        ?>

        <br><br><br>

        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>

                <br>

                <input
                        type="email"
                        class="form-control"
                        name="email"
                        required
                >

                <br><br>

            </div>
            <div class="mb-3">
                <label
                        for="exampleInputPassword1"
                        class="form-label">Password</label>

                <br>

                <input
                        type="password"
                        class="form-control"
                        name="password"
                        required
            </div>

            <br><br>

            <button
                    type="submit"
                    class="btn btn-primary">Sign up</button>

        </form>
    </div>

</body>
</html>


