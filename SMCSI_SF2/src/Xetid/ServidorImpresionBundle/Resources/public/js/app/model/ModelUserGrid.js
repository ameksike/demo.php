/**
 * Created by jmzaldivar on 19/03/15.
 */
Ext.define("Pikota.model.UsersGrid", {
    extend : 'Ext.data.Model',
    fields  : [
        {name : 'id'},
        {name : 'username'},
        {name : 'description'},
        {name: 'groupname'},
        {name: 'isgroup'},
        {name: 'overcharge'},
        {name: 'lifetimepaid'},
        {name : 'text'},
        {name : 'leaf'}
    ]
});
