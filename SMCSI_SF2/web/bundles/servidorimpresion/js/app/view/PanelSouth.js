/**
 * Created by adrian on 3/11/14.
 */
Ext.define("Printers.views.PanelSouth", {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelSouth",
    
    height:250,
    margin: '0 10 10 10',
    /* minHeight: 100,
    maxHeight: 190,*/


    initComponent:function(){
        this.title =  'Detalles';
        //this.height = 400,
        this.collapsed = true;
        this.collapsible = true;
        this.collapseMode = 'mini';
        this.anchor = '100%';
        this.region = 'south';
        this.id = 'panelDetalles';
        this.name = 'panelDetalles';
        //this.html = "<h3  style= 'padding: 10px 5px 5px 5px;'> No hay ningún elemento seleccionado ...</h3>",
        this.split = true;
        this.layout = {
            type: 'hbox',
                pack: 'start',
                align: 'stretch'
        },
        this.items = [
            {id:'details1',html:"<h3  style= 'padding: 10px 5px 5px 5px;'> No hay ningún elemento seleccionado ...</h3>", flex:1},
            {id:'details2', flex:2}
        ];
              
        this.callParent(arguments);
    }
});
