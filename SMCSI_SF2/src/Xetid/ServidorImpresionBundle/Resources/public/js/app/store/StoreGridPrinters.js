Ext.define('Printers.store.gridprinter', {
    require : [
        'Ext.data.Store'
    ],
    extend  : 'Ext.data.Store',
    model: 'Printers.model.gridImpresoras',

    proxy   : {
        type   : 'ajax',
        url : 'servidor/jobhistory',
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
