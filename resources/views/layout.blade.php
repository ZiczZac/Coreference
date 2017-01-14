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
                        <li><a  href="#">About Us</a></li>
                    </ul>
                @if(Auth::user())
                    <ul class="nav navbar-nav">
                        <li><a class="admin_tool" href="{{URL::to('/user')}}">Admin Tool</a></li>
                        <li><a class="user_tool" href="{{URL::to('/labeling')}}">User Tool</a></li>
                        <li><a class="reviser_tool" href="#"></a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">{{Auth::user()->fullname}}</a></li>
                        <li><a herf="#" class="log_out"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
                    </ul>
                @else
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" onclick="document.getElementById('id01').style.display='block'"><span
                                        class="glyphicon glyphicon-log-in"></span>Login</a></li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    <!-- Button to open the modal login form -->
    <!-- <button onclick="document.getElementById('id01').style.display='block'">Login</button> -->
    <div id="id01" class="modal container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-2 col-xs-0"></div>
            <div class="col-md-6 col-sm-8 col-xs-12">
                <form class="modal-content animate login_form">
                    <span onclick="document.getElementById('id01').style.display='none'"
                          class="close" title="Close Modal">&times;</span>
                    <label><b>Email</b></label>
                    <input id="email" type="email" placeholder="alex@gmail.com" name="uname" required>
                    <br>
                    <label><b>Password</b></label>
                    <input id="password" type="password" placeholder="password" name="psw" required>
                    <br>
                    <input class="btn btn-primary sign_in" placeholder="Sign In">
                    <br>
                    <input type="checkbox" checked="checked" placeholder="">Rememeber password
                    <br>
                </form>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-0"></div>
        </div>
    </div>
</div>
<div style="padding-top: 50px;"></div>
<div class="container-fluid" id="banner">
    @yield('banner')
</div>
<div class="container-fluid" id="content-main">
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
            <img src="{!! asset('img/logo.jpg') !!}" alt="logo">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12" id="map"></div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
<script type="text/javascript" src="{!! asset('jquery/jquery-3.1.1.js') !!}"></script>
<script type="text/javascript" src="{!! asset('jquery/bootstrap.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/layout/layout.js') !!}"></script>
@yield('script')
<script type="text/javascript">
    var token = '{{ Session::token() }}';
    $('.sign_in').click(function () {
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            type: 'post',
            data: {_token: token, email: email, password: password},
            dataType: 'json',
            url: 'login',
            success: function (data) {
                alert(data);
                if (data == "success") {
                    window.location.reload();
                    $('.admin_tool').attr('href', "{{URL::to('/user')}}");
                    $('.user_tool').attr('href', "{{URL::to('/labeling')}}");
                } else {
                    $('.alert').remove();
                    var error = '<p class=\'alert alert-danger\'>Wrong email or password<p>';
                    $('.login_form').append(error);
                }
            }
        });
    })

    $('.log_out').click(function () {
        $.ajax({
            type: 'post',
            url: 'logout',
            data: {_token: token},
            dataType: 'json',
            success: function (data) {
                alert(data);
                window.location.reload();
                $('.admin_tool').attr('href', '#');
                $('.user_tool').attr('href', '#');
            }
        });
    });
</script>
</html>