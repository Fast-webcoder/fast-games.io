<?php
/* Copyright (c) 2024 FG PANEL| DEVELOPER - vk.com/maksweeb */
session_start();
require('../../../engine/config.php');

// Проверка, если сессия существует
if (!isset($_SESSION['email']) || !isset($_SESSION['pass'])) {
    $response = array(
        'status' => 'error',
        'error' => 'Пользователь не авторизован'
    );
    echo json_encode($response);
    exit;
}

$email = $_SESSION['email'];
$pass = $_SESSION['pass'];


$query = $con->prepare("SELECT * FROM users WHERE Email = ? AND Password = ?");
$query->execute([$email, $pass]);
$user = $query->fetch(PDO::FETCH_ASSOC);
// Проверка, является ли пользователь администратором
if ($user['Admin'] != 1) {
    // Если не администратор, перенаправляем на страницу с сообщением об ошибке или другую страницу
    header('Location: /error_page');
    exit();
}
$save = $con->prepare("INSERT INTO news SET Title = ?, Image = ?, Link = ?");
$save->execute([trim($_POST['Title']), trim($_POST['Image']), trim($_POST['Link'])]); 

$response = array(
    'status' => 'success',
    'success' => 'Новость успешно добавлена!'
);
echo json_encode($response);
exit;
?>
