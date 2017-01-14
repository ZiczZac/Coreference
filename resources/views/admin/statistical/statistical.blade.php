<link rel="stylesheet" href="{!! asset('css/admin/statistical.css') !!}">
@extends('admin.layout.admin-layout')
@section('banner')
    <marquee scrollamount="20">
        <div id="welcome">Xin chào admin !</div>
    </marquee>
    <h1>Báo cáo thống kê</h1>
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Tài liệu duyệt trong tuần này
                </div>
                <div class="panel-body big-number info4">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Người đang online
                </div>
                <div class="panel-body big-number info2">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Tài liệu đang thực hiện
                </div>
                <div class="panel-body big-number info3">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel  panel-warning">
                <div class="panel-heading">
                    Số thành viên
                </div>
                <div class="panel-body big-number info1">
                    56
                </div>
                <hr>
                <div class="panel- pannel-seemore">
                    <a href="#">Chi tiết</a>
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
                <caption><h2>Top 10 người làm nhiều</h2></caption>
                <tr>
                    <th>Stt</th>
                    <th>User</th>
                    <th>Số lượng</th>
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
                <caption><h2>Top 10 người làm ít</h2></caption>
                <tr>
                    <th>Stt</th>
                    <th>User</th>
                    <th>Số lượng</th>
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
                <caption><h2 class="warning">Không làm 7 ngày qua</h2></caption>
                <tr>
                    <th>Stt</th>
                    <th>User</th>
                    <th>Số lượng</th>
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
                <caption><h2 class="warning">Các file quá hạn</h2></caption>
                <tr>
                    <th>Stt</th>
                    <th>User</th>
                    <th>Số file quá hạn</th>
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