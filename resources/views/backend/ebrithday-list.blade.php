<?php $person = \Request::segment(3)?>
@extends ('backend.layouts.master')
@section ('title', 'Ebirthday' . ' | Transaction')
@section('page-header')
<h1>
<small>transaction</small>
</h1>
@endsection
@section('content')
{!! Form::open(['route' => 'transaction.list', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Transaction</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! $view !!}
        </div>
        <div class="box box-info">

            <div class="box-body">
                <div class="pull-right">
                    <input type="submit" class="btn btn-success btn-ls" value="{{ trans('lang.btn.search') }}" />
                </div>
                <div class="clearfix"></div>
                </div><!-- /.box-body -->
                </div><!--box-->
            </div>
            {!! Form::close() !!}
            <div class="box box-success">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr style="font-size: 13px !important">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th style="width:85px !important">Msisdn</th>
                                    <th style="width:100px !important">Sender</th>
                                    <th>Url</th>
                                    <th>Short Url</th>
                                    <th style="width: 135px !important">{{ trans('labels.backend.access.users.table.created') }}</th>
                                    <th style="width: 135px !important">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = genId($data->perPage(), $data->currentPage())?>
                                @foreach ($data as $key => $list)
                                <tr style="font-size: 12px !important">
                                    <td>{{$id++}}</td>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->msisdn}}</td>
                                    <td>{{$list->sender}}</td>
                                    <td>{{$list->url}}</td>
                                    <td>{{$list->short_url}}</td>
                                    <td class="visible-lg">{!! date('d-m-Y H:i:s',strtotime($list->created_at )) !!}</td>
                                    <td class="visible-lg">{!! $list->updated_at->diffForHumans() !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div><!-- /.box-body -->
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="pull-left">Found : {{number_format($data->total())}} item</div>
                            <div class="pull-right">
                                {!! $data->appends(\Request::all())->links() !!}
                            </div>
                            <div class="clearfix"></div>
                            </div><!-- /.box-body -->
                            </div><!--box-->
                            </div><!--box-success-->
                            @stop
                            @section('after-scripts-end')
                            {!! Html::script('js/backend/access/permissions/script.js') !!}
                            {!! Html::script('js/backend/access/users/script.js') !!}
                            @stop
                            {{-- <script type="text/javascript"></script> --}}
                            <style type="text/css">
                            div.form-group {
                            font-size: 11.5px !important;
                            }
                            </style>