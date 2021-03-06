<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $MetaTitle;?></title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    
    <?php echo meta($meta);?>
    <!--<meta name="robots" content="index,follow" /> 
    <link rel="author" href=" https://www.egiftsportal.com"/> -->
    
    <?php if($ogImage!=''){?>
    <meta property="og:title" content="<?php echo $MetaTitle;?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php echo current_url();?>"/>
    <meta property="og:description" content="<?php echo $MetaTitle;?>"/>
    <meta property="og:site_name" content="<?php echo current_url();?>"/> 
    <meta property="fb:app_id" content="1705337169784949"/>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="<?php echo current_url();?>">
    <meta name="twitter:title" content="<?php echo $MetaTitle;?>">
        <?php if($this->uri->segment(1)=='resort'):?>
            <meta property="og:image" content="<?php echo ResortModiumURL.$ogImage;?>"/>
            <meta name="twitter:image" content="<?php echo ResortModiumURL.$ogImage;?>">
        <?php else:?>
            <meta property="og:image" content="<?php echo ToursModiumURL.$ogImage;?>"/>
            <meta name="twitter:image" content="<?php echo ToursModiumURL.$ogImage;?>">
        <?php endif;?>
    <?php }?>
    <!--<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>ionicons-2.0.1/css/ionicons.min.css">
    <link href="<?php echo SiteCSSURL;?>bootstrap.min.css" rel="stylesheet">
    <!--<link href="<?php //echo SiteCSSURL;?>font-awesome.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?php echo SiteCSSURL;?>flexslider.css" type="text/css" media="screen" />
    <link href="<?php echo SiteCSSURL;?>animate.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SiteCSSURL;?>style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>css/sweetalert.css">
    <script src="<?php echo SiteJSURL;?>modernizr.js"></script>
    <script type="text/javascript">
        myJsMain = window.myJsMain || {};
        myJsMain.adminBaseURL = '<?php echo ADMIN_BASE_URL;?>';
        myJsMain.MainSiteBaseURL = '<?php echo BASE_URL;?>';
        myJsMain.baseURL = '<?php echo BASE_URL;?>';
        myJsMain.SystemMessageName='Maldives Traveller System Message'
    </script>
</head>