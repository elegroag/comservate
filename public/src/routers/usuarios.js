class RouterUsuarios extends Backnone.Router {

    constructor(e){
        super(e)
    }

    initialize(){
        this.content = "containerBone";
        this.viewUsuarios = ViewUsuarios;
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

    }

    detalleShowView(){

    }

    editaShowView(){

    }

    crearShowView(){

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

    setUsuarios($scope, usuarios) {
		if($scope.usuarios === void 0) $scope.usuarios = new UsuariosCollection();
        $scope.usuarios.add(usuarios, {'merge': true});
	}
}