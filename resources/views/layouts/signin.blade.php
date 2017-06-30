<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Website</title>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/template/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/template/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/template/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/template/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="/assets/template/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->

        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    
    <body class=" login">

        @yield('content')

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
        <script src="/assets/template/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="/assets/template/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/template/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/assets/template/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>
</html>