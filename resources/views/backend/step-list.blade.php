<?php $person = \Request::segment(3)?>
@extends ('backend.layouts.master')
@if(\Request::segment(3) == 'vip')
@section ('title', trans('lang.menu.step-vip') . ' | ' .trans('lang.menu.vip'))
@else
@section ('title', trans('lang.menu.step-normal') . ' | ' .trans('lang.menu.normal'))
@endif

@section('page-header')
    <h1>
        {{trans('lang.menu.management-step')}}
        @if(\Request::segment(3) == 'vip')
        <small>{{ trans('lang.menu.vip') }}</small>
        @else
        <small>{{ trans('lang.menu.normal') }}</small>
        @endif
    </h1>
@endsection

@section('content')
    {{-- {!! Form::open(['route' => 'admin.access.users.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!} --}}
    @if(\Request::segment(3) == 'vip')
    {!! Form::open(['route' => 'management.step.vip', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}
    @else
    {!! Form::open(['route' => 'management.step.normal', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}
    @endif
        <div class="box box-success">
            <div class="box-header with-border">
                @if(\Request::segment(3) == 'vip')
                <h3 class="box-title">{{ trans('lang.menu.step-list-vip') }}</h3>
                @else
                <h3 class="box-title">{{ trans('lang.menu.step-list-normal') }}</h3>
                @endif

                {{-- <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.header-buttons')
                </div> --}}
            </div><!-- /.box-header -->
            <div class="box-body">
                 {!! $view !!}
            </div>
            <div class="box box-info">
                <div class="box-body">
                    {{-- <div class="pull-left">
                        <a href="{{route('admin.access.users.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
                    </div> --}}
                    <div class="pull-right">
                     @permission('create-step')
                    <a href="{{\URL::to('admin/step/benefit?person='.genValueLink($person))}}" class="btn btn-ls btn-primary">
                                       Create Step
                                    </a>
                    @endauth
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
                        <th>Step</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Credit Limit</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $list)
                            <tr style="font-size: 12px !important">
                                <td>{{$list->id}}</td>
                                <td>{{$list->step}}</td>
                                <td>{{$list->person}}</td>
                                <td>{{$list->type}}</td>
                                <td>{{$list->price}}</td>
                                <td class="visible-lg">{!! date('d-m-Y H:i:s',strtotime($list->created_at )) !!}</td>
                                <td class="visible-lg">{!! $list->updated_at->diffForHumans() !!}</td>
                                <td>
                                     @permission('edit-step')
                                    <a href="{{\URL::to('/admin/step/benefit/'.$list->id.'/edit')}}" class="btn btn-xs btn-primary">
                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                                    </a>
                                    @endauth
                                     @permission('delete-step')
                                   <a data-method="delete" class="btn btn-xs btn-danger" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                    <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>
<form action="{{\URL::to('admin/step/benefit/'.$list->id)}}" method="POST" name="delete_item" style="display:none">
   <input type="hidden" name="_method" value="delete">
   {{ csrf_field() }}
</form>
</a>
@endauth
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
