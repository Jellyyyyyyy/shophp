<?php
session_start();
if (empty($_POST)) header("Location /home"); // users should not be able to access this file
require_once 'include/functions.inc.php';
require_once 'include/dbcon.inc.php';
turnOnErrorReport();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!empty(isset($_POST["search-query"]))) {
  $searchQuery = "%" . strtolower(sanitize_input($_POST["search-query"])) . "%";
} else {
  $searchQuery = "%1234%"; // Empty = No items found
}

function getSearchFromDB() {
  global $conn, $searchQuery;
  if ($conn->connect_error) {
    setcookie("searchQuery", "Connection error. Please try again later");
  } else {
    $query = $conn->prepare("SELECT * FROM items WHERE name LIKE ?");
    $query->bind_param("s", $searchQuery);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows > 0) {
      $query->close();
      $rows = $result->fetch_assoc();
      setcookie("searchQuery", $rows);
    } else setcookie("searchQuery", "No items found");
  } $conn->close();
  return $rows;
}

getSearchFromDB();

header("Location: /search");