Ext.define('Pikota.store.StoreConfigIp', {
    require: [
        'Ext.data.Store'
    ],
    extend: 'Ext.data.Store',
    model: 'Pikota.model.ModelConfigIp',
    alias: "widget.ConfigIp",
    proxy: {
        type: 'ajax',
        url:'admin/getip',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'data_count'
        }
    },
    pageSize: 10,

    autoLoad: true

    //store.load();
});
