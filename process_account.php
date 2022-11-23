<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  <?php include_once "include/head.inc.php" ?>
  <link rel="stylesheet" href="css/admin.css">
  <script src="js/admin.js" defer></script>
</head>


<body>
  <?php
        include_once "include/nav.inc.php";
        //include_once "include/dbcon.inc.php";
        ?>
  <?php
    $fname = $errorMsg = "";
    $success = true;
//if (empty($_POST["lname"])) {
//    $errorMsg .= "Last name is required.<br>";
//    $success = false;
//} else {
    $fname = sanitize_input($_POST["fname"]);
// Additional check to make sure e-mail address is well-formed.
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//       $errorMsg .= "Invalid email format.";
//       $success = false;
//    }
//}
    if ($success) {
        
    } else {
        echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
    }





    $lname = $errorMsg = "";
    $success = true;
    if (empty($_POST["lname"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
// Additional check to make sure e-mail address is well-formed.
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//       $errorMsg .= "Invalid email format.";
//       $success = false;
//    }
    }
    if ($success) {
        // echo "<h4>Change successful!</h4>";
        
    } else {
        echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
    }





    $email = $errorMsg = "";
    $success = true;
    if (empty($_POST["email"])) {
        $errorMsg .= "Old email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
// Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid old email format.";
            $success = false;
        }
    }
    if ($success) {
        // echo "<h4>Change successful!</h4>";
        
    } else {
        // echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
    }
    
    
    
    $new_email = $errorMsg = "";
    $success = true;
    if (empty($_POST["new_email"])) {
        $errorMsg .= "New email is required.<br>";
        $success = false;
    } else {
        $new_email = sanitize_input($_POST["new_email"]);
// Additional check to make sure e-mail address is well-formed.
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid new email format.";
            $success = false;
        }
    }
    if ($success) {
        // echo "<h4>Change successful!</h4>";
        
    } else {
        // echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
    }

//Helper function that checks input for malicious or unwanted content.
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $pwd = $errorMsg = "";
    $success = true;
    if (empty($_POST["pwd"])) {
        $errorMsg .= "Password is required.<br>";
        $success = false;
    }// else {
    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
// Additional check to make sure e-mail address is well-formed.
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//       $errorMsg .= "Invalid email format.";
//       $success = false;
//    }
//}
    if ($success) {
        // echo "<h4>Change successful!</h4>";
        // echo "<p>New password: " . $pwd;
    } else {
        // echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
    }





    $pwd_confirm = $errorMsg = "";
    $success = true;
    if (empty($_POST["pwd_confirm"])) {
        $errorMsg .= "Confirm Password is required.<br>";
        $success = false;
    }// else {
    $pwd_confirm = password_hash($_POST["pwd_confirm"], PASSWORD_DEFAULT);
// Additional check to make sure e-mail address is well-formed.
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//       $errorMsg .= "Invalid email format.";
//       $success = false;
//    }
//}


    if (($_POST["pwd"]) != ($_POST["pwd_confirm"])) {
        $errorMsg .= "Password does not match Confirm Password.<br>";
        $success = false;
    }


    if ($success) {
        // echo "<h4>Change successful!</h4>";
        // echo "<p>Confirm new password: " . $pwd_confirm;
    } else {
        // echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
    }
    ?>


  <?php
    /*
     * Helper function to write the member data to the DB
     */

    function saveMemberToDB() {
        global $fname, $lname, $email, $new_email, $pwd, $errorMsg, $success;
// Create database connection.
        //include_once "include/dbcon.inc.php";
        //$config = parse_ini_file('../private/db-config.ini');
        //$conn = new mysqli(
        //  $config['servername'],
        //  $config['username'],
        //  $config['password'],
        //  $config['dbname']);
        // TEST require_once "../include/dbcon.inc.php";
        // 
        $config = parse_ini_file('/var/www/private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
$config['password'], $config['dbname']);
// Check connection
          //echo "<p>" . $fname . "</p>";
          //  echo "<p>" . $lname . "</p>";
          //  echo "<p>" . $email . "</p>";
          //  echo "<p>" . $pwd . "</p>";
          //  echo "<p>" . $new_email . "</p>";  
          //echo "<p>" . $config['servername'] . "</p>";

        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = "false";
            echo "<p>" . $errorMsg . "</p>";
        } else 
        {
            
          //  echo "<p>conn variable:" . $conn->servername . "</p>";
          //  echo "<p> else statement ran </p>";
// Prepare the statement:
//$stmt = $conn->prepare("INSERT INTO world_of_pets.world_of_pets_members (fname, lname, email, password) VALUES ($fname, $lname, $email, $pwd)");
//            $stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname,
//email, password) VALUES (?, ?, ?, ?)");
            
            
//$sql = "update shophp.users set fname='ac', lname='ac', email='limjunxiangjxxxxx@gmail.com' where email='limjunxiangjx@gmail.com'";
//$stmt = $conn->prepare($sql);
//$stmt->execute();


//$stmt = $conn->prepare("UPDATE shophp.users SET fname=?, lname=?, email=?, password=? WHERE email=?");
            //$stmt = $conn->prepare("UPDATE users SET fname=?, lname=?, email=?, password=? WHERE email=?");
            $stmt = $conn->prepare("UPDATE users SET fname=?, lname=?, password=?, email=? WHERE email=?");
//update shophp.users set fname='ab', lname='ab', username='ab' where email='limjunxiangjx@gmail.com' 
//update shophp.users set fname='ac', lname='ac', email='limjunxiangjxxxxx@gmail.com' where email='limjunxiangjx@gmail.com'
            
            //TESTING $stmt = $conn->prepare("UPDATE users SET fname='MRBEAN' WHERE email='darrenlim0209@gmail.com'");
            
// Bind & execute the query statement:
            $stmt->bind_param("sssss", $fname, $lname, $pwd, $new_email, $email);       
              //$stmt->bind_param("ss", $fname, $email);
            //$stmt->execute();
            
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $success = false;
                echo "<p>" . $errorMsg . "</p>";
            }
            else
            {
                $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
                $stmt->bind_param("s", $new_email);
                $stmt->execute();
                $checkrecord = $stmt->get_result();
                if ($checkrecord->num_rows > 0) {
                    echo "<h4>Change successful!</h4>";
                    echo "<p>First name: " . $fname;
                    echo "<p>Last name: " . $lname;
                    echo "<p>Old email: " . $email;
                    echo "<p>New Email: " . $new_email;
                
                }
                else{
                    echo "<h4>Change Not Successful. There is no such existing records.</h4>";
                    echo "<p>Old email: " . $email;
                }
            }

//$backtrace = debug_backtrace();
//print_r($backtrace);


            $stmt->close();
        }
        
        $conn->close();
    }

    saveMemberToDB();
    ?>




  <?php include_once "include/footer.inc.php"; ?>
</body>

</html>