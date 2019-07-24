<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Correspondencia</title>

    <link rel="stylesheet" href="{{ asset('css/perfect_scrollbar/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
       <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href=""><span>[</span>HR<span>]</span></a></div>
    <div class="br-sideleft overflow-y-auto">
      <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
      <div class="br-sideleft-menu">
      <a href="{{ route('correspondence.render') }}" class="{{Route::current()->getName() == 'correspondence.render' ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Correspondencia</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
      <a href="{{ route('third_parties.render') }}" class="{{Route::current()->getName() == 'third_parties.render' ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-person-outline tx-22"></i>
            <span class="menu-item-label">Terceros</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{route('dependencies.render')}}" class="{{Route::current()->getName() == 'dependencies.render' ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
            <span class="menu-item-label">Dependencias</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{route('employees.render')}}" class="{{Route::current()->getName() == 'employees.render' ? 'br-menu-link active' : 'br-menu-link'}}">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-people-outline tx-22"></i>
            <span class="menu-item-label">Funcionarios</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
       
        <a href="{{route('employees.render')}}" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-email-outline tx-22"></i>
            <span class="menu-item-label">Radicación</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
       
       
        <a href="pages.html" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-22"></i>
            <span class="menu-item-label">Configuración</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
       
      </div><!-- br-sideleft-menu -->

      <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">Información reciente</label>

      <div class="info-list">
        <div class="d-flex align-items-center justify-content-between pd-x-15">
          <div>
            <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Radicados</p>
            <h5 class="tx-lato tx-white tx-normal mg-b-0">32.3%</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div><!-- d-flex -->

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
          <div>
            <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">De entrada</p>
            <h5 class="tx-lato tx-white tx-normal mg-b-0">140.05</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
        </div><!-- d-flex -->

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
          <div>
            <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">De salida</p>
            <h5 class="tx-lato tx-white tx-normal mg-b-0">82.02%</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
        </div><!-- d-flex -->
      
      </div><!-- info-lst -->

      <br>
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    
    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
        <div class="br-header-left">
          <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
          <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
          <div class="input-group hidden-xs-down wd-170 transition">
            <input id="searchbox" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
            </span>
          </div><!-- input-group -->
        </div><!-- br-header-left -->
        <div class="br-header-right">
          <nav class="nav">
            <div class="dropdown">
              <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                <i class="icon ion-ios-email-outline tx-24"></i>
                <!-- start: if statement -->
                <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
                <!-- end: if statement -->
              </a>
              <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
                <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
                  <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Messages</label>
                  <a href="" class="tx-11">+ Add New Message</a>
                </div><!-- d-flex -->
  
                <div class="media-list">
                  <!-- loop starts here -->
                  <a href="" class="media-list-link">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <div class="d-flex align-items-center justify-content-between mg-b-5">
                          <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Donna Seay</p>
                          <span class="tx-11 tx-gray-500">2 minutes ago</span>
                        </div><!-- d-flex -->
                        <p class="tx-12 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                      </div>
                    </div><!-- media -->
                  </a>
                  <!-- loop ends here -->
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <div class="d-flex align-items-center justify-content-between mg-b-5">
                          <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Samantha Francis</p>
                          <span class="tx-11 tx-gray-500">3 hours ago</span>
                        </div><!-- d-flex -->
                        <p class="tx-12 mg-b-0">My entire soul, like these sweet mornings of spring.</p>
                      </div>
                    </div><!-- media -->
                  </a>
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <div class="d-flex align-items-center justify-content-between mg-b-5">
                          <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Robert Walker</p>
                          <span class="tx-11 tx-gray-500">5 hours ago</span>
                        </div><!-- d-flex -->
                        <p class="tx-12 mg-b-0">I should be incapable of drawing a single stroke at the present moment...</p>
                      </div>
                    </div><!-- media -->
                  </a>
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <div class="d-flex align-items-center justify-content-between mg-b-5">
                          <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Larry Smith</p>
                          <span class="tx-11 tx-gray-500">Yesterday</span>
                        </div><!-- d-flex -->
                        <p class="tx-12 mg-b-0">When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
                      </div>
                    </div><!-- media -->
                  </a>
                  <div class="pd-y-10 tx-center bd-t">
                    <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Messages</a>
                  </div>
                </div><!-- media-list -->
              </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
            <div class="dropdown">
              <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                <i class="icon ion-ios-bell-outline tx-24"></i>
                <!-- start: if statement -->
                <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
                <!-- end: if statement -->
              </a>
              <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
                <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
                  <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notifications</label>
                  <a href="" class="tx-11">Mark All as Read</a>
                </div><!-- d-flex -->
  
                <div class="media-list">
                  <!-- loop starts here -->
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                        <span class="tx-12">October 03, 2017 8:45am</span>
                      </div>
                    </div><!-- media -->
                  </a>
                  <!-- loop ends here -->
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
                        <span class="tx-12">October 02, 2017 12:44am</span>
                      </div>
                    </div><!-- media -->
                  </a>
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                        <span class="tx-12">October 01, 2017 10:20pm</span>
                      </div>
                    </div><!-- media -->
                  </a>
                  <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                      <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                      <div class="media-body">
                        <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                        <span class="tx-12">October 01, 2017 6:08pm</span>
                      </div>
                    </div><!-- media -->
                  </a>
                  <div class="pd-y-10 tx-center bd-t">
                    <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Notifications</a>
                  </div>
                </div><!-- media-list -->
              </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
            <div class="dropdown">
              <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                <span class="logged-name hidden-md-down">Cristhian</span>
                <img src="http://via.placeholder.com/64x64" class="wd-32 rounded-circle" alt="">
                <span class="square-10 bg-success"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-header wd-200">
                <ul class="list-unstyled user-profile-nav">
                  <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                  <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
                  <li><a href=""><i class="icon ion-ios-download"></i> Downloads</a></li>
                  <li><a href=""><i class="icon ion-ios-star"></i> Favorites</a></li>
                  <li><a href=""><i class="icon ion-ios-folder"></i> Collections</a></li>
                  <li><a href=""><i class="icon ion-power"></i> Sign Out</a></li>
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
            <div class="row row-sm">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/perfect_scrollbar/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('js/template.js')}}"></script>
    </body>
</html>
