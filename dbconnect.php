<?php
$dsn = 'mysql:host=localhost;dbname=manalog';
$user = 'root';
$pdo = new PDO($dsn,$user,'');
$pdo->query('SET NAMES utf8');