<?php
session_start();

if(!isset($_SESSION['name']) || !isset($_SESSION['id']) || !isset($_SESSION['email'])){
  header('location:/manalog/login.view.php');
}