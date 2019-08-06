/**
 * Created by adrian on 3/11/14.
 */
Ext.Loader.setConfig({enabled: true});
Ext.define("Printers.views.PanelCenter", {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelCenter",
    region: 'center',
    layout:'border',
   // margins: '5 0 0 0',
    split: true,

    initComponent: function () {
		
		this.fieldSetFiltro = Ext.widget ('fsHistorial');	
		this.gridPrincipal = Ext.widget ('printerslist');	
		this.PanelSouth = Ext.widget('panelSouth');	
		this.items = [this.fieldSetFiltro,this.gridPrincipal,this.PanelSouth],       
        this.callParent(arguments);
    }
});
