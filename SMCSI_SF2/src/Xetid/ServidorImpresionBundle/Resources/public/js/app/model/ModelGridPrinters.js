Ext.define("Printers.model.gridImpresoras", {
    extend : 'Ext.data.Model',
    fields  : [
        {name : 'user'},
        {name: 'name'},
        {name : 'action'},
        {name : 'impresora'},
        {name : 'pag'},
        {name : 'costo'},
        {name : 'dirip'},
        {name : 'fecha'},
        {name: 'priceperpage'},
        {name: 'priceperjob'},
        {name: 'groupname'},
        {name: 'groupprinter'},
        {name: 'cuota'}
    ]
});
