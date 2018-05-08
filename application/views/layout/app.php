<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> <?php echo $title;?> | Đỗ đại học - Luyện thi đại học</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Oleo+Script:400,700" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">

    <!-- Favicon -->
</head>
<body>
<div id="page" class="wrap-main">
    <div class="main-container register-page page-sing-in-up background-account">
        <header class="header">
            <div class="container">
                <div class="logo col-md-3">
                    <a href="#">
                    </a>
                </div>
                <div class="header-right pull-right">
                    <div class="header-avatar">
                        <?php if (!empty($user->avatar)):?>
                            <img src="<?php echo $user->avatar .'?nocache='.time();?>" alt="Avatar">
                        <?php else:?>
                            <img src="../../../assets/images/avatar/male.gif" alt="Avatar">
                        <?php endif;?>
                    </div>

                    <span class="fullname"><?php echo $user->name;?></span>
                    <a href="/logout">Đăng xuất</a> 
                </div>
            </div>
        </header>
        <main class="main-app">
            <div class="container">
                <?php echo $this->load->view($content, '', TRUE);?>
            </div>
        </main>
        <!-- box wrap site -->
    </div>
    <script src="../../../assets/js/jquery.min.js"></script>
    <script src="../../../assets/js/bootstrap-datepicker.js"></script>
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/app.js"></script>
</div></body>
</html>

