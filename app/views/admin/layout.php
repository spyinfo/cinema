<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->e($title);?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" type="image/png">
    <!-- End Favicon -->

    <!--  Styles  -->
    <!--    <link rel="stylesheet" href="/css/main.css">-->
    <!--    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="/static/css/main.css">-->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/skin-purple.min.css">
    <link rel="stylesheet" href="/assets/css/slick-theme.css">
    <link rel="stylesheet" href="/assets/css/styles.css">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!--    <link rel="stylesheet" href="/css/main.css">-->
    <!--    <link rel="stylesheet" href="/css/media.css">-->
    <!--  End Styles  -->


    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- End Google Fonts -->
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="/admin/home" class="logo">
<!--            <span class="logo-mini"><b>MGKIT</b></span>-->
            <span class="logo-lg"><?= $this->e($second_title); ?></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation"></nav>
    </header>


    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Навигация</li>
                <li><a href="/admin/cinema"><i class="fa fa-camera-retro"></i> <span>Кинотеатры</span></a></li>
                <li><a href="/admin/film"><i class="fa fa-video-camera"></i><span>Фильмы</span></a></li>
                <li><a href="/admin/session"><i class="fa fa-film"></i> <span>Сеансы</span></a></li>
                <li><a href="/admin/user"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>



                <li><a href="/"><i class="fa fa-sign-out"></i> <span>Перейти на сайт</span></a></li>
                <li><a href="/admin/logout"><i class="fa fa-sign-out"></i> <span>Выйти из аккаунта</span></a></li>
            </ul>
        </section>
    </aside>


    <?=$this->section('content');?>

</div>


<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<!--<script src="/assets/js/dataTables.bootstrap.min.js"></script>-->
<script src="/assets/js/adminlte.min.js"></script>
<script src="/assets/js/admin.js"></script>
<script>
    $(function () {
        $('#example1').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : true
        });
    })
</script>
</body>
</html>
