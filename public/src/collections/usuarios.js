class UsuariosCollection extends Backbone.Collection {
	constructor(options) {
		super(options);
		this.url = "http://localhost:8080/api/usuarios";
		this.model = UsuarioModel;
	}
}
