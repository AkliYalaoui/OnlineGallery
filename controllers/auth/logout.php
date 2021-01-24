<?php
session_start();
require_once "../../vendor/helpers/helpers.php";

if($_SERVER['REQUEST_METHOD'] ===  "POST" && isset($_SESSION['id'])){
   logout("../../views/login.php");
}