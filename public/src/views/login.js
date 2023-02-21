class ViewLogin extends Backbone.View {
    constructor(e){
        super(e)
    }

    initialize(){
        this.template = $("#tmp_login_render").html();
        this.loginModel = LoginModel;
        this.render();   
    }
    
    render(){
        let template = _.template(this.template);
        this.$el.html(template());
        return this;
    }
    
    events(){
        return {
            "click #btnSendDataLogin": "sendDataLogin",
            "keypress input[name='password']": "sendKeyDataLogin",
            "click #btnShowPassword": "showPassword",
            "click #btnRecoveryPassword": "recoveryPassword"
        }
    }

    showPassword(e){
        e.preventDefault();
        if(this.$el.find('#password').attr('type') == 'text')
        {
            this.$el.find('#password').attr('type', 'password');
        }else{
            this.$el.find('#password').attr('type', 'text');
        }
    }

    sendKeyDataLogin(e){
        let keycode = e.keyCode || e.which;
        if(keycode == '13') {
            document.querySelector("#btnSendDataLogin").click();
        }
    }

    sendDataLogin(e){
        e.preventDefault();
        var target = $(e.target); 
        target.attr('disabled', true);
        
        this.loginModel.forRecovery = false;

        let loginModel = new this.loginModel(formSerialiceObject('formLogin'));
        if(!loginModel.isValid())
        {
            let errors = loginModel.validationError;
            showNotification('top', 'right', errors.join("<br/>"), false);
            target.removeAttr('disabled');
            return false;
        }
        loading.show();
        axios.post(create_url('api_token'), loginModel.toJSON())
        .then(function(response){
            if(response.data.status)
            {
                window.location.href = create_url('web/validation/'+response.data.token); 
            } else {
                Swal.fire({
                    position: 'center',
                    type: 'error',
                    text:  response.data.message,
                    title: 'Alerta error!',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        }).catch(function(err){
            let message = (err.code == 'ERR_BAD_REQUEST')? err.response.data.message : err.message;
            if(err.code == 'ERR_NETWORK') message = 'No hay red disponible para acceder al servidor.';
            Swal.fire({
                position: 'center',
                type: 'error',
                text:  message,
                title: 'Alerta error!',
                showConfirmButton: false,
                timer: 3000
            })
        }).finally(function(){
            loading.hide();
            target.removeAttr('disabled');
        })
    }

    recoveryPassword(e){
        e.preventDefault()
        $(e.target).attr('disabled', true)
        loading.show();
        routerLogin.navigate("recovery", { trigger: true })
        this.remove();
    }
}

class ViewLoginRecovery extends Backbone.View {
    constructor(e){
        super(e)
    }

    initialize(){
        this.template = $("#tmp_login_recovery").html();
        this.loginModel = LoginModel;
        this.render();   
    }
    
    render(){
        let template = _.template(this.template);
        this.$el.html(template());
        return this;
    }
    
    events(){
        return {
            "click #btnSendDataRecovery": "sendData",
            "keypress input[name='email']": "sendKeyDataRecovery",
            "click #btnVolverSesion": "volverSesion"
        }
    }

    volverSesion(e){
        e.preventDefault()
        $(e.target).attr('disabled', true)
        loading.show();
        routerLogin.navigate("auth", { trigger: true })
        this.remove();
    }

    sendKeyDataRecovery(e){
        let keycode = e.keyCode || e.which;
        if(keycode == '13') {
            document.querySelector("#btnSendData").click();
        }
    }

    sendData(e){
        e.preventDefault();
        var target = $(e.target); 
        target.attr('disabled', true);
        
        this.loginModel.forRecovery = true;

        let loginModel = new this.loginModel(formSerialiceObject('formRecovery'));
        if(!loginModel.isValid())
        {
            let errors = loginModel.validationError;
            console.log(errors);
            showNotification('top', 'right', errors.join("<br/>"), false);
            target.removeAttr('disabled');
            return false;
        }
        loading.show();
        axios.post(create_url('login/recovery'), loginModel.toJSON())
        .then(function(response){
            if(response.data.status)
            {
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    text:  response.data.message,
                    title: 'Notificación!',
                    showConfirmButton: false,
                    timer: 4000
                })
                document.querySelector("#btnVolverSesion").click();
            } else {
                Swal.fire({
                    position: 'center',
                    type: 'error',
                    text:  response.data.message,
                    title: 'Alerta error!',
                    showConfirmButton: false,
                    timer: 4000
                })
            }
        }).catch(function(err){
            let message = (err.code == 'ERR_BAD_REQUEST')? err.response.data.message : err.message;
            if(err.code == 'ERR_NETWORK') message = 'No hay red disponible para acceder al servidor.';
            Swal.fire({
                position: 'center',
                type: 'error',
                text:  message,
                title: 'Alerta error!',
                showConfirmButton: false,
                timer: 4000
            })
        }).finally(function(){
            loading.hide();
            target.removeAttr('disabled');
        })
    }
}