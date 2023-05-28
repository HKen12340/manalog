<?php
session_start();
require 'dbconnect.php';
require_once 'check.php';

$sql = 'select * from task WHERE task_release	= 1 and class = :class';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':class',$_SESSION['class']);
$stmt->execute();

require 'index.view.php';