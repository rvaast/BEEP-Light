@extends('layouts.app')

@section('page-title') {{ __('crud.create',['item'=>__('general.user')]) }}
@endsection

@section('content')

	@if (count($errors) > 0)
		<div class="alert alert-danger">
			{{ __('crud.input_err') }}:<br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::open(array('route' => 'users.store','method'=>'POST','files'=>'true')) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>{{ __('crud.name') }}:</label>
                {!! Form::text('name', null, array('placeholder' => __('crud.name'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>{{ __('crud.email') }}:</label>
                {!! Form::text('email', null, array('placeholder' => __('crud.email'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>{{ __('crud.avatar') }}:</label>
                {!! Form::file('avatar', array('class' => 'btn btn-default')) !!}
                <p class="help-block">{{ __('crud.avatar_file') }}</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>{{ __('crud.pass') }}:</label>
                {!! Form::password('password', array('placeholder' => __('crud.pass'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>{{ __('crud.pass_confirm') }}:</label>
                {!! Form::password('confirm-password', array('placeholder' => __('crud.pass_confirm'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>{{ __('general.Sensors') }}:</label>
                {!! Form::select('sensors[]', $sensors, [], array('class' => 'form-control','multiple')) !!}
                <p class="help-block">{{ __('crud.select_multi', ['item'=>__('general.sensor')]) }}</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>{{ __('general.Role') }}:</label>
                {!! Form::select('roles[]', $roles, [], array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary btn-block">{{ __('crud.save') }}</button>
        </div>
	</div>
    {!! Form::hidden('api-token', str_random(60)) !!}
	{!! Form::close() !!}
@endsection