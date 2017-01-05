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
            <td>Name</td>
            <td>Importer</td>
            <td>Imported Date</td>
        </tr>
    </thead>
    <tbody>
    <?php $number = 1; ?>
    @foreach($files as $file)
        
        <tr id='{{$file->id}}'>
            <td>{{ $number ++ }}</td>
            <td>{{ $file->name }}</td>
            <td>{{ $file->user['fullname']}}</td>
            <td>{{ $file->imported_date }}</td>
            </td>
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <button class = "btn btn-info" data-toggle = "modal" data-target = "#editModal">Edit</button>
                <button class = "btn btn-info" data-toggle = "modal" data-target = "#editModal">Corpus</button>
                <button class = "btn btn-info" data-toggle = "modal" data-target = "#editModal">Sentences</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    
    
</script>
<!-- </body>
</html> -->

@endsection