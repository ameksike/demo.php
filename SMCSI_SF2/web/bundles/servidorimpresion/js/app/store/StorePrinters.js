Ext.define('Pikota.store.printers', {
    require : [
        'Ext.data.Store'
    ],
    extend  : 'Ext.data.Store',
    model: 'Pikota.model.PrintersGrid',

    proxy: {
        type: 'ajax',
        url: 'admin/impresoras',
        reader : {
            type          : 'json',
            root          : 'data',
            totalProperty : 'data_count'
        }

    },
    pageSize: 10,
    autoLoad: true

    //store.load();
});
