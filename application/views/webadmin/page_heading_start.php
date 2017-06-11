<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $pageTitle; ?>
            <small id="PageHeading"><?php echo $pageSubtitle; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo ADMIN_BASE_URL;?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo ADMIN_BASE_URL;?><?php echo $contName.'/'.$contAction;?>" class="active"><?php echo $contNameLabel;?></a></li>
            <!--<li class="active">Pace page</li> -->
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">