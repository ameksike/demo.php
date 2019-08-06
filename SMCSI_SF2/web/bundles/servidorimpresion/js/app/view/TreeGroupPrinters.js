/**
 * Created by adrian on 19/11/14.
 */
Ext.define('Pikota.view.TreeGroupPrinters', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.treeGroupPrinters',
    
    initComponent: function () {

        this.treeStore = Ext.create('Ext.data.TreeStore', {
            model: 'Pikota.model.GroupsPrinters',

            proxy: {
                type: 'ajax',
                url: 'servidor/grupoprinters',
                extraParams: {
                    param: false

                }

            },
            autoLoad: true,
            root: {
                text: 'Grupos de impresoras',
                id: 'rootGPrinters',
                expanded: true

            },
            folderSort: true,
            sorters: [{
                property: 'text',
                direction: 'ASC'
            }]
        });

        this.id = 'treeGroupPrinters',
        this.name = 'treeGroupPrinters',
        //this.width = 298,
        //this.height = 50,
        this.store = this.treeStore,
        //this.region = 'north';
       this.viewConfig = {
                loadingText: 'Cargando datos',
                plugins: {
                ptype: 'treeviewdragdrop',
                //appendOnly: true,
                //dragGroup: 'fourGridDDGroup',
                dropGroup: 'threeGridDDGroup',
                appendOnly: true,
                expandDelay: '5'
                }
       }
        this.callParent(arguments);
    }
});
