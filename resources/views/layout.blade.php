<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! asset('css/layout/layout.css') !!}">
</head>
<div id="head-section">
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
                    <li><a href="#" onclick="document.getElementById('id01').style.display='block'"><span
                                    class="glyphicon glyphicon-log-in"></span>Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="padding-top: 17px;"></div>
    <!-- Button to open the modal login form -->
    <!-- <button onclick="document.getElementById('id01').style.display='block'">Login</button> -->
    <div id="id01" class="modal container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-2 col-xs-0"></div>
            <div class="col-md-6 col-sm-8 col-xs-12">
                <form class="modal-content animate" action="action_page.php">
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
                    <button type="button" onclick="document.getElementById('id01').style.display='none'"
                            class="cancelbtn">Cancel
                    </button>
                    <span class="psw">Quên <a href="#">mật khẩu?</a></span>
                </form>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-0"></div>
        </div>
    </div>
</div>

<div class="container-fluid" id="banner">
    @yield('banner')
</div>
<div id="content-main">
    @yield('content-main')
</div>

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
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
<script type="text/javascript" src="jquery/jquery-3.1.1.js"></script>
<script type="text/javascript" src="jquery/bootstrap.js"></script>
<script type="text/javascript" src="{!! asset('js/layout/layout.js') !!}"></script>
</html>