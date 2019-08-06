Ext.define('Tab.view.TabAdministracion', {

    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: 'widget.TabAdministracion',
    title: 'Administración', //93b12cff555dc4aa37d24647281d579e
    id: 'tabAdministrador',
    layout : 'fit',
    initComponent: function () {
        this.treePanelCenterPrinter = Ext.create('Tab.view.printers.panelmainprinters');
        this.PanelCenterPrinter = Ext.create('Tab.view.printers.panelcenterprinters');
        this.treePanelCenterUsers = Ext.create('Tab.view.user.panelmainusers');
        this.PanelCenterUsers = Ext.create('Tab.view.user.panelcenterusers');
        this.PanelDetallesUsers = Ext.create('Tab.view.user.paneldetallesrusers');
        this.panleConfig = Ext.create('Printer.view.configuration.panelmain');
        this.items = [
            {
                xtype: 'tabpanel',
                id: 'idtabadmin',
                frame: true,
                items: [{
                    title: 'Impresoras',
                    layout: 'border',
                        id: 'tabprinters',
                    items:[
                        this.PanelCenterPrinter,
                        this.treePanelCenterPrinter

                    ]
                }, {
                    title: 'Usuarios',
                    layout: 'border',
                    id: 'tabusers',
                    items: [
                        this.PanelCenterUsers,
                        this.treePanelCenterUsers,
                        this.PanelDetallesUsers

                    ]
                }, {
                    title: 'Monitoreo',
                    html: '<iframe id="iframeCups" src="'+original_dircups+'/jobs" width="100%" height="100%"></iframe>',
                    id: 'tabmonitoreo'
                }, {
                    title: 'Configuración',
                    layout: 'border',
                    id: 'tabconfig',
                    items:[
                        this.panleConfig
                    ]
                }]
            }
        ]
        this.callParent(arguments);
    }
});
