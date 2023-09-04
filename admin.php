<?php
  include 'include/conn.php';

  session_start();
  # if user is already logged in take them to panel.php
  if(isset($_SESSION['loggedIN'])) {
    header('Location: panel.php');
    exit();
  }

  #LET ADMIN LOGIN
  if (isset($_POST['send'])) {
      $name = $conn->real_escape_string($_POST['namePHP']);
      $password = $conn->real_escape_string($_POST['passPHP']);

    if (!empty($name) && !empty($password)) {
      $data = $conn->query("SELECT id from admin WHERE name='$name' AND password='$password'");
      if($data->num_rows > 0) {
        $_SESSION['loggedIN'] = '1';
        exit('<font>Login Success!</font>');
      }else {
        exit('<font>Incorrect Details!</font>');
      }
    }else{
      exit('<font>Empty Inputs!</font>');
    }
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JDK EYEWEARS|ADMIN</title>

    <!--MAin CSS file-->
    <link rel="stylesheet" href="css/index.css" />
    <!--BOXICONS CSS-->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>

    <!-- HEADER SECTION -->
    <header>
        <nav class="navbar" id="navbar">
            <a href="index.php">
                <img class="logo" src="images/logo.png" alt="" />
            </a>
        </nav>
    </header>

    <!-- RESPONSE POP UP -->
    <div class="response" id="response"></div>

    <!-- ADMIN SIGNUP SECTION -->
    <section class="admin">
      <div class="col1">
        <img src="images/logo1.png" alt="" />
      </div>
      <div class="col2">
        <h3>JDK ADMIN</h3>
        <form action="#" method="post" class="form">
          <input type="text" class="control" id="name" placeholder="ADMIN NAME" />
          <input type="password" class="control" id="password" placeholder="password" />
          <input type="button" class="btn"  id="login" value="LOGIN" />
        </form>
      </div>
    </section>
    
    <!-- FOOTER SECTION -->
    <!-- <?php include_once 'include/footer.php'?> -->

    <!-- JAVASCRIPT CODE AND LINKS  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
          $(".form").on("submit", function (e) {
              e.preventDefault();
          });
          $("#login").on("click", function () {
              let name = $('#name').val();
              let password = $('#password').val();

              $.ajax({
                  url: "admin.php",
                  method: "POST",
                  data: {
                      send: 1,
                      namePHP: name,
                      passPHP: password
                  },
                  success: function (response) {
                      if(response) {
                          $("#response").html(response);
                          $("#response").css("display", "block");
                          setTimeout(() => {
                              $("#response").css("display", "none");
                          }, 7000);
                          if (response.indexOf('Success') > 0) {
                              window.location = "panel.php";
                          }
                      }
                  },
                  dataType: "text",
              })
          })
      })

    </script>

  </body>
</html>