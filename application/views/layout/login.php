<!DOCUMENT html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> <?php echo $title;?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Oleo+Script:400,700" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">

    <!-- Favicon -->
</head>
<body>
<div id="page" class="wrap-main">
    <div class="main-container register-page page-sing-in-up background-account">
        <div class="container">
            <?php echo $this->load->view($content, '', TRUE);?>
        </div>
        <!-- box wrap site -->
    </div>
    <script src="../../../assets/js/jquery.min.js"></script>
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/jquery-form.js"></script>
    <script src="../../../assets/js/bootstrap-datepicker.js"></script>
    <script src="../../../assets/js/app.js"></script>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '170210776975737',
                xfbml      : true,
                version    : 'v2.10'
            });
        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function login(){
            FB.login(function(response){
                if(response.status === 'connected'){
                    var url = window.location.href;
                    var arguments = url.split('?');
                    getInfo(arguments[1]);
                } else if(response.status === 'not_authorized') {
                    console.log(response.status);
                } else {
                    console.log(response.status);
                }

            }, {scope: 'email'});
        }
        // get user basic info

        function getInfo(params) {
            FB.api('/me', 'GET', {fields: 'id, name, email, birthday, gender'}, function(response) {
                console.log(response);
                response.getData = params;
                $.ajax({
                    url: '/loginFB',
                    type: 'post',
                    data: response,
                    success: function (response) {
                        console.log(response);
                        if (response.status) {
                            window.location.href = response.url;
                        } else {
                            $('.form-sing-in-up').append('<div class="alert alert-danger alert-dismissable fade in">'+
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>')
                        }
                    }
                })
            });
        }

    </script>
</div></body>
</html>

