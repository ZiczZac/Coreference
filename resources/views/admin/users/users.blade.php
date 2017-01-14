<link rel="stylesheet" href="{!! asset('css/admin/users.css') !!}">
<link rel="stylesheet" href="{!! asset('dataTable/jquery.dataTables.min.css') !!}">
@extends('admin.layout.admin-layout')
@section('content-main')

    <hr id="hr1">
    <table class="user-list">
        <caption><h2>Danh sách user</h2></caption>
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>User</th>
            <th>Role</th>
            <th>Action</th>
            <th>Delete</th>
            <th>Edit</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        
        <tr id='{{$user->id}}'>
            <td>{{ $user->id }}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->accountType['name']}}</td>
            <td>Role</td>
            <td id="activated{{$user->id}}">
            @if($user->activated == 0)
                Inactive
            @else
                Activated
            @endif
            </td>
            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <button class = "btn btn-danger delete" data-toggle = "modal" data-target = "#deleteModal" id="delete-record">Delete</button>
            </td>
            <td><button class = "btn btn-primary edit" data-toggle = "modal" data-target = "#editModal">Edit</button></td>
            <td><button class="btn btn-success active" type="submit">Active/Inactive</button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.manageuser.edit')
    @include('admin.manageuser.delete')
@stop
@section('script')
    <script type="text/javascript" src="{!! asset('dataTable/jquery.dataTables.min.js') !!}"></script>
    <script type="text/javascript">
        //make by TRIỆU, koong sửa dòng bên dưới
        $('.user-list').DataTable({});

        function getDataUser(elem) {
            var data = [];
            $(elem).closest('tr').find('td').each(function () {
                data.push($(this).text());
            });
            $('#id').val(data[1]);
            $('#name').val(data[2]);
            $('#email').val(data[3]);
            $('#type').val(data[4]);
            return data;
        }
        $('.delete').click(function () {
            var data = getDataUser($(this));
            $('.info').empty();
            var title = '<span>' + 'Record Info: ID: ' + '</span>';
            var id = '<span class=\'id\'>' + data[1] + '</span>';
            var fullName = '<span>, ' + data[2] + '</span>';
            $('.info').append(title, id, fullName);

        });
        $('#submit_delete').click(function () {
            var user_id = $('.id').text();
            $.ajax({
                type: 'delete',
                url: 'user/delete',
                data: {_token: token, id: user_id},
                dataType: 'json',
                success: function (data) {
                    $('#' + data).remove();
                    var i = 1;
                    $('tbody').find('tr').each(function () {
                        $(this).find('td').first().text(i);
                        i++;
                    });
                }
            });
        });
        $('.edit').click(function () {
            var data = getDataUser($(this));

            $('#id').val(data[1]);
            $('#name').val(data[2]);
            $('#email').val(data[3]);
            $('#type').val(data[4]);
        });
        $('.active').click(function () {
            var user_id = getDataUser($(this))[1];
            $.ajax({
                type: 'post',
                url: 'user/active',
                data: {_token: token, id: user_id},
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        $('#activated' + user_id).text('Activated');
                    } else {
                        $('#activated' + user_id).text('Inactive');
                    }
                }
            });
        });
        $('#submit_edit').click(function () {
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    _token: token, name: $('#name').val(),
                    id: $('#id').val(),
                    email: $('#email').val(),
                    type: $('#type').val()
                },
                dataType: 'json',
                success: function (data) {
                    var i = 1;
                    var type = data['account_type'] == 1 ? 'admin' : 'user';
                    var datas = [data['fullname'], data['email'], type];
                    // alert(data['account_type']);
                    $('#' + data['id']).find('td').each(function () {
                        if (i >= 3 && i <= 5) {
                            $(this).text(datas[i - 3]);
                        }
                        i++;
                    });
                }
            });
        });
    </script>
@stop