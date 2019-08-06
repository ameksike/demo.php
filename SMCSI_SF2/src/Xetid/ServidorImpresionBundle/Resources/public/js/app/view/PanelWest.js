/**
 * Created by adrian on 3/11/14.
 */
Ext.define("Printers.views.PanelWest", {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelWest",


    initComponent:function(){

        this.treeFiltro = Ext.widget('treeFiltros');
        this.treeUser = Ext.widget('treeGrupoUsers');
        this.treePrinters = Ext.widget('treeGrupoImpresoras');
        
        this.layout = 'fit',
        this.width = 300,
        this.region = 'west',
        this.id = 'panelWest',
        this.name = 'panelWest',
        this.collapsible = true,
        this.collapseMode = 'mini',
		this.title = 'Filtros',
        this.split = true,
        this.margins = '5 0 10 0',
        this.layout = 'border',
        this.items = [this.treeFiltro,this.treeUser,this.treePrinters],
        

        this.callParent(arguments);
    }
});
