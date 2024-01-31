<!DOCTYPE html>
<?php

require_once ('db.php');

$pdo = getPDO();

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

 $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $pdo->query($query);
    session_start();
    if ($result->num_rows > 0) {
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


    $insertQuery = "INSERT INTO messages (name, massage) VALUES ('$email', '$newMessage')";
    $pdo->query($insertQuery);
}

$pdo = null;
?>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Сторінка з повідомленнями</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script><script>
  function appendComment (email, new_message){
        $("saveMessage").append(
            "<li class='list-group-item'><strong>" + email + "</strong>: " + new_message + "</li>"
        );

          $(document).ready(function () {
        $.ajax({
            url: 'messages.php',
            method: 'GET',
            success: function(request) {
                if (request.data) {
                    request.data.map(function (comment){
                      appendComment(comment.email, comment.new_message)
                    })
                }
            }
        })
      $("newMessage").submit(function (event){
      event.preventDefault()

          let data1 = {
          new_message: $(this).find('input[name="new_message"]').val("заборона")
          };
          $.ajax({
              url: 'create-new-message.php',
              method: 'POST',
              data: data1,
              success: function(request) {
                  appendComment(data1.email, data1.new_message);
                  $("newMessage").trigger("reset");
              }
              //success: function(request) {
                  //console.log('here');
                  // if (request.data) {
                  //     request.data.map(function (comment){
                  //         appendComment(comment.email, comment.new_message)
                  //     })
                  // }
              }
          })
      }
  })
  });

</script>
</head>
<body>
<div class="container">
    <div class="card">
         <div class="card"
        <div class="card-header">
              Чат
        </div>
<ul class="list-group list-group-flush" id="saveMessage">

</ul>
    <br><br><br>

    <?php if ($isAuthorized) { ?>
        <div class="alert alert-success" role="alert">
            Ви авторизовані як: <?php echo $_SESSION['email']; ?>
            <a href="?logout">Вийти</a>
        </div>

        <form  method="post" >
            <div class="mb-3">
                <label for="newMessage"  class="form-label">Нове повідомлення</label>
                <label>
                    <input type="text"
                           class="form-control"
                           name="new_message" required>
                </label>
            </div>
            <button type="submit"
                    class="btn btn-primary">Додати</button>
        </form>
    <?php } else { ?>
        <form id=newMessage method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1"
                       class="form-label">Електронна адреса</label>
                <label>
                    <input type="email"
                           class="form-control"
                           name="email" required>
                </label>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1"
                       class="form-label">Пароль</label>
                <label>
                    <input type="password"
                           class="form-control"
                           name="password" required>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Увійти</button>
        </form>
    <?php } ?>

    <br><br><br>


</div>
</body>
</html>