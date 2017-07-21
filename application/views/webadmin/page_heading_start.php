<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            <?php echo $pageTitle; ?>
            <small id="PageHeading"><?php echo $pageSubtitle; ?></small>
        </h4>
        <ol class="breadcrumb">
            <li><a href="<?php echo ADMIN_BASE_URL;?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <?php if(isset($secondContName)){?>
            <li><a href="<?php echo ADMIN_BASE_URL;?><?php echo $contName.'/'.$contAction;?>"> <i class="fa fa-building-o"></i> <?php echo $contNameLabel;?></a></li>
            <li class="active"><?php echo $secondContNameLabel;?></li>
            <?php }else{?>
            <li class="active"><?php echo $contNameLabel;?></li>
            <?php }?>
            <!--<li class="active">Pace page</li> -->
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">