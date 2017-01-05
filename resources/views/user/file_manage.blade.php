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

<h1>File</h1>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Number</td>
            <td>Id</td>
            <td>Name</td>
        </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    @foreach($fileLabeling as $file)
        
        <tr id='{{$file->id}}'>
            <td>{{ $number ++ }}</td>
            <td>{{ $file->id}}</td>
            <td>{{ $file->name }}</td>
            </td>
            <td>
                <button class = "btn btn-info btn-sm corpus" data-toggle = "modal" data-target = "#corpusModal">Corpus</button>
                <a class = "btn btn-success" href="{{URL::to('labeling/label/'.$file->id)}}">Labeling</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</div>
@include('user.corpus');
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    var token = '{{Session::token()}}';
    function getDataUser(elem){
        var data = [];
        $(elem).closest('tr').find('td').each(function(){
            data.push($(this).text());
        });
        return data;
    }
    var file_id = 9989;
    $('.corpus').click(function(){
        file_id = getDataUser($(this))[1];
        // alert(file_id);
        $.ajax({
            type: 'get',
            url: 'labeling/corpus',
            data: {_token: token, file_id: file_id},
            success: function(corpus){
                $('.info').text(corpus);
            }
        });
    });
    
</script>
<!-- </body>
</html> -->

@endsection