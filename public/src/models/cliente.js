class ClienteModel extends Backbone.Model{
	constructor(options){
		super(options);
		this.urlRoot = "http://localhost:8080/api/clientes";
	}
	initialize(){
		//console.log("inicializa el modelo de login");
	}
	defaults(){
		return {
			cedula: void 0,
			nit: void 0,
			afiliado: void 0,
			representante: void 0,
			ruta: void 0,
			id_municipio: void 0,
			frecuencia: void 0,
			contrato: void 0,
			fecha_finalizacion: void 0,
			valor_kilo: void 0,
			kilos: void 0,
			valor_kilo_adicional: void 0,
			direccion: void 0,
			telefono: void 0,
			barrio: void 0,
			correo: void 0,
			especiales: void 0,
			fecha_creacion: void 0,
			fecha_modificacion: void 0,
			usuario_creador: void 0,
			estado: void 0,
			mapa: void 0,
			syncros: void 0,
		}
	}
	validate(attrs){
		let errors = [];
		let out = "";
		if ((out = Testeo.vacio(attrs.cedula, "cedula", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.nit, "nit", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.representante, "representante", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.afiliado, "afiliado", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.id_municipio, "id_municipio", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.direccion, "direccion", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.telefono, "telefono", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.barrio, "barrio", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.correo, "correo", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.kilos, "kilos", "has-error"))) errors.push(out);
		if ((out = Testeo.vacio(attrs.valor_kilo, "valor_kilo", "has-error"))) errors.push(out);
		if ((out = Testeo.numerico(attrs.id_municipio, "id_municipio", "has-error"))) errors.push(out);
		if ((out = Testeo.numerico(attrs.telefono, "telefono", "has-error"))) errors.push(out);
		if ((out = Testeo.decimal(attrs.valor_kilo, "valor_kilo", "has-error"))) errors.push(out);
		if ((out = Testeo.decimal(attrs.kilos, "kilos", "has-error"))) errors.push(out);
		if ((out = Testeo.decimal(attrs.valor_kilo_adicional, "kilos", "has-error"))) errors.push(out);
        if ((out = Testeo.telefono(attrs.telefono, "telefono", "has-error"))) errors.push(out);
        if ((out = Testeo.identi(attrs.cedula, "cedula", 6, 16, "has-error"))) errors.push(out);
		if ((out = Testeo.identi(attrs.nit, "nit", 6, 16, "has-error"))) errors.push(out);
		if ((out = Testeo.email(attrs.correo, "correo", "has-error"))) errors.push(out);
		return _.size(errors) > 0 ? errors : void 0;
	}
};
