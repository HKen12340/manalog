<?php
session_start();
require 'dbconnect.php';

$sql = 'select * from task WHERE task_release	= 1 and class = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_SESSION['class']));

require 'index.view.php';