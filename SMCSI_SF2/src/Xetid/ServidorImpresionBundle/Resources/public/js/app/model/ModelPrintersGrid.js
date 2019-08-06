/**
 * Created by jmzaldivar on 19/03/15.
 */
Ext.define("Pikota.model.PrintersGrid", {
    extend : 'Ext.data.Model',
    fields  : [
        {name : 'text'},
        {name : 'leaf'},
        {name : 'id'},
        {name : 'printername'},
        {name : 'description'},
        {name : 'priceperpage'},
        {name : 'priceperjob'},
        {name : 'maxjobsize'},
        {name : 'groupname'},
        {name : 'isgroup'}
    ]
});
