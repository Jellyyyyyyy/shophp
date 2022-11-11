<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verification</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/nav.css" />
  <link rel="stylesheet" href="css/verify.css">
  <script src="js/nav.js" defer></script>
</head>

<body>
  <?php 
    include 'nav.inc.php'
  ?>
  <div class="message">
    <?php
    function sanitize_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // Variables
    $email = $token = $titleMsg = '';
    $loginLink = '<a href="/login">Login</a>';
    $registerLink = '<a href="/register">Register</a>';

    // Start connection
    $config = parse_ini_file('../private/db-config.ini');
    $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Getting data from link
    if ((isset($_GET['email']) && !empty($_GET['email'])) || (isset($_GET['token']) && !empty($_GET['token']))) {
      $email = sanitize_input($_GET['email']);
      $token = sanitize_input($_GET['token']);
      $query = $conn -> prepare("SELECT user_email, user_token, verified FROM shophp_users WHERE user_email=? AND user_token=? AND verified='0';");

      // Binding and executing query
      $query -> bind_param("ss", $email, $token);
      $query -> execute();
      $result = $query -> get_result();
      
      if ($result -> num_rows > 0) {
        $row = $result -> fetch_assoc();
        $userToken = $row['user_token'];
        $query -> close();

        if ($token == $userToken) {
          $updateQuery = $conn -> prepare("UPDATE shophp_users SET verified='1' WHERE user_email=?;");
          $updateQuery -> bind_param("s", $email);
          $updateQuery -> execute();
          echo "<span class='message-text'>Account verified!<br>Click here to " . $loginLink . "</span>";
        }
      } else {
        echo "<span class='message-text'>Account not found or already verified.<br>Click here to " . $loginLink . " or " . $registerLink . "</span>";
      }
      $updateQuery -> close();
    } else {
      echo "<span class='message-text'>Account not found or already verified.<br>Click here to " . $loginLink . " or " . $registerLink . "</span>";
    } $conn -> close();
  ?>
  </div>
</body>

</html>