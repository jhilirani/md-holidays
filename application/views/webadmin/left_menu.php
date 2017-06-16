<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel 
        <div class="user-panel">
            <div class="pull-left image">
                <i class="fa fa-user fa-5x" aria-hidden="true" style="color: #FFF;"></i>
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo ADMIN_BASE_URL;?>">
                    <i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span>
                    <!--<span class="pull-right-container">
                        <small class="label pull-right bg-red">3</small>
                        <small class="label pull-right bg-blue">17</small>
                    </span>-->
                </a>
            </li>
            <!--<li class="treeview active">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                    <li><a href="profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                    <li><a href="login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                    <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                    <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                    <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                    <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                    <li><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                    <li class="active"><a href="pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Multilevel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                </ul>
            </li>-->
            <li><a href="<?php echo ADMIN_BASE_URL.'category';?>"><i class="fa fa-tags"></i><i class="fa fa-tasks"></i><span>Category Manager</span></a></li>
            <!--<li class="header">LABELS</li>-->
            <li><a href="<?php echo ADMIN_BASE_URL.'cms/viewlist';?>"><i class="fa fa-tags"></i><i class="fa fa-tasks"></i><span>Static Page Manager</span></a></li>
            <li><a href="<?php echo ADMIN_BASE_URL.'banner/viewlist';?>"><i class="fa fa-tags"></i><i class="fa fa-picture-o"></i><span>Banner Manager</span></a></li>
            <li><a href="<?php echo ADMIN_BASE_URL.'adminuser/viewlist';?>"><i class="fa fa-tags"></i><i class="fa fa-user-circle-o"></i><span>Adminuser Manager</span></a></li>
            <li><a href="<?php echo ADMIN_BASE_URL.'menu/viewlist';?>"><i class="fa fa-tags"></i><i class="fa fa-bars"></i><span>Menu Manager</span></a></li>
            <li><a href="<?php echo ADMIN_BASE_URL.'site_config/viewlist';?>"><i class="fa fa-tags"></i><i class="fa fa-cogs"></i><span>Site Config Manager</span></a></li>
            <li class="treeview">
                <a href="javascript:void(0);">
                    <i class="fa fa-tags"></i><i class="fa fa-cutlery"></i><i class="fa fa-bed"></i><i class="fa fa-beer"></i><span>Resort</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo ADMIN_BASE_URL.'resort/viewlist';?>"><i class="fa fa-cutlery"></i> <i class="fa fa-bed"></i><i class="fa fa-beer"></i>Resort Manager</a></li>
                    <li><a href="<?php echo ADMIN_BASE_URL.'facility/viewlist';?>"><i class="fa fa-building"></i>Facility</a></li>
                    <li><a href="<?php echo ADMIN_BASE_URL.'factfile/viewlist';?>"><i class="fa fa-circle-o"></i> Factfile</a></li>
                    <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                    <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                    <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                    <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                    <li><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                    <li class="active"><a href="pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->