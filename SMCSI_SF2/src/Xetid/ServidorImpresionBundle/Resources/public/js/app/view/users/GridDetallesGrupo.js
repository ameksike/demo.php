Ext.define('Pikota.view.user.GridDetallesGroup', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.GridDetallesGroup',
    region: 'center',
    margin: '0 10 0 10',
    initComponent: function () {

        this.id = 'gridDetalles',
        this.storeUser = Ext.create('Pikota.store.detallesprinters');
        this.store = this.storeUser,
           // this.multiSelect = true,
            //this.plugins = [actionrow];
            this.columns = [
                {text: 'Impresoras', dataIndex: 'printername', flex: 1},
                {text: 'Cuota', dataIndex: 'cuota', flex: 1},
                {text: 'Consumido', dataIndex: 'consumido', flex: 1},
                {
                    xtype: 'actioncolumn',
                    flex: 1,
                    text: 'Resetear',
                    layout:'center',
                    items: [{
                        icon: '../bundles/servidorimpresion/images/icons/reevaluacion.png',
                        tooltip: 'Resetear Cuota',
                        handler: function (grid, rowIndex, colIndex) {
                            var _this = this;
                            var rec = grid.getStore().getAt(rowIndex);
                            Ext.Ajax.request({
                                url: 'admin/reset',
                                method: 'POST',
                                params: {
                                    nameGroup: nodeSelectedUser.raw.text,
                                    namePrinter: rec.get('printername')
                                },
                                callback: function (options, success, response) {
                                    var store = Ext.getCmp('gridDetalles').getStore();
                                    store.load();

                                }
                            });

                        }
                    }]
                }
            ];


       /* this.viewConfig = {
            loadingText: 'Cargando datos',
            plugins: {
                ptype: 'gridviewdragdrop',
                dropGroup: 'secondGridDDGroup',
                dragGroup: 'firstGridDDGroup'
            }
        },*/
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

