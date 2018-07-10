{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
    {{--<head>--}}
        {{--<meta charset="utf-8">--}}
        {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
        {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

        {{--<title>Laravel</title>--}}

        {{--<!-- Fonts -->--}}
        {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
       {{-- <script src="{{ asset('js/app.js') }}" defer></script>--}}
       {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        {{--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">--}}
        {{--<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">--}}
        {{--<!-- Ionicons -->--}}
        {{--<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">--}}
        {{--<!-- DataTables -->--}}
        {{--<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">--}}
        {{--<!-- Theme style -->--}}
        {{--<link rel="stylesheet" href="dist/css/AdminLTE.min.css">--}}
        {{--<!-- AdminLTE Skins. Choose a skin from the css/skins--}}
            {{--folder instead of downloading all of them to reduce the load. -->--}}
        {{--<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">--}}

   {{-- <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    {{-- <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>  --}}
   {{----}}

       {{--<style>--}}
        {{----}}
          {{--html,body{--}}
              {{--background-image:url({{ asset('image/symphony.png') }});--}}
            {{----}}
          {{--}--}}
         {{--div.dataTables_wrapper div.dataTables_filter input {--}}
              {{--width: auto;--}}
              {{--padding: 16px;--}}
              {{--width: 85%;--}}
              {{--border-radius: 18px;--}}
              {{--border: 1px solid #ddd;--}}
              {{--outline: none;--}}
         {{--}--}}
         {{--div.dataTables_wrapper div.dataTables_filter label {--}}
              {{--/* right: 40px; */--}}
              {{--font-weight: normal;--}}
              {{--white-space: nowrap;--}}
              {{--text-align: left;--}}
              {{--position: relative;--}}
              {{--top: -51px;--}}
              {{--color: #fff;--}}
              {{--left: -22px;--}}
              {{--width: 50%;--}}
          {{--}--}}
         {{--.fa-search {--}}
                {{--position: absolute;--}}
                {{--top: 28px;--}}
                {{--right: 30px;--}}
                {{--z-index: 1000;--}}
                {{--color: #bfbebe;--}}
          {{--}--}}
        {{--.name::placeholder{--}}
            {{--color:#ddd;--}}
         {{--}--}}
        {{--.nameDiv i{--}}
          {{--position: relative;--}}
          {{--right: 29px;--}}
          {{--color: #ddd;--}}
         {{--}--}}
         {{--.box{--}}
           {{--box-shadow: 1px 4px 3px 2px #565555;--}}
           {{--border-radius:15px;--}}
            {{--width: 97%;--}}
            {{--margin: auto;--}}
            {{--max-width: 97%;--}}
         {{--}--}}
         {{--.box-body{--}}
            {{--background: teal;--}}
         {{--}--}}
         {{--.box-header{--}}
            {{--text-align: center;--}}
         {{--}--}}
         {{--.box-header .box-title{--}}
            {{--font-size: 21px;--}}
            {{--margin: 9px;--}}
            {{--font-weight: bold;--}}
            {{--font-family: monospace;--}}
            {{--color: #7b7a7a;--}}
         {{--}--}}
        {{--thead{--}}
           {{--background-color: #035858;--}}
           {{--color: #ffff;--}}
         {{--}--}}
         {{--.pagination>.active>a, --}}
         {{--.pagination>.active>a:focus, --}}
         {{--.pagination>.active>a:hover, --}}
         {{--.pagination>.active>span, --}}
         {{--.pagination>.active>span:focus, --}}
         {{--.pagination>.active>span:hover {--}}
            {{--z-index: 3;--}}
            {{--color: #fff;--}}
            {{--cursor: default;--}}
            {{--background-color: #025f5f;--}}
            {{--border-color: #025f5f;--}}
         {{--}--}}
         {{--table{--}}
            {{--width: 97%;--}}
            {{--margin: auto;--}}
            {{--max-width: 97% !important;--}}
         {{--}--}}
       {{--</style>--}}
    {{--</head>--}}

     {{--<section class="content">--}}
        {{--<div class="row">--}}
        {{--<div class="col-xs-12">--}}
           {{-- <div class="row">--}}
            {{--<div class="col-md-3 nameDiv">--}}
              {{--<input type="text" placeholder="Search By Name" class="name"  >--}}
              {{--<i class="fa fa-search"></i>--}}
            {{--</div>--}}
          {{--</div> --}}
          {{--<div class="box">--}}
            {{--<div class="box-header">--}}
              {{--<h3 class="box-title">Student Data List </h3>--}}
            {{--</div>--}}
            {{--<!-- /.box-header -->--}}
            {{--<div class="box-body">--}}
              {{--<table id="users" class="table table-bordered table-striped">--}}
                {{--<i class="fa fa-search"></i>--}}
                {{--<thead>--}}
                {{--<tr>--}}
                  {{--<th>Code</th>--}}
                  {{--<th>الاسم</th>--}}
                  {{--<th>التقدير العام</th>--}}
                  {{--<th>التخصص</th>--}}
                  {{--<th>الفصل</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
              {{--</table>--}}
              {{----}}
            {{--</div>--}}
          {{--</div>--}}
            {{--<!-- /.box-body -->--}}
          {{--</div>--}}
          {{--<!-- /.box -->--}}
        {{--</div>--}}
        {{--<!-- /.col -->--}}


      {{--<!-- /.row -->--}}
{{--</section>--}}


    {{--<!-- /.content -->--}}
 {{-- {{ $students->links("vendor.pagination.simple-bootstrap-4") }} --}}
{{--<!-- jQuery 3 -->--}}
{{--<script src="bower_components/jquery/dist/jquery.min.js"></script>--}}

 {{--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>--}}
{{--<!-- Bootstrap 3.3.7 -->--}}
{{--<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}
  {{--<!-- DataTables -->--}}
{{--<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>--}}
{{--<!-- SlimScroll -->--}}
{{--<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>--}}
{{--<!-- FastClick -->--}}
{{--<script src="bower_components/fastclick/lib/fastclick.js"></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="dist/js/adminlte.min.js"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="dist/js/demo.js"></script>--}}
{{--<!-- page script -->--}}
{{--<script src="js/bootstrap3-typeahead.min.js"></script>--}}
{{--<script>--}}
 {{----}}
{{--var editor;--}}

  {{--$(document).ready(function() {--}}
    {{----}}
       {{--$('#users').DataTable({--}}
        {{--"processing": true,--}}
        {{--"searching":true,--}}
        {{--"info":false,--}}
         {{--"key":true,--}}
        {{--"lengthChange":false,--}}
        {{--"serverSide": true,--}}
        {{--"ajax": "{{ route('list.getlist') }}",--}}
        {{--"columns": [--}}
            {{--{data: 'code', name: 'code'},--}}
            {{--{data: 'name', name: 'name'},--}}
            {{--{data: 'Gname', name: 'Gname'},--}}
            {{--{data: 'MSname', name: 'MSname'},--}}
            {{--{data: 'DTname', name: 'DTname'}--}}
        {{--] --}}
    {{--}); --}}



  {{--});--}}

{{--</script>--}}

{{--</body>--}}
{{--</html>--}}

@extends('layouts.app2')
@section('content')

    {{--<section class="content">--}}
    {{--<div class="row">--}}
    {{--<div class="col-xs-12">--}}
    {{--<div class="box">--}}
    {{--<div class="box-header">--}}
    {{--<h3 class="box-title">Student Data List </h3>--}}
    {{--</div>--}}
    {{--<!-- /.box-header -->--}}
    {{--<div class="box-body">--}}
    {{--<table id="students" class="table table-bordered table-striped">--}}
    {{--<i class="fa fa-search"></i>--}}
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Student Data List
                </h2>
            </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Student Data List
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id = "students" class="table table-bordered table-striped table-hover js-basic-example dataTable" style="direction: rtl;">
                    <thead>
                    <tr>
                    <th>الكود</th>
                    <th>الاسم</th>
                    <th>التقدير العام</th>
                    <th>التخصص</th>
                    <th>الفصل</th>
                    <th>التفاصيل</th>
                    </tr>
                        </table>

                        {{--{{ $paginator->links('vendor/pagination/simple-bootstrap-4') }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
</section>


  @endsection
