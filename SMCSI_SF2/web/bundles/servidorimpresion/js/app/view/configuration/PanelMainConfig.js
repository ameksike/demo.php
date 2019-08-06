Ext.define('Tab.view.configuration.panelmainconfig', {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelmainconfig",
    initComponent: function () {

      this.grid = Ext.create('Pikota.view.user.GridIpConfig');
       // this.collapsible = true;
       // this.collapseMode = 'mini';
       // this.collapsed = true;
        this.frame = true;
        this.region = 'center';
        this.width = "50%";
        //this.layout = 'fit';
        //this.margins = '5 0 0 0';
        //this.width = "50%";
        this.id = 'panelmainconfig';
        //this.layout = 'fit',
        this.split = true;
        // this.html = "jahsdlgfkhjasd";
        this.tbar=[
            {
                text   : 'Adicionar',
                iconCls: 'icon-plus',
                id     : 'add_ip',
                action : 'addip',
                tooltip: 'Adicionar usuario <b>(Alt+S)</b>'
            }, {
                text    : 'Eliminar',
                id      : 'delete_ip',
                iconCls : 'icon-remove',
                action  : 'delip',
                disabled: true,
                tooltip : 'Eliminar usuario <b>(Alt+E)</b>'
            }, {
                text: 'Guardar',
                iconCls: 'icon-save',
                id: 'save_ip',
                action: 'savechangesIp',
                tooltip: 'Guardar Ip <b>(Alt+H)</b>'
            },{
                xtype: "checkbox",
                boxLabel: 'Permitir todas',
                id: "checkboxall"
            }
        ];
        this.obj = new Ext.panel.Panel(
            {
                xtype: "panel",
                layout: 'column',
                id:'id_panel_search',
                margin: '10 0 10 10',
                items: [
                    {
                        xtype: 'textfield',
                        // fieldLabel: 'Usuario',
                        name: 'ip',
                        id: 'tfipfiltre',
                        anchor: '95%',
                        vtype:"IPAddress"
                    }, {
                        xtype: 'button',
                        text:'Buscar',
                        iconCls: 'icon-search',
                        baseCls: 'x-btn',
                        margin: '0 0 0 2',
                        name: 'btnBusip',
                        id: 'btn_search_ip',
                        action: 'busquedaIp',
                        //width: 23,
                        tooltip: 'Filtrar búsquedad <b>(Alt+B)</b>'
                    }, {
                        xtype: 'button',
                        iconCls: 'icon-refresh',
                        text:'Limpiar',
                        margin: '0 0 0 2',
                        name: 'btnClearFiltreGridIp',
                        id: 'clear_grid_ip',
                        action: 'clearGridIp',
                        //width: 23,
                        tooltip: 'Limpiar búsquedad <b>(Alt+L)</b>'
                    }
                ]
            });
        this.items = [this.obj,this.grid];
        this.callParent(arguments);
    }
});

