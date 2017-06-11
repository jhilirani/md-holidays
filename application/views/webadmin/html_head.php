<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo SITE_NAME;?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>font-awesome-4.7.0/css/font-awesome.min.css">
        <!-- Ionicons 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>ionicons-2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>dist/css/skins/_all-skins.min.css">
        <!-- Pace style -->
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>plugins/pace/pace.min.css">
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>plugins/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>css/sweetalert.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            myJsMain = window.myJsMain || {};
            myJsMain.adminBaseURL = '<?php echo ADMIN_BASE_URL;?>';
            myJsMain.MainSiteBaseURL = '<?php echo BASE_URL;?>';
            myJsMain.baseURL = '<?php echo BASE_URL;?>';
            myJsMain.baseURL = '<?php echo BASE_URL;?>';
            myJsMain.SystemMessageName='Maldives Traveller System Message'
        </script>
        <style>
            .form-control{
                border-radius:4px !important;
            }
        </style>
    </head>