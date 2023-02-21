class LoginModel extends Backbone.Model {

	constructor(op) {
		super(op)
	}

	static forRecovery = false;

	initialize() {
		this.urlRoot = "http://localhost:8080/api/auth";
	}

	defaults(){
		return {
			username: void 0,
			password: void 0,
			email:  void 0
		}
	}
	
	validate(attrs){
		let errors = [];
		let out = "";
		if ((out = Testeo.vacio(attrs.username, "username", "has_error"))) errors.push(out);

		if ((out = Testeo.menor(attrs.username, "username", "has_error", 30))) errors.push(out);		
		
		if(LoginModel.forRecovery === true)
		{
			if ((out = Testeo.email(attrs.email, "email", "has_error"))) errors.push(out);
		
		} else {
			if ((out = Testeo.vacio(attrs.password, "password", "has_error"))) errors.push(out);
		
			if ((out = Testeo.menor(attrs.password, "password", "has_error", 30))) errors.push(out);
		}
		return _.size(errors) > 0 ? errors : void 0;
	}
}