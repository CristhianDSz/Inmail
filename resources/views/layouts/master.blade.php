<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Correspondencia</title>

        <link rel="stylesheet" href="{{ asset('css/perfect_scrollbar/perfect-scrollbar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ionicons/css/ionicons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/multiselect/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        @yield('styles')

    </head>
    <body>
       <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href="">
    <img src="{{ $logo !== null ? asset('storage/'. $logo) : asset('img/logo.png')}}" alt="company logo" style="width:100px">  
    </a></div>
    <div class="br-sideleft overflow-y-auto">
      <label class="sidebar-label pd-x-15 mg-t-20">Menú principal</label>
      <div class="br-sideleft-menu">
      @can('view', App\Record::class)
        <a href="{{ route('correspondence.render') }}" class="{{Route::current()->named('correspondence.render')  ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Correspondencia</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
      @endcan

      @can('view', App\ThirdParty::class)
        <a href="{{ route('third_parties.render') }}" class="{{Route::current()->named('third_parties.render') ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-person-outline tx-22"></i>
            <span class="menu-item-label">Terceros</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
      @endcan
     
      @can('view', App\Dependency::class)
          <a href="{{route('dependencies.render')}}" class="{{Route::current()->getName() == 'dependencies.render' ? 'br-menu-link active' : 'br-menu-link'}}">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
              <span class="menu-item-label">Dependencias</span>
            </div><!-- menu-item -->
          </a><!-- br-menu-link -->  
      @endcan

      @can('view', App\Employee::class)
        <a href="{{route('employees.render')}}" class="{{Route::current()->getName() == 'employees.render' ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-people-outline tx-22"></i>
            <span class="menu-item-label">Funcionarios</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
      @endcan
       
       @can('viewControl', App\Record::class)
       <a href="{{route('tracking.index')}}" class="{{Route::current()->getName() == 'tracking.index' ? 'br-menu-link active' : 'br-menu-link'}}">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-email-outline tx-22"></i>
          <span class="menu-item-label">Seguimiento</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
       @elsecan('viewAccounting', App\Record::class)
       <a href="{{route('tracking.index')}}" class="{{Route::current()->getName() == 'tracking.index' ? 'br-menu-link active' : 'br-menu-link'}}">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-email-outline tx-22"></i>
          <span class="menu-item-label">Seguimiento</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
       @endcan
       

      <a href="#" class="{{
              Route::current()->getPrefix() === '/config' ? 'br-menu-link active' : 'br-menu-link'}}" id="config-item">
            <div class="br-menu-item">
              <i class="menu-item-icon ion-ios-gear-outline tx-20"></i>
              <span class="menu-item-label">Configuración</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a>
        <ul class="br-menu-sub nav flex-column">
        @can('view', App\User::class)
          <li class="nav-item"><a href="{{route('users.index')}}" class="nav-link">Usuarios</a></li>
        @endcan
        <li class="nav-item"><a href="{{route('permissions.index') }}" class="nav-link">Permisos</a></li>
        @can('view', App\Role::class)
          <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link">Roles</a></li>
        @endcan
        @can('view', App\Company::class)
        <li class="nav-item"><a href="{{route('companies.index') }}" class="nav-link">Empresa</a></li>
        @endcan
      </ul>

      <a href="{{ route('formats.index') }}" class="{{Route::current()->getName() == 'formats.index' ? 'br-menu-link active' : 'br-menu-link'}}">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
          <span class="menu-item-label">Generar planilla</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      @can('view', App\RecordEvent::class)
        <a href="{{route('events.index')}}" class="{{Route::current()->getName() == 'events.index' ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-time-outline tx-22"></i>
            <span class="menu-item-label">Bitácora de eventos</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
      @endcan
       
      </div><!-- br-sideleft-menu -->
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    
    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
        <div class="br-header-left">
          <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
          <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
          {{-- <div class="input-group hidden-xs-down wd-170 transition">
            <input id="searchbox" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
            </span>
          </div><!-- input-group --> --}}
        </div><!-- br-header-left -->
        <div class="br-header-right">
          <nav class="nav">
            {{-- <div class="dropdown">
              <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                <i class="icon ion-ios-bell-outline tx-24"></i>
                <!-- start: if statement -->
                <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
                <!-- end: if statement -->
              </a>
              <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
                <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
                  <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notificaciones</label>
                  <a href="" class="tx-11">Marcar como leídas</a>
                </div><!-- d-flex -->
  
                <div class="media-list">
                  <!-- loop starts here -->
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Usuario</strong> Ha registrado....</p>
                        <span class="tx-12">Julio 03, 2019 8:45am</span>
                      </div>
                    </div><!-- media -->
                  </a>
                  <!-- loop ends here -->
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Usuario</strong> ha entregado <strong class="tx-medium tx-gray-800">a la dependencia..</strong></p>
                        <span class="tx-12">Julio 02, 2019 12:44pm</span>
                      </div>
                    </div><!-- media -->
                  </a>
                
                  <div class="pd-y-10 tx-center bd-t">
                    <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Mostrar todas las notificaciones</a>
                  </div>
                </div><!-- media-list -->
              </div><!-- dropdown-menu -->
            </div><!-- dropdown --> --}}
            <div class="dropdown">
              <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                @if (Auth::check())
                <span class="logged-name hidden-md-down">
                    {{ Auth::user()->name }}
                </span>
                @endif
                <img src="http://via.placeholder.com/64x64" class="wd-32 rounded-circle" alt="">
                <span class="square-10 bg-success"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-header wd-200">
                <ul class="list-unstyled user-profile-nav">
                <li><a href="{{route('users.edit.password')}}"><i class="icon ion-ios-gear"></i> Contraseña</a></li>
                  <li><a  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     <i class="icon ion-power"></i>Cerrar sesión</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </li>
                </ul>
              </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
          </nav>
        </div><!-- br-header-right -->
      </div><!-- br-header -->
      <!-- ########## END: HEAD PANEL ########## -->

    <div class="br-mainpanel" id="app">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">@yield('pageTitle')</h4>
            {{-- <p class="mg-b-0"></p> --}}
        </div>
        
        <div class="br-pagebody mg-t-5 pd-x-30">
          @yield('content')
        </div>
        <footer class="br-footer">
            <div class="footer-center">
              <div class="mg-b-2">Copyright © 2019. Indexs S.A.S. Todos los derechos reservados.</div>
              <div>In-Mail - Software web de Correspondencia.</div>
            </div>
          
          </footer> 
    </div>
    
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/perfect_scrollbar/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('js/multiselect/select2.min.js')}}"></script>
    <script src="{{asset('js/template.js')}}"></script>
    <script>
      $("#config-item").click(function () {
       $(".br-menu-link.active").removeClass('active')
       $(this).addClass('active')
      })
    </script>

    <script>
      @auth
        window.Permissions = {!! json_encode(Auth::user()->allPermissions(), true) !!};
      @else
        window.Permissions = [];
      @endauth
    </script>
      @yield('scripts')
    </body>
</html>
