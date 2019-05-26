<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name}}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Posts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i> Posts</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i> Categories</a></li>
                </ul>
            </li>
            <li><a href="{{url(route('clients.index'))}}"><i class="fa fa-users"></i> <span>Clients</span></a></li>
            <li><a href="{{url(route('governments.index'))}}"><i class="fa fa-list"></i> <span>Governments</span></a></li>
            <li><a href="{{url(route('cities.index'))}}"><i class="fa fa-home"></i> <span>Cities</span></a></li>
            <li><a href="{{url(route('categories.index'))}}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
            <li><a href="{{url(route('posts.index'))}}"><i class="fa fa-pencil"></i> <span>Posts</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url(route('contacts.index'))}}"><i class="fa fa-inbox"></i> Inbox</a></li>
                    <li><a href="{{url(route('read'))}}"><i class="fa fa-envelope-open"></i> Read</a></li>
                    <li><a href="{{url(route('trash'))}}"><i class="fa fa-trash"></i> Trash</a></li>
                </ul>
            </li>
            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Settings</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>