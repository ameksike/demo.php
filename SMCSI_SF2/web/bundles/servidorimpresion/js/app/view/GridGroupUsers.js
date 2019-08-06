Ext.define('Pikota.view.user.GridGroupUsers', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.gridGroupUsers',
    region: 'center',
    initComponent: function () {
        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 2
        });
        this.id = 'gridUsers',
            this.storeUser = Ext.create('Printers.store.users');
        this.store = this.storeUser,
            this.multiSelect = true,
            this.plugins = [cellEditing],

            this.columns = [
                {
                    text: 'Usuario', dataIndex: 'username', width: "20%", editor: {
                    allowBlank: false
                }
                },
                {
                    text: 'Nombre y apellidos', dataIndex: 'description', flex: 1, editor: {
                    allowBlank: false
                }
                },
                {text: 'Grupo', dataIndex: 'groupname', width: "20%"},
                {
                    text: 'Costo agregado', dataIndex: 'overcharge', width: "10%", editor: {
                    xtype: 'numberfield',
                    allowBlank: false,
                    minValue: 0,
                    maxValue: 1
                }
                },
                {text: 'Gasto Total ($)', dataIndex: 'lifetimepaid', width: "10%"}
            ];

        this.tbar = [{
            text: 'Guardar cambios',
            iconCls: 'icon-save',
            id: 'save_users',
            action: 'savechanges',
            tooltip: 'Guardar cambios <b>(Alt+H)</b>'
        }],
            this.viewConfig = {
                loadingText: 'Cargando datos',
                plugins: {
                    ptype: 'gridviewdragdrop',
                    //dropGroup: 'secondGridDDGroup',
                    dragGroup: 'firstGridDDGroup'
                }
            },
            this.bbar = Ext.create('Ext.PagingToolbar', {
                store: this.storeUser,
                displayInfo: true,
                emptyMsg: '0 Resultado a mostrar',
                displayMsg: 'Mostrando de {0} - {1} de {2}',
                beforePageText: 'Página',
                afterPageText: 'de {0}',
                firstText: 'Primera Página',
                prevText: 'Página anterior',
                nextText: 'Página siguiente',
                lastText: 'Última Página',
                refreshText: 'Actualizar'

            })

        this.callParent(arguments);
    }
});
