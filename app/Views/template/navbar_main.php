<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-icon btn-round">
                    <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                    <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
                </button>
            </div>
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler border-0">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="javascript:;"><?= esc($title) ?></a>
        </div>

        <button class="navbar-toggler btn-toggle collapsed border-0" data-bs-toggle="collapse" data-bs-target="#navigationCollapse" type="button" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navigationCollapse">
            <form>
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="nc-icon nc-zoom-split"></i>
                        </div>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown btn-rotate">
                    <a id="dropdown_menu_link2" href="#" role="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        <i class="nc-icon nc-bell-55"></i>
                        <p><span class="d-lg-none d-md-block">Some Actions</span></p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdown_menu_link2">
                        <li>
                            <?= linkTo('logout', 'Cerrar sesión', 'class: dropdown-item') ?>    
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>