Ext.define('Tab.view.users.fsUsers', {
    extend: 'Ext.form.FieldSet',
    alias: 'widget.fsUsers',
    initComponent: function () {
        this.form = Ext.widget({
            xtype: 'form',
            //frame: true,
            id: 'idusers',
            margin: '2 5 5 5',
            bodyPadding: '5 40 5 40',
            fieldDefaults: {
                labelAlign: 'top',
                msgTarget: 'side'
            },

            items: [{
                xtype: 'container',
                anchor: '100%',
                layout: 'hbox',
                items: [{
                    xtype: 'container',
                    flex: 20,
                    layout: 'anchor',
                    items: [{
                        xtype: 'textfield',
                        fieldLabel: 'Usuario',
                        name: 'user',
                        id: 'tfusersfiltre',
                        anchor: '95%'

                    }]
                },{
                    xtype: 'container',
                    flex: 20,
                    //layout: 'anchor',
                    items: [{ xtype:'smcsi.btn.export.pdf' },{
                        xtype: 'button',
                        iconCls: 'icon-search',
                        //text:'btn1',
                        margin: '20 0 0 2',
                        name: 'btnBususer',
                        id: 'btn_search_user',
                        action: 'busquedaUsers',
                        width: 23,
                        tooltip: 'Filtrar búsquedad <b>(Alt+B)</b>'
                    }, {
                        xtype: 'button',
                        iconCls: 'icon-refresh',
                        margin: '20 0 0 2',
                        name: 'btnClearFiltreGrid',
                        id: 'clear_grid_user',
                        action: 'clearGridUsers',
                        width: 23,
                        tooltip: 'Limpiar búsquedad <b>(Alt+L)</b>'
                    }]
                }]
            }]
        });

            this.title = 'Filtrar búsqueda';
            this.collapsible = true;
            //this.frame=true,
          //  this.flex = 1;
           // this.layout = 'fit',
               // this.border = 0;
            this.region = 'north';
            this.items = [this.form];

            this.callParent(arguments);
    }
});
