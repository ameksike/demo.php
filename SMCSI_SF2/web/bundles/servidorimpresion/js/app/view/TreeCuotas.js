/**
 * Created by adrian on 26/03/15.
 */

Ext.define('Pikota.view.TreeCuotas', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.treeCuotas',

    initComponent: function () {

        this.store = Ext.create('Ext.data.TreeStore', {
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

        this.id = 'treeCuotas',
        this.name = 'treeCuotas',
        //this.width = 298,
            //this.height = 50,
            this.store = this.store,
            //this.region = 'north';
            this.viewConfig = {
                loadingText: 'Cargando datos'
            }
        this.callParent(arguments);
    }
});
