class UsuarioModel extends Backbone.Model {
	constructor(options) {
		super(options);
	}

	static omitirPassword = false;

	initialize() {
		this.urlRoot = "http://localhost:8080/api/usuario";
	}

	defaults() {
		return {
            "id": void 0,
            "nombres": void 0,
            "usuario": void 0,
            "fecha_creacion": void 0,
            "correo": void 0,
            "estado": void 0,
			"password": void 0
		};
	}

	validate(attrs) {
		let errors = [];
		let out = "";
        
		if ((out = Testeo.vacio(attrs.nombres, "nombres", "has_error"))) errors.push(out);

		if ((out = Testeo.vacio(attrs.usuario, "usuario", "has_error"))) errors.push(out);

        if ((out = Testeo.vacio(attrs.correo, "correo", "has_error"))) errors.push(out);

        if ((out = Testeo.vacio(attrs.estado, "estado", "has_error"))) errors.push(out);

		if(UsuarioModel.omitirPassword === false) {
			if ((out = Testeo.vacio(attrs.password, "password", "has_error"))) errors.push(out);
		}
		return _.size(errors) > 0 ? errors : void 0;
	}
}