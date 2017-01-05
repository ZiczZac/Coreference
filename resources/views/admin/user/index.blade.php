<!-- app/views/nerds/index.blade.php -->
@extends('layouts.app')
@section('content')
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    Optional theme
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    Latest compiled and minified JavaScript
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body> -->
<div class="container">

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a data-toggle = "modal" data-target = "#createModal">Add User</a>
    </ul>
</nav>

<h1>User</h1>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Number</td>
            <td>User ID</td>
            <td>Full Name</td>
            <td>Email</td>
            <td>Account Type</td>
            <td>Active</td>
        </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    @foreach($users as $user)
        
        <tr id='{{$user->id}}'>
            <td>{{ $number ++ }}</td>
            <td>{{ $user->id }}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->accountType['name']}}</td>
            <td id="activated{{$user->id}}">
            @if($user->activated == 0)
                Inactive
            @else
                Activated
            @endif
            </td>
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                <button class = "btn btn-danger delete" data-toggle = "modal" data-target = "#deleteModal" id="delete-record">Delete</button>
                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <button class = "btn btn-primary edit" data-toggle = "modal" data-target = "#editModal">Edit</button>
                <button class="btn btn-success active" type="submit">Active/Inactive</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</div>
@include('admin.user.edit')
@include('admin.user.delete')
@include('admin.user.create')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    
    function getDataUser(elem){
        var data = [];
        $(elem).closest('tr').find('td').each(function(){
            data.push($(this).text());
        });
        $('#id').val(data[1]);
        $('#name').val(data[2]);
        $('#email').val(data[3]);
        $('#type').val(data[4]);
        return data;
    }
    $('.delete').click(function(){
        var data = getDataUser($(this));
        $('.info').empty();
        var title = '<span>'+'Record Info: ID: '+'</span>';
        var id = '<span class=\'id\'>' + data[1] +'</span>';
        var fullName = '<span>, ' + data[2] +'</span>';
        $('.info').append(title, id, fullName);
        
    });
    $('#submit_delete').click(function(){
        var user_id = $('.id').text();
        $.ajax({
            type: 'delete',
            url: 'user/delete',
            data: {_token: token, id: user_id},
            dataType: 'json',
            success: function(data){
                $('#'+data).remove();
                var i = 1;
                $('tbody').find('tr').each(function(){
                    $(this).find('td').first().text(i);
                    i++;
                });
            }
        });
    });
    $('.edit').click(function(){
        var data = getDataUser($(this));
        
        $('#id').val(data[1]);
        $('#name').val(data[2]);
        $('#email').val(data[3]);
        $('#type').val(data[4]);
    });
    $('.active').click(function(){
        var user_id = getDataUser($(this))[1];
        $.ajax({
            type: 'post',
            url: 'user/active',
            data:{_token: token, id: user_id},
            dataType:'json',
            success: function(data){
                if(data){
                    $('#activated' + user_id).text('Activated');
                } else {
                    $('#activated' + user_id).text('Inactive');
                }
            }
        });
    });
    $('#submit_edit').click(function(){
      $.ajax({
          type: 'post',
          url: url,
          data: {_token: token, name: $('#name').val(),
                                id: $('#id').val(),
                                email: $('#email').val(),
                                type: $('#type').val()
                },
          dataType:'json',
          success: function(data){
              var i = 1;
              var type = data['account_type'] == 1 ? 'admin':'user';
              var datas = [data['fullname'], data['email'], type];
              // alert(data['account_type']);
              $('#' + data['id']).find('td').each(function(){
                    if(i >= 3 && i <= 5){
                        $(this).text(datas[i-3]);
                    }
                    i++;
              });
          }
      });
    });
</script>
<!-- </body>
</html> -->

@endsection