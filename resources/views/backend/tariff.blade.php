
{{-- {{dd($data)}} --}}
@extends ('backend.layouts.master')

@section ('title',trans('lang.menu.tariff') . ' | ' . trans('lang.menu.list'))

@section('page-header')
    <h1>
        {{ trans('lang.menu.tariff') }}
        <small>{{ trans('lang.menu.list') }}</small>
    </h1>
    {!! Html::style('js/template/jquery.datetimepicker.css') !!}
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.tariff', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('lang.menu.tariff') }}</h3>

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
                    <tr style="font-size: 13px !important">
                        <th>id</th>
                        <th>simtype</th>
                        {{-- <th>country code</th> --}}
                        <th class="visible-lg">country name th</th>
                        <th class="visible-lg">country name en</th>
                        <th class="visible-lg">handset display</th>
                        <th>operator th</th>
                        <th>operator en</th>
                        <th class="visible-lg">data roaming charge</th>
                        <th>mcc mnc</th>
                        <th>mcc</th>
                        <th>mnc</th>
                        <th class="">flatrate</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($data as $key => $value)
                            <tr style="font-size: 12px !important">
                                <td>{{$value['id']}}</td>
                                <td>{{$value['sim_type']}}</td>
                                {{-- <td>{{$value['country_code']}}</td> --}}
                                <td>{{$value['country_name_th']}}</td>
                                <td>{{$value['country_name_en']}}</td>
                                <td>{{$value['handset_display']}}</td>
                                <td>{{$value['operator_th']}}</td>
                                <td>{{$value['operator_en']}}</td>
                                <td>{{$value['data_roaming_charge']}}</td>
                                <td>{{$value['mcc_mnc']}}</td>
                                <td>{{$value['mcc']}}</td>
                                <td>{{$value['mnc']}}</td>
                                <td>{{$value['flat_rate']}}</td>
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
        font-size: 11px !important;
    }
</style>
