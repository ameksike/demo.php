Ext.define('Pikota.store.detallesprinters', {
    require : [
        'Ext.data.Store'
    ],
    extend  : 'Ext.data.Store',
    model: 'Pikota.model.DetallesPrintersGrid',
    alias: "widget.detallesprinters",
    proxy: {
        type: 'ajax',
        url: 'admin/datosgroups',
        reader : {
            type          : 'json',
            root          : 'data',
            totalProperty : 'data_count'
        },
        extraParams: {
            idgrupo : 0
        }
    },
    pageSize: 10,

    autoLoad: true

    //store.load();
});
