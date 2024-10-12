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
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include 'includes/modules/sidebar.php'; ?>
		
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'includes/modules/topbar.php'; ?>
		

        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Все контакты</h1>
</div>

<div class="card shadow mb-4">
    
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Все контакты</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th>Название</th>
<th>Наименование</th>
<th>Взаимодействие</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<img class="img-profile rounded-circle" height="30px" src="/engine/img/avatars/<?php echo $user['Avatar']?>.png">
No Code </td>
<td>
Владелец
</td>
<td>
<a class="btn btn-primary btn-sm" href="https://vk.com/maximych2906" target="blank"><i class="fab fa-fw fa-vk"></i></a>
</td>
</tr>
<tr>
<td>
<img class="img-profile rounded-circle" height="30px" src="https://static.cdnlogo.com/logos/v/36/vk.png">
LK.NO-CODES.RU</td>
<td>
Группа ВКонтакте
</td>
<td>
<a class="btn btn-primary btn-sm" href="https://vk.com/no.code" target="blank"><i class="fab fa-fw fa-vk"></i></a>
<tr>
<td>
<img class="img-profile rounded-circle" height="30px" src="https://static.cdnlogo.com/logos/v/36/vk.png">
LK.NO-CODES.RU | TECH</td>
<td>
Техническая Поддежрка
</td>
<td>
<a class="btn btn-primary btn-sm" href="https://vk.com/no.code.tech" target="blank"><i class="fab fa-fw fa-vk"></i></a>
</tbody>
</table>
</div>
</div>
</div>
</div>


            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- Logout Modal-->
	<?php include ('includes/modules/footer.php'); ?>

    <?php include ('includes/modules/logout.php'); ?>

    <script src="/engine/vendor/jquery/jquery.min.js"></script>
    <script src="/engine/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/engine/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/engine/js/sb-admin-2.min.js"></script>
    <script src="/engine/vendor/chart.js/Chart.min.js"></script>
    <script src="/engine/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/engine/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="/engine/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	</script>
    <script src="/engine/js/sakura.min.js"></script>
    <script>
    $(function(){
    $('body').sakura();
    });
    </script>

</body>

</html>