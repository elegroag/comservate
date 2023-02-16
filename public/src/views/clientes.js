class ViewCliente extends Backbone.View {
    constructor(options){
        super(options);
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
        <td><%=afiliado%></td>
        <td><%=representante%></td>
        <td><%=id_municipio%></td>
        <td><%=estado%></td>
        <td><%=telefono%></td>
        <td>
            <div class="btn-group">
                <a type="button" data-cid='<%=id%>' data-toggle='row-like' class="btn btn-info btn-link btn-icon btn-sm like">
                    <i class="fa fa-user"></i>
                </a>
                <a type="button" data-cid='<%=id%>' data-toggle='row-edit' class="btn btn-warning btn-link btn-icon btn-sm edit">
                    <i class="fa fa-edit"></i>
                </a>
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

class ViewClientes extends Backbone.View {
    
    constructor(options){
		super(options)
	}

    initialize() {
        this.template = $('#tmp_all_clientes').html();
        this.viewCliente = ViewCliente;
        this.children = {};
        this.dataTable = void 0;
       
        this.listenTo(this.collection, 'add', this.clienteAdd);
        this.listenTo(this.collection, 'remove', this.clienteRemoved);
        this.render();
    }

    render(){ 
        var $scope = this;
        let filas = this.collection.map(function(cliente){
            let view = $scope.renderModel(cliente, $scope);
            return view.$el;
        });

        let template = _.template(this.template);
        this.$el.html(template());
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
    editData(e){
        e.preventDefault();
        Routers.routerClientes.navigate("edita/"+$(e.currentTarget).attr('data-cid'), { trigger: true });
        this.remove();
    }
    likeData(e){
        e.preventDefault();
        Routers.routerClientes.navigate("detalle/"+$(e.currentTarget).attr('data-cid'), { trigger: true });
        this.remove();       
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
                    "url": create_url('api/cliente/remove/'+ element.attr('data-cid')),
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
    serializeData(){
        return (!this.collection)? void 0 : this.collection.toJSON();
    }
    clienteAdd(model){
        let view = this.renderModel(model, this);
        this.$el.find('#filas').append(view.$el);
    }
    
    renderModel(cliente, $scope)
    {
        let view;
        if(_.size($scope.children) > 0){
            if(_.indexOf($scope.children, cliente.cid) != -1){
                view = $scope.children[cliente.cid];
            }else{
                view = new $scope.viewCliente({model: cliente, tagName:'tr'});        
                $scope.children[cliente.cid] = view;        
            }
        }else{
            view = new $scope.viewCliente({model: cliente, tagName:'tr'});        
            $scope.children[cliente.cid] = view;  
        }
        view.render();
        return view;
    }

    clienteRemoved(model) {
        var view = this.children[model.cid];
        if (view) {
            view.remove();
            this.children[model.cid] = undefined;
        }
    }

    renderDataTable($scope)
    {
        $scope.$el.find('#datatable').DataTable({
            "pagingType": "full_numbers",
            "paging": true,
            "pageLength": 10,
            "info": true,
            "columnDefs": [
                { targets: 0, searchable: false, width:'25%'},
                { targets: 1, width:'25%'},
                { targets: 2, width:'15%'},
                { targets: 3, width:'10%'},
                { targets: 4, width:'15%'},
                { targets: 5, width:'10%'}
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
}

class ViewShowCliente extends Backbone.View {
    
    constructor(options) {
        super(options);
    }

    initialize() {
        this.template = $('#tmp_cliente_detalle').html();
        return this.render();
    }

    render(){
        let template = _.template(this.template);
        this.$el.html(template(this.serializeData()));
        return this;
    }

    events(){
        return {
            "click #btnVolver": "volverListaClientes"
        }
    }
    
    volverListaClientes(e){
        e.preventDefault()
        $(e.target).attr('disabled', true)
        var $scope = this;
        loading.show();
        $scope.$el.fadeOut('fast', function() {
            Routers.routerClientes.navigate("all", { trigger: true })
            $scope.remove();
        });
    }

    serializeData(){
        return (!this.model)? void 0 : this.model.toJSON();
    }
}

class ViewEditCliente extends Backbone.View {
    
    constructor(options) {
        super(options);
    }

    initialize() {
        this.clientes = void 0;
        this.municipios = void 0;
        this.template = $('#tmp_cliente_editar').html();
        this.clienteModel = ClienteModel;
        this.usuarioLocal = usuario_local();
        this.listenTo(this.model, 'change', this.render);
        return this.render();
    }

    render(){
        this.clientes = this.collection[0];
        this.municipios = this.collection[1];
        let template = _.template(this.template);
        this.$el.html(template(this.serializeData()));
        this.addListMunicipios(this);
        this.$el.find("#fecha_finalizacion").datetimepicker(optionsDataPicker());
        return this;
    }

    events(){
        return {
            "click #btnSendData": "sendData",
            "keypress input[name='password']": "sendKeyData",
            "click #btnVolver": "volverListaClientes"
        }
    }

    addListMunicipios($scope){
        let html='<option value="">Seleccionar aquí..</option>';
        _.each($scope.municipios.toJSON(), function(municipio){
            let selected = ($scope.model.get('id_municipio') == municipio.id)? 'selected': '';
            html+='<option '+selected+' value="'+municipio.id+'">'+(municipio.municipio).toUpperCase() +'</option>';
        }, html);
        $scope.$el.find('#id_municipio').html(html);
        $scope.$el.find('#id_municipio').chosen({"width":"100%", "allow_single_deselect": true});
    }

    sendData(e){
        e.preventDefault()
        var $scope = this;
        $scope.target = $(e.target);
        $scope.target.attr('disabled', true)
        let form = this.$el.find('#formEditData');
        let token = formSerialiceObject(form, true);
        $scope.previus = $scope.model.clone();
        
        let cliente = new this.clienteModel(token);
        if(!cliente.isValid())
        {
            let errors = cliente.validationError;
            showNotification('top', 'right', errors.join("<br/>"), false);
            $scope.target.removeAttr('disabled');
            return false;
        }

        cliente.set('usuario_creador', this.usuarioLocal.id);
        _.each(cliente.toJSON(), function(element, key){
            $scope.model.set(key, element);
        });
        cliente = void 0;
        
        loading.show();
        axios({
            "method": 'put',
            "url": create_url('api/cliente/edita/'+$scope.model.get('id')),
            "type": 'JSON',
            "headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()},
            "data": $scope.model.toJSON()
        })
        .then(function(response){
            if(response.data)
            {
                RouterClientes.clientes.add(cliente, {trigger: true});
                Swal.fire('Actualizado!', response.data.message, 'success');
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
            document.querySelector("#btnSendDataLogin").click();
        }
    }

    volverListaClientes(e){
        e.preventDefault()
        $(e.target).attr('disabled', true)
        var $scope = this;
        loading.show();
        $scope.$el.fadeOut('fast', function() {
            Routers.routerClientes.navigate("all", { trigger: true })
            $scope.remove();
        });
    }

    serializeData(){
        return (!this.model)? void 0 : this.model.toJSON();
    }
}

class ViewCreateCliente extends Backbone.View {
    
    constructor(options) {
        super(options);
    }

    initialize() {
        this.clientes = void 0;
        this.municipios = void 0;
        this.template = $('#tmp_cliente_crear').html();
        this.clienteModel = ClienteModel;
        this.usuarioLocal = usuario_local();
        return this.render();
    }

    render(){
        this.clientes = this.collection[0];
        this.municipios = this.collection[1];
        let template = _.template(this.template);
        this.$el.html(template());
        this.addListMunicipios(this);
        this.$el.find("#fecha_finalizacion").datetimepicker(optionsDataPicker());
        return this;
    }

    events(){
        return {
            "click #btnSendData": "sendData",
            "keypress input[name='password']": "sendKeyData",
            "click #btnVolver": "volverListaClientes"
        }
    }

    addListMunicipios($scope){
        let html='<option value="">Seleccionar aquí..</option>';
        _.each($scope.municipios.toJSON(), function(municipio){
            html+='<option value="'+municipio.id+'">'+(municipio.municipio).toUpperCase()+'</option>';
        }, html);
        $scope.$el.find('#id_municipio').html(html);
        $scope.$el.find('#id_municipio').chosen({width: '100%', allow_single_deselect: true});
    }

    sendData(e){
        e.preventDefault()
        var $scope = this;
        $scope.target = $(e.target);
        $scope.target.attr('disabled', true)
        let form = this.$el.find('#formCreateData');
        let token = formSerialiceObject(form, true);
        
        let cliente = new this.clienteModel(token);
        if(!cliente.isValid())
        {
            let errors = cliente.validationError;
            showNotification('top', 'right', errors.join("<br/>"), false);
            $scope.target.removeAttr('disabled');
            return false;
        }

        cliente.set('usuario_creador', this.usuarioLocal.id);
        loading.show();
        axios({
            "method": 'post',
            "url": create_url('api/cliente/create'),
            "type": 'JSON',
            "headers": {'X-Requested-With': 'XMLHttpRequest', 'Authorization': bearer_token()},
            "data": cliente.toJSON()
        })
        .then(function(response){
            if(response.data)
            {
                _.each(response.data.cliente, function(element, key){
                    cliente.set(key, element);
                });
                RouterClientes.clientes.add(cliente);
                Swal.fire('Creado!', response.data.message, 'success');
                Routers.routerClientes.navigate("detalle/"+cliente.get('id'), { "trigger": true })
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
            document.querySelector("#btnSendDataLogin").click();
        }
    }
    
    volverListaClientes(e)
    {
        e.preventDefault()
        $(e.target).attr('disabled', true)
        var $scope = this;
        loading.show();
        $scope.$el.fadeOut('fast', function() {
            Routers.routerClientes.navigate("all", { trigger: true })
            $scope.remove();
        });
    }
}