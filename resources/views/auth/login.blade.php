<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>In-Mail - Software de correspondencia</title>

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main>
          <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
          <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
          <img class="wd-100" src="{{asset('img/inmail.png') }}" alt="Inmail">
          </div>
          <div class="tx-center mg-b-5">Software de correspondencia en la nube</div>

          <div class="signin-logo tx-center tx-28 tx-bold tx-inverse mg-b-20">
            <img class="wd-100" src="{{ $logo !== null ? asset('storage/'.$logo) : asset('img/logo.png') }}" alt="Insuma">
          </div>
  
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="form-group">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Ingrese su usuario" autofocus>
            
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div><!-- form-group -->
                      <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingrese su contraseña">
            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div><!-- form-group -->
                      <button type="submit" class="btn btn-teal btn-block">Iniciar sesión</button>
            </form>
  
          <div class="mg-t-60 tx-center">Para más información visite: <a href="" class="tx-info">Indexs S.A.S</a></div>
        </div><!-- login-wrapper -->
      </div>

        </main>
    </div>
</body>
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
