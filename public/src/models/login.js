Model.Login = Backbone.Model.extend({
    initialize: function(){
        console.log("inicializa el modelo de login")
    },
    urlRoot: 'http://localhost:8080/api/auth',
    defaults: {
        username: void 0,
        password: void 0
    },
    validate: function(attrs){
        let errors = []
        let out = '';
        if(out = Testeo.vacio(attrs.username, 'username','has_error')) errors.push(out);
        if(out = Testeo.menor(attrs.username, 'username','has_error', 30)) errors.push(out); 
        if(out = Testeo.vacio(attrs.password, 'password','has_error')) errors.push(out); 
        if(out = Testeo.menor(attrs.password, 'password','has_error', 30)) errors.push(out); 
        return (_.size(errors) > 0)? errors : void 0;
    }
});

