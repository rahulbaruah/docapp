<header class="main-header">

            <!-- Logo -->
            <a href="/home" class="logo"><b>Mvd</b>Doc</a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li><a href="#"><span>Welcome {{ Auth::user()->name }}</span></a></li>
                        <li>
                            <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> Log Out
                                </a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>