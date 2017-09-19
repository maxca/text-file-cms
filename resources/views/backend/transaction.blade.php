
@extends ('backend.layouts.master')

@section ('title',  trans('lang.menu.transaction') . ' | ' .  trans('lang.menu.request'))

@section('page-header')
    <h1>
        {{ trans('lang.menu.transaction') }}
        <small>{{ trans('lang.menu.request') }}</small>
    </h1>
    {!! Html::style('js/template/jquery.datetimepicker.css') !!}
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.transaction', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('lang.menu.transaction') }}</h3>

               {{--  <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.header-buttons')
                </div> --}}
            </div><!-- /.box-header -->

            <div class="box-body">
                {!! $view!!}
            </div><!-- /.box-body -->

            <div class="box box-info">
                <div class="box-body">

                    <div class="pull-right">
                        <input type="submit" class="btn btn-success btn-ls" value="{{ trans('lang.btn.search') }}" />
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.box-body -->
            </div><!--box-->

        </div><!--box-->


    {!! Form::close() !!}
         <div class="box box-success">
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr style="font-size: 12px !important">
                        <th>TRANSACTION_ID</th>
                        <th>msisdn</th>
                        <th>Operator</th>
                        <th>Step</th>
                        <th>Action</th>
                        <th>Type</th>
                        <th>MCC_MNC</th>
                        <th>Accepted</th>
                        <th>Credit Limit</th>
                        <th>Device</th>
                        <th>Browser</th>
                        <th>IP</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">view</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($data as $key => $value)
                            <tr style="font-size: 12px !important">
                                <td>{{$value->transaction_id}}</td>
                                <td>{{$value->msisdn}}</td>
                                <td>{{$value->operator}}</td>
                                <td>{{$value->step}}</td>
                                <td>{{$value->action}}</td>
                                <td>{{$value->type}}</td>
                                <td>{{$value->mcc_mnc}}</td>
                                <td>{{$value->accepted}}</td>
                                <td>{{$value->warning_level}}</td>
                                <td>{{$value->device}}</td>
                                <td>{{$value->browser}}</td>
                                <td>{{$value->ip_address}}</td>
                                <td>{{date('d-m-Y H:i:s',strtotime($value->created_at))}}</td>
                                <td>
                                    <a href="{{getLink($value)}}" target="_blank" class="btn btn-xs btn-primary">
                                        <i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="view page"></i>
                                    </a>
                                  </td>


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
        </div><!--box-->
@stop

@section('after-scripts-end')

    {!! Html::script('js/template/datetimeactive.js') !!}
    {!! Html::script('js/template/jquery.datetimepicker.js') !!}
    {!! Html::script('js/backend/access/permissions/script.js') !!}
    {!! Html::script('js/backend/access/users/script.js') !!}
@stop
<style type="text/css">
    div.form-group {
        font-size: 11.5px !important;
    }
</style>
