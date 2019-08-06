/**
 * Created by adrian on 19/11/14.
 */
Ext.define('Printers.view.treeGrupoUsers', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.treeGrupoUsers',
    
    initComponent: function () {

        this.treeStore = Ext.create('Ext.data.TreeStore', {

            proxy: {
                type: 'ajax',
                url: 'servidor/grupouser',
                extraParams: {
                    param: true
                }

            },
            autoLoad: true,
            root: {
                text: 'Grupo de usuarios',
                id: 'grupopuser',
                expanded: true
            },
            folderSort: true,
            sorters: [{
                property: 'text',
                direction: 'ASC'
            }]
        });

        this.id = 'treeUsers';
        this.name = 'treeUsers';
        this.width = "20%";
        this.height = "35%";
        this.store = this.treeStore;
        this.region = 'center';
        this.viewConfig = {
                loadingText: 'Cargando datos'
            };

        this.callParent(arguments);
    }
});
