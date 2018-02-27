<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Carewell |  {{$page}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- TOP -->
    <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="/assets/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/assets/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/css/globals.css">
    <!-- FONT -->
    <link rel="stylesheet" href="/assets/css/offline/font-offline.css">
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
    <!-- AJAX -->
    <script src="/assets/js/offline/ajax-offline.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <!-- TOASTR -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    
    <script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>
  </head>
  <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="/dashboard" class="logo">
          <span class="logo-mini"><b>C</b>W</span>
          <span class="logo-lg"><b>Carewell</b></span>
        </a>
        <nav class="navbar navbar-static-top">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                    <li>
                      <ul class="menu">
                        <li>
                          <a href="#">
                            <div class="pull-left">
                              <img src="/images/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                      <a href="#">
                        <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                        </h3>
                        <div class="progress xs">
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>
                <li class="footer">
                  <a href="#">View all tasks</a>
                </li>
              </ul>
            </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{$user->user_profile}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{$user->user_first_name." ".$user->user_last_name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{$user->user_profile}}" class="img-circle" alt="User Image">
                <p>
                  {{$user->user_first_name." ".$user->user_last_name}}
                  <small>{{$user->user_position}}</small>
                  <small>Member since {{date("F j, Y",strtotime($user->user_created))}}</small>
                </p>
              </li>
              {{-- <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li> --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat view-profile">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="/logout" class="btn btn-default btn-flat" data-modalname="Sign Out?">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- SIDEBAR -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$user->user_profile}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{$user->user_first_name." ".$user->user_last_name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form ">
        <div class="user-id-display">
          <p style="margin:0;">{{$user->user_number}}</p>
        </div>
      </form>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="/dashboard">
            <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
          </a>
        </li>
        
        <li>
          <a href="/company">
            <i class="fa fa-building-o"></i> <span>COMPANY CENTER</span>
          </a>
        </li>
        <li>
          <a href="/member">
            <i class="fa fa-user"></i> <span>MEMBER CENTER</span>
          </a>
        </li>
        <li >
          <a href="/provider">
            <i class="fa fa-hospital-o"></i> <span>PROVIDER CENTER</span>
          </a>
        </li>
        <li>
          <a href="/doctor">
            <i class="fa fa-user-md"></i> <span>DOCTOR CENTER</span>
          </a>
        </li>
        <li>
          <a href="/billing">
            <i class="fa fa-credit-card"></i> <span>BILLING CENTER</span>
          </a>
        </li>
        <li >
          <a href="/availment">
            <i class="fa fa-medkit"></i> <span>AVAILMENT CENTER</span>
          </a>
        </li>
        <li >
          <a href="/payable">
            <i class="fa fa-paypal"></i> <span>PAYABLE</span>
          </a>
        </li>
        <li class="treeview">
          <a >
            <i class="fa fa-bar-chart"></i> <span>REPORTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="treeview-menu">
            <li><a href="/reports/availment"><i class="fa fa-circle-o"></i>AVAILMENT </a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>MONITORING</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>BREAKDOWN</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>ENDING NUMBER</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>SUMMARY</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>SETTINGS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/settings/admin"><i class="fa fa-universal-access"></i>ADMIN PANEL</a></li>
            <li><a href="/settings/coverage"><i class="fa fa-circle-o"></i>COVERAGE PLAN</a></li>
            <li><a href="/settings/developer"><i class="fa fa-circle-o"></i>DEVELOPER</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- CONTENT -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      {{$page}}
      <small>center</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        @if($page=='Dashboard')
        @else
        <li class="active">{{$page}}</li>
        @endif
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      
      @yield('content')
      <!-- MODALS DONT DELETE-->
      {{-- @include('carewell.modals.modal-lg')
      @include('carewell.modals.modal-md')
      @include('carewell.modals.modal-sm')
      @include('carewell.modals.modal-import-member') --}}
      @include('carewell.modals.user_center_modals')
      {{-- @include('carewell.modals.confirm-modal') --}}
      <div class="append-modal">
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- FOOTER -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Carewell </b> HMO
    </div>
    <strong>Allright reserved &copy; 2017 Powered by: <a href="#">DigimaHouse.com</a></strong>
  </footer>
  <!-- Control Sidebar -->
  @include('plugin.control_sidebar')
  <!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- BOTTOM -->
<!-- BOWER -->
<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/assets/bower_components/chart.js/Chart.js"></script>
<script src="/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/assets/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- PLUGINS -->
<script src="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="/assets/plugins/iCheck/icheck.min.js"></script>
<!-- ADMINLTE -->
<script src="/assets/js/adminlte.min.js"></script>
<script src="/assets/js/demo.js"></script>
<!-- PAGES -->
<script src="/assets/js/pages/user_center.js"></script>
<script src="/assets/js/pages/globals.js"></script>
<script src="/assets/js/pages/dashboardv2.js"></script>
<script src="/assets/js/pages/dashboard.js"></script>
<script src="/assets/js/pages/admin_center.js"></script>
<script src="/assets/js/pages/company_center.js"></script>
<script src="/assets/js/pages/member_center.js"></script>
<script src="/assets/js/pages/billing_center.js"></script>
<script src="/assets/js/pages/availment_center.js"></script>
<script src="/assets/js/pages/provider_center.js"></script>
<script src="/assets/js/pages/doctor_center.js"></script>
<script src="/assets/js/pages/payable_center.js"></script>
{{-- <script src="/assets/js/pages/report_center.js"></script> --}}
<script src="/assets/js/pages/settings_center.js"></script>
<script src="/assets/js/pages/settings_coverage.js"></script>
<script src="/assets/js/pages/settings_developer.js"></script>


<!-- SCRIPT -->
<script>
  $(function () {
    //select2
    $('.select2').select2()
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    })
 })
$('body').on('hidden.bs.modal', function (e) {
    if($('.modal').hasClass('in')) {
    $('body').addClass('modal-open');
    }
    else
    {
      $('div').removeClass('modal-backdrop');
    }    
});
 
</script>
</body>
</html>