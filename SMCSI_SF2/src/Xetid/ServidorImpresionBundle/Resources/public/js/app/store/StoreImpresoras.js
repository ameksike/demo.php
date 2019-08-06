Ext.define('Printers.store.impresoras', {
    require : [
        'Ext.data.Store'
    ],
    extend  : 'Ext.data.Store',
    model: 'Printers.model.impresoras',

    proxy: {
         type: 'ajax',
         url: 'servidor/printers'
       
     },
    autoLoad: true

    //store.load();
});
