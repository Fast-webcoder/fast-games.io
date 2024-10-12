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
<form method="POST" action="includes/request/pay">
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include 'includes/modules/sidebar.php'; ?>
		
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'includes/modules/topbar.php'; ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Вопросы и ответы на них</h1>
                    </div>
					
					<div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Вопросы касаемые нашего сайта</h6>
                    </div>
					<div class="card-body">
                    <div class="card shadow mb-4">
                    <a href="#Question1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Как пополнить баланс?</h6>
                    </a>
                    <div class="collapse" id="Question1">
                    <div class="card-body">
                    Пополнить баланс можно на любой странице сайта, нажав на кнопку «Пополнить баланс» (даже если вы с Украины).
					</br>
					Можно выбрать любой способ оплаты (GidPay - Оплата UA картой)
					</br>
					Если вы оплатили UA картой сообщите об этом технической поддержке для выдачи баланса. >> <a href="https://vk.me/no.code.tech" style="color:#ff0000" target="_blank">Техническая поддержка</a>
                    </div>
					</div>
					</div>
                    <div class="card shadow mb-4">
                    <a href="#Question2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Товары продаются навсегда?</h6>
                    </a>
                    <div class="collapse" id="Question2">
                    <div class="card-body">
					Все товары кроме кроме игрового мода выдаются навсегда. Мод выдается ровно на год в связи с большими затратами на обновления.
                    </div>
					</div>
					</div>
                    <div class="card shadow mb-4">
                    <a href="#Question3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">У меня забрали/заблокировали купленный товар, почему?</h6>
                    </a>
                    <div class="collapse" id="Question3">
                    <div class="card-body">
                    Если у вас забрали/заблокировали купленный товар, то вы нарушили правил(а/о) из <a href="https://lk.no-codes.ru/shop?action=terms_of_use" style="color:#ff0000" target="_blank">пользовательского соглашения</a>.
					В скором времени вам вернут ваш купленный товар, если нарушение не критично.
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Я написал в тех. поддержку, когда мне ответят?</h6>
                    </a>
                    <div class="collapse" id="Question4">
                    <div class="card-body">
                    Время ответа тех. поддержки на ваш вопрос варьируется от 5 минут до 24 часов.
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question5" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Я пополнил баланс, но он не начислился</h6>
                    </a>
                    <div class="collapse" id="Question5">
                    <div class="card-body">
					Если вы провели оплату со статусом "Успешно" но вам не начислился баланс, обратитесь в техническую поддержку
					</br> предвалительно приложив скриншот оплаты. <a href="https://vk.com/no.code.tech" style="color:#ff0000" target="_blank">Техническая Поддержка</a>
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question6" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Я не нашел ответ на свой вопрос</h6>
                    </a>
                    <div class="collapse" id="Question6">
                    <div class="card-body">
					Любой вопрос вы можете задать тут >> <a href="https://vk.com/no.code.tech" style="color:#ff0000" target="_blank">Техническая Поддержка</a>
					</div>
					</div>
					</div>
					</div>
					</div>
					<br>
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Вопросы касаемые мода</h6>
                    </div>
					<br>
					<div class="card shadow mb-4">
                    <a href="#Question7" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Как часто происходят обновления модов?</h6>
                    </a>
                    <div class="collapse" id="Question7">
                    <div class="card-body">
					Обновления мода ARIZONA RP происходят каждые 5-7 дней.
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question8" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Что делать если сервер определяется как Unknown?</h6>
                    </a>
                    <div class="collapse" id="Question8">
                    <div class="card-body">
					Может быть несколько причин возникновения этой ошибки.<br>
					Самая частая причина это неправильное подключение базы данных.
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question9" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Маска демона при авторизации/регистрации на сервере</h6>
                    </a>
                    <div class="collapse" id="Question9">
                    <div class="card-body">
					Если при регистрации появляется красная маска демона, мод определяется как Unknown<br>
					или же регистрация после авторизации на сервере, то проблем может быть куча.<br>
					Самые частые причины это: неправильно подключенная база данных, ошибки в консоле сервера<br>
					и не все прописанные плагины в server.cfg
					</div>
					</div>
					</div>
					</div>
					<br>
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Вопросы касаемые лаунчеров ARZ PC - ARZ MOBILE</h6>
                    </div>
					<br>
					<div class="card shadow mb-4">
                    <a href="#Question10" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Как часто происходят обновления лаунчеров?</h6>
                    </a>
                    <div class="collapse" id="Question10">
                    <div class="card-body">
					Лаунчеры получают обновление спустя неделю после выхода на оригинальной ARIZONA RP.
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question11" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Что делать если не работает CEF на сервере</h6>
                    </a>
                    <div class="collapse" id="Question11">
                    <div class="card-body">
					Может быть несколько причин возникновения этой ошибки.<br>
					Самая частая причина это не включенный параметр "Новая авторизация".
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question12" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Что делать если пишет "Сервер загрузки не отвечает"</h6>
                    </a>
                    <div class="collapse" id="Question12">
                    <div class="card-body">
					Разберем пару частых причин
					</br>
					1 - Вы не настроили лаунчер когда купили его (В пункте "Настройки")
					</br>
					2 - Технические работы на Arizona RP (Обычно это занимает пары часов времени)
					</br>
					</div>
					</div>
					</div>
					<div class="card shadow mb-4">
                    <a href="#Question13" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Question1">
                    <h6 class="m-0 font-weight-bold text-primary">Что делать если неотображается сервер в лаунчере</h6>
                    </a>
                    <div class="collapse" id="Question13">
                    <div class="card-body">
					Пара частых причин
					</br>
					1 - Возможно у вас выключен сервер или же он запустился но с ошибкой UNKNOWN
					</br>
					2 - Вы не настроили лаунчер когда купили его, в разделе "Настройки".
					</div>

                </div>
                <!-- /.container-fluid -->

            </div>
			</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © <?php echo $panelname?> 2024</span>
                    </div>
                </div>
            </footer>
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
	</script>

</body>

</html>