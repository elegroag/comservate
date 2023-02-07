<div class="sidebar" data-color="default" data-active-color="warning">
    <div class="logo" style="background-color:#fff;">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small"></div>
        </a>
        <a href="" class="simple-text logo-normal" style='color:#66615b;'> COMSERVA</a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav list-unstyled ps-0">
            <li class="mb-1">
                <a  data-toggle="collapse" class="btn-toggle align-items-center collapsed fs-6" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>Home <b class="caret"></b></p>
                </a>
                <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled pb-0">
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">B</span><span class="sidebar-normal"> Buscar </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">U</span><span class="sidebar-normal"> Updates </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">R</span><span class="sidebar-normal"> Reports </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a  data-toggle="collapse" class="btn-toggle align-items-center collapsed fs-6" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    <i class="nc-icon nc-briefcase-24"></i>
                    <p>Dashboard <b class="caret"></b></p>
                </a>
                <div class="collapse" id="dashboard-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-0 small">
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">B</span><span class="sidebar-normal"> Buscar </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">U</span><span class="sidebar-normal"> Updates </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">R</span><span class="sidebar-normal"> Reports </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a  data-toggle="collapse" class="btn-toggle align-items-center collapsed fs-6" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    <i class="fa fa-users"></i>
                    <p>Orders <b class="caret"></b></p>
                </a>
                <div class="collapse" id="orders-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-0 small">
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">B</span><span class="sidebar-normal"> Buscar </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">U</span><span class="sidebar-normal"> Updates </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">R</span><span class="sidebar-normal"> Reports </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                    </ul>
                </div>
            </li>
            <li class="border-top my-3"></li>
            <li class="mb-1">
                <a  data-toggle="collapse" class="btn-toggle align-items-center collapsed fs-6" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>Account <b class="caret"></b></p>
                </a>
                <div class="collapse" id="account-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-0 small">
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">B</span><span class="sidebar-normal"> Buscar </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">U</span><span class="sidebar-normal"> Updates </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                        <li>
                            <?= linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">R</span><span class="sidebar-normal"> Reports </span>', 'class: link-warning ps-2 pb-0 fs-6') ?>    
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>