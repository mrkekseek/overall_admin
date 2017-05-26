<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Website</title>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/uniform.default.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="/assets/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
    </head>
    
    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="/">
                <img src="/assets/images/logo-big.png" alt="" />
            </a>
        </div>
        <!-- END LOGO -->

        @yield('content')

        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/js/template/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/js/template/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/additional-methods.min.js" type="text/javascript"></script>
        <script src="/assets/js/template/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/js/template/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/assets/js/template/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>
</html>