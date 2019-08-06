/**
 * Created by adrian on 19/11/14.
 */
Ext.define('Printers.view.treeGrupoImpresoras', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.treeGrupoImpresoras',
    
    initComponent: function () {

        this.treeStore = Ext.create('Ext.data.TreeStore', {
            proxy: {
                type: 'ajax',
                url: 'servidor/grupoprinters',
                extraParams: {
                    param: true
                }

            },
            autoLoad: true,
            root: {
                text: 'Grupo de impresoras',
                id: 'grupoprinter',
                expanded: true
            },
            folderSort: true,
            sorters: [{
                property: 'text',
                direction: 'ASC'
            }]
        });

        this.id = 'treeImpres',
        this.name = 'treeImpres',
        this.width = "20%",
        this.height = "35%",
        this.store = this.treeStore,
        this.region = 'south',
        this.viewConfig = {
                loadingText: 'Cargando datos'
        },
       
        this.callParent(arguments);
    }
});
