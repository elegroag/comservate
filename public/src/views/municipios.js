class ViewMunicipio extends Backbone.View {
    constructor(e) {
        super(e)
    }
    initialize(){
        this.listenTo(this.model, 'change', this.render);
        this.listenTo(this.model, 'remove', this.remove);
    }   
    
    remove(){
        Backbone.View.prototype.remove.call(this);
    }
    
    render(){
        let template = _.template(`
        <td><%=id%></td>
        <td><%=municipio%></td>
        <td><%=estado%></td>
        <td><%=departamento_id%></td>
        <td>
            <div class="btn-group">
                <a type="button" data-cid='<%=id%>' data-toggle='row-remove' class="btn btn-danger btn-link btn-icon btn-sm remove">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </td>`);
        this.$el.html(template(this.serializeData(this.model)));
        return this;
    }
    
    serializeData(){
        return (!this.model)? void 0 : this.model.toJSON();
    }

}

class ViewMunicipios extends Backbone.View {
    
    constructor(e) {
        super(e)
    }

    static viewMunicipio;
    static children = {};

    initialize(){
        this.template = $('#tmp_all_municipios').html()
        this.dataTable = void 0
        ViewMunicipios.children = {}
        ViewMunicipios.viewMunicipio = ViewMunicipio;

        this.listenTo(this.collection, 'add', this.rowAdd);
        this.listenTo(this.collection, 'remove', this.rowRemoved);
        this.render()
    }

    render(){
        var $scope = this;
        let filas = this.collection.map(function(municipio){
            let view = ViewMunicipios.renderModel(municipio, $scope);
            return view.$el;
        });
        let template = _.template(this.template)
        this.$el.html(template())
        this.$el.find('#filas').html(filas);
        this.renderDataTable(this);
        return this;
    }

    events(){
        return {
            "click [data-toggle='row-edit']": "editData",
            "click [data-toggle='row-like']": "likeData",
            "click [data-toggle='row-remove']": "removeData"
        }
    }

    removeData(e){
        e.preventDefault();
        var $scope = this;
        var element = $(e.currentTarget);
        element.attr('disabled', true);

        Swal.fire({
            title: '¿Está seguro de continuar?',
            text: "¡Una vez se ejecute el borrado, tu ya no podras revertir está acción!",
            type: 'warning',
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            confirmButtonText: 'Si, borralo todo'
        }).then( function(result){
            if (result.value) {
                loading.show();
                axios({
                    "method": 'delete',
                    "url": create_url('api/usuario/remove/'+ element.attr('data-cid')),
                    "type": 'JSON',
                    "headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()}
                })
                .then(function(response){
                    if(response.data.status)
                    {
                        $scope.collection.remove(element.attr('data-cid'));
                        Swal.fire('Borrado!', 'Tu registro se ha borrado con éxito.', 'success') 
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
                    element.removeAttr('disabled');
                })
            } else {
                element.removeAttr('disabled');
            }
        })
    }

    editData(e){
        e.preventDefault();
        Routers.routerUsuarios.navigate("edita/"+$(e.currentTarget).attr('data-cid'), { trigger: true });
        this.remove();
    }

    likeData(e){
        e.preventDefault();
        Routers.routerUsuarios.navigate("detalle/"+$(e.currentTarget).attr('data-cid'), { trigger: true });
        this.remove();       
    }

    rowAdd(model){
        let view = ViewMunicipios.renderModel(model, this);
        this.$el.find('#filas').append(view.$el);
    }

    rowRemoved(model){
        let view = ViewMunicipios.children[model.cid];
        if (view) {
            view.remove();
            ViewMunicipios.children[model.cid] = undefined;
        }
    }

    static renderModel(model)
    {
        let view;
        if(_.size(ViewMunicipios.children) > 0){
            if(_.indexOf(ViewMunicipios.children, model.cid) != -1){
                view = ViewMunicipios.children[model.cid];
            }else{
                view = new ViewMunicipios.viewMunicipio({model: model, tagName:'tr'});        
                ViewMunicipios.children[model.cid] = view;        
            }
        }else{
            view = new ViewMunicipios.viewMunicipio({model: model, tagName:'tr'});        
            ViewMunicipios.children[model.cid] = view;  
        }
        view.render();
        return view;
    }

    renderDataTable($scope)
    {
        $scope.$el.find('#datatable').DataTable({
            "pagingType": "full_numbers",
            "paging": true,
            "pageLength": 10,
            "info": true,
            "columnDefs": [
                { targets: 0, width:'5%'},
                { targets: 1, width:'30%'},
                { targets: 2, width:'5%'},
                { targets: 3, width:'30%'},
                { targets: 4, searchable: false, width:'5%'}
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "language": TABLE_LENGUAJE
        })
        this.dataTable = $scope.$el.find('#datatable').DataTable();
    }

    serializeData(){
        return (!this.collection)? void 0 : this.collection.toJSON();
    }
}

class ViewMasivoMunicipios extends Backbone.View {

    constructor(e){
        super(e)
    }

    initialize(){
        this.municipios = void 0;
        this.template = $('#tmp_masivo_municipios').html();
        this.municipioModel = MunicipioModel;
        return this.render();
    }

    render(){
        this.municipios = this.collection;
        let template = _.template(this.template);
        this.$el.html(template());
        return this;
    }

    events(){
        return {
            "click #btnSendData": "sendData",
            "keypress input[name='password']": "sendKeyData",
            "click #btnVolver": "volverListaUsuarios",
            "click #btnShowPassword": "showPassword"
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

    sendData(e){
        e.preventDefault()
        var $scope = this;
        $scope.target = $(e.target);
        $scope.target.attr('disabled', true)
        let form = this.$el.find('#formCreateData');
        let token = formSerialiceObject(form, true);
        
        let usuario = new this.usuarioModel(token);
        if(!usuario.isValid())
        {
            let errors = usuario.validationError;
            showNotification('top', 'right', errors.join("<br/>"), false);
            $scope.target.removeAttr('disabled');
            return false;
        }

        loading.show();
        axios({
            "method": 'post',
            "url": create_url('api/usuario/create'),
            "type": 'JSON',
            "headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()},
            "data": usuario.toJSON()
        })
        .then(function(response){
            if(response.data)
            {
                _.each(response.data.usuario, function(element, key){
                    usuario.set(key, element);
                });
                RouterUsuarios.usuarios.add(usuario);
                Swal.fire('Creado!', response.data.message, 'success');
                Routers.routerUsuarios.navigate("detalle/"+usuario.get('id'), { trigger: true })
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
    
    volverListaUsuarios(e)
    {
        e.preventDefault()
        $(e.target).attr('disabled', true)
        var $scope = this;
        loading.show();
        $scope.$el.fadeOut('fast', function() {
            Routers.routerUsuarios.navigate("all", { trigger: true })
            $scope.remove();
        });
    }

}