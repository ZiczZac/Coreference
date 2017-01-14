<link rel="stylesheet" href="{!! asset('css/admin/statistical.css') !!}">
@extends('admin.layout.admin-layout')
@section('banner')
    <marquee scrollamount="20">
        <div id="welcome">Welcome admin !</div>
    </marquee>
    <h1>Report</h1>
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    New document on week
                </div>
                <div class="panel-body big-number info4">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Detail</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Online
                </div>
                <div class="panel-body big-number info2">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Detail</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    On Processing
                </div>
                <div class="panel-body big-number info3">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Detail</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel  panel-warning">
                <div class="panel-heading">
                    Nembers
                </div>
                <div class="panel-body big-number info1">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Detail</a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content-main')
    <hr>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <table>
                <caption><h2>Hard working</h2></caption>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Number</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><a href="#" title="Xem thông tin">TrieuNv@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="#" title="Xem thông tin">ThuNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="#" title="Xem thông tin">DatNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="#" title="Xem thông tin">DatNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-12 col-sm-6">

            <table>
                <caption><h2>Lazy</h2></caption>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Number</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><a href="#" title="Xem thông tin">TrieuNv@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="#" title="Xem thông tin">DatNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="#" title="Xem thông tin">ThuNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="#" title="Xem thông tin">DatNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>

            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12 col-sm-6">

            <table>
                <caption><h2 class="warning">Not working last 7 days</h2></caption>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>The Last Login</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><a href="#" title="Xem thông tin">TrieuNv@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><a href="#" title="Xem thông tin">TrieuNv@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><a href="#" title="Xem thông tin">TrieuNv@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="#" title="Xem thông tin">ThuNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="#" title="Xem thông tin">DatNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>

            </table>
        </div>
        <div class="col-xs-12 col-sm-6">

            <table>
                <caption><h2 class="warning">Out of date (3 days)</h2></caption>
                <tr>
                    <th>Stt</th>
                    <th>User</th>
                    <th>Number</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><a href="#" title="Xem thông tin">TrieuNv@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="#" title="Xem thông tin">ThuNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="#" title="Xem thông tin">DatNguyen@gmail.com</a></td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="#" title="Xem thông tin">MinhDuong@gmail.com</a></td>
                    <td>22</td>
                </tr>
            </table>
        </div>
    </div>
@stop