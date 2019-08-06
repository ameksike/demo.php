Ext.define('Pikota.controller.Pikota', {
    extend: 'Ext.app.Controller',

    stores: [
        // 'packs'
    ],
    model: [
        // 'packs'
    ],
    views: [],
    refs: [{
        ref: 'gridHistorial',
        selector: 'gridHistorial'
    },{
        ref: 'treeAdmin',
        selector: 'treeAdmin'
    },{
        ref: 'treeGroupPrinters',
        selector: 'treeGroupPrinters'
    },{
        ref: 'aux',
        selector: 'aux'
    },{
        ref: 'panelPikWest',
        selector: 'panelPikWest'
    },{
        ref: 'gridGroupUsers',
        selector: 'gridGroupUsers'
    },{
        ref: 'menuCuota',
        selector: 'menuCuota'
    },{
        ref: 'cuota',
        selector: 'cuota'
    },{
        ref: 'treeCuotas',
        selector: 'treeCuotas'
    }],

    init: function() {
        _this = this;
        dir_cups = document.getElementById('dir_cups').value;
        dir_help = document.getElementById('dir_help').value;
        _this.itemsApendTree1 = {
            parentnode: '',
            node: ''
        };
        _this.itemsApendTree2 = {
            parentnode: '',
            node: ''
        };

        _this.control({
             'viewport panel[id=panelGestUsers]': {
                expand: this.onexpandPanelGestUsers
            },'viewport panel[id=panelGestPrinters]': {
                expand: this.onexpandPanelGestUsers
            },
             'panelPikWest panel[id=panelTreePrinters]': {
                expand: this.onexpandPanelTreePrinters
            },'panelPikWest panel[id=panelTreeAdmin]': {
                expand: this.onexpandPanelTreePrinters
            },
            'panelPikWest': {
                render: _this.onRenderPanelPikWest
            },'panelPikWest button[action=addGrups]': {
                click: _this.addGrups
            },'panelPikWest button[action=delGrups]': {
                click: _this.delGrups
            },'treeAdmin': {
                itemclick: _this.itemclickTree,
                'load': _this.onLoadTreeUser,
                'render':_this.onFire,
                'itemexpand':_this.onExpandTree,
                'itemcontextmenu': _this.onItemcontextmenu

            },'aux': {
                render: _this.onRenderAux
            },'aux button[action=closeWin]': {
                click: _this.closeWin
            },'aux button[action=addAux]': {
                click: _this.addAux
            },'treeGroupPrinters':{
                itemclick: _this.itemclickTree,  //
                'load': _this.onLoadTreePrint,
                'render': _this.onWater,
                'itemexpand':_this.onExpandTree
            },'gridGroupUsers button[action=adduser]':{
                click: _this.addWin
            },'gridGroupUsers button[action=deluser]':{
                click: _this.deluser
            },'gridGroupPrinters button[action=addprint]':{
                click: _this.addWin
            },'gridGroupPrinters button[action=savechanges]':{
                click: _this.savechanges
            },'gridGroupUsers':{
                'render': _this.onRendergridGroupUsers,
                'itemclick': _this.onitemclickGridGroupUsers
            },'gridGroupPrinters':{
                'render': _this.onRenderGridGroupPrinters
            },'menuCuota menuitem[action=asigcuota]':{
                 click: _this.asignarCuota
            },'menuCuota menuitem[action=modcuota]':{
                click: _this.modificarCuota
            },'cuota button[action=actioncuota]':{
                click: _this.actioncuota
            },'cuota button[action=closeWin]':{
                click: _this.closeWin
            },'cuota button[action=asignar]':{
                click: _this.asignar
            },'treeCuotas':{
                load:_this.onLoadTreeCuotas,
                itemclick: _this.itemclickTreeCuotas

            }});

    },

    onexpandPanelGestUsers: function(panel){
      (panel.id == 'panelGestUsers') ? Ext.getCmp('panelTreeAdmin').expand() : Ext.getCmp('panelTreePrinters').expand();
        //Ext.getCmp('panelTreePrinters').collapse();
        //Ext.getCmp('panelTreeAdmin').expand();

    },

    onexpandPanelTreePrinters: function(panel){
        (panel.id == 'panelTreePrinters') ? Ext.getCmp('panelGestPrinters').expand() : Ext.getCmp('panelGestUsers').expand();
    },

    onRenderPanelPikWest: function(){

        this.keyMap = Ext.widget('keymapController');

        this.keyMap.pressAltG(this);
        this.keyMap.pressAltR(this);
        this.keyMap.pressAltS(this);
        this.keyMap.pressAltH(this);

        this.myMask = new Ext.LoadMask(Ext.getBody(), {msg: 'Espere por favor...'});
    },

    onFire: function(){
        var $this = this;
        Ext.getCmp('treeAdmin').getView().on('drop', function(a,b){

            $this.dropTreeUser = a.textContent;
            $this.ajaxAddUserToGroup();

        });

        Ext.getCmp('treeAdmin').getView().on('viewready', function(){

            var view = Ext.getCmp('treeAdmin').getView(),
            dd = view.findPlugin('treeviewdragdrop');

            dd.dragZone.onBeforeDrag = function (data, e) {
                var rec = view.getRecord(e.getTarget(view.itemSelector));
                return rec.isLeaf();
            };

        });

        Ext.getCmp('treeAdmin').getView().on('itemremove', function(parentnode){

            _this.itemsApendTree1.parentnode = parentnode;

        });
    },

    onWater: function(){
        var $this = this;
        Ext.getCmp('treeGroupPrinters').getView().on('drop', function(a,b){

            $this.dropTreePrints = a.textContent;
            $this.ajaxAddPrintersToGroup();

        });

        Ext.getCmp('treeGroupPrinters').getView().on('viewready', function(){

            var view = Ext.getCmp('treeGroupPrinters').getView(),
                dd = view.findPlugin('treeviewdragdrop');

            dd.dragZone.onBeforeDrag = function (data, e) {
                var rec = view.getRecord(e.getTarget(view.itemSelector));
                return rec.isLeaf();
            };

        });

        Ext.getCmp('treeGroupPrinters').getView().on('itemremove', function(parentnode){

            _this.itemsApendTree2.parentnode = parentnode;

        });
    },

    onRendergridGroupUsers: function(){
        var $this = this;
        Ext.getCmp('gridUsers').getView().on('drop', function(){

            $this.ajaxDelUserToGroup();

        });
    },

    onRenderGridGroupPrinters: function(){
        var $this = this;
        Ext.getCmp('gridGroupPrinters').getView().on('drop', function(){

            $this.ajaxDelPrinterToGroup();

        });
    },

    onRenderAux: function(win){

        this.keyMap.pressAltX(this, win);
        this.keyMap.pressEnter(this, win);

    },

    closeWin: function(button){
        button.up('window').destroy();
    },

    addGrups: function(btn){

        var tree = (this.nodeSelected.raw.id == 'rootGusers') ? Ext.getCmp('treeAdmin') : Ext.getCmp('treeGroupPrinters');
        var selModel = tree.getSelectionModel();

        // Could also use:
        // var node = selModel.getSelection()[0];
        var node = selModel.getLastSelected();
        if(node.isRoot()){ //node.raw.name === 'users'

            if(tree.getId() == 'treeAdmin'){
                var win = Ext.widget('cuota');
            }else{
                var aux = Ext.widget('aux', {fieldLabelTf: 'Nombre', fieldLabelTa: 'Descripción'});
                aux.setTitle('Adicionar grupo de impresora');
            }


        }
    },

    ajaxEliminarGrupo: function(btn){
        if(btn == 'YES'){

            var url = (this.treeActive == 'users') ? 'admin/deletegroups' : 'admin/deleteprintergroups';
            this.myMask.show();
            Ext.Ajax.request({
             url: url,
             method: 'POST',
             params: {
             name: this.nodeSelected.raw.text,
             id: this.nodeSelected.raw.id

             },
             callback: function(options, success, response) {
                 var response =  Ext.decode(response.responseText);
                 _this.myMask.hide();
                 if(response.success){

                    if(url == 'admin/deletegroups'){
                        Ext.getCmp('gridUsers').getStore().load();
                        Msg.util.msg(1, 'Información','El grupo fue eliminado satisfactoriamente.');
                        var tree = Ext.getCmp('treeAdmin');
                        var store = tree.getStore();

                        store.setProxy({
                            type: 'ajax',
                            url: 'servidor/grupouser',
                            extraParams: {
                                param: false

                            }
                        });

                        store.load();
                    }else{
                        Ext.getCmp('gridGroupPrinters').getStore().load();
                        Msg.util.msg(1, 'Información','El grupo fue eliminado satisfactoriamente.');
                        var tree = Ext.getCmp('treeGroupPrinters');
                        var store = tree.getStore();

                        store.setProxy({
                            type: 'ajax',
                            url: 'servidor/grupoprinters',
                            extraParams: {
                                param: false

                            }
                        });

                        store.load();
                    }

                 }
             }
             });
        }
    },

    delGrups: function(){
        Msg.util.MostrarMsg(4, 'Eliminar grupo', '¿Está seguro que desea elminar el grupo?', this.ajaxEliminarGrupo, this);
    },

    addNodesTree: function(){
        var tree = btn.up('treeAdmin');
        var selModel = tree.getSelectionModel();

        // Could also use:
        // var node = selModel.getSelection()[0];
        var node = selModel.getLastSelected();
        if (!node) {
            return;
        }

        // Feels like this should happen automatically
        node.set('leaf', false);

        node.appendChild({
            leaf: false,
            text: 'New Child'
        });

        // The tree lines won't join up without a refresh
        tree.getView().refresh();

        // Not strictly required but...
        node.expand();
    },

    itemclickTree: function(view, record, html){
        this.treeActive = (view.getNode(0).textContent == 'Grupos de usuario') ? 'users' : 'printers';
        this.nodeSelected = record;

        if (record.isRoot()) {
            Ext.getCmp('btnaddGrups').enable();
            Ext.getCmp('btnadelGrups').disable();
        }else{
           Ext.getCmp('btnaddGrups').disable();
            (record.isLeaf()) ?  Ext.getCmp('btnadelGrups').disable() : Ext.getCmp('btnadelGrups').enable();
            record.expand();
           //Ext.getCmp('btnadelGrups').disable();
        }

    },

    onExpandTree: function(node){
        if (!node.isRoot()) {
            /*(node.childNodes.length != 0) ? Ext.getCmp('btnadelGrups').disable() : */
            Ext.getCmp('btnadelGrups').enable();
        }else{
            Ext.getCmp('btnadelGrups').disable();
        }
    },

    onLoadTreeUser: function(){

        this.dropTreeUser = '';
        console.log('AKI ENTRO');
        var store = Ext.getCmp('treeAdmin').store;
        store.setProxy({
            type: 'ajax',
            url: 'servidor/grupouser',
            extraParams: {
                param: true
            }
        });

        Ext.getCmp('treeAdmin').on('itemappend', function(parentnode, node){

            _this.itemsApendTree1.parentnode = parentnode;
            _this.itemsApendTree1.node = node;

            if(_this.dropTreeUser == 'Grupos de usuario'){
                node.remove();
            }

        });

        Ext.getCmp('treeAdmin').on('iteminsert', function(parentnode, node){

            _this.itemsApendTree1.parentnode = parentnode;
            _this.itemsApendTree1.node = node;

            if(_this.dropTreeUser == 'Grupos de usuario'){
                node.remove();
            }

        });

    },

    onLoadTreePrint: function(){
        this.dropTreePrints = '';
        var store = Ext.getCmp('treeGroupPrinters').store;
        store.setProxy({
            type: 'ajax',
            url: 'servidor/grupoprinters',
            extraParams: {
                param: true
            }
        });

        Ext.getCmp('treeGroupPrinters').on('itemappend', function(parentnode, node){
            _this.itemsApendTree2.parentnode = parentnode;
            _this.itemsApendTree2.node = node;

            if(_this.dropTreePrints == 'Grupos de impresoras'){
                node.remove();
            }

        });

        Ext.getCmp('treeGroupPrinters').on('iteminsert', function(parentnode, node){

            _this.itemsApendTree2.parentnode = parentnode;
            _this.itemsApendTree2.node = node;

            if(_this.dropTreePrints == 'Grupos de impresoras'){
                node.remove();
            }

        });

    },
    addAux: function(botton){

        var titleWin = botton.up('window').title;
        switch (titleWin){

            case 'Adicionar grupo de usuario':
                var form = botton.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        url: 'admin/addgroups',
                        waitTitle: 'Enviando datos',
                        waitMsg: 'Espere por favor',
                        success: function(form, action){
                            botton.up('window').close();
                        },
                        failure: function(form, action){

                        }
                    });

                }
            break;

            case 'Adicionar usuario':
                var form = botton.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        url: 'admin/addgusers',
                        waitTitle: 'Enviando datos',
                        waitMsg: 'Espere por favor',
                        success: function(form, action){
                            Ext.getCmp('gridUsers').getStore().load();
                            botton.up('window').close();
                            Msg.util.msg(1, 'Información','El usuario fue adicionado satisfactoriamente.');
                        },
                        failure: function(form, action){

                        }
                    });

                }
            break;

            case 'Adicionar grupo de impresora':
                var form = botton.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        url: 'admin/addgroupprinter',
                        waitTitle: 'Enviando datos',
                        waitMsg: 'Espere por favor',
                        success: function(form, action){
                            var tree = Ext.getCmp('treeGroupPrinters');
                            var store = tree.getStore();

                            store.setProxy({
                                type: 'ajax',
                                url: 'servidor/grupoprinters',
                                extraParams: {
                                    param: false

                                }
                            });

                            store.load();
                            botton.up('window').close();
                            Msg.util.msg(1, 'Información','El grupo fue adicionado satisfactoriamente.');
                        },
                        failure: function(form, action){

                        }
                    });

                }
                break;
        }


       //botton.up('window').destroy();

    },

    addWin: function(btn){
        var title = 'Adicionar usuario';
        var aux = Ext.widget('aux', {fieldLabelTf: 'Usuario', fieldLabelTa: 'Nombre y apellidos'});
        aux.setTitle(title);
    },

    onitemclickGridGroupUsers: function(){
       Ext.getCmp('btndellUser').enable();
    },

    ajaxEliminarUser: function(btn){
        if(btn == 'YES'){
            var arrayNomb = [];
            Ext.getCmp('gridUsers').getSelectionModel().getSelection().forEach(function(a){
                arrayNomb.push(a.raw.username);
            });

           this.myMask.show();
            Ext.Ajax.request({
                url: 'admin/deleteusers',
                method: 'POST',
                params: {
                    arrayNomb: Ext.encode(arrayNomb)

                },
                callback: function(options, success, response) {
                    _this.myMask.hide();
                    var response = Ext.decode(response.responseText);
                    if(response.success){
                        Msg.util.msg(1, 'Información','El (los) usuario(s) se eliminaron satisfactoriamente.');
                        Ext.getCmp('gridUsers').getStore().load();
                    }


                }
            });
        }else{
          Ext.getCmp('btndellUser').disable();
        }

    },

    deluser: function(){
        Msg.util.MostrarMsg(4, 'Eliminar usuario(s)', '¿Está seguro que desea el (los) usuario(s)?', this.ajaxEliminarUser, this);
    },

    ajaxAddUserToGroup: function(){

      if(!_this.itemsApendTree1.parentnode.isRoot()){
          this.myMask.show();
          Ext.Ajax.request({
              url: 'admin/usertogroups',
              method: 'POST',
              params: {
                  nameParent: _this.itemsApendTree1.parentnode.raw.text,
                  name: _this.itemsApendTree1.node.raw.text

              },
              callback: function(options, success, response) {
                  _this.myMask.hide();
                  var response = Ext.decode(response.responseText);
                  if(response.success){
                      Ext.getCmp('treeAdmin').getStore().load({node:_this.itemsApendTree1.parentnode});
                      Ext.getCmp('gridUsers').getStore().load();
                  }


              }
          });
      }
    },

    ajaxAddPrintersToGroup: function(){

        if(!_this.itemsApendTree2.parentnode.isRoot()){
            this.myMask.show();
            Ext.Ajax.request({
             url: 'admin/addprintertogroups',
             method: 'POST',
             params: {
             nameParent: _this.itemsApendTree2.parentnode.raw.text,
             name: _this.itemsApendTree2.node.raw.text

             },
             callback: function(options, success, response) {
                 _this.myMask.hide();
                 var response = Ext.decode(response.responseText);
                 if(response.success){
                     Ext.getCmp('treeGroupPrinters').getStore().load({node:_this.itemsApendTree2.parentnode});
                     Ext.getCmp('gridGroupPrinters').getStore().load();
                 }

             }
             })
        }

    },

    ajaxDelUserToGroup: function(){

        this.myMask.show();
        Ext.Ajax.request({
            url: 'admin/deleteuserfromgroups',
            method: 'POST',
            params: {
                name: _this.itemsApendTree1.parentnode.raw.text,
                nameParent: _this.itemsApendTree1.parentnode.parentNode.raw.text

            },
            callback: function(options, success, response) {
                _this.myMask.hide();
                var response = Ext.decode(response.responseText);
                if(response.success){
                    Ext.getCmp('treeAdmin').getStore().load({node:_this.itemsApendTree1.parentnode.parentNode});
                    Ext.getCmp('gridUsers').getStore().load();
                }

            }
        });

    },

    ajaxDelPrinterToGroup: function(){

        this.myMask.show();
        Ext.Ajax.request({
         url: 'admin/deleteprinterfromgroups',
         method: 'POST',
         params: {
             name: _this.itemsApendTree2.parentnode.raw.text,
             nameParent: _this.itemsApendTree2.parentnode.parentNode.raw.text

         },
         callback: function(options, success, response) {
             _this.myMask.hide();
             var response = Ext.decode(response.responseText);
             if(response.success){
                 Ext.getCmp('treeGroupPrinters').getStore().load({node:_this.itemsApendTree2.parentnode.parentNode});
                 Ext.getCmp('gridGroupPrinters').getStore().load();
             }
         }
         });

    },

    savechanges: function(){
       var data = [];
       var changes = Ext.getCmp('gridGroupPrinters').getStore().getUpdatedRecords();
       if(changes.length != 0){
           changes.forEach(function(a,b){
               data.push(a.data);
           });

          this.myMask.show();
          Ext.Ajax.request({
               url: 'admin/modprinter',
               method: 'POST',
               params: {
                   data: Ext.encode(data)
               },
               callback: function(options, success, response) {
                   _this.myMask.hide();
                    var response = Ext.decode(response.responseText);
                    if(response.success){
                        Msg.util.msg(1, 'Información','El (Los) cambio(s) se han guardado satisfactoriamente.');
                        Ext.getCmp('gridGroupPrinters').getStore().load();
                    }
               }
           });
       }else{
           Msg.util.msg(1, 'Información','No se ha realizado ningún cambio.');
       }

    },

    onItemcontextmenu: function(view, record, html, index, e){
        e.stopEvent();
        if (!record.isRoot() && !record.isLeaf()) {
            this.itemContext = record;
            var  menu = Ext.getCmp('menuCuota');
            if(menu){
                menu.destroy();
            }

            var menu = Ext.widget('menuCuota');
            menu.showAt(e.getXY());
        }


    },

    asignarCuota: function(){

        var win = Ext.widget('cuota');
        //win.setTitle('Asignar cuota');
    },

    modificarCuota: function(){

        //TODO: aki va una peticion ajax
        var win = Ext.widget('cuota');
        win.setTitle('Modifcar cuota');

    },

    onLoadTreeCuotas: function(){
       var descrip, idGrupo  = 0;

       if(Ext.getCmp('winCuota').title == 'Modifcar cuota'){
           idGrupo = this.itemContext.raw.id;
           descrip = this.itemContext.raw.description;

           var tf = Ext.getCmp('tfuserCuota');
           var ta = Ext.getCmp('taDescrip');

           tf.setValue(this.itemContext.raw.text);
           tf.disable();

           ta.setValue(descrip);

       }

        var store = Ext.getCmp('treeCuotas').store;
        store.setProxy({
            type: 'ajax',
            url: 'servidor/grupoprinters',
            extraParams: {
                param: true,
                check: true,
                idG: idGrupo
            }
        });
    },

    actioncuota: function(botton){

        var data = [];
        Ext.getCmp('treeCuotas').getChecked().forEach(function(a,b){
            data.push(a.data);
        });

        var idGrupo = (this.itemContext) ? this.itemContext.raw.id : '';



        var nameG = (this.itemContext) ? this.itemContext.raw.text : '';

        var url = (botton.up('window').title == 'Modifcar cuota') ? 'admin/modgroups' : 'admin/addgroups';


        var form = botton.up('form').getForm();
        if (form.isValid()) {
            Ext.getCmp('tfuserCuota').enable();
            form.submit({
                url: url,
                waitTitle: 'Enviando datos',
                waitMsg: 'Espere por favor',
                params: {
                    data: Ext.encode(data),
                    idG: idGrupo
                },
                success: function(form, action){
                    if(botton.up('window').title == 'Modifcar cuota'){

                    }else{


                        var tree = Ext.getCmp('treeAdmin');
                        var store = tree.getStore();

                        store.setProxy({
                            type: 'ajax',
                            url: 'servidor/grupouser',
                            extraParams: {
                                param: false

                            }
                        });

                        //root.removeAll();
                        store.load();
                        //root.expand();
                    }

                    botton.up('window').close();


                },
                failure: function(form, action){

                }

            });

        }

    },

    itemclickTreeCuotas: function(view, record){

        var number = Ext.getCmp('numbercuota');
        var asignar = Ext.getCmp('btnasignar');
        this.nodeTreeCuotas = record;
        if (record.isLeaf()) {

            number.setValue(record.data.cuota);

            if(record.data.checked){
                number.enable();
                asignar.enable();
            }else{
                number.disable();
                asignar.disable();

            }

        }else{
            number.reset();
        }


    },

    asignar: function(){
        var value = Ext.getCmp('numbercuota').getValue();
        this.nodeTreeCuotas.set('cuota', value);
        this.nodeTreeCuotas.commit();

    }
})
