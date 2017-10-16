<aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->

                <!-- search form (Optional) -->
                
                <!-- /.search form -->

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <!-- Optionally, you can add icons to the links -->
                    @if(Auth::user()->role == 'admin')
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user pull-left"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/users/create">Add New User</a></li>
                            <li><a href="/admin/users">View All Users</a></li>
                        </ul>
                    </li>
                    @endif
                    
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user-md pull-left"></i> <span>Doctors</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/doctors/create">Add Doctor</a></li>
                            <li><a href="/doctors">View All Doctors</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="/searchpatient"><i class="fa fa-hospital-o"></i> <span>Referred Patient Entry</span></a></li>
                </ul><!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>