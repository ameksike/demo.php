/**
 * Created by adrian on 3/11/14.
 */
Ext.define("Pikota.views.PanelPikWest", {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelPikWest",


    initComponent:function(){

        this.treeAdmin = Ext.widget('treeAdmin');
        this.treeGroupPrinters = Ext.widget('treeGroupPrinters');

            this.region = 'west',
            this.width = 350,
            this.layout = 'accordion',
            this.frame = true,

            this.items = [{
                title: 'Grupos de Usuarios',
                layout:'fit',
                id:'panelTreeAdmin',
                items: [this.treeAdmin]
                },{
                title: 'Grupos de Impresoras',
                id:'panelTreePrinters',
                layout:'fit',
                items: [this.treeGroupPrinters]
                }],
            this.tbar = [
            {
                text: 'Adicionar',
                iconCls:'icon-file-text-alt',
                action: 'addGrups',
                id:'btnaddGrups',
                disabled:true,
                tooltip:'Adicionar grupo <b>(Alt+G)</b>'

            },{
                text: 'Eliminar',
                iconCls:'icon-remove-circle',
                action: 'delGrups',
                id:'btnadelGrups',
                disabled:true,
                tooltip:'Eliminar grupo <b>(Alt+R)</b>'
            }
            ]
        

        this.callParent(arguments);
    }
});
