Ext.define('Printers.view.Principal', {

    extend: 'Ext.container.Viewport',
    alias: 'widget.principal',
    initComponent: function () {

        this.PanelCenter = Ext.widget('panelCenter');
        this.PanelWest = Ext.widget('panelWest');

        this.layout = 'fit';
        this.items = [
            {
                xtype: 'tabpanel',
                id: 'tabCups',
                margin: '0 0 0 0',
                frame: true,
                items: [{
                    title: 'Historial de impresiones',
                    layout: 'border',
                    id: 'panelHistory',
                    items: [this.PanelCenter, this.PanelWest]

                }],
                tools: [
                    {
                        type: 'maximize',
                        tooltip: 'Cambiar contraseña',
                        action: 'autenticate',
                        id: 'change_pass',
                        hidden: true

                    },{
                        type: 'refresh',
                        tooltip: 'Logout',
                        action: 'autenticate',
                        id: 'logout',
                        hidden: true

                    },  {
                        type: 'gear',
                        tooltip: 'Login',
                        id: 'login',
                        action: 'autenticate'
                    }, {
                        type: 'help',
                        tooltip: 'Ayuda',
                        handler: function (event, toolEl, panel) {
                            Ext.create('Ext.window.Window',{
                                id : 'winAux',
                                name:'winAux',
                                width: '100%',
                                height:'100%',
                                autoShow : true,
                                html: '<iframe id="iframeCups" src="'+ dirHelp +'/bundles/servidorimpresion/help/index.html" style="width: 100%; height: 100%"></iframe>'
                            });
                        }
                    }]

            }

        ];



            this.callParent(arguments);
    }


});
