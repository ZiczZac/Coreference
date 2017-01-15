@extends('member.layout.member-layout')
<link rel="stylesheet" href="{!! asset('css/member/labeling.css') !!}">
@section('banner')
    <h1>Labeling</h1>
    <div class="row">
        <div class="btn-group">
            <button type="button" onclick="createNewGroup()" class="btn btn-primary">New Group</button>
            <button type="button" class="btn btn-primary save_group">Save</button>
            <button type="button" class="btn btn-primary finshed_labeling" >Finish</button>
            <button type="button" onclick="sua()" class="btn btn-primary" id="btn">Sửa 1 file đã gom nhóm</button>
        </div>
    </div>
@stop
@section('content-main')

    <div class="row">
        <div class="col-sm-6" id="left">
            <div id="doanvan">
                <p id="left_p"></p>
            </div>
        </div>
        <div class="col-sm-6" id="right">

        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{!! asset('js/labeling/labeling.js') !!}"></script>
@stop