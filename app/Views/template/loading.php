<script type='text/template' id='tmp_modal'>
	<div class="modal-dialog <%=size%>">
		<div class="modal-content">
			<div class="modal-header" style='padding: 5px 8px;'>
				<div class="row">
					<div class="col-11"><h6 class="modal-title"><%=title%></h6></div>
					<div class="col-1">
						<a type='button' class="btn-close" data-bs-dismiss="modal"><i class='fa fa-times'></i></a>
					</div>
				</div>
			</div>
			<div class="modal-body"><%=content%></div>
			<% if(footer !== -1){ %>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary">Continuar</button>
				</div>
			<% } %>
		</div>
	</div>
</script>

<script type='text/template' id='tmp_busqueda_invalid'>
	<div class='row'>
		<div class="pull-right" style='z-index:3000; position:absolute; right:10px;'>
			<a href='#' class="btn btn-sm btn-outline-primary btn-round" id='bt_back'><i class="fa fa-heart"></i> Salir</a>
		</div>
		<div class="col-md-6 ml-auto mr-auto">
			<div class="card-testimonial">
				<div class="card-body">
					<h4 class="card-title">Notificación Asamblea</h4>
					<p><%=msj%></p><br/>
					<div class="card-avatar">
						<a href="javascript:;"></a>
					</div>
				</div>
				<div class="card-footer ">
					<h6 class="card-category">@Comfaca</h6>
				</div>
			</div>
		</div>
	</div>
</script>

<div class="modal fade" id="notice_modal" tabindex="-1" role="dialog" aria-labelledby="notice" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="nc-icon nc-simple-remove"></i>
				</button>
				<h5 class="modal-title" id='mdl_set_title'></h5>
			</div>
			<div class="modal-body" id='mdl_set_body'></div>
			<div class="modal-footer justify-content-center" id='mdl_set_footer'>
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal" id='mdl_set_button'>Continuar!</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="dialog_modal" tabindex="-1" role="dialog" aria-labelledby="notice" aria-hidden="true">
	<div class="modal-dialog modal-dialog">
		<div class="modal-content" id='mdl_set_body'>
		</div>
	</div>
</div>

<script type='text/template' id='tmp_loader'>
    <div class="loader-inner">
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
    </div>
</script>

<script type='text/javascript'>
    const loading = (function($){
        let _status = void 0;
        let _element = void 0;
        let _loader = void 0;
        let _tmp = {};
        
        const Show = function(out = false){
            if(out){
                _element = document.createElement('div');
                _element.setAttribute('id', 'loading_msj');
                $(_element).html("<div class='loading_msj'><p class='text-warning'>Procesando datos de busqueda...</p></div>");
                document.getElementById('app').appendChild(_element);
            }
            if(!_status){
                _tmp.loading = _.template($('#tmp_loader').html());
                _loader = document.createElement('div');
                _loader.setAttribute('class','loader');
                _loader.setAttribute('id','loader');
                $(_loader).append(_tmp.loading());
                document.body.appendChild(_loader);
                _loader.setAttribute('style','display:block');
            }
            _status = true;
        };

        const Hide = function(out = false){
            if(out){
                _element.remove();
            }
            if(_status){
                _loader.remove();
            }
            _status = void 0;
        };
        
        return {
            "hide":Hide,
            "show":Show
        }
    })(jQuery);
</script>