@extends('layout')
@section('menu')
    <li><a href="{{URL::to('/user')}}">Admin Tool</a></li>
    <li><a href="{{URL::to('/labeling')}}">User Tool</a></li>
    <li><a href="#">reviser_tool</a></li>
@stop