<div class="sidebar" data-color="default" data-active-color="warning">
    <div class="logo" style="background-color:#fff;">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small"></div>
        </a>
        <a href="" class="simple-text logo-normal" style='color:#66615b;'> COMSERVA</a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav"> 
            <li class='active' data-toggle-nav='recepcion'>
                <a data-toggle="collapse" href="#page_recepcion" aria-expanded="false">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>Recepción <b class="caret"></b></p>
                </a>
                <div class="collapse" id="page_recepcion">
                    <ul class="nav">
                        <li>
                            <?=linkTo('recepcion/index#buscar', '<span class="sidebar-mini-icon">B</span><span class="sidebar-normal"> Buscar </span>')?>
                        </li>
                    </ul>
                </div>
            </li>
           
            <li data-toggle-nav='poderes'>
                <a data-toggle="collapse" href="#page_poderes" aria-expanded="false">
                    <i class="nc-icon nc-briefcase-24"></i>
                    <p>Poderes <b class="caret"></b></p>
                </a>
                <div class="collapse" id="page_poderes">
                    <ul class="nav">
                        <li>
                            <?=linkTo('poderes/index#buscar', '<span class="sidebar-mini-icon">B</span><span class="sidebar-normal"> Buscar </span>')?>
                        </li>
                    </ul>
                </div>
            </li>
           
            <li data-toggle-nav='interventores'>
                <a data-toggle="collapse" href="#page_interventores" aria-expanded="false">
                    <i class="fa fa-users"></i>
                    <p>Interventores <b class="caret"></b></p>
                </a>
                <div class="collapse" id="page_interventores">
                    <ul class="nav">
                        <li>
                            <?=linkTo('interventores/index#listar', '<span class="sidebar-mini-icon">L</span><span class="sidebar-normal"> Listar </span>')?>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>