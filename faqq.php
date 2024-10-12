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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include ('includes/modules/sidebar.php'); ?>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
			<?php include ('includes/modules/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Сотрудничество</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="card-body">

                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="card-toolbar">
                                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                        <li class="nav-item mr-3">
                                            <a class="nav-link active show" data-toggle="tab" href="#info">
                                            <span class="nav-icon">
                                            <i class="fas fa-cog"></i>
                                            </span>
                                            <span class="nav-text font-size-lg">Информация</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link " data-toggle="tab" href="#referal">
                                            <span class="nav-icon">
                                            <i class="fa fa-tag"></i>
                                            </span>
                                            <span class="nav-text font-size-lg">Реферальная программа</span>
                                            </a>
                                        </li>
                                        <?
                                        if($user['ReferalCode'] == 1) echo('<li class="nav-item mr-3">
                                            <a class="nav-link " data-toggle="tab" href="#preroll">
                                            <span class="nav-icon">
                                            <i class="fas fa-photo-video"></i>
                                            </span>
                                            <span class="nav-text font-size-lg">Преролл</span>
                                            </a>
                                        </li>')
                                        ?>                                                                                                                           
                                        </ul>                                        
                                    </div>
                                        </a>
                                            </li>
                                                </ul>
                                    </div>
                                    <div class="card-body">
                                    <div class="tab-content">
                                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    Сотрудничество - это к началу совместная деятельность, которая приносит множество плюсов каждому участнику. <br>
                                    Мы готовы сотрудничать с каждым из вас, хоть Вы и малоизвестный. Взамен мы даем вам возможный опыт и общение с другими.<br><br>
                                    Чтобы проложить путь к началу сотрудничества, Вам нужно подходить по критериям:<br>
                                    1. Заниматься деятельностью похожей на нашу.<br>
                                    2. Иметь от 50 подписчиков и от 150+ просмотров стабильно.<br>
                                    3. Стараться выпускать записи минимум раз в неделю.<br>
                                    4. Быть общительным, интересным и любопытным, чтобы получить опыт от других.<br><br>
                                    Если вы подходите по критериям, то смело можете отписать <strong><a class="collapse-item" href="https://vk.com/no.code.tech" target="_blank">Технической поддержке.</a></strong>
                                    </div>
                                    <div class="tab-pane fade" id="preroll" role="tabpanel">
                                        <iframe width="1150" height="500" src="https://www.youtube.com/embed/Qr-olpsEkWQ?autoplay=0&amp;showinfo=0&amp;controls=0&amp;rel=0" frameborder="0" allowfullscreen=""></iframe></br></br>
                                        <center><strong>Скачать данный преролл: <a class="collapse-item" href="lk.no-codes.ru" target="_blank">Тык</a></strong></center>
                                    </div>
                                    <div class="tab-pane fade " id="referal" role="tabpanel">
                                        <div class="row">
                                        <div class="col-lg-3 mb-4">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Информация</h6>
                                                </div>
                                                <div class="text-center">
                                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="border-radius: 50px; width: 25rem;" src="/engine/img/referal-program.jpg" alt="...">
                                                </div>
                                                <hr>
                                                <center>
                                                <p><strong>
                                                Ваш промокод: <span style="color:#ff0000">
                                                    <? 
                                                    if($user['ReferalCode'] == 0) echo('Не создан')?>
                                                    <?
                                                    if($user['ReferalCode'] == 1) echo $referal['name']?></span><br>
                                                Реферальный баланс: <span style="color:#ff0000">
                                                    <?
                                                    if($user['ReferalCode'] == 0) echo ('0');
                                                    else echo $referal['ReferalBalance']?> ₽</span>
                                                </strong></p>
                                                <?php
                                                if($user['ReferalCode'] == 0) echo('<form class="user d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100">
                                                <p><button type="button" class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#Referal">Создать промокод</button>');

                                                else echo('<form class="user d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100">
                                                <p><button type="button" class="btn btn-primary btn-user btn-block" href="#" onclick="myFunction()">Скопировать промокод</button>')
                                                ?>
                                                </center>
                                            </div>
                                        </div>
                                         <div class="col-lg-9 mb-4">       
                                            <div class="card shadow mb-4">
                                                <div class="card-header">
                                                    <div class="card-body">
                                                    <div class="tab-content">
                                                    <center><h3>Что это?</h3></center>
                                                    Реферальный промокод - это личный код для приглашения. Другие люди введя реферальный код и подтвердив его, смогут получить скидку в несколько процентов!<br>
                                                    <center><h3>Как это работает?</h3></center>
                                                    После создания вашего реферального кода, люди смогут его активировать при покупке нашего товара в магазине. После покупки Вам будут начисляться проценты с покупок от тех людей, которые ввели ваш реферальный код и Вы в любой момент сможете сделать выплату на баланс вашего аккаунта.
                                                    <center><h3>Как привлечь людей к активации кода?</h3></center>
                                                    Вы сможете распространять свой код на любых площадках(Twitch, YouTube, Telegram), но не нарушая при этом правила.
                                                    <center><h3>Что делать потом?</h3></center>
                                                    Как только Вы получите реферальный код, Вы автоматически станите нашими партнерами. Вам нужно будет отписать нашему менеджеру о том, что Вы стали партнером и получить дальнейшие указания.
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
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

    <!-- Logout Modal-->
     <?php include ('includes/modules/logout.php'); ?>

    <div class="modal fade" id="Referal" tabindex="-1" role="dialog" aria-labelledby="ReferalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="ReferalLabel">Создание реферального кода</h5>
    <form id="referaladd">
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    </div>
    <div class="modal-body">
    Инструкция по созданию<br><br>
    1. Прочитать (<a href="soglasref" target="_blank">Правила использования реферального кода.</a>)<br>
    2. Ввести свой будущий реферальный код в ниже предоставленный диалог.<br>
    3. Нажмите кнопку «Создать»<br><br>
    Введите свой будущий реферальный код
    <div class="form-group">
    <input type="text" class="form-control" id="ReferalName" name="ReferalName" placeholder="Пример: #maxim">
    </div>
    <button class="btn btn-primary btn-block">Создать</button>
    </form>
    </div>
    </div>
    </div>
    </div>

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
    <script src="/engine/js/sakura.min.js"></script>
    <script>
	function myFunction() {
      /* Copy text into clipboard */
            navigator.clipboard.writeText
                ("<?php echo $referal['name'] ?>");

            new Notify ({
                title: 'Успешно',
                text: "Промокод успешно скопирован!",
                status: 'success',
                autoclose: true,
                autotimeout: 2000                    
            })               
    }
    $(function(){
    $('body').sakura();
    }
	$("#referaladd").on('submit', function(e) {    
        e.preventDefault();
        

        $.ajax({
            type:'GET',
            url: '/includes/result/addreferal.php',
            data: $('#referaladd').serialize(),
            cache: false,
            success: function(data) { 
                if (data.search('#Ошибка') != -1) { 
                    data = data.replace('#Ошибка', ''); 
                    
                    new Notify ({
                        title: 'Ошибка',
                        text: data,
                        status: 'error',
                        autoclose: true,
                        autotimeout: 2000                    
                    })                            
                    
                    event.preventDefault();
                    return false;             
                }
                else if (data == 'YES') {
                    new Notify ({
                        title: 'Успешно',
                        text: "Реферальный код успешно создан!",
                        status: 'success',
                        autoclose: true,
                        autotimeout: 2000                    
                    })   
                    setInterval(() => {
                        window.location = "/pages/referal.php"
                    }, 2000);
                }                
            }
        });
    });
    </script>

</body>

</html>