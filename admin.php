<?php
/* Copyright (c) 2024 FG PANEL| DEVELOPER - vk.com/maksweeb */
session_start();
require('engine/config.php');

$email = $_SESSION['email'];
$pass = $_SESSION['pass'];

$query = $con->prepare("SELECT * FROM users WHERE Email = ? AND Password = ?");
$query->execute([$email, $pass]);
$user = $query->fetch(PDO::FETCH_ASSOC);
        $userid = $user['ID'];
	$fullname = $user['FirstName'];
	$lastname = $user['LastName'];
if (!$user || $_SESSION['auth'] == false) {
    header('Location: /authorization');
    exit();       
}

if ($user['Admin'] != 1 && $user['Agent'] != 1) {
    // Если ни администратор, ни агент, перенаправляем на страницу 404
    header('Location: /404');
    exit();
}

$action = trim($_GET['action'] ?? '');
if ($user['Admin'] == 1) {
    switch ($action) {
    case 'index':
        include('includes/admin/index.php');
        break;
	//users
    case 'users':
        include('includes/admin/users/index.php');
        break;
	case 'users-edit':
        include('includes/admin/users/edit.php');
        break;
    case 'invoices':
        include('includes/admin/users/invoices.php');
        break;
	//Промо
	case 'promo':
		include('includes/admin/promo/index.php');
		break;
	case 'promoadd':
		include('includes/admin/promo/add.php');
		break;
	case 'promoedit':
		include('includes/admin/promo/edit.php');
		break;
	//Новости
	case 'news':
		include('includes/admin/news/index.php');
		break;
	case 'newsadd':
		include('includes/admin/news/add.php');
		break;
	case 'newsedit':
		include('includes/admin/news/edit.php');
		break;
	//Уведомления
	case 'uved':
		include('includes/admin/uved/index.php');
		break;
	case 'uvedadd':
		include('includes/admin/uved/add.php');
		break;
	case 'uvededit':
		include('includes/admin/uved/edit.php');
		break;
	//shop
    case 'shops':
        include('includes/admin/shop/index.php');
        break;
    case 'shopadd':
        include('includes/admin/shop/add.php');
        break;
	case 'shops-edit':
        include('includes/admin/shop/edit.php');
        break;
	//Покупки
    case 'purchases':
        include('includes/admin/purchases/index.php');
        break;
	case 'purchases-edit':
        include('includes/admin/purchases/edit.php');
        break;
	//Система
	case 'system':
        include('includes/admin/system.php');
        break;
        case 'tickets':
            include('includes/admin/tickets/index.php');
            break;
        case 'view_ticket':
            include('includes/admin/tickets/view.php');
            break;   
	//Дефолт
    default:
        include('includes/admin/index.php');
		// Отправка сообщения в беседу ВКонтакте
                $message = "Пользователь под $userid ID $fullname $lastname вошел в админ панель!";
                $peer_id = '6'; // Айди беседы
                $access_token = 'vk1.a.RV64IDOJrd4ot8eCoaJP9aMuczo7RTXAwEfPI4ZHEfuBNk31A-OVSLlXw-GZGcFFHSNMADEWC69FZUXR2kGHLET-412VAOzZAQMFg8L1QcVjIUoL8FcXPr3Kw-oqRN1QRhkK55uFWRNk0TenR7nW-RXF1EtcJPDgU-qY2sA7Q8Hw10MiWKx86tcYQSjDtYdvfGqMM9sU-bxUfdM8hY6OUg'; // Токен доступа группы VK

                $request_params = [
                    'chat_id' => $peer_id,
                    'group_id' => '1',
                    'message' => $message,
                    'access_token' => $access_token,
                    'v' => '5.131', // Версия API ВКонтакте
                    'random_id' => rand(1, 999999), // Рандом
                ];

                $response22 = file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($request_params));
        break;
}
}
elseif ($user['Agent'] == 1) {
    switch ($action) {
    case 'tickets':
        include('includes/admin/tickets/index.php');
        break;
    case 'view_ticket':
        include('includes/admin/tickets/view.php');
        break;
	//Дефолт
    default:
        include('/index.php');
        break;
}
}
?>
