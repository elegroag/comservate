class MunicipioModel extends Backbone.Model {
	constructor(options) {
		super(options);
	}

	initialize() {
		this.urlRoot = "http://localhost:8080/api/municipio";
	}

	defaults() {
		return {
			id: void 0,
			municipio: void 0,
			estado: void 0,
			departamento_id: void 0,
		};
	}

	validate(attrs) {
		let errors = [];
		let out = "";
		if ((out = Testeo.vacio(attrs.municipio, "municipio", "has_error")))
			errors.push(out);
		if ((out = Testeo.vacio(attrs.estado, "estado", "has_error")))
			errors.push(out);
		if (
			(out = Testeo.vacio(
				attrs.departamento_id,
				"departamento_id",
				"has_error"
			))
		)
			errors.push(out);
		return _.size(errors) > 0 ? errors : void 0;
	}
}
