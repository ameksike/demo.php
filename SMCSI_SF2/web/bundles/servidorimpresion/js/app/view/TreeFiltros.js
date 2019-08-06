/**
 * Created by adrian on 19/11/14.
 */
Ext.define('Printers.view.treeFiltros', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.treeFiltros',
    
    initComponent: function () {

        this.treeStore = Ext.create('Ext.data.TreeStore', {

            /*proxy: {
                type: 'ajax',
                url: 'cargarxmlRepositorio'

            },*/
            root: {
                text: 'Historial',
                id: 'src',
                expanded: true,
                children: [{text:'Hoy',leaf:true,idpadre:'src',id:'hoy'},{text:'Ayer',leaf:true,idpadre:'src',id:'ayer'},
                {text:'Últimos 7 días',leaf:true,idpadre:'src',id:'ultimo_siete_dia'},{text:'Este mes',leaf:true,idpadre:'src',id:'este_mes'},
                {text:'Este año',leaf:true,idpadre:'src',id:'este_anno'}]
            },
            folderSort: true,
            sorters: [{
                property: 'text',
                direction: 'ASC'
            }]
        });

        this.id = 'treeFiltro',
        this.name = 'treeFiltro',
        this.width = "20%",
        this.height = "30%";
        this.store = this.treeStore,
        this.region = 'north';
        this.viewConfig = {
                loadingText: 'Cargando datos'
            },
       
        this.callParent(arguments);
    }
});
