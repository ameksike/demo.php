Ext.define('Printers.store.users', {
    require : [
        'Ext.data.Store'
    ],
    extend  : 'Ext.data.Store',
    model: 'Pikota.model.UsersGrid',

    proxy: {
        type: 'ajax',
        url: 'admin/usuarios',
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
