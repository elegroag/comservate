class ClientesCollection extends Backbone.Collection {
	constructor(options) {
		super(options);
		this.url = "http://localhost:8080/api/clientes";
		this.model = ClienteModel;
	}
}
