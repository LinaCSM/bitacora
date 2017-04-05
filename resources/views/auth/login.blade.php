<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}"  id="formularioInicioSesion">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('user_red') ? ' has-error' : '' }}">
        @if ($errors->has('user_red'))
            <span class="help-block"><strong>{{ $errors->first('user_red') }}</strong></span>
        @endif
        <div class="col-md-10 col-md-offset-1">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input class="form-control" placeholder="Usuario" id="user_red" type="text" name="user_red" value="{{ old('user_red') }}" required  autofocus >
            </div>

        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="col-md-10 col-md-offset-1" >
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input class="form-control" placeholder="Contraseña"  id="password" type="password" class="form-control" name="password" required autofocus>
            </div>
            @if ($errors->has('password'))
                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8 col-md-offset-2">
            <div class="checkbox">
                <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Recordarme </label>
            </div>
            <div id="btnLogin">
                <input id="btnLogin" class="btn btn-lg btn-success btn-block" type="submit" value="Ingresar">
            </div>
        </div>
    </div>
</form>

