Ext.define('Tab.view.printers.panelcenterprinters', {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelcenterprinters",
    initComponent: function () {
        this.fieldSetPrinters = Ext.create('Tab.view.printers.fsImpresoras');
        this.gridGrupoPrinter = Ext.create('Pikota.view.user.GridGroupPrinters');
        this.collapsible = false;
        this.region = 'center';
        this.margin = '0 10 0 10';
        this.layout = 'border',
        this.split=true;
        this.tbar = [
            {
                text: 'Adicionar',
                iconCls: 'icon-plus',
                action: 'btnaddprinters',
                id: 'btnaddprinters',
               // disabled: true,
                tooltip: 'Adicionar Impresoras<b>(Alt+I)</b>'

            }, {
                text: 'Modificar',
                iconCls: 'icon-remove',
                action: 'modPrinter',
                id: 'btnmodPrinters',
                disabled: true,
                tooltip: 'Eliminar grupo <b>(Alt+R)</b>'
            }
        ];
        this.items = [

                    this.fieldSetPrinters,
                    this.gridGrupoPrinter

        ];
        this.callParent(arguments);
    }
});
