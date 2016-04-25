@extends('../templates.admin')
@section('content')
    @if(Session::has('auth_error'))
        <div class="alert alert-danger" role="alert">
            <p class="text-center"> {{Session::get('auth_error')}} </p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ implode('', $errors->all('<p class="text-center">:message</p>')) }}
        </div>
    @endif


    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 login-form">
            <div class="row">
                <div class="admin-login-header">
                    Admin Login
                </div>
            </div>
            <div class='form_wrapper'>


                {{ Form::open(array('route' => 'authenticate', 'class'=>'form-horizontal')) }}
                <div class="form-group">
                    {{Form::label('username', 'Username', array('class' => 'col-lg-3 control-label'))}}


                    <div class="col-lg-5">

                        {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Usernmae')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('password', 'Password', array('class' => 'col-lg-3 control-label'))}}

                    <div class="col-lg-5">
                        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}

                    </div>
                </div>


                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">

                        {{ Form::submit('Login', array('class'=>'btn btn-primary'))}}
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
@stop