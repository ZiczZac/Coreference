@extends('user.layout.master')
@section('content')
<div class="container">

<h1>File</h1>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Number</th>
            <th>Id</th>
            <th>Name</th>
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
@include('user.corpus')
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