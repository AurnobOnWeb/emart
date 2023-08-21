<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu Bar
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin') ? 'active' : '' }}" href="{{ route('admin') }}"><i class="far fa-chart-bar"></i>Dashboard</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Route::is('banner.index','banner.create','banner.edit') ? 'active' : '' }} " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="far fa-images"></i>Banner <span class="badge badge-success">6</span></a>
                        <div id="submenu-1" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('banner.index') }}"> All Banner</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('banner.create') }}"> Add Banner</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Route::is('category.index','category.create','category.edit') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-sitemap"></i> Category <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('category.index') }}">All Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('category.create') }}">Add Category</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Route::is('brand.index','brand.create','brand.edit') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-cubes"></i> Brand <span class="badge badge-success">6</span></a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('brand.index') }}">All Brand</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('brand.create') }}">Add Brand</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Route::is('product.index','product.create','product.edit') ? 'active' : '' }} " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class=" fas fa-briefcase"></i>Product Management <span class="badge badge-success">6</span></a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('product.index') }}">All Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('product.create') }}">Add product</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('order') ? 'active' : '' }}" href="{{ route('admin') }}"><i class="fas fa-shopping-basket"></i>Order Management</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class=" fas fa-shopping-cart"></i>carts <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-list-alt"> All Category</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-plus-circle"> Add Category</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-list-alt"></i>Post category <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-list-alt"> All Category</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-plus-circle"> Add Category</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-tag"></i>Post Tag <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-list-alt"> All Category</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-plus-circle"> Add Category</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-list-alt"></i>Posts <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-list-alt"> All Category</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-plus-circle"> Add Category</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class=" fas fa-star"></i>Review Management <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-list-alt"> All Category</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-plus-circle"> Add Category</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class=" fas fa-comments"></i>Comment Management <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-list-alt"> All Category</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-plus-circle"> Add Category</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle "></i>User Management <span class="badge badge-success">6</span></a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-list-alt"> All Category</i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-plus-circle"> Add Category</i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('settings') ? 'active' : '' }}" href="{{ route('admin') }}"><i class="fa fa-cog"></i>Settings</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
