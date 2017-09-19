@extends ('backend.layouts.master')

@section ('title', trans('lang.menu.management-step') . ' | ' .trans('lang.menu.create-step'))

@section('page-header')
    <h1>
         {{trans('lang.menu.management-step')}}
         @if(\Request::segment(5) == 'edit')
        <small>Edit Step</small>
        @else
        <small>{{ trans('lang.menu.create-step') }}</small>
        @endif
    </h1>
@endsection

@section('content')
    @if(\Request::segment(5) =='edit')
    {!! Form::open(['url' => 'admin/step/benefit/'.\Request::segment(4), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'put']) !!}
    @else
    {!! Form::open(['route' => 'management.admin.step.benefit.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
    @endif
        <div class="box box-success">
            <div class="box-header with-border">
             @if(\Request::segment(4))
                <h3 class="box-title">Edit Step</h3>
                @else
                <h3 class="box-title">{{ trans('lang.menu.create-step') }}</h3>
                @endif
{{--
                <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.header-buttons')
                </div> --}}
            </div><!-- /.box-header -->

            <div class="box-body">
                {!! $view!!}
                @if(\Request::segment(4))
                <input type="hidden" name="id_step" value="{{\Request::segment(4)}}" >
                @endif
            </div><!-- /.box-body -->
            <div class="box box-info">
             <div class="box-body">
                <div class="pull-left">
                    <a href="#" id="back" class="btn btn-danger btn-ls">Back</a>
                </div>
                @if(\Request::segment(5) == 'edit')
                <div class="pull-right">
                    <input type="submit" class="btn btn-success btn-ls" value="{{ trans('buttons.general.crud.edit') }}" />
                </div>
                @else
                <div class="pull-right">
                    <input type="submit" id='create' class="btn btn-success btn-ls" value="{{ trans('buttons.general.crud.create') }}" />
                </div>
                @endif
                <div class="clearfix"></div>
            </div><!-- /.box-body -->
            </div>
        </div><!--box-->



    {!! Form::close() !!}
@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/script.js') !!}
    {!! Html::script('js/backend/access/users/script.js') !!}
    {!! Html::script('js/backend/validate.js') !!}
@stop
