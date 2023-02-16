class RouterUsuarios extends Backbone.Router {

    constructor(e){
        super(e)
    }

    static usuarios;

    initialize(){
        RouterUsuarios.usuarios = new UsuariosCollection();
        this.content = "containerBone";
        this.viewUsuarios = ViewUsuarios;
		this.viewShowUsuario = ViewShowUsuario;
		this.viewEditUsuario = ViewEditUsuario;
		this.viewCreateUsuario = ViewCreateUsuario;
    }

    routes(){
        return {
            'all':'allShowView',
            'detalle/:id':'detalleShowView',
            'edita/:id':'editaShowView',
            'crear':'crearShowView',
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

    allShowView(){
        this.createContent();
		if(RouterUsuarios.usuarios.length > 0)
		{
			new this.viewUsuarios({el: `#${this.content}`, collection: RouterUsuarios.usuarios}); 
			loading.hide();
		} else {
			loading.show();
            var $scope = this;
			axios({
				"method": 'get',
				"url": create_url('api/usuarios'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterUsuarios.setUsuarios(response.data);
					new $scope.viewUsuarios({el: `#${$scope.content}`, collection: RouterUsuarios.usuarios}); 
				} else {
					Swal.fire({
						position: 'center',
						type: 'error',
						text:  (_.size(response.data) == 0)? 'No hay datos disponibles de clientes' : '',
						title: 'Alerta error!',
						showConfirmButton: false,
						timer: 3000
					})
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		}
		return null;
    }

    detalleShowView(id){
		this.createContent();
		var $scope = this;
		if(RouterUsuarios.usuarios.length > 0)
		{
			let usuario = RouterUsuarios.usuarios.get(parseInt(id));
			if(usuario)
			{
				new this.viewShowUsuario({el: `#${this.content}`, model: usuario, className:'box animated'});
				loading.hide();
			}else{
				Routers.routerUsuarios.navigate("all", { trigger: true });
			}
		} else {
			loading.show();
			axios({
				"method": 'get',
				"url": create_url('api/usuarios'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterUsuarios.setUsuarios(response.data);
					let usuario = RouterUsuarios.usuarios.get(id);
					if(usuario){
						new $scope.viewShowUsuario({el: `#${$scope.content}`, model: usuario, className:'box animated'});
					}else{
						Routers.routerUsuarios.navigate("all", { trigger: true });
					}
				} else {
					Swal.fire({
						position: 'center',
						type: 'error',
						text:  (_.size(response.data) == 0)? 'No hay datos disponibles de clientes' : '',
						title: 'Alerta error!',
						showConfirmButton: false,
						timer: 3000
					})
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		}
		return null;
    }

    editaShowView(id){
		this.createContent();
		if(RouterUsuarios.usuarios.length > 0)
		{
			let usuario = RouterUsuarios.usuarios.get(id);
			if(usuario)
			{
				new this.viewEditUsuario({el: `#${this.content}`, model: usuario,  collection: RouterUsuarios.usuarios, className:'box animated'});
				loading.hide();
			} else {
				Routers.routerUsuarios.navigate("all", { trigger: true });
			}
		} else {
			loading.show();			
			var $scope = this;
			axios({
				"method": 'get',
				"url": create_url('api/usuarios'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterUsuarios.setUsuarios(response.data);

					let usuario = RouterUsuarios.usuarios.get(id);
					if(usuario){
						new $scope.viewEditUsuario({el: `#${$scope.content}`, model: usuario, collection: RouterUsuarios.usuarios, className:'box animated'});
					}else{
						Routers.routerUsuarios.navigate("all", { trigger: true });
					}
				} else {
					Swal.fire({
						position: 'center',
						type: 'error',
						text:  (_.size(response.data) == 0)? 'No hay datos disponibles de clientes' : '',
						title: 'Alerta error!',
						showConfirmButton: false,
						timer: 3000
					})
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		}
		return null;
    }

    crearShowView(){
		this.createContent();
		if(RouterUsuarios.usuarios.length === 0)
		{
			var $scope = this;
			axios({
				"method": 'get',
				"url": create_url('api/usuarios'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterUsuarios.setUsuarios(response.data);	
					new $scope.viewCreateUsuario({el: `#${$scope.content}`, collection: RouterUsuarios.usuarios, className:'box animated'});
					loading.hide();
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		} else {
			new this.viewCreateUsuario({el: `#${this.content}`, collection: RouterUsuarios.usuarios, className:'box animated'});
			loading.hide();
		}
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

    static setUsuarios(usuarios) {
		if(RouterUsuarios.usuarios === void 0) RouterUsuarios.usuarios = new UsuariosCollection();
        RouterUsuarios.usuarios.add(usuarios, {'merge': true});
	}
}

Routers.routerUsuarios = new RouterUsuarios();

$(function(){
	jQuery.datetimepicker.setLocale('es');
	if (!Backbone.history.start()) {
		Routers.routerUsuarios.navigate("all", { trigger: true });
	}
	document.querySelector('[data-bs-target="#configuracion_collapse"]').click();
});