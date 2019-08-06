Ext.define('Tab.view.printers.panelmainprinters', {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelmainprinters",


    initComponent: function () {

        this.treeGrupoPrinter = Ext.create('Pikota.view.TreeGroupPrinters');

        this.layout = 'fit';
        this.width = "20%";
        this.region = 'west';
        this.id = 'panelWestPrinter';
        this.name = 'panelWestPrinter';
        this.collapsible = true;
        this.collapseMode = 'mini';
        this.title = 'Grupo de Impresoras';
        this.split = true;
        this.margins = '5 0 0 0';
       // this.layout = 'border',
        this.tbar = [
            {
                text: 'Adicionar',
                iconCls: 'icon-plus',
                action: 'addGrups',
                id: 'btnaddGrupsPrinter',
                disabled: true,
                tooltip: 'Adicionar grupo <b>(Alt+G)</b>'

            }, {
                text: 'Modificar',
                iconCls: 'icon-screenshot',
                action: 'addGrups',
                id: 'btnmodGrupsPrinter',
                disabled: true,
                tooltip: 'Modificar grupo <b>(Alt+M)</b>'

            }, {
                text: 'Eliminar',
                iconCls: 'icon-remove',
                action: 'delGrups',
                id: 'btnadelGrupsPrinters',
                disabled: true,
                tooltip: 'Eliminar grupo <b>(Alt+R)</b>'
            }
        ],
        this.items = [this.treeGrupoPrinter],
        this.callParent(arguments);
    }
});
