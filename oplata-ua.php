<?php
/*Copyright (c) 2024 FG PANEL| DEVELOPER - vk.com/maksweeb */
session_start();
require('engine/config.php');

$email = $_SESSION['email'];
$pass = $_SESSION['pass'];

$query = $con->prepare("SELECT * FROM users WHERE Email = ? AND Password = ?");
$query->execute([$email, $pass]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if(!$user || $_SESSION['auth'] == false)
{
    header('Location: /authorization');
    exit();       
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $panelname?> | Магазин скриптов SAMP!</title>
    <link rel="icon" type="image/x-icon" href="/engine/img/logo.ico">
    <link href="/engine/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/engine/alert/style.css" />
    <script src="/engine/alert/cute-alert.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <?php
    if($user['Theme'] == 0) echo('<link href="/engine/css/sb-admin-2.min.css" rel="stylesheet">');
    else if($user['Theme'] == 1) echo('<link href="/engine/css/sb-admin-2-dark.min.css" rel="stylesheet">');
    ?>
    <link href="/engine/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include ('includes/modules/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include ('includes/modules/topbar.php'); ?>
                <div class="container-fluid">
                    </div>
<center>

				<div class="oplata-ua"><center>
				<img class="img-profile rounded-circle" src="/engine/img/avatars/<?php echo $user['Avatar']?>.png" width="100" height="100"><br>
				<span><strong>
				<?php echo $user['FirstName']?></span>
				<span><?php echo $user['LastName']?>
				</span> (ID: <?php echo $user['ID']?>)</strong></center><br>
				<div class="number-zakaz">
                    ℹ Номер заявки: <?php echo $pay_id1?> </div> <br>
                <div class="box-text">
                    ✅ Зайдите в свой интернет-банк (банковское приложение)
                </div>
                <div class="box-text">
                <div class="number-ua"></div> ✅ Номер банковской карты получателя: 4441 1144 0331 7801 (моно)
                </div>
				<div class="box-text">
                <div class="number-ua"></div> ✅ Сумма оплаты: ( курс 1 грн = 2 руб )
                </div>
               <hr class="sidebar-divider">
				<a class="btn btn-primary btn-sm" href="//vk.me/no.code.tech">Я оплатил!</a>
                <br></center>
                <br>
                <br><br><br><br>
		<br><br><br><br><br><br>
    <?php include ('includes/modules/logout.php'); ?>

    <script src="/engine/vendor/jquery/jquery.min.js"></script>
    <script src="/engine/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/engine/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/engine/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="/engine/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/engine/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/engine/js/sb-admin-2.min.js"></script>
    <script src="/engine/vendor/chart.js/Chart.min.js"></script>
    <script src="/engine/js/demo/chart-area-demo.js"></script>
    <script src="/engine/js/demo/chart-pie-demo.js"></script>
	</script>
    </script>
</body>
</html>