<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>

        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="#">Img Logo</a>
                </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">tool 2</a></li> 
                    <li><a href="#">tool 3</a></li>
                    <li><a href="#">tool...</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
                    <li><a href="#" onclick="document.getElementById('id01').style.display='block'"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
        <!-- Button to open the modal login form -->
        <!-- <button onclick="document.getElementById('id01').style.display='block'">Login</button> -->

        <!-- The Modal -->
        <div id="id01" class="modal container-fluid">

              <!-- Modal Content -->
            <div class="row">
                <div class="col-md-3 col-sm-2 col-xs-0"></div>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form class="modal-content animate" action="action_page.php">
                <!--        <div class="imgcontainer">
                    <img src="img_avatar2.png" alt="Avatar" class="avatar">
                </div> -->
                            <span onclick="document.getElementById('id01').style.display='none'" 
                            class="close" title="Close Modal">&times;</span>
                            <label><b>Tên tài khoản</b></label>
                            <input type="text" placeholder="Nhập tài khoản tại đây" name="uname" required>
                            <br>
                            <label><b>Mật khẩu</b></label>
                            <input type="password" placeholder="Nhập mật khẩu tại đây" name="psw" required>
                            <br>
                            <button type="submit">Đăng nhập</button>
                            <br>
                            <input type="checkbox" checked="checked"> Nhớ mật khẩu
                            <br>
                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                            <span class="psw">Quên <a href="#">mật khẩu?</a></span>
                    </form>
                </div>
                <div class="col-md-3 col-sm-2 col-xs-0"></div>
            </div>
        </div>
        </section>
    </div>
<div id="app">
    abc








    ddddddddddddd
</div>
    <div class="footer">
        <div class="container-fluid" id="footer">
            <div class="row">
                <div class="col-md-6 col-sm-6 col col-xs-12">
                    <h4>website .... this is organization-name</h4>
                    <ul id="contact">
                        <li>Địa chỉ : 334 Nguyễn Trãi-Thanh Xuân-Hà Nội</li>
                        <li>Điện thoại: (04) 888 888</li>
                        <li>Email: email@hotmail.com</li>
                    </ul>
                        <ul class="nav navbar-nav">
                        <li><a href="#">liên kết 1</a></li>
                        <li><a href="#">liên kết 2</a></li>
                        <li><a href="#">liên kết 3</a></li>
                        <li><a href="#">liên kết 4</a></li>
                    </ul>
                    <div style="clear: both;"></div>
                    <!-- <br> -->
                    <img src="img/logo.jpg" alt="logo">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12" id="map"></div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
<link rel="stylesheet" type="text/css" href="bootstraps/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="jquery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="jquery/bootstrap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
    <script type="text/javascript" src="js/footer.js"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</html>
