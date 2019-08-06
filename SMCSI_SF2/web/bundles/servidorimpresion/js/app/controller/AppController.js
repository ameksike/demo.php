Ext.define('Printers.controller.Users', {
    extend: 'Ext.app.Controller',

    stores: [
        // 'packs'
    ],
    model: [
        // 'packs'
    ],
    views: [],
    refs: [{
        ref: 'treeFiltros',
        selector: 'treeFiltros'
    },{
        ref: 'WinChangePass',
        selector: 'WinChangePass'
    },{
        ref: 'TabAdministracion',
        selector: 'TabAdministracion'
    },{
        ref: 'AddIp',
        selector: 'AddIp'
    },{
        ref: 'panelmainconfig',
        selector: 'panelmainconfig'
    },{
        ref: 'GridIpConfig',
        selector: 'GridIpConfig'
    },{
        ref: 'WinAddPrinters',
        selector: 'WinAddPrinters'
    },{
        ref: 'paneldetallesrusers',
        selector: 'paneldetallesrusers'
    },{
        ref: 'panelmainusers',
        selector: 'panelmainusers'
    },{
        ref: 'panelmainprinters',
        selector: 'panelmainprinters'
    },{
        ref: 'panelcenterprinters',
        selector: 'panelcenterprinters'
    },{
        ref: 'panelcenterusers',
        selector: 'panelcenterusers'
    },{
        ref: 'treeGrupoUsers',
        selector: 'treeGrupoUsers'
    },{
        ref: 'treeGrupoImpresoras',
        selector: 'treeGrupoImpresoras'
    },{
        ref: 'fsImpresoras',
        selector: 'fsImpresoras'
    },{
        ref: 'fsUsers',
        selector: 'fsUsers'
    },{
        ref: 'fsHistorial',
        selector: 'fsHistorial'
    },{
        ref: 'principal',
        selector: 'principal'
    },{
        ref: 'autentication',
        selector: 'autentication'
    },{
        ref: 'printerslist',
        selector: 'printerslist'
    },{
        ref: 'gridHistorial',
        selector: 'gridHistorial'
    }, {
        ref: 'treeAdmin',
        selector: 'treeAdmin'
    }, {
        ref: 'treeGroupPrinters',
        selector: 'treeGroupPrinters'
    }, {
        ref: 'aux',
        selector: 'aux'
    }, {
        ref: 'panelPikWest',
        selector: 'panelPikWest'
    }, {
        ref: 'gridGroupUsers',
        selector: 'gridGroupUsers'
    }, {
        ref: 'menuCuota',
        selector: 'menuCuota'
    }, {
        ref: 'cuota',
        selector: 'cuota'
    }, {
        ref: 'treeCuotas',
        selector: 'treeCuotas'
    }, {
        ref: 'Server',
        selector: 'Server'
    }],
    init: function() {
        var _this = this;
        dirCups = document.getElementById('dirCups').value;
        dirHelp = document.getElementById('dirHelp').value;
        original_dircups = dirCups;
        helpState = 'historial';
        nodeSelectedUser = "";
        this.obj = {
            filter:'',
            idGroupPrinters:'',
            idGroupUser:'',
            usuario:'',
            action:'',
            printer:'',
            date:''
        };
        _this.itemsApendTree1 = {
            parentnode: '',
            node: ''
        };
        _this.itemsApendTree2 = {
            parentnode: '',
            node: ''
        };
        this.myMask = new Ext.LoadMask(Ext.getBody(), {msg: 'Espere por favor...'});
        _this.control({

            'treeFiltros': {
                itemclick: _this.itemclickTreefiltre
            },
            'treeGrupoUsers': {
                itemclick: _this.itemclickTreefiltre
            },
            'GridIpConfig': {
                itemclick: _this.itemClickGridIp,
                itemdblclick: _this.itemDbClickGridIp,
                afterrender:_this.afterRenderGridIp
            },
            'treeGrupoImpresoras': {
                itemclick: _this.itemclickTreefiltre
            },
            'WinChangePass button[action=change_password]': {
                click: _this.changePassword
            },
            'WinChangePass button[action=closeWin]': {
                click: _this.closeWin
            },
            'fsHistorial':{
               render:_this.resnderFielsdSet
            },
            'fsHistorial button[action=ClearGridMain]': {
                click: _this.reloadGridMains
            },
            'fsHistorial button[action=ShearchGridMain]': {
                click: _this.shearchGridMainGridMains
            },
            'fsImpresoras button[action=busquedaImpresora]': {
                click: _this.clicKBootonFilset
            },
            'panelmainconfig button[action=addip]': {
                click: _this.clickBtnPanelIp
            },
            'panelmainconfig button[action=delip]': {
                click: _this.clickBtnPanelIp
            },
            'panelmainconfig checkbox[id=checkboxall]': {
                render: _this.ifAllowAllCheck
            },
            'panelmainconfig button[action=busquedaIp]': {
                click: _this.clickBtnPanelIp
            },
            'panelmainconfig button[action=clearGridIp]': {
                click: _this.clickBtnPanelIp
            },
            'panelmainconfig button[action=savechangesIp]': {
                click: _this.clickBtnPanelIp
            },
            'fsImpresoras button[action=clearGridImpresoras]': {
                click: _this.clicKBootonFilset
            },
            'fsUsers button[action=busquedaUsers]': {
                click: _this.clicKBootonFilset
            },
            'fsUsers button[action=clearGridUsers]': {
                click: _this.clicKBootonFilset
            },
            'principal':{
              'render': _this.onRenderMain
            },
            'principal tabpanel[id=tabCups]': {
                tabchange: _this.onTabchange,
                render: _this.onRenderTabmain
            },
            'principal tool[action=refresh]': {
                click: _this.onClickRefresh
            },
            'principal tool[action=autenticate]': {
                click: _this.onClickAutenticate
            },
            'autentication': {
                'render': _this.onRenderAutentic
            },
            'autentication button[action=closeWin]': {
                click: _this.closeWin
            },
            'AddIp button[action=closeWin]': {
                click: _this.closeWin
            },
            'AddIp button[action=addIps]': {
                click: _this.addIps
            },
            'WinAddPrinters button[action=finalizar]': {
                click: _this.winFinalizar
            },
            'WinAddPrinters': {
                beforeclose: _this.winClose
            },
            'autentication button[action=aceptarWin]': {
                click: _this.submitlogin
            },
            'printerslist': {
                itemclick: _this.onItemclickGrid,
                afterrender:_this.afterrenderGridHistory
            },
            'viewport panel[id=panelGestUsers]': {
                expand: this.onexpandPanelGestUsers
            },
            'viewport panel[id=panelGestPrinters]': {
                expand: this.onexpandPanelGestUsers
            },
            'panelmainprinters button[action=addGrups]': {
                click: _this.addGrups
            },
            'panelmainprinters button[action=delGrups]': {
                click:_this.delGrups
            },
            'panelmainusers button[action=modcuota]': {
                click: _this.modificarCuota
            },
            'panelmainusers button[action=addGrups]': {
                click: _this.addGrups
            },
            'panelmainusers button[action=delGrups]': {
                click: _this.delGrups
            },
            'panelPikWest panel[id=panelTreePrinters]': {
                expand: this.onexpandPanelTreePrinters
            },
            'panelPikWest panel[id=panelTreeAdmin]': {
                expand: this.onexpandPanelTreePrinters
            },
            'panelPikWest': {
                render: _this.onRenderPanelPikWest
            },
            'panelPikWest button[action=addGrups]': {
                click: _this.addGrups
            },
            'panelPikWest button[action=delGrups]': {
                click: _this.delGrups
            },
            'treeAdmin': {
                itemclick: _this.itemclickTree,
                'load': _this.onLoadTreeUser,
                'render': _this.onFire,
                'itemexpand': _this.onExpandTree,
                'itemcontextmenu': _this.onItemcontextmenu

            },
            'aux': {
                render: _this.onRenderAux
            },
            'aux button[action=closeWin]': {
                click: _this.closeWin
            },
            'aux button[action=addAux]': {
                click: _this.addAux
            },
            'treeGroupPrinters': {
                itemclick: _this.itemclickTree,  //
                'load': _this.onLoadTreePrint,
                'render': _this.onWater//,
                //'itemexpand': _this.onExpandTree
            },
            'panelcenterprinters button[action=btnaddprinters]': {
                click: _this.itemclickCups
            },
            'panelcenterprinters button[action=modPrinter]': {
                click: _this.itemclickCupsMod
            },
            'panelcenterusers button[action=adduser]': {
                click: _this.addWin
            },
            'panelcenterusers button[action=deluser]': {
                click: _this.deluser
            },
            'gridGroupPrinters button[action=addprint]': {
                click: _this.addWin
            },
            'gridGroupPrinters button[action=savechanges]': {
                click: _this.savechanges
            },
            'gridGroupUsers button[action=savechanges]': {
                click: _this.savechanges
            },
            'gridGroupUsers': {
                'render': _this.onRendergridGroupUsers,
                'itemclick': _this.onitemclickGridGroupUsers
            },
            'gridGroupPrinters': {
                'render': _this.onRenderGridGroupPrinters,
                'itemclick':_this.OnItemClikGridPrinters
            },
            'paneldetallesrusers': {
                render: _this.loadGridGroupsDetalles
            },
            'menuCuota menuitem[action=asigcuota]': {
                click: _this.asignarCuota
            },
            'menuCuota menuitem[action=modcuota]': {
                click: _this.modificarCuota
            },
            'cuota button[action=actioncuota]': {
                click: _this.actioncuota
            },
            'cuota button[action=closeWin]': {
                click: _this.closeWin
            },
            'cuota button[action=asignar]': {
                click: _this.asignar
            },
            'treeCuotas': {
                load: _this.onLoadTreeCuotas,
                itemclick: _this.itemclickTreeCuotas,
                checkchange:_this.checkChange

            },
            'TabAdministracion tabpanel[id=idtabadmin]': {
                tabchange: _this.tabChangeAdmin
            },
            'Server button[action=saveConfigS]': {
                click: _this.saveConfigS
            },
            'Server': {
                beforerender: _this.loadConfigS
            }
        });
    },

    onRenderMain: function(){

        this.keyMap = Ext.widget('keymapController');

        this.keyMap.pressAltB(this);
        this.keyMap.pressAltL(this);
    },

    onRenderAutentic: function(win){

        this.keyMap.pressAltX(this, win);
        this.keyMap.pressEnter(this, win);
    },

    onRenderTabmain: function(){
        Ext.Ajax.request({
            url: 'isauthenticate',
            method: 'POST',

            callback: function(options, success, response) {
                var obj = Ext.decode(response.responseText);
                if(obj.success === true){
                   /* var tab2 = {
                        xtype:'panel',
                        title: 'Administración', //93b12cff555dc4aa37d24647281d579e
                        id:'panelCups',
                        html:'<iframe id="iframeCups" src="http://10.12.34.23:631/admin" width="100%" height="100%"></iframe>'
                    };

                    Ext.getCmp('tabCups').add(tab2);*/

                    var tab2 = Ext.create('Tab.view.TabAdministracion');
                    Ext.getCmp('tabCups').add(tab2);
                    Ext.getCmp('logout').show();
                    Ext.getCmp('change_pass').show();
                    Ext.getCmp('login').hide();
                  //  Ext.getCmp('tabCups').setActiveTab(1);
                }
            }
        });
    },

    closeWin: function(button){
        (button.id == 'closeLogin') ? Ext.getCmp('tabCups').setActiveTab(0) : '';
        button.up('window').destroy();
    },

    itemclickTreefiltre: function(view, record, htmlItems){
        if (!record.isRoot()) {
            var tree1 = Ext.getCmp('treeFiltro').getSelectionModel().getSelection();
            var tree2 = Ext.getCmp('treeUsers').getSelectionModel().getSelection();
            var tree3 = Ext.getCmp('treeImpres').getSelectionModel().getSelection();

            (tree1.length != 0) ? Ext.getCmp('fecha').disable() : Ext.getCmp('fecha').enable();
            this.obj.filter = (tree1.length != 0) ? tree1[0].raw.id : '';
            this.obj.idGroupUser = (tree2.length != 0) ? tree2[0].raw.id : '';
            this.obj.idGroupPrinters = (tree3.length != 0) ? tree3[0].raw.id : '';

            Ext.getCmp('gridGrupoUsers').getStore().load({params: {
                json: Ext.encode(this.obj)
            },callback: function(records, operation, success) {
                (records.length == 0) ? Msg.util.msg(1, 'Información','No existen datos que mostrar.') : '';
            }});
        }
    },

    reloadGridMains: function(){
        Ext.getCmp('tfuser').reset();
        Ext.getCmp('cmbaccion').reset();
        Ext.getCmp('cmbimpresoras').reset();
        Ext.getCmp('fecha').reset();
        Ext.getCmp('fecha').enable();
        this.obj = {
            filter: '',
            idGroupPrinters: '',
            idGroupUser: '',
            usuario: '',
            action: '',
            printer: '',
            date: ''
        };

        Ext.getCmp('treeFiltro').getSelectionModel().deselectAll();
        Ext.getCmp('treeUsers').getSelectionModel().deselectAll();
        Ext.getCmp('treeImpres').getSelectionModel().deselectAll();

        Ext.getCmp('gridGrupoUsers').getStore().load();
    },

    shearchGridMainGridMains: function(){
        var accion = Ext.getCmp('cmbaccion');
        var printer = Ext.getCmp('cmbimpresoras');
        var user = Ext.getCmp('tfuser').getValue();

        var date = Ext.getCmp('fecha').getRawValue();

        var valueAction = (accion.getValue()!=null) ? accion.findRecordByValue(accion.getValue()).raw.id : '';
        var valuePrinter = (printer.getValue()!=null) ? printer.findRecordByValue(printer.getValue()).raw.id : '';

        this.obj.usuario = user;
        this.obj.action = valueAction;
        this.obj.printer = valuePrinter;
        this.obj.date = date;

        Ext.getCmp('gridGrupoUsers').getStore().load({params: {
            json: Ext.encode(this.obj)
        },callback: function(records, operation, success) {
            (records.length == 0) ? Msg.util.msg(1, 'Información','No existen datos que mostrar.') : '';
        }});
    },

    onTabchange: function(tab, neoCard){
        var idPanel = neoCard.id;

       if(idPanel == "panelHistory"){
           /*Recargar Grid Historial*/
           helpState = 'historial';
           Ext.getCmp('gridGrupoUsers').getStore().load();
           Ext.getCmp('treeImpres').getStore().load();
           Ext.getCmp('treeUsers').getStore().load();
       }else{
           helpState = (helpState == 'historial') ? 'impresoras':helpState;
       }
    },

    submitlogin: function(button){
        var form = button.up('form').getForm();
        if (form.isValid()) {
            form.submit({
                url: 'login',
                waitTitle: 'Enviando datos',
                waitMsg: 'Espere por favor',

                //Arreglar esto
                success: function(form, action){
                    button.up('window').close();
                    var dir = dirCups+"/admin";
                    var tab2 = Ext.create('Tab.view.TabAdministracion');
                    Ext.getCmp('tabCups').add(tab2);
                    Ext.getCmp('tabCups').setActiveTab(1);
                    /*
                        Visibilidad a los btn
                         cambiar pass
                         logout

                         Ocultar el btn
                          login

                    * */
                    Ext.getCmp('logout').show();
                    Ext.getCmp('change_pass').show();
                    Ext.getCmp('login').hide();
                },
                failure: function(form, action){
                   Msg.util.msg(3, 'Error', 'Autenticación incorrecta, inténtelo de nuevo');
                }
            });
        }
    },

    onItemclickGrid: function(view, record,c, d, e){

        var title = record.raw.title;
        var grupoUser = record.raw.groupname;
        var groupprinter = record.raw.groupprinter;
        var name = record.raw.name;

       /*
        var nombre = record.raw.title;
        var verssion = record.raw.VERSION;
        var descrip = record.raw.DESCRIPCION;
        var dependencia = record.raw.DEPENDENCIAS;
        var autor = record.raw.AUTOR;
        var logo = record.raw.LOGO;
        var estado = record.raw.ESTADO;
       */

       var style =
            '<div style="margin-left: 15px;">'+
            '<h3>'+'Nombre y Apellido:'+'</h3>' +//------------------Desarrollado------------ -----
            '<label >' + name + '</label>' +//------------------Desarrollado------------ -----
            '<h3>' + 'Titulo del trabajo:' + '</h3>' +//------------------Desarrollado------------ -----
            '<label >' + title + '</label>' +//------------------Desarrollado------------ -----

            '</div>';

      var style2 ='<div style="margin-left: 30px;">' +
       '<h3>' + 'Grupo de usuario:' + '</h3>' +//------------------Desarrollado------------ -----
       '<label >' + grupoUser + '</label>' +//------------------Desarrollado------------ -----
       '<h3>' + 'Grupo de impresora:' + '</h3>' +//------------------Desarrollado------------ -----
       '<label >' + groupprinter + '</label>' + //------------------Desarrollado------------ -----
       '</div>'
        /*  '<div style="margin-left: 30px">'+
            '<h3>'+'Gasto total de hojas:'+'</h3>' +//------------------Desarrollado------------ -----
            '<label >' + pag + '</label>' +//------------------Desarrollado------------ -----

            '<h3>'+'Gasto total($):'+'</h3>' +//------------------Desarrollado------------ -----
            '<label >' + costo + '</label>' +//------------------Desarrollado------------ -----
            '</div>';*/

        var tpl = new Ext.Template(style);
        var tpl2 = new Ext.Template(style2);
        var detailPanel = Ext.getCmp('panelDetalles');
        var details1 = Ext.getCmp('details1');
        var details2 = Ext.getCmp('details2');

        detailPanel.expand(true);
        tpl.overwrite(details1.body, e);
        tpl2.overwrite(details2.body, e);
    },

    ajaxCerrarSesion: function(btn){
      if(btn == 'YES'){
          Ext.Ajax.request({
              url: 'admin/logout',
              method: 'POST',

              callback: function(options, success, response) {
                  var obj = Ext.decode(response.responseText);
                  if(obj.success === true){
                      Ext.getCmp('tabCups').remove(Ext.getCmp('tabAdministrador'));
                      Ext.getCmp('logout').hide();
                      Ext.getCmp('change_pass').hide();
                      Ext.getCmp('login').show();
                  }
              }
          });
      }
    },

    onClickRefresh: function(event){
       var tab = Ext.getCmp('tabCups');

       if(tab.getActiveTab().id == 'panelCups'){
           var dir = dirCups + "/admin";
           Ext.get('iframeCups').dom.src = dir;
           tab.setActiveTab(0);
           tab.setActiveTab(1);
       }
    },

    onClickAutenticate: function(btn){
        var _this = this
        var idBtn = btn.id;
        switch (idBtn){
            case 'logout' :
                Msg.util.MostrarMsg(4, 'Información', '¿Estas seguro que deseas cerrar la sesión?', _this.ajaxCerrarSesion, this);
                break;
            case 'login':
                Ext.widget('autentication');
                break;
            case 'change_pass':
                Ext.create('Pikota.view.session.WinChangePass');
                break;

        }
    },

    onexpandPanelGestUsers: function (panel) {
        (panel.id == 'panelGestUsers') ? Ext.getCmp('panelTreeAdmin').expand() : Ext.getCmp('panelTreePrinters').expand();
        //Ext.getCmp('panelTreePrinters').collapse();
        //Ext.getCmp('panelTreeAdmin').expand();

    },

    onexpandPanelTreePrinters: function (panel) {
        (panel.id == 'panelTreePrinters') ? Ext.getCmp('panelGestPrinters').expand() : Ext.getCmp('panelGestUsers').expand();
    },

    onRenderPanelPikWest: function () {

        this.keyMap = Ext.widget('keymapController');

        this.keyMap.pressAltG(this);
        this.keyMap.pressAltR(this);
        this.keyMap.pressAltS(this);
        this.keyMap.pressAltH(this);

        this.myMask = new Ext.LoadMask(Ext.getBody(), {msg: 'Espere por favor...'});
    },

    onFire: function () {
        var _this = this;
        Ext.getCmp('treeAdmin').getView().on('drop', function (a, b) {
            var idNode = b.records[0].raw.id;
            _this.dropTreeUser = a.textContent;

            if (_this.itemsApendTree1.parentnode.isRoot()) {

                Ext.getCmp('treeAdmin').getStore().getNodeById(idNode).remove();

                // _this.itemsApendTree2.parentnode.remove(idNode,true);
            } else {
                _this.ajaxAddUserToGroup();
            }

        });

        Ext.getCmp('treeAdmin').getView().on('viewready', function () {

            var view = Ext.getCmp('treeAdmin').getView(),
                dd = view.findPlugin('treeviewdragdrop');

            dd.dragZone.onBeforeDrag = function (data, e) {
                var rec = view.getRecord(e.getTarget(view.itemSelector));
                return rec.isLeaf();
            };

        });

        Ext.getCmp('treeAdmin').getView().on('itemremove', function (parentnode) {

            _this.itemsApendTree1.parentnode = parentnode;

        });
    },

    onWater: function () {
        var _this = this;

        Ext.getCmp('treeGroupPrinters').getView().on('drop', function (a, b) {
            var idNode = b.records[0].raw.id;
            _this.dropTreePrints = a.textContent;
            if(_this.itemsApendTree2.parentnode.isRoot()) {

                Ext.getCmp('treeGroupPrinters').getStore().getNodeById(idNode).remove();

               // _this.itemsApendTree2.parentnode.remove(idNode,true);
            }else{
                _this.ajaxAddPrintersToGroup();
            }



        });

        Ext.getCmp('treeGroupPrinters').getView().on('viewready', function () {

            var view = Ext.getCmp('treeGroupPrinters').getView(),
                dd = view.findPlugin('treeviewdragdrop');

            dd.dragZone.onBeforeDrag = function (data, e) {
                var rec = view.getRecord(e.getTarget(view.itemSelector));
                return rec.isLeaf();
            };

        });

        Ext.getCmp('treeGroupPrinters').getView().on('itemremove', function (parentnode) {

            _this.itemsApendTree2.parentnode = parentnode;

        });


    },

    onRendergridGroupUsers: function () {
        var $this = this;
        Ext.getCmp('gridUsers').getView().on('drop', function () {

            $this.ajaxDelUserToGroup();

        });

        Ext.getCmp('gridUsers').getView().on('viewready', function () {

            var view = Ext.getCmp('gridUsers').getView(),
                dd = view.findPlugin('gridviewdragdrop');

            dd.dragZone.onBeforeDrag = function (data, e) {
                var groupname = view.getRecord(e.getTarget(view.itemSelector)).raw.isgroup
                return (!groupname);
            };

        });
    },

    onRenderGridGroupPrinters: function () {
        var $this = this;
        Ext.getCmp('btnmodPrinters').disable();
        Ext.getCmp('gridGroupPrinters').getView().on('drop', function () {

            $this.ajaxDelPrinterToGroup();

        });

        Ext.getCmp('gridGroupPrinters').getView().on('viewready', function () {

            var view = Ext.getCmp('gridGroupPrinters').getView(),
                dd = view.findPlugin('gridviewdragdrop');

            dd.dragZone.onBeforeDrag = function (data, e) {
                var groupname = view.getRecord(e.getTarget(view.itemSelector)).raw.isgroup
                return (!groupname);
            };

        });
    },

    onRenderAux: function (win) {

        this.keyMap.pressAltX(this, win);
        this.keyMap.pressEnter(this, win);

    },

    closeWin: function (button) {
        button.up('window').destroy();
    },

    addGrups: function (btn) {
       var idBtn = btn.id;
        var tree = (this.nodeSelected.raw.id == 'rootGusers') ? Ext.getCmp('treeAdmin') : Ext.getCmp('treeGroupPrinters');
        var selModel = tree.getSelectionModel();
        var node = selModel.getLastSelected();
        if(idBtn == 'btnmodGrupsPrinter'){

            var name = node.raw.text;
            var description = node.raw.description;

            var aux = Ext.widget('aux', {fieldLabelTf: 'Nombre', fieldLabelTa: 'Descripción',valueName:name,valueDescription:description});

            aux.setTitle('Modificar grupo de impresora');
        }else{
            // Could also use:
            // var node = selModel.getSelection()[0];

            if (node.isRoot()) { //node.raw.name === 'users'

                if (tree.getId() == 'treeAdmin') {
                    var win = Ext.widget('cuota');
                } else {
                    var aux = Ext.widget('aux', {fieldLabelTf: 'Nombre', fieldLabelTa: 'Descripción'});
                    aux.setTitle('Adicionar grupo de impresora');
                }


            }
        }


    },

    ajaxEliminarGrupo: function (btn) {
        var _this = this;
        if (btn == 'YES') {
            var url = "";
            var obj = {};
            if(this.treeActive == 'users'){
                if(this.nodeSelected.isLeaf()){
                    url = 'admin/deleteuserfromgroups';
                    obj = {
                        name: this.nodeSelected.raw.text,
                        nameParent: this.nodeSelected.parentNode.raw.text
                    }

                }else{
                    url = 'admin/deletegroups';
                    obj = {
                        name: this.nodeSelected.raw.text,
                        id: this.nodeSelected.raw.id
                    }
                }
            }else{
                if (this.nodeSelected.isLeaf()) {
                    url = 'admin/deleteprinterfromgroups';
                    obj = {
                        name: this.nodeSelected.raw.text,
                        nameParent: this.nodeSelected.parentNode.raw.text
                    }
                } else {
                    url = 'admin/deleteprintergroups';
                    obj = {
                        name: this.nodeSelected.raw.text
                    }
                }
            }
            //var url = (this.treeActive == 'users') ? 'admin/deletegroups' : 'admin/deleteprintergroups';
            this.myMask.show();
            Ext.Ajax.request({
                url: url,
                method: 'POST',
                params: obj,
                callback: function (options, success, response) {
                    var response = Ext.decode(response.responseText);
                    _this.myMask.hide();
                    if (response.success) {
                            Ext.getCmp('btnadelGrups').disable();
                            Ext.getCmp('btnadelGrupsPrinters').disable();
                        if (url == 'admin/deletegroups') {
                           // Ext.getCmp('gridUsers').getStore().load();
                            Msg.util.msg(1, 'Información', 'El grupo fue eliminado satisfactoriamente.');
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
                            Ext.getCmp('gridUsers').getStore().load();
                            /*Desabilitar botones*/
                            Ext.getCmp('btnmodGrupsUser').disable();
                        } else if (url == 'admin/deleteprintergroups'){
                            //Ext.getCmp('gridGroupPrinters').getStore().load();
                            Msg.util.msg(1, 'Información', 'El grupo fue eliminado satisfactoriamente.');
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
                            Ext.getCmp('gridGroupPrinters').getStore().load();
                            /*Desabilitar botones elimina*/
                            Ext.getCmp('btnmodGrupsPrinter').disable();
                        }else if(url == 'admin/deleteuserfromgroups'){
                           // Ext.getCmp('gridUsers').getStore().load();
                            Msg.util.msg(1, 'Información', 'El usuario fue eliminado del grupo satisfactoriamente.');
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
                            Ext.getCmp('gridUsers').getStore().load();

                        }else if(url == 'admin/deleteprinterfromgroups'){
                            //Ext.getCmp('gridGroupPrinters').getStore().load();
                            Msg.util.msg(1, 'Información', 'La impresora fue eliminada del grupo satisfactoriamente.');
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
                            Ext.getCmp('gridGroupPrinters').getStore().load();
                        }

                    }
                }
            });
        }
    },

    delGrups: function (btn) {
        var id  = btn.id;
        var titleWin = "Eliminar Grupo";
        var msg = "¿Está seguro que desea elminar el grupo?";
        switch(id){
            case 'btnadelGrups':
                if (this.nodeSelected.isLeaf()) {
                    titleWin = "Eliminar Usuario del Grupo";
                    var msg = "¿Está seguro que desea elminar el usuario "+this.nodeSelected.raw.text +" del grupo seleccionado?";
                }
                break;
            case 'btnadelGrupsPrinters':
                if (this.nodeSelected.isLeaf()) {
                    titleWin = "Eliminar Impresora del Grupo";
                    var msg = "¿Está seguro que desea elminar la impresora " + this.nodeSelected.raw.text + "  del grupo seleccionado?";
                }
                break;
        }
        Msg.util.MostrarMsg(4, titleWin, msg, this.ajaxEliminarGrupo, this);
    },

    addNodesTree: function () {
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

    itemclickTree: function (view, record, html) {
        this.treeActive = (view.getNode(0).textContent == 'Grupos de usuario') ? 'users' : 'printers';
        this.nodeSelected = record;
        this.itemContext = record;
        var idelement = record.raw.id;
        var idpadre = record.raw.idpadre;
        if (record.isRoot()) {
            if(idelement == 'rootGPrinters'){
                Ext.getCmp('btnaddGrupsPrinter').enable();
                Ext.getCmp('btnadelGrupsPrinters').disable();
                Ext.getCmp('btnmodGrupsPrinter').disable();
            }else if(idelement == 'rootGusers'){
                Ext.getCmp('btnaddGrups').enable();
                Ext.getCmp('btnadelGrups').disable();
                Ext.getCmp('btnmodGrupsUser').disable();
                Ext.getCmp('gridDetalles').getStore().removeAll();
                Ext.getCmp('idpaneldetalles').collapse();
            }

        } else {
            /*if(idpadre == 'rootGPrinters'){
                Ext.getCmp('btnaddGrupsPrinter').disable();
                Ext.getCmp('btnmodGrupsPrinter').enable();
            }else if(idpadre == 'rootGusers'){
                Ext.getCmp('btnaddGrups').disable();
            }*/


            if(record.isLeaf()){
                var idAbuelo = record.parentNode.parentNode.raw.id;
                if (idAbuelo == 'rootGPrinters') {
                    Ext.getCmp('btnaddGrupsPrinter').disable();
                    Ext.getCmp('btnadelGrupsPrinters').enable();
                    Ext.getCmp('btnmodGrupsPrinter').disable();
                }else if(idAbuelo == 'rootGusers'){
                    Ext.getCmp('btnadelGrups').enable();
                    Ext.getCmp('btnmodGrupsUser').disable();
                    Ext.getCmp('gridDetalles').getStore().removeAll();
                    Ext.getCmp('idpaneldetalles').collapse();
                }
            }else{
                /*Colabsar detalles*/

                if (idpadre == 'rootGPrinters') {
                    Ext.getCmp('btnaddGrupsPrinter').disable();
                    Ext.getCmp('btnadelGrupsPrinters').enable();
                    Ext.getCmp('btnmodGrupsPrinter').enable();
                } else if (idpadre == 'rootGusers') {
                     Ext.getCmp('btnmodGrupsUser').enable();
                    Ext.getCmp('btnaddGrups').disable();
                    /*btnmodGrupsUser*/
                    nodeSelectedUser = record;
                    Ext.getCmp('idpaneldetalles').collapse();
                    Ext.getCmp('idpaneldetalles').toggleCollapse();
                    Ext.getCmp('btnadelGrups').enable();
                    Ext.getCmp('gridDetalles').getStore().load({
                        params: {
                            idgrupo: idelement
                        }, callback: function (records, operation, success) {
                            (records.length == 0) ? Msg.util.msg(1, 'Información', 'No existen datos que mostrar.') : '';
                        }
                    });

                }


            }
            //record.expand();
            //Ext.getCmp('btnadelGrups').disable();
        }

    },

    onExpandTree: function (node) {
        /*var idpadre = node.raw.idpadre;
        if (!node.isRoot()) {
            if (idpadre == 'rootGPrinters') {
                Ext.getCmp('btnadelGrupsPrinters').enable();
            } else if (idpadre == 'rootGusers') {
                Ext.getCmp('btnadelGrups').enable();
            }
        } else {
            if (idpadre == 'rootGPrinters') {
                Ext.getCmp('btnaddGrupsPrinter').disable();
            } else if (idpadre == 'rootGusers') {
                Ext.getCmp('btnaddGrups').disable();
            }
        }*/
    },

    onLoadTreeUser: function () {

        this.dropTreeUser = '';
        var store = Ext.getCmp('treeAdmin').store;
        store.setProxy({
            type: 'ajax',
            url: 'servidor/grupouser',
            extraParams: {
                param: true
            }
        });
        var _this = this;
        Ext.getCmp('treeAdmin').on('itemappend', function (parentnode, node) {

            _this.itemsApendTree1.parentnode = parentnode;
            _this.itemsApendTree1.node = node;

            if (_this.dropTreeUser == 'Grupos de usuario') {
                node.remove();
            }

        });

        Ext.getCmp('treeAdmin').on('iteminsert', function (parentnode, node) {

            _this.itemsApendTree1.parentnode = parentnode;
            _this.itemsApendTree1.node = node;

            if (_this.dropTreeUser == 'Grupos de usuario') {
                node.remove();
            }

        });

    },

    onLoadTreePrint: function () {
        this.dropTreePrints = '';
        var store = Ext.getCmp('treeGroupPrinters').store;
        store.setProxy({
            type: 'ajax',
            url: 'servidor/grupoprinters',
            extraParams: {
                param: true
            }
        });
        var _this = this;
        Ext.getCmp('treeGroupPrinters').on('itemappend', function (parentnode, node) {
            _this.itemsApendTree2.parentnode = parentnode;
            _this.itemsApendTree2.node = node;

            if (_this.dropTreePrints == 'Grupos de impresoras') {
                node.remove();
            }

        });

        Ext.getCmp('treeGroupPrinters').on('iteminsert', function (parentnode, node) {

            _this.itemsApendTree2.parentnode = parentnode;
            _this.itemsApendTree2.node = node;

            if (_this.dropTreePrints == 'Grupos de impresoras') {
                node.remove();
            }

        });

    },
    addAux: function (botton) {

        var titleWin = botton.up('window').title;
        switch (titleWin) {

            case 'Adicionar grupo de usuario':
                var form = botton.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        url: 'admin/addgroups',
                        waitTitle: 'Enviando datos',
                        waitMsg: 'Espere por favor',
                        success: function (form, action) {
                            var obj = Ext.decode(action.response.responceText);

                            botton.up('window').close();
                        },
                        failure: function (form, action) {

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
                        success: function (form, action) {
                            Ext.getCmp('gridUsers').getStore().load();
                            botton.up('window').close();
                            Msg.util.msg(1, 'Información', 'El usuario fue adicionado satisfactoriamente.');
                        },
                        failure: function (form, action) {

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
                        success: function (form, action) {
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
                            Msg.util.msg(1, 'Información', 'El grupo fue adicionado satisfactoriamente.');
                        },
                        failure: function (form, action) {
                            Msg.util.msg(3, 'Error', 'El grupo que deseas adicionar ya existe.');
                        }
                    });

                }
            break;
            case 'Modificar grupo de impresora':
                var id_modificar = this.nodeSelected.raw.id;
                var form = botton.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        url: 'admin/addgroupprinter',
                        waitTitle: 'Enviando datos',
                        waitMsg: 'Espere por favor',
                        params:{
                          id:id_modificar
                        },
                        success: function (form, action) {
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
                            Msg.util.msg(1, 'Información', 'El grupo fue modificado satisfactoriamente.');
                            /*desabilitar los btn*/
                            Ext.getCmp('btnmodGrupsPrinter').disable();
                            Ext.getCmp('btnadelGrupsPrinters').disable();
                        },
                        failure: function (form, action) {
                            Msg.util.msg(3, 'Error', 'El grupo que deseas modificar ya existe.');
                        }
                    });

                }
                break;
        }

    },

    addWin: function (btn) {

        var title = 'Adicionar usuario';
        var aux = Ext.widget('aux', {fieldLabelTf: 'Usuario', fieldLabelTa: 'Nombre y apellidos'});
        aux.setTitle(title);
    },

    onitemclickGridGroupUsers: function () {
        Ext.getCmp('btndellUser').enable();
    },

    ajaxEliminarUser: function (btn) {
        var _this = this;
        if (btn == 'YES') {
            var arrayNomb = [];
            Ext.getCmp('gridUsers').getSelectionModel().getSelection().forEach(function (a) {
                arrayNomb.push(a.raw.username);
            });

            _this.myMask.show();
            Ext.Ajax.request({
                url: 'admin/deleteusers',
                method: 'POST',
                params: {
                    arrayNomb: Ext.encode(arrayNomb)

                },
                callback: function (options, success, response) {
                    _this.myMask.hide();
                    var response = Ext.decode(response.responseText);
                    if (response.success) {
                        Msg.util.msg(1, 'Información', 'El (los) usuario(s) se eliminaron satisfactoriamente.');
                        Ext.getCmp('gridUsers').getStore().load();
                        Ext.getCmp('treeAdmin').getStore().load({params:{param: false}});
                    }


                }
            });
        } else {
            Ext.getCmp('btndellUser').disable();
        }

    },

    deluser: function () {
        Msg.util.MostrarMsg(4, 'Eliminar usuario(s)', '¿Está seguro que desea el (los) usuario(s)?', this.ajaxEliminarUser, this);
    },

    ajaxAddUserToGroup: function () {
        var _this = this;
        if (!_this.itemsApendTree1.parentnode.isRoot()) {
            this.myMask.show();
            Ext.Ajax.request({
                url: 'admin/usertogroups',
                method: 'POST',
                params: {
                    nameParent: _this.itemsApendTree1.parentnode.raw.text,
                    name: _this.itemsApendTree1.node.raw.text

                },
                callback: function (options, success, response) {
                    _this.myMask.hide();
                    var response = Ext.decode(response.responseText);
                    if (response.success) {
                        Ext.getCmp('treeAdmin').getStore().load({node: _this.itemsApendTree1.parentnode});
                        Ext.getCmp('gridUsers').getStore().load();
                    }


                }
            });
        }
    },

    ajaxAddPrintersToGroup: function () {
        var _this = this;
        if (!_this.itemsApendTree2.parentnode.isRoot()) {
            this.myMask.show();
            Ext.Ajax.request({
                url: 'admin/addprintertogroups',
                method: 'POST',
                params: {
                    nameParent: _this.itemsApendTree2.parentnode.raw.text,
                    name: _this.itemsApendTree2.node.raw.text

                },
                callback: function (options, success, response) {
                    _this.myMask.hide();
                    var response = Ext.decode(response.responseText);
                    if (response.success) {
                        Ext.getCmp('treeGroupPrinters').getStore().load({node: _this.itemsApendTree2.parentnode});
                        Ext.getCmp('gridGroupPrinters').getStore().load();
                    }

                }
            })
        }

    },

    ajaxDelUserToGroup: function () {
        var _this = this;
        this.myMask.show();
        Ext.Ajax.request({
            url: 'admin/deleteuserfromgroups',
            method: 'POST',
            params: {
                name: _this.itemsApendTree1.parentnode.raw.text,
                nameParent: _this.itemsApendTree1.parentnode.parentNode.raw.text

            },
            callback: function (options, success, response) {
                _this.myMask.hide();
                var response = Ext.decode(response.responseText);
                if (response.success) {
                    Ext.getCmp('treeAdmin').getStore().load({node: _this.itemsApendTree1.parentnode.parentNode});
                    Ext.getCmp('gridUsers').getStore().load();
                }

            }
        });

    },

    ajaxDelPrinterToGroup: function () {
        var _this = this;
        this.myMask.show();
        Ext.Ajax.request({
            url: 'admin/deleteprinterfromgroups',
            method: 'POST',
            params: {
                name: _this.itemsApendTree2.parentnode.raw.text,
                nameParent: _this.itemsApendTree2.parentnode.parentNode.raw.text

            },
            callback: function (options, success, response) {
                _this.myMask.hide();
                var response = Ext.decode(response.responseText);
                if (response.success) {
                    Ext.getCmp('treeGroupPrinters').getStore().load({node: _this.itemsApendTree2.parentnode.parentNode});
                    Ext.getCmp('gridGroupPrinters').getStore().load();
                }
            }
        });

    },

    savechanges: function (btn) {
        var id = btn.id;
        var _this = this;
        switch (id){
            case 'save_printers':
                var data = [];
                var changes = Ext.getCmp('gridGroupPrinters').getStore().getUpdatedRecords();
                if (changes.length != 0) {
                    changes.forEach(function (a, b) {
                        data.push(a.data);
                    });

                    this.myMask.show();
                    Ext.Ajax.request({
                        url: 'admin/modprinter',
                        method: 'POST',
                        params: {
                            data: Ext.encode(data)
                        },
                        callback: function (options, success, response) {
                            _this.myMask.hide();
                            var response = Ext.decode(response.responseText);
                            if (response.success) {
                                Msg.util.msg(1, 'Información', 'El (Los) cambio(s) se han guardado satisfactoriamente.');
                                Ext.getCmp('gridGroupPrinters').getStore().load();
                            }
                        }
                    });
                } else {
                    Msg.util.msg(1, 'Información', 'No se ha realizado ningún cambio.');
                }
                break;
            case 'save_users':
                var data = [];
                var changes = Ext.getCmp('gridUsers').getStore().getUpdatedRecords();
                if (changes.length != 0) {
                    changes.forEach(function (a, b) {
                        data.push(a.data);
                    });
                    this.myMask.show();

                    Ext.Ajax.request({
                        url: 'admin/modusers',
                        method: 'POST',
                        params: {
                            data: Ext.encode(data)
                        },
                        callback: function (options, success, response) {
                            _this.myMask.hide();
                            var response = Ext.decode(response.responseText);
                            if (response.success) {
                                Msg.util.msg(1, 'Información', 'El (Los) cambio(s) se han guardado satisfactoriamente.');
                                Ext.getCmp('gridUsers').getStore().load();
                            }
                        }
                    });
                } else {
                    Msg.util.msg(1, 'Información', 'No se ha realizado ningún cambio.');
                }
                break;

                break;

        }

    },

    onItemcontextmenu: function (view, record, html, index, e) {
        e.stopEvent();
        if (!record.isRoot() && !record.isLeaf()) {
            this.itemContext = record;
            var menu = Ext.getCmp('menuCuota');
            if (menu) {
                menu.destroy();
            }

            var menu = Ext.widget('menuCuota');
            menu.showAt(e.getXY());
        }


    },

    asignarCuota: function () {

        var win = Ext.widget('cuota');
        //win.setTitle('Asignar cuota');
    },

    modificarCuota: function () {

        //TODO: aki va una peticion ajax
        var win = Ext.widget('cuota');
        win.setTitle('Modificar grupo');

    },

    onLoadTreeCuotas: function () {
        var descrip, idGrupo = 0;

        if (Ext.getCmp('winCuota').title == 'Modificar grupo') {
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

    actioncuota: function (botton) {

        var data = [];
        Ext.getCmp('treeCuotas').getChecked().forEach(function (a, b) {
            data.push(a.raw);
        });

        var idGrupo = (this.itemContext) ? this.itemContext.raw.id : '';


        var nameG = (this.itemContext) ? this.itemContext.raw.text : '';

        var url = (botton.up('window').title == 'Modificar grupo') ? 'admin/modgroups' : 'admin/addgroups';


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
                success: function (form, action) {
                    var obj = Ext.decode(action.response.responseText);
                    var title  = botton.up('window').title;

                    if(obj.success == true){
                        switch (title){
                            case 'Modificar grupo':
                                Msg.util.msg(1,'Informacion', 'El (Los) cambio(s) se han guardado satisfactoriamente.');
                                break;

                            default:
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
                                Msg.util.msg(1,'Informacion','El Grupo ha sido adicionado satisfactoriamente.');


                        }
                       botton.up('window').close();
                    }
                },
                failure: function (form, action) {
                    var obj = Ext.decode(action.response.responseText);
                    var title = botton.up('window').title;

                    if (obj.failure == true) {
                        Msg.util.msg(3,'Error','El grupo que deseas adicionar ya existe.');
                    }
                }

            });

        }

    },

    itemclickTreeCuotas: function (view, record) {
        var number = Ext.getCmp('numbercuota');
        var asignar = Ext.getCmp('btnasignar');
        this.nodeTreeCuotas = record;
        if (record.isLeaf()) {
            number.setValue(record.raw.cuota);
            if (record.data.checked) {
                //console.log('Si esta check');
                number.enable();
                asignar.enable();
            }else {
                //console.log('No esta check');
                number.disable();
                asignar.disable();
            }
        }else {
           //console.log('No es hoja');
            number.disable();
            asignar.disable();
            number.reset();
        }
    },
    checkChange:function (node, checked, eOpts) {
        var number = Ext.getCmp('numbercuota');
        var asignar = Ext.getCmp('btnasignar');
        if(checked){
            number.enable();
            asignar.enable();
        }else{
            number.disable();
            asignar.disable();
        }
    },

    asignar: function () {
        var value = Ext.getCmp('numbercuota').getValue();
        this.nodeTreeCuotas.set('cuota', value);
        this.nodeTreeCuotas.commit();
        this.nodeTreeCuotas.raw.cuota = value;
        //this.nodeTreeCuotas.commit();
    },

    itemclickCups: function(btn){

        //window.name = "adicionarprinters";

        Ext.Ajax.request({
            url: 'admin/allowdeny',
            method: 'POST',
            params: {
                data: 'allow'
            },
            callback: function (options, success, response) {
                var response = Ext.decode(response.responseText);

                if (response.success) {
                    dirCups = original_dircups + '/admin/';
                    var window = Ext.create('Pikota.view.WinAddPrinters');
                    Ext.getCmp('finaddprinters').show();
                        window.show();
                }
            }
        });
    },
    itemclickCupsMod: function (btn) {
        var nameprinter = Ext.getCmp('gridGroupPrinters').getSelectionModel().selected.items[0].data.printername;
        dirCups = original_dircups + '/printers/'+nameprinter;
        var window = Ext.create('Pikota.view.WinAddPrinters');
        //window.name = "modificarprinters";
        Ext.Ajax.request({
            url: 'admin/preparaParaModificar',
            method: 'POST',
            params: {
                data: 'sdx'
            },
            callback: function (options, success, response) {
                var response = Ext.decode(response.responseText);
                if (response.success) {
                    Ext.getCmp('finmodprinters').show();
                    window.show();
                }
            }
        });
    },
    OnItemClikGridPrinters:function(view,record,item,index, e, eOpts){
        Ext.getCmp('btnmodPrinters').enable();
    },
    loadGridGroupsDetalles:function(store,records,successful,eOpts){
        var _this = this;
        Ext.getCmp('gridDetalles').getStore().on({
            beforeload: _this.onDetallesLoad,
            scope: _this // Important. Ensure "this" is correct during handler execution
        });
    },
    onDetallesLoad : function(store,operation,eOpts ){
        if(!this.nodeSelected.isLeaf() && !this.nodeSelected.isRoot()){
            var params = {
                idgrupo: this.nodeSelected.raw.id
            }
            operation.params = params;
        }else{
            var params = {
                idgrupo: 0
            }
            operation.params = params;
        }

    },
    winFinalizar:function(btn){
        var id = btn.id;
        var _this = this;
        switch (id){
            case 'finaddprinters':
               /* _this.myMask.show();
                Ext.Ajax.request({
                    url: 'admin/addprinter',
                    method: 'POST',
                    params: {
                        data: 'sdx'
                    },
                    callback: function (options, success, response) {
                        _this.myMask.hide();
                        var response = Ext.decode(response.responseText);
                        if (response.success) {
                            //Ext.getCmp('finmodprinters').show();
                            btn.up('window').close();
                        }
                    }
                });*/
                btn.up('window').close();
                break;
            case 'finmodprinters':
               /* _this.myMask.show();
                Ext.Ajax.request({
                    url: 'admin/modprinterbycups',
                    method: 'POST',
                    params: {
                        data: 'sdx'
                    },
                    callback: function (options, success, response) {
                        _this.myMask.hide();
                        var response = Ext.decode(response.responseText);
                        if (response.success) {
                            //Ext.getCmp('finmodprinters').show();
                            btn.up('window').close();
                        }
                    }
                });*/
                btn.up('window').close();
                break;
        }
    },
    winClose: function(p,obj){
        var _this = this;
        if(Ext.getCmp('finmodprinters').isVisible()){
            _this.myMask.show();
            Ext.Ajax.request({
                url: 'admin/modprinterbycups',
                method: 'POST',
                callback: function (options, success, response) {
                    _this.myMask.hide();
                    Ext.getCmp("gridGroupPrinters").getStore().load();

                }
            });
        }else{
            _this.myMask.show();
            Ext.Ajax.request({
                url: 'admin/addprinter',
                method: 'POST',
                callback: function (options, success, response) {
                    _this.myMask.hide();
                    Ext.getCmp("gridGroupPrinters").getStore().load();
                }
            });
        }

    },
    clicKBootonFilset:function(btn){
       var id = btn.id;
       var _this = this;

        switch (id) {
            case 'btn_search_user':
                _this.busquedaUser(btn);
                break;
            case 'clear_grid_user':
                _this.clearGridUser(btn);
                break;
            case 'btn_search_printer':
                _this.busquedaImpresora(btn);
                break;
            case 'clear_grid_printer':
                _this.clearGridImpresoras(btn);
                break;
        }
    },
    busquedaImpresora:function(btn){
       var value = Ext.getCmp('tfuserimpresoras').getValue();
        Ext.getCmp('gridGroupPrinters').getStore().load({
            params: {
                filtre: value
            }
        });
    },
    clearGridImpresoras: function (btn) {
        Ext.getCmp('tfuserimpresoras').reset();
        Ext.getCmp('gridGroupPrinters').getStore().load();
    },
    busquedaUser: function (btn) {
        var value = Ext.getCmp('tfusersfiltre').getValue();
        Ext.getCmp('gridUsers').getStore().load({
            params : {
                filtre :value
            }
        });
    },
    clearGridUser: function (btn) {
        Ext.getCmp('tfusersfiltre').reset();
        Ext.getCmp('gridUsers').getStore().load();
    },

    itemClickGridIp:function(grid,record,item,index,e,eOpts){
       /*Actibar el eliminar*/
        Ext.getCmp('delete_ip').enable();

    },
    clickBtnPanelIp:function(btn){
        var id = btn.id;
        switch (id){
            case "add_ip":
                this.addIp();
                break;
            case "delete_ip":
                Msg.util.MostrarMsg(4, 'Eliminar Ip(s)', '¿Está seguro que desea el (los) Ip(s)?', this.deleteIp, this);
                break;
            case "btn_search_ip":
                this.buscarIpgrid();
                break;
            case "clear_grid_ip":
                this.clearGridIp();
                break;
            case "save_ip":
                this.guardarCambiosIp();
                break;
        }

    },
    buscarIpgrid:function(){
        var cadena = Ext.getCmp('tfipfiltre').getValue();
        Ext.getCmp('GridIpConfig').getStore().load({
            params: {
                filter: cadena
            }
        });
    },
    guardarCambiosIp:function(){
        var _this = this;
        _this.myMask.hide();
        Ext.Ajax.request({
            url: 'admin/save_changes_ip',
            method: 'POST',
            params: {
                data: Ext.encode(objEdit)
            },
            callback: function (options, success, response) {
                _this.myMask.hide();
                var response = Ext.decode(response.responseText);
                if (response.success) {
                    var cod = response.cod;
                    var title = "";
                    switch (cod){
                        case 1 :
                            title  = "Información";
                            break;
                        case 2 :
                            title = "Advertencia";
                            break;
                        case 3 :
                            title = "Error";
                            break;
                    }
                    Msg.util.msg(cod, title, response.msg);
                    Ext.getCmp('GridIpConfig').getStore().load();
                }
            }
        });
        Ext.getCmp('GridIpConfig').getStore().load();
        objEdit = new Array;
    },
    addIp:function(){
        /*Crear la ventana
        *
        * y mostrarla
        * */
        var winAdd = Ext.create('Printers.views.AddIp');
    },
    deleteIp:function(btn){
        var _this = this;
        if (btn == 'YES') {
            var ips= [];
            Ext.getCmp('GridIpConfig').getSelectionModel().getSelection().forEach(function (a) {
                ips.push(a.raw.ip);
            });

            _this.myMask.show();
            Ext.Ajax.request({
                url: 'admin/delete_ip',
                method: 'POST',
                params: {
                    data: Ext.encode(ips)
                },
                callback: function (options, success, response) {
                    _this.myMask.hide();
                    var response = Ext.decode(response.responseText);
                    if (response.success) {
                        Msg.util.msg(1,"Información",response.msg);
                        Ext.getCmp('GridIpConfig').getStore().load();
                    }


                }
            });
        }
    },

    clearGridIp:function(){
        var editor = Ext.getCmp('tfipfiltre');
        editor.reset();
        Ext.getCmp('GridIpConfig').getStore().load();
    },
    itemDbClickGridIp:function(view, record,item, index,e,eOpts){


    },
    afterRenderGridIp : function(cmp,obj){
        objEdit = new Array;
        var _this = this;
        var grid = Ext.getCmp('GridIpConfig');
        grid.on('edit', function (editor, e) {
            var nuevo = e.value;
            var viejo = e.record.raw.ip;
            var i = e.rowIdx;
            if(nuevo != viejo){
                var obj = {
                    'nuevo': nuevo,
                    'viejo': viejo
                };
                objEdit[i] = obj;
            }else{
                objEdit[i] = {};
            }
        });
        grid.on('canceledit', function (editor, e, object) {

        });

        grid.getStore().on({
               beforeload: _this.btnDeleteIp,
               scope:_this
        });

        var check = Ext.getCmp('checkboxall');
        check.on('change',function(fiel,newValue,oldValue,obj){
            if(newValue){
                /*'Permirit todas las ip'*/
                _this.myMask.show();
                Ext.Ajax.request({
                    url: 'admin/activate_all',
                    method: 'POST',
                    callback: function (options, success, response) {
                        _this.myMask.hide();
                        var response = Ext.decode(response.responseText);
                        if (response.success) {
                            //Msg.util.msg(1, 'Información', 'El (los) usuario(s) se eliminaron satisfactoriamente.');
                            Ext.getCmp('GridIpConfig').disable();
                        } else if (!response.success) {

                        }


                    }
                });
                grid.getStore().removeAll();
                grid.disable();
                Ext.getCmp('add_ip').disable();
                Ext.getCmp('delete_ip').disable();
                Ext.getCmp('id_panel_search').disable();
                /*Activar los enabled*/
            }else{
                _this.myMask.show();
                Ext.Ajax.request({
                    url: 'admin/deactivate_all',
                    method: 'POST',
                    callback: function (options, success, response) {
                        _this.myMask.hide();
                        var response = Ext.decode(response.responseText);
                        if (response.success) {
                            grid.getStore().load();
                            grid.enable();
                            Ext.getCmp('add_ip').enable();
                            Ext.getCmp('id_panel_search').enable();
                        }
                    }
                });
            }
        });
    },

    btnDeleteIp : function(){
        Ext.getCmp('delete_ip').disable();
    },
    addIps: function(btn){
        var idbtn = btn.id;
        switch (idbtn){
            case "id_btn_addIps":
                 this.adicionarIp(btn,false);
                break
            case "id_btn_applyIps":
                this.adicionarIp(btn, true);
                break
        }
    },
    adicionarIp:function(btn,apply){
        var form = btn.up('form');
        form.submit({
            url: 'admin/add_ip',
            waitTitle: 'Enviando datos',
            waitMsg: 'Espere por favor',
            success: function (form, action) {
                var obj = Ext.decode(action.response.responseText);
                if (obj.success == true) {
                    /*recargar grid IP*/
                    var storeGridIps = Ext.getCmp('GridIpConfig').getStore();
                    storeGridIps.load();
                    if(!apply){
                        btn.up('window').close();
                    }
                    /*Mensaje de Exito*/
                    Msg.util.msg(1, 'Información', obj.msg);
                }
            },
            failure: function (form, action) {
                var obj = Ext.decode(action.response.responseText);
                Msg.util.msg(3, 'Error', obj.msg);
            }

        });
    },
    afterrenderGridHistory:function(grid,obj){
        var _this = this;
        var grid = Ext.getCmp('gridGrupoUsers');
        grid.getStore().on({
            beforeload: _this.changeParams,
            scope: _this
        });
    },
    changeParams:function(store,operation,obj){
        var valor = {
            json:Ext.encode(this.obj)
        };
        operation.params = valor;

    },
    ifAllowAllCheck: function(a,d){
        Ext.Ajax.request({
            url: 'admin/allowall_or_not',
            method: 'POST',
            callback: function(options, success, response) {
                var obj = Ext.decode(response.responseText);
                if(obj.success === true && obj.msg == "all"){
                    Ext.getCmp('checkboxall').setValue('true');
                }
            }
        });
    },
    tabChangeAdmin:function(tab,newCard,oldCard,obj){
        var idelement = newCard.id;
        switch (idelement) {
            case 'tabusers' :
                /*Cargar Grid User*/
                helpState = 'usuario';
                Ext.getCmp('gridUsers').getStore().load();
                break;
            case 'tabprinters' :
                /*Cargar Grid printers*/
                helpState = 'impresoras';
                Ext.getCmp('gridGroupPrinters').getStore().load();
                break;
            case 'tabmonitoreo' :
                /*recargar marco*/
                helpState = 'monitoreo';
                tab.items.items[2].update('<iframe id="iframeCups" src="' + original_dircups + '/jobs" width="100%" height="100%"></iframe>');
                break;
            default :
                helpState = 'configuracion';
        }
    },
    resnderFielsdSet:function(cmp,obj){
        Ext.getCmp('gridGrupoUsers').doLayout();


    },
    changePassword:function(btn){
        /* Peticion formulario submit */
        var form = btn.up('form').getForm();
        form.submit({
            url: 'admin/changes_password',
            waitTitle: 'Enviando datos',
            waitMsg: 'Espere por favor',
            success: function (form, action) {
                var obj = Ext.decode(action.response.responseText);
                Msg.util.msg(1, 'Información', 'La contraseña a sido cambiada satisfactoriamente.');
                btn.up('window').close();
            },
            failure: function (form, action) {
                var obj = Ext.decode(action.response.responseText);
                Msg.util.msg(3, 'Error', 'Ocurrio un error, puede sers que el proveedor de seguridad no tenga permiso de escritura.');
            }

        });

    },
    saveConfigS:function(btn){
        /* Peticion formulario submit */
        var form = btn.up('form').getForm();
        form.submit({
            url: 'admin/saveConfigS',
            waitTitle: 'Enviando datos',
            waitMsg: 'Espere por favor',
            success: function (form, action) {
                var obj = Ext.decode(action.response.responseText);
                Msg.util.msg(1, 'Información', 'El (Los) cambio(s) se han guardado satisfactoriamente.');
                //btn.up('window').close();
            },
            failure: function (form, action) {
                var obj = Ext.decode(action.response.responseText);
                Msg.util.msg(3, 'Error', 'Ocurrio un error, puede sers que el proveedor de seguridad no tenga permiso de escritura.');
            }

        });

    },
    loadConfigS:function(cmp,obj){
        Ext.Ajax.request({
            url: 'admin/loadConfigS',
            method: 'POST',
            callback: function(options, success, response) {
                var obj = Ext.decode(response.responseText);
                Ext.getCmp('idenominacion').setValue(obj.data['iddenominacion']);
                Ext.getCmp('idNoInventario').setValue(obj.data['idNoInventario']);
                Ext.getCmp('idlocal').setValue(obj.data['idlocal']);
                Ext.getCmp('idoperario').setValue(obj.data['idoperario']);
            }
        });

    }

});
