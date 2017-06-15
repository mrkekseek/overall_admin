<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Overall Admin Panel</title>
        <!-- BEGIN LAYOUT FIRST STYLES -->
        <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
        <!-- END LAYOUT FIRST STYLES -->

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/template/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/template/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/template/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/template/layouts/layout5/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/layouts/layout5/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <!-- BEGIN CUSTOM STYLES -->
        <link href="/assets/css/app.css" rel="stylesheet" type="text/css" />
        <!-- END CUSTOM STYLES -->

        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    
    <body class="page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN CONTAINER -->
        <div class="wrapper">
            <!-- BEGIN HEADER -->
            <header class="page-header">
                <nav class="navbar mega-menu" role="navigation">
                    <div class="container-fluid">
                        <div class="clearfix navbar-fixed-top">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="toggle-icon">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </span>
                            </button>
                            <!-- End Toggle Button -->

                            <!-- BEGIN LOGO -->
                            <a href="/" class="page-logo">
                                <img src="/assets/template/layouts/layout5/img/logo.png" alt="Logo" />
                            </a>
                            <!-- END LOGO -->

                            <!-- BEGIN SEARCH -->
                            <form class="search" action="extra_search.html" method="GET">
                                <input type="name" class="form-control" name="query" placeholder="Search..." />
                                <a href="javascript:;" class="btn submit">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                            <!-- END SEARCH -->

                            <!-- BEGIN TOPBAR ACTIONS -->
                            <div class="topbar-actions">
                                <!-- BEGIN GROUP NOTIFICATION -->
                                <div class="btn-group-notification btn-group" id="header_notification_bar">
                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="badge">7</span>
                                    </button>
                                </div>
                                <!-- END GROUP NOTIFICATION -->

                                <!-- BEGIN GROUP INFORMATION -->
                                <div class="btn-group-red btn-group">
                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <!-- END GROUP INFORMATION -->

                                <!-- BEGIN USER PROFILE -->
                                <div class="btn-group-img btn-group">
                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <span>Hi, {{ Auth::user()->name }}</span>
                                        <img src="/assets/template/layouts/layout5/img/avatar1.jpg" alt="">
                                    </button>

                                    <ul class="dropdown-menu-v2" role="menu">
                                        <li>
                                            <a href="page_user_profile_1.html">
                                                <i class="icon-user"></i> My Profile
                                                <span class="badge badge-danger">1</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="app_calendar.html">
                                                <i class="icon-calendar"></i> My Calendar </a>
                                        </li>

                                        <li>
                                            <a href="app_inbox.html">
                                                <i class="icon-envelope-open"></i> My Inbox
                                                <span class="badge badge-danger"> 3 </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="app_todo_2.html">
                                                <i class="icon-rocket"></i> My Tasks
                                                <span class="badge badge-success"> 7 </span>
                                            </a>
                                        </li>

                                        <li class="divider"> </li>

                                        <li>
                                            <a href="page_user_lock_1.html">
                                                <i class="icon-lock"></i> Lock Screen
                                            </a>
                                        </li>

                                        <li>
                                            <a href="/logout">
                                                <i class="icon-key"></i> Log Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END USER PROFILE -->

                                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                <!--button type="button" class="quick-sidebar-toggler" data-toggle="collapse">
                                    <span class="sr-only">Toggle Quick Sidebar</span>
                                    <i class="fa fa-sign-out"></i>
                                </button-->
                                <!-- END QUICK SIDEBAR TOGGLER -->
                            </div>
                            <!-- END TOPBAR ACTIONS -->
                        </div>

                        <!-- BEGIN HEADER MENU -->
                        <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown dropdown-fw {{ request()->path() == '/' ? 'active open selected' : '' }}">
                                    <a href="/" class="text-uppercase">
                                        <i class="fa fa-tachometer"></i> Dashboard
                                    </a>
                                </li>

                                <li class="dropdown dropdown-fw {{ strpos(request()->path(), 'clubs') !== FALSE ? 'active open selected' : '' }}">
                                    <a href="/clubs/lists" class="text-uppercase">
                                        <i class="fa fa-futbol-o"></i> Clubs
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="{{ strpos(request()->path(), 'clubs/lists') !== FALSE ? 'active' : '' }}">
                                            <a href="/clubs/lists">
                                                <i class="fa fa-th-list"></i>
                                                List All
                                            </a>
                                        </li>

                                        <li class="{{ strpos(request()->path(), 'clubs/add') !== FALSE ? 'active' : '' }}">
                                            <a href="/clubs/add">
                                                <i class="fa fa-plus-circle"></i>
                                                Add New
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown dropdown-fw {{ strpos(request()->path(), 'federations') !== FALSE ? 'active open selected' : '' }}">
                                    <a href="/federations/lists" class="text-uppercase">
                                        <i class="fa fa-flag"></i> Federations
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="{{ strpos(request()->path(), 'federations/lists') !== FALSE ? 'active' : '' }}">
                                            <a href="/federations/lists">
                                                <i class="fa fa-th-list"></i>
                                                List All
                                            </a>
                                        </li>

                                        <li class="{{ strpos(request()->path(), 'federations/add') !== FALSE ? 'active' : '' }}">
                                            <a href="/federations/add">
                                                <i class="fa fa-plus-circle"></i>
                                                Add New
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown dropdown-fw {{ (strpos(request()->path(), 'servers') !== FALSE || strpos(request()->path(), 'subdomains') !== FALSE) ? 'active open selected' : '' }}">
                                    <a href="/servers/lists" class="text-uppercase">
                                        <i class="fa fa-server"></i> Servers & Subdomains
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="{{ strpos(request()->path(), 'servers/lists') !== FALSE ? 'active' : '' }}">
                                            <a href="/servers/lists">
                                                <i class="fa fa-th-list"></i>
                                                List all servers
                                            </a>
                                        </li>

                                        <li class="{{ strpos(request()->path(), 'servers/add') !== FALSE ? 'active' : '' }}">
                                            <a href="/servers/add">
                                                <i class="fa fa-plus-circle"></i>
                                                Add new server
                                            </a>
                                        </li>

                                        <li class="{{ strpos(request()->path(), 'subdomains/lists') !== FALSE ? 'active' : '' }}">
                                            <a href="/subdomains/lists">
                                                <i class="fa fa-th-list"></i>
                                                List all subdomains
                                            </a>
                                        </li>

                                        <li class="{{ strpos(request()->path(), 'subdomains/add') !== FALSE ? 'active' : '' }}">
                                            <a href="/subdomains/add">
                                                <i class="fa fa-plus-circle"></i>
                                                Add new subdomain
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown dropdown-fw {{ strpos(request()->path(), 'settings') !== FALSE ? 'active open selected' : '' }}">
                                    <a href="/settings/users" class="text-uppercase">
                                        <i class="fa fa-cogs"></i> Settings
                                    </a>
                                    
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="{{ strpos(request()->path(), 'settings/users') !== FALSE ? 'active' : '' }}">
                                            <a href="/settings/users">
                                                <i class="fa fa-users"></i>
                                                Users
                                            </a>
                                        </li>

                                        <li class="{{ strpos(request()->path(), 'settings/add') !== FALSE ? 'active' : '' }}">
                                            <a href="/settings/add">
                                                <i class="fa fa-users"></i>
                                                Add user
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- END HEADER MENU -->
                    </div>
                    <!--/container-->
                </nav>
            </header>
            <!-- END HEADER -->

            <div class="container-fluid">
                <div class="page-content">
                    @yield('breadcrumbs')
                    
                    @yield('content')

                    @if (session('message'))
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                {{ session('message') }}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (session('openModal'))
                    <div class="modal fade" id="not-club-add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="text-center text-danger">Sorry!</h3>
                                <p class="text-center">But, оnly the administrator has access to the page</p>
                              </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/template/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/template/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/template/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/assets/template/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!--script src="/assets/template/pages/scripts/components-select2.min.js" type="text/javascript"></script-->
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/template/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="/assets/template/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- BEGIN PAGE CUSTOM SCRIPTS -->
        <script src="/assets/js/app.js" type="text/javascript"></script>
        <!-- END PAGE CUSTOM SCRIPTS -->
        @yield('customJS')
    </body>
</html>
