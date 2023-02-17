class RouterLogin extends Backbone.Router {
	
	constructor(op){
		super(op)
	}

	initialize(){
		this.content = "containerBone";
		this.viewLogin = ViewLogin;
		this.viewLoginRecovery = ViewLoginRecovery;
		this.errors = void 0;
	}
	
	routes() {
		return {
			"auth": "loginShowView",
			"recovery": "recoveryShowView"	
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

	loginShowView() {
		this.createContent();
		new this.viewLogin({el: `#${this.content}`, className: 'boxLogin', id:'viewLogin'});
		loading.hide();
	}

	recoveryShowView(){
		this.createContent();
		new this.viewLoginRecovery({el: `#${this.content}`, className: 'boxLogin', id:'viewLoginRecovery'});
		loading.hide();
	}
}

var routerLogin = new RouterLogin();
$(function(){
	if (!Backbone.history.start()) {
		routerLogin.navigate("auth", { trigger: true });
	}
});