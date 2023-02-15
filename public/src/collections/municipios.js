class MunicipiosCollection  extends Backbone.Collection {
	constructor(options) {
		super(options);
		this.url = "http://localhost:8080/api/municipios";
		this.model = MunicipioModel;
	}
}
