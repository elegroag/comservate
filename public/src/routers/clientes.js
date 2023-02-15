class RouterClientes extends Backbone.Router {
	constructor(options){
		super(options)
	}
	
    initialize() {
		this.content = "containerBone";
        this.errors = void 0;
		this.clientes = new ClientesCollection();
		this.municipios = new MunicipiosCollection();
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
		if($scope.clientes.length > 0)
		{
			new $scope.viewClientes({el: `#${$scope.content}`, collection: $scope.clientes}); 
			loading.hide();
		} else {
			loading.show();
			$scope.clientes.reset();
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
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		}
		return null;
	}

	detalleShowView(id = void 0) {
		this.createContent();
		var $scope = this;
		if($scope.clientes.length > 0)
		{
			let cliente = this.clientes.get(parseInt(id));
			if(cliente)
			{
				new this.viewShowCliente({el: `#${this.content}`, model: cliente, className:'box animated'});
				loading.hide();
			}else{
				Routers.routerClientes.navigate("all", { trigger: true });
			}
		} else {
			loading.show();
			$scope.clientes.reset();
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
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		}
		return null;
	}

	editaShowView(id = void 0) {
		this.createContent();
		var $scope = this;
		if(this.clientes.length > 0)
		{
			$scope.cliente = this.clientes.get(id);
			if($scope.cliente)
			{
				if(this.municipios.length > 0)
				{
					new $scope.viewEditCliente({el: `#${this.content}`, model: $scope.cliente,  collection: [ this.clientes, this.municipios], className:'box animated'});
					loading.hide();
				} else {
					axios({
						"method": 'get',
						"url": create_url('api/municipios'),
						"type": 'JSON',
						"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
					})
					.then(function(response){
						if(response.data)
						{
							$scope.setMunicipios($scope, response.data);
							new $scope.viewEditCliente({el: `#${$scope.content}`, model: $scope.cliente,  collection: [$scope.clientes, $scope.municipios], className:'box animated'});
						}
					}).catch(this.cathRequest).finally(function(){
						loading.hide();
					})
				}
			}else{
				Routers.routerClientes.navigate("all", { trigger: true });
			}
		} else {
			loading.show();			
			axios({
				"method": 'get',
				"url": create_url('api/cliente/require'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					$scope.setClientes($scope, response.data.clientes);
					$scope.setMunicipios($scope, response.data.municipios);

					let cliente = $scope.clientes.get(id);
					if(cliente){
						new $scope.viewEditCliente({el: `#${$scope.content}`, model: cliente, collection: [$scope.clientes, $scope.municipios], className:'box animated'});
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
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		}
		return null;
	}

	cathRequest(err){
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

	crearShowView() {
		this.createContent();
		if(this.municipios.length === 0)
		{
			var $scope = this;
			axios({
				"method": 'get',
				"url": create_url('api/cliente/require'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					$scope.setMunicipios($scope, response.data.municipios);
					$scope.setClientes($scope, response.data.clientes);
					
					new $scope.viewCreateCliente({el: `#${$scope.content}`, collection: [$scope.clientes, $scope.municipios], className:'box animated'});
					loading.hide();
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		} else {
			new this.viewCreateCliente({el: `#${this.content}`, collection: [ this.clientes, this.municipios], className:'box animated'});
			loading.hide();
		}
	}

	setClientes($scope, clientes) {
		if($scope.clientes === void 0) $scope.clientes = new ClientesCollection();
        $scope.clientes.add(clientes, {'merge': true});
	}

	setMunicipios($scope, municipios) {
		if($scope.municipios === void 0) $scope.municipios = new MunicipiosCollection();
        $scope.municipios.add(municipios, {'merge': true});
	}
}

Routers.routerClientes = new RouterClientes();

$(function(){
	jQuery.datetimepicker.setLocale('es');
	if (!Backbone.history.start()) {
		Routers.routerClientes.navigate("all", { trigger: true });
	}
	document.querySelector('[data-bs-target="#gestion_clientes_collapse"]').click();
});