<?php
if (!isset($conn)) {
  global $conn;
  $config = parse_ini_file('../private/db-config.ini');
  $conn = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
  );
}