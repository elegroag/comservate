class RouterMunicipios extends Backbone.Router {

    constructor(e){
        super(e)
    }

    static municipios;
    static content = "containerBone";

    initialize(){
        RouterMunicipios.municipios = new MunicipiosCollection();
        this.viewMunicipios = ViewMunicipios;
		this.viewMasivoMunicipio = ViewMasivoMunicipios;
    }

    routes(){
        return {
            'all':'allShowView',
            'masivo':'masivoShowView',
        }
    }

    createContent() {
		$("#"+RouterMunicipios.content).remove();
		let _el = document.createElement("div");
		_el.setAttribute("id", RouterMunicipios.content);
		document.getElementById("container").appendChild(_el);
		scroltop();
	}

    allShowView(){
        this.createContent();
		if(RouterMunicipios.municipios.length > 0)
		{
			new this.viewMunicipios({el: `#${RouterMunicipios.content}`, collection: RouterMunicipios.municipios}); 
			loading.hide();
		} else {
			loading.show();
            var $scope = this;
			axios({
				"method": 'get',
				"url": create_url('api/municipios'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterMunicipios.setMunicipios(response.data);
					new $scope.viewMunicipios({el: `#${RouterMunicipios.content}`, collection: RouterMunicipios.municipios}); 
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

    masivoShowView(){
		this.createContent();
		if(RouterMunicipios.municipios.length === 0)
		{
			var $scope = this;
			axios({
				"method": 'get',
				"url": create_url('api/municipios'),
				"type": 'JSON',
				"headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
			})
			.then(function(response){
				if(response.data)
				{
					RouterMunicipios.setMunicipios(response.data);	
					new $scope.viewCreateUsuario({el: `#${RouterMunicipios.content}`, collection: RouterMunicipios.municipios, className:'box animated'});
					loading.hide();
				}
			}).catch(this.cathRequest).finally(function(){
				loading.hide();
			})
		} else {
			new this.viewCreateUsuario({el: `#${RouterMunicipios.content}`, collection: RouterMunicipios.municipios, className:'box animated'});
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

    static setMunicipios(municipios) {
		if(RouterMunicipios.municipios === void 0) RouterMunicipios.municipios = new MunicipiosCollection();
        RouterMunicipios.municipios.add(municipios, {'merge': true});
	}
}

Routers.routerMunicipios = new RouterMunicipios();

$(function(){
	if (!Backbone.history.start()) {
		Routers.routerMunicipios.navigate("all", { trigger: true });
	}
	document.querySelector('[data-bs-target="#configuracion_collapse"]').click();
});