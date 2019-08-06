Ext.define('Tab.view.user.panelmainusers', {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelmainusers",


    initComponent: function () {

        this.treeGrupoUsers = Ext.create('Pikota.view.TreeAdmin');

        this.layout = 'fit',
        this.width = "20%",
        this.region = 'west',
        this.id = 'panelmainusers',
        this.name = 'panelmainusers',
        this.collapsible = true,
        this.collapseMode = 'mini',
        this.title = 'Grupo de Usuario',
        this.split = true,
        this.margins = '5 0 0 0',
       // this.layout = 'border',
        this.tbar = [
            {
                text: 'Adicionar',
                iconCls: 'icon-plus',
                action: 'addGrups',
                id: 'btnaddGrups',
                disabled: true,
                tooltip: 'Adicionar grupo <b>(Alt+G)</b>'

            }, {
                text: 'Modificar',
                iconCls: 'icon-screenshot',
                action: 'modcuota',
                id: 'btnmodGrupsUser',
                disabled: true,
                tooltip: 'Modificar grupo <b>(Alt+M)</b>'

            }, {
                text: 'Eliminar',
                iconCls: 'icon-remove',
                action: 'delGrups',
                id: 'btnadelGrups',
                disabled: true,
                tooltip: 'Eliminar grupo <b>(Alt+R)</b>'
            }
        ],
        this.items = [this.treeGrupoUsers],
        this.callParent(arguments);
    }
});
