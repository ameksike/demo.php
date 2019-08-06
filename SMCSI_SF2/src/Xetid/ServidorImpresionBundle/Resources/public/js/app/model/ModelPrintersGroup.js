/**
 * Created by jmzaldivar on 19/03/15.
 */
Ext.define("Pikota.model.DetallesPrintersGrid", {
    extend : 'Ext.data.Model',
    fields  : [
        {name : 'id'},
        {name : 'printername'},
        {name : 'cuota'},
        {name : 'consumido'},
        {name : 'algo'}
    ]
});
