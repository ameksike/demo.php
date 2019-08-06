Ext.define('Tab.view.user.paneldetallesrusers', {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.paneldetallesrusers",
    initComponent: function () {
        this.grid = Ext.create('Pikota.view.user.GridDetallesGroup');
        this.collapsible = true;
        this.collapseMode = 'mini';
        this.collapsed = true;
        this.title = "Detalles";
        this.region = 'east';
        this.layout = 'fit';
        this.margins = '5 0 0 0';
        this.width = "20%";
        this.id = 'idpaneldetalles';
        //this.layout = 'fit',
        this.split = true;
       // this.html = "jahsdlgfkhjasd";
        this.items = [this.grid];
        this.callParent(arguments);
    }
});

