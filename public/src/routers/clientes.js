class RouterClientes extends Backbone.Router {
	constructor(options){
		super(options)
	}
	
    initialize() {
		this.content = "containerBone";
        this.errors = void 0;
		this.clientes = new ClientesCollection();
		this.viewClientes = ViewClientes;
		this.viewShowCliente = ViewShowCliente;
		this.viewCreateCliente = ViewCreateCliente;
		this.viewEditCliente = ViewEditCliente;
    }

    routes(){
		return {
            "all": "allShowView",
	    	"detalle/:id": "detalleShowView",
			"edita/:id": "editaShowView",
	    	"crear": "crearShowView"
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

	allShowView() {
		this.createContent();
		var $scope = this;

		if(_.size($scope.clientes) > 0)
		{
			loading.show();
			new $scope.viewClientes({el: `#${$scope.content}`, collection: $scope.clientes}); 
			loading.hide();
		} else {
			loading.show();
			this.clientes.reset();
			axios({
				"method": 'get',
				"url": create_url('api/clientes'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					$scope.setClientes($scope, response.data);
					new $scope.viewClientes({el: `#${$scope.content}`, collection: $scope.clientes}); 
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
			}).catch(function(err){
				let message = (err.code == 'ERR_BAD_REQUEST')? err.response.data.message : err.message;
				if(err.code == 'ERR_NETWORK') message = 'No hay red disponible para acceder al servidor.';
				Swal.fire({
					position: 'center',
					type: 'error',
					text:  message,
					title: 'Alerta error!',
					showConfirmButton: false,
					timer: 3000
				})
			}).finally(function(){
				loading.hide();
			})
		}
		return null;
	}

	detalleShowView(id = void 0) {
		this.createContent();
		var $scope = this;
		if(_.size(this.clientes) > 0)
		{
			let cliente = this.clientes.get(id);
			if(cliente)
			{
				new this.viewShowCliente({el: `#${this.content}`, model: cliente, className:'box animated'});
				loading.hide();
			}else{
				Routers.routerClientes.navigate("all", { trigger: true });
			}
		} else {
			loading.show();
			this.clientes.reset();
			axios({
				"method": 'get',
				"url": create_url('api/clientes'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					$scope.setClientes($scope, response.data);
					let cliente = $scope.clientes.get(id);
					if(cliente){
						new $scope.viewShowCliente({el: `#${$scope.content}`, model: cliente, className:'box animated'});
					}else{
						Routers.routerClientes.navigate("all", { trigger: true });
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
			}).catch(function(err){
				let message = (err.code == 'ERR_BAD_REQUEST')? err.response.data.message : err.message;
				if(err.code == 'ERR_NETWORK') message = 'No hay red disponible para acceder al servidor.';
				Swal.fire({
					position: 'center',
					type: 'error',
					text:  message,
					title: 'Alerta error!',
					showConfirmButton: false,
					timer: 3000
				})
			}).finally(function(){
				loading.hide();
			})
		}
	}

	editaShowView(id = void 0)  {
		this.createContent();
		var $scope = this;
		if(_.size(this.clientes) > 0)
		{
			let cliente = this.clientes.get(id);
			if(cliente)
			{
				new this.viewEditCliente({el: `#${this.content}`, model: cliente, className:'box animated'});
				loading.hide();
			}else{
				Routers.routerClientes.navigate("all", { trigger: true });
			}
		} else {
			loading.show();
			this.clientes.reset();
			axios({
				"method": 'get',
				"url": create_url('api/clientes'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					$scope.setClientes($scope, response.data);
					let cliente = $scope.clientes.get(id);
					if(cliente){
						new $scope.viewEditCliente({el: `#${$scope.content}`, model: cliente, className:'box animated'});
					}else{
						Routers.routerClientes.navigate("all", { trigger: true });
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
			}).catch(function(err){
				let message = (err.code == 'ERR_BAD_REQUEST')? err.response.data.message : err.message;
				if(err.code == 'ERR_NETWORK') message = 'No hay red disponible para acceder al servidor.';
				Swal.fire({
					position: 'center',
					type: 'error',
					text:  message,
					title: 'Alerta error!',
					showConfirmButton: false,
					timer: 3000
				})
			}).finally(function(){
				loading.hide();
			})
		}
	}

	crearShowView() {
		this.createContent();
		new this.viewCreateCliente({el: `#${this.content}`, collection: this.clientes, className:'box animated'});
	}

	setClientes($scope, clientes) {
		if($scope.clientes == void 0) $scope.clientes = new ClientesCollection();
        $scope.clientes.add(clientes, {'merge': true});
	}
}

Routers.routerClientes = new RouterClientes();

$(function(){	
	if (!Backbone.history.start()) {
		Routers.routerClientes.navigate("all", { trigger: true });
	}
});