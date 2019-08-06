/**
 * Created by adrian on 19/11/14.
 */
Ext.define('Pikota.view.TreeAdmin', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.treeAdmin',
    
    initComponent: function () {

        this.treeStore = Ext.create('Ext.data.TreeStore', {
            model: 'Pikota.model.Users',

            proxy: {
                type: 'ajax',
                url: 'servidor/grupouser',
                extraParams: {
                    param: false

                }

            },
            autoLoad: true,
            root: {
                text: 'Grupos de usuario',
                id: 'rootGusers',
                expanded: true

            },
            folderSort: true,
            sorters: [{
                property: 'text',
                direction: 'ASC'
            }]
        });

        this.id = 'treeAdmin',
        this.name = 'treeAdmin',
        //this.width = 298,
        //this.height = 280,
        this.store = this.treeStore,
        //this.region = 'north';
        this.viewConfig = {
                loadingText: 'Cargando datos',
                plugins: {
                ptype: 'treeviewdragdrop',
                //appendOnly: true,
                //dragGroup: 'secondGridDDGroup',
                dropGroup: 'firstGridDDGroup',
                allowParentInserts: true,
                appendOnly : true,
                expandDelay : '5'
                }
        }
        this.callParent(arguments);
    }
});
