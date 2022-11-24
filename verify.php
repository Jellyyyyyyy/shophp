<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Verification</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/verify.css">
</head>

<body>
  <?php include_once 'include/nav.inc.php' ?>
  <main>
    <div class="message">
      <?php require_once 'include/functions.inc.php';
      // Variables
      $email = $token = $titleMsg = '';
      $loginLink = '<a href="/login">Login</a>';
      $registerLink = '<a href="/register">Register</a>';

      // Start connection
      include_once "include/dbcon.inc.php";

      // Getting data from link
      if ((isset($_GET['email']) && !empty($_GET['email'])) || (isset($_GET['token']) && !empty($_GET['token']))) {
        $email = sanitize_input($_GET['email']);
        $token = sanitize_input($_GET['token']);
        $query = $conn->prepare("SELECT email, token, verified FROM users WHERE email=? AND token=? AND verified='0';");

        // Binding and executing query
        $query->bind_param("ss", $email, $token);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $userToken = $row['token'];
          $query->close();

          if ($token == $userToken) {
            $updateQuery = $conn->prepare("UPDATE users SET verified='1' WHERE email=?;");
            $updateQuery->bind_param("s", $email);
            $updateQuery->execute();
            echo "<span class='message-text'>Account verified!<br>Click here to " . $loginLink . "</span>";
          }
        } else {
          echo "<span class='message-text'>Account not found or already verified.<br>Click here to " . $loginLink . " or " . $registerLink . "</span>";
        }
        $updateQuery->close();
      } else {
        echo "<span class='message-text'>Account not found or already verified.<br>Click here to " . $loginLink . " or " . $registerLink . "</span>";
      }
      $conn->close();
      ?>
    </div>
  </main>
</body>

</html>