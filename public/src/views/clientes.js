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
        this.className = "box";
        this.id = "viewClientes";
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
        let element = $(e.currentTarget);
        let id = element.attr('data-cid');
        Routers.routerClientes.navigate("edita/"+id, { trigger: true });
        this.remove();
    }

    likeData(e){
        e.preventDefault();
        let element = $(e.currentTarget);
        let id = element.attr('data-cid');
        Routers.routerClientes.navigate("detalle/"+id, { trigger: true });
        this.remove();
        // let model =  this.collection.get(id);
        // model.set('afiliado', 'edwin legro');
    }

    removeData(e){
        e.preventDefault();
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
        this.className = "box";
        this.id = "viewClientes";
        this.template = $('#tmp_cliente_detalle').html();
        this.viewCliente = ViewCliente;
        this.children = {};
        return this.render();
    }

    render(){
        let template = _.template(this.template);
        this.$el.html(template());
        return this;
    }

    events(){
        return {
            "click #btnSendData": "sendData",
            "keypress input[name='password']": "sendKeyData"
        }
    }
    
    sendData(event){
    }

    sendKeyData(event){
    }
}

class ViewEditCliente extends Backbone.View {
    
    constructor(options) {
        super(options);
        this.className = "box";
        this.id = "viewClientes";
        this.template = $('#tmp_clientes_listar').html();
        this.viewCliente = ViewCliente;
        return this.render();
    }

    initialize() {
        this.children = {};
        this.listenTo(this.collection, 'add', this.clienteAdd);
        this.listenTo(this.collection, 'remove', this.clienteRemoved);
    }

    render(){
        let template = _.template(this.template);
        this.$el.html(template());
        return this;
    }

    events(){
        return {
            "click #btnSendData": "sendData",
            "keypress input[name='password']": "sendKeyData"
        }
    }

    clienteAdd(model){
        var view = this.renderModel(model);
        this.$el.append(view.$el);
    }
    
    renderModel(model){
        var view = new this.viewCliente({model: model});
        this.children[model.cid] = view;
        this.listenTo(view, 'all', eventName => {
            this.trigger('item:' + eventName, view, model);
        });
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

    sendData(event){
    }

    sendKeyData(event){
    }
}

class ViewCreateCliente extends Backbone.View {
    
    constructor(options) {
        super(options);
        this.className = "box";
        this.id = "viewClientes";
        this.template = $('#tmp_clientes_listar').html();
        this.viewCliente = ViewCliente;
        return this.render();
    }

    initialize() {
        this.children = {};
        this.listenTo(this.collection, 'add', this.clienteAdd);
        this.listenTo(this.collection, 'remove', this.clienteRemoved);
    }

    render(){
        let template = _.template(this.template);
        this.$el.html(template());
        return this;
    }

    events(){
        return {
            "click #btnSendData": "sendData",
            "keypress input[name='password']": "sendKeyData"
        }
    }

    clienteAdd(model){
        var view = this.renderModel(model);
        this.$el.append(view.$el);
    }
    
    renderModel(model){
        var view = new this.viewCliente({model: model});
        this.children[model.cid] = view;
        this.listenTo(view, 'all', eventName => {
            this.trigger('item:' + eventName, view, model);
        });
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

    sendData(event){
    }

    sendKeyData(event){
    }
}