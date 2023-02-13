"use strict";

var RouterLogin = Backbone.Router.extend({
	content: "containerBone",
	errors: void 0,
	initialize: function () {
		if (!Backbone.history.start()) {
			this.navigate("auth", { trigger: true });
		}
	},
	routes: {
		auth: "loginShowView",
		recovery: "recoveryShowView",
	},
	createContent: function () {
		$("#" + this.content).remove();
		let _el = document.createElement("div");
		_el.setAttribute("id", this.content);
		_el.setAttribute("class", "box");
		document.getElementById("container").appendChild(_el);
		scroltop();
		return _el;
	},
	loginShowView: function () {
		this.createContent();
		new View.Login({el: `#${this.content}`})
	}
});


$(function(){
	new RouterLogin();
});