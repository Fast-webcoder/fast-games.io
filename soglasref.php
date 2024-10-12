<?php 

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
$bquery = $con->query("SELECT * FROM users ORDER BY ID DESC");
$buser = $bquery->fetch(PDO::FETCH_ASSOC);
$users = $buser['ID'];

$news = $con->query("SELECT * FROM news");
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
	<link href="/engine/css/sakura.min.css" rel="stylesheet">

<style>
    .card-block {
    box-shadow: 0px 2px 2px rgb(37 37 37 / 24%), 0 3px 9px rgb(25 24 24 / 28%);
    transition: box-shadow .3s;
    width: 100%;
    height: 100%;
    border-radius: 10px;
    background: #222437;
    }

    ::-webkit-scrollbar{width:3px}
    
    ::-webkit-scrollbar-thumb{background:#FFFFFF;border:none;border-radius:0;opacity:.2}
    ::-webkit-scrollbar-track{background:#424242;border:none;border-radius:0}
    ::-webkit-scrollbar {
      width: 8px;
      height: 5px;
      background-color: #48494D;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #686868;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #4A4A4A;
    }    </style>

</head>

<body id="page-top">
    <!-- Logout Modal-->
<div class="modal fade" id="PayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Пополнение счета</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form method="POST" action="/includes/request/pay">
<label>Почта</label>
<input type="text" class="form-control" placeholder="Email" value="<?php echo $user['Email']?>" name="email" required readonly><br>
<label>Сумма</label>
<input type="text" class="form-control" placeholder="Сумма пополнения" id="sum" name="sum" required><br>
<div class="form-group">
<label>Способ оплаты</label>
<select class="form-select" name="method" id="method">
<option value="0" selected />GidPay</option>
</select>
</div>
<button class="btn btn-lg btn-primary btn-block">Оплатить</button>
<a href="/oplata-ua" class="btn btn-facebook btn-user btn-block" onclick="ResetTelegramGoogleAuthentication()">
<i class="fab fa-flag fa-fw"></i> Оплатить с помощью Укр. Карты [🇺🇦]
</a>
</form>
</div>
</div>
</div>
</div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include ('includes/modules/sidebar.php'); ?>
        <!-- End of Sidebar -->
		
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
			<?php include ('includes/modules/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Правила реферальной системы</h6>
                </div>
                <div class="card-body">
                <strong>Правила создания</strong><br><br>
				1.0 - Запрещено создавать оскорбительные/унижительные реферальные промокоды (Пример: Pidoras/Hueglot и.т.п).<br><br>
				1.1 - Запрещено продавать и покупать реферальные промокоды.<br><br>
				1.2 - Запрещено создавать промокоды схожие с промокодом другого пользователя.<br><br>
				1.3 - Запрещено создавать промокоды, где упомянута наша группа, наш YouTube канал (Пример: #nocoode - #maximych).</br></br>
				1.3 - Создавая промокод вы автоматически соглашаетесь со всеми правилами.<br><br>
				1.4 - Абсолютно все реферальные промокоды дают 10% скидки на любой товар (Иск промокоды: #NOCODE или NOCODE).<br><br>
				<strong>Правила пользования</strong><br><br>
				2.0 - Запрещено обманывать пользователей, говорив, что ваш промокод дает 20%, а на самом деле он дает всего лишь 10%.<br><br>
				2.1 - Запрещено форсить промокоды на сайте, в нашей официальной группе вк, в беседе пользователей нашего сайта.<br><br>
				2.2 - Администрация вправе заблокировать или удалить ваш промокод за нарушение правил без подробных описаний нарушения.
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include ('includes/modules/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
     <?php include ('includes/modules/logout.php'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="/engine/vendor/jquery/jquery.min.js"></script>
    <script src="/engine/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/engine/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/engine/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/engine/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/engine/js/demo/chart-area-demo.js"></script>
    <script src="/engine/js/demo/chart-pie-demo.js"></script>

</body>

</html>