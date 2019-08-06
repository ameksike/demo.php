Ext.application({
    name: 'Pikota',

    appFolder: 'app',
    controllers : [
        'Pikota'
    ],
    launch: function() {

       this.gridGroupUsers = Ext.widget('gridGroupUsers');
       this.gridGroupPrinters = Ext.widget('gridGroupPrinters');
       this.panelPikWest = Ext.widget('panelPikWest');

        Ext.create('Ext.container.Viewport', {
            layout: 'fit',
            items: [
                {
                    xtype: 'panel',
                    layout:'border',
                    frame:true,
                    items: [{
                        xtype: 'panel',
                        region:'center',
                        layout: {
                            type: 'accordion',
                            align : 'stretch',
                            pack  : 'start'
                        },

                        items:[
                        {title: 'Gestionar usuarios',id:'panelGestUsers',flex:1,layout:'fit',items:[this.gridGroupUsers]},
                        {title: 'Impresoras', id:'panelGestPrinters', flex:1,layout:'fit', items:[this.gridGroupPrinters]}
                        ]},
                        this.panelPikWest

                    ]
                }
            ]
        });

    }
});
