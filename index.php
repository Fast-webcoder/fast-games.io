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

$ts1 = strtotime(date("d.m.Y"));
$ts2 = strtotime('05.06.2024');
$diff =  floor(($ts1 - $ts2)/(60*60*24));

function formatDays($days)
{
    $singular = "день";
    $plural = "дней";
    $alternate_plural = "дня";

    if ($days % 10 == 1 && $days % 100 != 11) {
        return $days . " " . $singular;
    } elseif ($days % 10 >= 2 && $days % 10 <= 4 && ($days % 100 < 10 || $days % 100 >= 20)) {
        return $days . " " . $alternate_plural;
    } else {
        return $days . " " . $plural;
    }
}
$start_date = strtotime('2024-02-09'); //
$current_date = time(); // мельников чмо
$seconds_diff = $current_date - $start_date; // это короче, иди нахуй короче
$days_elapsed = floor($seconds_diff / (60 * 60 * 24)); // далбаеб
$maffin_days = formatDays($days_elapsed); // маффин легенда
$shopquery = $con->query("SELECT * FROM purchases ORDER BY BuyID DESC");
$bsh = $shopquery->fetch(PDO::FETCH_ASSOC);
$shop = $bsh['BuyID'];
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
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include ('includes/modules/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include ('includes/modules/topbar.php'); ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Главная</h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Пользователей</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $users?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">ПРОДАННЫХ ТОВАРОВ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $shop?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-basket fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Мы работаем
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $maffin_days; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Промокод</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $promo?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Новости</h6></div>
                        <div class="card-body">
                            <div class="content-wrapper">
                                <?php foreach($news as $data):?>
                                <div class="news-card">
                                    <a href="<? echo $data[3]?>" target="_blank" class="news-card__card-link"></a>
                                    <img src="<?php echo $data[2]?>" alt class="news-card__image">
                                    <div class="news-card__text-wrapper">
                                        <h2 class="news-card__title"><?php echo $data[1]?></h2>
                                    </div>
                                </div>
                                <?php endforeach?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include ('includes/modules/footer.php'); ?>
        </div>
    </div>
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