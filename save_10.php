<?php
session_start();
$text = $_POST['text'];

$pdo = new PDO("mysql:host=localhost;dbname=study_project;", "root", "");

$sql = "SELECT * FROM my_table WHERE text=:text";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
    $message = "Введенная запись уже существует!";
    $_SESSION['danger'] = $message;
    header("Location: /task_10.php");
    exit();
}

$sql = "INSERT INTO my_table (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

$message = "Запись записана в таблицу!";
$_SESSION['success'] = $message;

header("Location: /task_10.php");
