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
  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
  </script>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

</head>
<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="#">WebSiteName</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li id="adduser" data-toggle="modal" data-target="#addUserForm"><a href="#">Add User</a></li>`
          <li id="adduser" data-toggle="modal" data-target="#fileUpload"><a href="#">Upload New File</a></li>
          <li id="adduser" data-toggle="modal" ><a href="{{URL::to('/file')}}">File Management</a></li>
          <li id="adduser" data-toggle="modal" ><a href="{{URL::to('/user')}}">User Management</a></li>
          <li><a href="#"></a></li>
        </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->fullname}}</a></li>
        <li><a class="log_out" href="#"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>
  @yield('content')
<div class="modal fade" id="addUserForm" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <form id="addform" data-toggle="validator" role="form">
          <div class="form-group">
            <label for="inputName" class="control-label">Name</label>
            <input type="text" class="form-control" id="inputName" placeholder="Cina Saffary" required>
          </div>

          <div class="form-group">
            <label for="inputEmail" class="control-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required>
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <label for="inputPassword" class="control-label">Password</label>
            <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
            <div class="help-block">Minimum of 6 characters</div>
          </div>

          <div class="form-group">
            <label for="inputPassword" class="control-label">Confirm</label>
            <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group"><label>Role</label>
            <div class="radio">
              <label>
                <input type="radio" name="role" required>
                User
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="role" required>
                Manager
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="role" required>
                Admin
              </label>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>

      </div>
      
    </div>
  </div>
<div class="modal fade" id="fileUpload" role="dialog">
  
</div>
</body>
<script type="text/javascript">
    $('.log_out').click(function(){
      $.ajax({
        type: 'post',
        url: 'logout',
        data: {_token: token},
        dataType: 'json',
        success: function(data){
            alert(data);
            location.href = "http://localhost:8000/home";
        }
      });
    });
  </script>
</html>
