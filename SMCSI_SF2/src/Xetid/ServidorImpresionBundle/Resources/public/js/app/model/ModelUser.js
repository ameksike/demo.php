/**
 * Created by adrian on 18/03/15.
 */
Ext.define("Pikota.model.Users", {
    extend : 'Ext.data.Model',
    fields:[{name : 'id'},
            {name : 'username'},
            {name : 'description'},
            {name : 'text'},
            {name: 'title'},
            {name : 'leaf'}]
});
