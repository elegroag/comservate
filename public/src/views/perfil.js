class ViewPerfil extends Backbone.View {
    constructor(op){
        super(op)
    }

    initialize(){
        this.template = $('#tmp_detalle_perfil').html();
        return this.render()
    }

    render(){
        let template = _.template(this.template);
        this.$el.html(template(this.model.toJSON()));
        return this;
    }

    events(){
        return {
            "click #btnEditaPerfil": "editaPerfil"
        }
    }

    editaPerfil(e){
        e.preventDefault()
        e.preventDefault()
        $(e.target).attr('disabled', true)
        var $scope = this;
        loading.show();
        $scope.$el.fadeOut('fast', function() {
            Routers.routerPerfil.navigate("edita", { trigger: true })
            $scope.remove();
        });
    }

}


class ViewEditPerfil extends Backbone.View {
    constructor(op){
        super(op)
    }

    initialize(){
        this.template = $('#tmp_edita_perfil').html();
        this.usuarioModel = UsuarioModel;
        return this.render()
    }

    render(){
        let template = _.template(this.template);
        this.$el.html(template(this.model.toJSON()))
        this.$el.find("[id='boxChangePassword']").bootstrapSwitch();
        this.$el.find("[id='boxChangePassword']").on("switchChange.bootstrapSwitch", this.changePassword);
        return this;
    }

    events(){
        return {
            "click #btnSendData": "sendData",
            "keypress input[name='password']": "sendKeyData",
            "click #btnVolver": "volverDetalle",
            "click #btnShowPassword": "showPassword"
        }
    }

    volverDetalle(e){
        e.preventDefault()
        $(e.target).attr('disabled', true)
        var $scope = this;
        loading.show();
        $scope.$el.fadeOut('fast', function() {
            Routers.routerPerfil.navigate("show", { trigger: true })
            $scope.remove();
        });
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

    changePassword(e){
        let element = $(this);
        if(element.is(':checked')){
            $("#renderChangePassword").fadeIn('fast');
        }else{
            $("#renderChangePassword").fadeOut('fast');
        }
    }

    sendData(e){
        e.preventDefault()
        var $scope = this;
        $scope.previus = this.model.clone();
        $scope.target = $(e.target);
        $scope.target.attr('disabled', true)
        let form = this.$el.find('#formEditData');
        let token = formSerialiceObject(form, true);
        
        UsuarioModel.omitirPassword = true;
        let usuario = new this.usuarioModel(token);
        if(!usuario.isValid())
        {
            let errors = usuario.validationError;
            showNotification('top', 'right', errors.join("<br/>"), false);
            $scope.target.removeAttr('disabled');
            return false;
        }

        _.each(usuario.toJSON(), function(element, key){
            if(key != 'id') $scope.model.set(key, element);
        });
        
        let clave = $scope.model.get('password');
        if(clave === '' || clave == void 0){
            $scope.model.unset('password');
        }
        usuario = void 0;
        loading.show();
        axios({
            "method": 'put',
            "url": create_url('api/usuario/edita/'+$scope.model.get('id')),
            "type": 'JSON',
            "headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()},
            "data": $scope.model.toJSON()
        })
        .then(function(response){
            if(response.data)
            {
                _.each(response.data.usuario, function(element, key){
                    $scope.model.set(key, element);
                });
                RouterPerfil.usuarioPerfil = $scope.model;
                Swal.fire('Actualizado!', response.data.message, 'success');
                Routers.routerPerfil.navigate("show", { trigger: true })
                $scope.remove();

            } else {
                Swal.fire({
                    position: 'center',
                    type: 'error',
                    text:  (_.size(response.data) == 0)? 'No hay datos disponible del cliente' : '',
                    title: 'Alerta error!',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        }).catch(function(err){
            _.each($scope.previus.toJSON(), function(element, key){
                $scope.model.set(key, element);
            });
            $scope.previus = void 0;
            let message;
            if(err.code == 'ERR_NETWORK') message = 'No hay red disponible para acceder al servidor.';
            if (err.code == 'ERR_BAD_REQUEST'){
                if (err.response.data.status == 404){
                    message = err.response.data.messages.error;
                } else {
                    message = err.response.data.message;
                }
            } else {
                message = err.message;
            }
            Swal.fire({
                position: 'center',
                type: 'error',
                text:  message,
                title: 'Alerta error!',
                showConfirmButton: false,
                timer: 3000
            })
        }).finally(function(){
            $scope.target.removeAttr('disabled');
            loading.hide();
        })
    }

    sendKeyData(e){
        let keycode = e.keyCode || e.which;
        if(keycode == '13') {
            let container = document.querySelector(".main-panel");
            container.scrollTop = 0;
        }
    }
}