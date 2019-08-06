Ext.define('Pikota.view.user.GridIpConfig', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.GridIpConfig',
    region: 'center',
    margin: '0 10 0 10',
    initComponent: function () {
        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 2
        });

        this.id = 'GridIpConfig';
        this.storeIP = Ext.create('Pikota.store.StoreConfigIp');
        this.store = this.storeIP;
        this.multiSelect = true;
        this.plugins = [cellEditing],
        //this.plugins = [actionrow];
        this.columns = [
                {
                    text: 'Dirección Ip', dataIndex: 'ip', width : "100%",
                    editor: {
                        xtype: 'textfield',
                        allowBlank: false,
                        vtype:"IPAddress"
                    }
                }
        ];
        this.width = '25%';
        this.height = 400;
       /* this.tbar = [
            {
                text: 'Guardar',
                iconCls: 'icon-save',
                id: 'save_ip',
                action: 'savechangesIp',
                tooltip: 'Guardar Ip <b>(Alt+H)</b>'
            }
        ];*/
        this.bbar = Ext.create('Ext.PagingToolbar', {
            store: this.storeIP,
            displayInfo: true,
            id:'pagintollIp',
            emptyMsg: '0 Resultado a mostrar',
            displayMsg: 'Mostrando de {0} - {1} de {2}',
            beforePageText: 'Página',
            afterPageText: 'de {0}',
            firstText: 'Primera Página',
            prevText: 'Página anterior',
            nextText: 'Página siguiente',
            lastText: 'Última Página',
            refreshText: 'Actualizar'
        });

        this.callParent(arguments);
    }
});


