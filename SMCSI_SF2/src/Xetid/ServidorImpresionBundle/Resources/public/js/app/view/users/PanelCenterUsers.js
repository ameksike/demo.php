Ext.define('Tab.view.user.panelcenterusers', {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelcenterusers",
    initComponent: function () {
        this.fieldSetUsers = Ext.create('Tab.view.users.fsUsers');
        this.gridGrupoUsers = Ext.create('Pikota.view.user.GridGroupUsers');
        this.collapsible = false;
        this.region = 'center';
        this.margin = '0 10 0 10';
        this.layout  = 'border';
        //this.layout = 'fit',
        this.split=true;
        this.tbar = [{
            text: 'Adicionar',
            iconCls: 'icon-plus',
            action: 'adduser',
            tooltip: 'Adicionar usuario <b>(Alt+S)</b>'
        }, {
            text: 'Eliminar',
            id: 'btndellUser',
            iconCls: 'icon-remove',
            action: 'deluser',
            disabled:true,
            tooltip: 'Eliminar usuario <b>(Alt+E)</b>'
        }],
        this.items = [

                    this.fieldSetUsers,
                    this.gridGrupoUsers

        ];
        this.callParent(arguments);
    }
});
