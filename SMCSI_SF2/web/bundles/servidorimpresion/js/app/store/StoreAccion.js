Ext.define('Printers.store.accion', {
    require : [
        'Ext.data.Store'
    ],
    extend  : 'Ext.data.Store',
    model: 'Printers.model.accion',

    data : [
        {id: 'ALLOW',name: 'Permitido'},
        {id: 'DENY',name: 'Denegado'},
        {id: 'WARN',name: 'Advertencia'},
        {id: 'CANCEL', name: 'Cancelado'}
    ],
    autoLoad: true

    //store.load();
});
