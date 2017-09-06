<div class="login_banner">
    <div class="loginbanner_inner">
        <div class="container">
            <div class="bread_cum"> <a href="<?php echo BASE_URL;?>">Home</a> > 
                <?php if(count($breadCrumb)==2){?>
                <a href="<?php echo $breadCrumb['link1']['url'];?>"><?php echo $breadCrumb['link1']['label'];?></a>
                >
                <?php echo $breadCrumb['link2']['label'];?>
                <?php }else if(count($breadCrumb)==1){ ?>
                <?php echo $breadCrumb['link1']['label']; }else if(count($breadCrumb)==3){?>
                <a href="<?php echo $breadCrumb['link1']['url'];?>"><?php echo $breadCrumb['link1']['label'];?></a>
                > <a href="<?php echo $breadCrumb['link2']['url'];?>"><?php echo $breadCrumb['link2']['label'];?></a>
                > <?php echo $breadCrumb['link3']['label'];?>
                <?php }?>
            </div>
        </div>
    </div>
</div>