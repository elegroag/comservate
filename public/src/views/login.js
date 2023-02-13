View.Login = Backbone.View.extend({
    className: "box",
    id: "viewLogin",
    initialize: function(){
        this.render();
    },
    render: function(){
        let template = _.template($("#tmp_login_render").html());
        this.$el.html(template());
        return this;
    },
    events: {
        "click #btnSendDataLogin": "sendDataLogin",
        "keypress input[name='password']": "sendKeyDataLogin"
    },
    sendKeyDataLogin: function(e){
        let keycode = e.keyCode || e.which;
        if(keycode == '13') {
            document.querySelector("#btnSendDataLogin").click();
        }
    },
    sendDataLogin: function(e){
        e.preventDefault();
        var target = $(e.target); 
        target.attr('disabled', true);
        let modelData = new Model.Login(formSerialiceObject('formLogin'));
        if(!modelData.isValid())
        {
            let errors = modelData.validationError;
            showNotification('top', 'right', errors.join("<br/>"), false);
            target.removeAttr('disabled');
            return false;
        }
        loading.show();
        axios.post(create_url('api_token'), modelData.toJSON())
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
});