<!-- app/views/nerds/index.blade.php -->
@extends('admin.layout.master')
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
        <tr id='{{ $file->id }}'>
            <td>{{ $number ++ }}</td>
            <td>{{ $file->id}}</td>
            <td>{{ $file->name }}</td>
            <td>{{ $file->user['fullname']}}</td>
            <td>{{ $file->imported_date }}</td>
            </td>
        
            <td>
                <button class = "btn btn-info edit" data-toggle = "modal" data-target = "#editModal">Edit</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@include('admin.managefile.edit')
</div>

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

    $('.edit').click(function(){
        var data = getDataUser($(this));
        $('#id').val(data[1]);
        $('#name').val(data[2]);
        $('#importer').val(data[3]);
    });

    $('#submit_edit').click(function(){
        var file_id = $('#id').val();
        var file_name = $('#name').val();
        var file_importer = $('#importer').val();

        $.ajax({
            type: 'post',
            url: 'file/edit',
            data: {_token: token, id: file_id, file_name: file_name, importer: file_importer},
            dataType: 'json',
            success: function(data){
                i = 0;
                var datas = [data['id'], data['name'], data['importer']];
                $('#' + data['id']).find('td').each(function(){
                    if(i >= 1 && i <= 3){
                        $(this).text(datas[i-1]);
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