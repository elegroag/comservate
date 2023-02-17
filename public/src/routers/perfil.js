class RouterPerfil extends Backbone.Router {
    constructor(e){
        super(e)
    }

    static usuarioPerfil = void 0;

    initialize(){
        this.content = "containerBone";
        this.usuarioLocal = usuario_local();
        this.viewPerfil = ViewPerfil;
		this.viewEditPerfil = ViewEditPerfil;
		this.usuarioModel = UsuarioModel;
    }

    routes(){
        return {
            'show':'showDetallePerfil',
            'edita': 'editaPerfil'
        }
    }

    createContent() {
		$("#" + this.content).remove();
		let _el = document.createElement("div");
		_el.setAttribute("id", this.content);
		_el.setAttribute("class", "box");
		document.getElementById("container").appendChild(_el);
		scroltop();
		return _el;
	}

    cathRequest(err){
        console.log(err);
		let message = (err.code == 'ERR_BAD_REQUEST')? err.response.data.message : err.message;
		if(err.code == 'ERR_NETWORK') message = 'No hay red disponible para acceder al servidor.';
		Swal.fire({
			position: 'center',
			type: 'error',
			text:  message,
			title: 'Alerta error!',
			showConfirmButton: false,
			timer: 3000
		});
	}

    showDetallePerfil(){
        this.createContent();
		var $scope = this;
		if(RouterPerfil.usuarioPerfil === void 0)
		{
			loading.show();
            let id = this.usuarioLocal.id;
			axios({
				"method": 'get',
				"url": create_url('api/usuario/show/'+id),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterPerfil.usuarioPerfil = new $scope.usuarioModel(response.data);
                    new $scope.viewPerfil({el: `#${$scope.content}`, model: RouterPerfil.usuarioPerfil, className:'box animated'});
				} else {
					Swal.fire({
						position: 'center',
						type: 'error',
						text:  (_.size(response.data) == 0)? 'No hay datos disponibles del usuario' : '',
						title: 'Alerta error!',
						showConfirmButton: false,
						timer: 3000
					})
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		} else {
            new this.viewPerfil({el: `#${this.content}`, model: RouterPerfil.usuarioPerfil, className:'box animated'});
            loading.hide();
        }
		return null;
    }

    editaPerfil(){
        this.createContent();
		var $scope = this;
		if(RouterPerfil.usuarioPerfil === void 0)
		{
			loading.show();
            let id = this.usuarioLocal.id;
			axios({
				"method": 'get',
				"url": create_url('api/usuario/show/'+id),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterPerfil.usuarioPerfil = new $scope.usuarioModel(response.data);
                    new $scope.viewEditPerfil({el: `#${$scope.content}`, model: RouterPerfil.usuarioPerfil, className:'box animated'});
				} else {
					Swal.fire({
						position: 'center',
						type: 'error',
						text:  (_.size(response.data) == 0)? 'No hay datos disponibles del usuario' : '',
						title: 'Alerta error!',
						showConfirmButton: false,
						timer: 3000
					})
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		} else {
            new this.viewEditPerfil({el: `#${this.content}`, model: RouterPerfil.usuarioPerfil, className:'box animated'});
            loading.hide();
        }
		return null;
    }
}

Routers.routerPerfil = new RouterPerfil();

$(function(){
    if(!Backbone.history.start()){
        Routers.routerPerfil.navigate('show', {trigger: true});
    }
    document.querySelector('[data-bs-target="#datos_de_usuario_collapse"]').click();
});