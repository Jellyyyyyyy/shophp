<?php
session_start();
if (empty(isset($_SESSION["user"]))) {
    header("location: /login");
    exit();
}
