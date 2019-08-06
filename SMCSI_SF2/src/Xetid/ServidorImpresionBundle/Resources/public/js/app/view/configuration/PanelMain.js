/**
 * Created by adonis on 7/07/15.
 */
Ext.define('Printer.view.configuration.panelmain', {
    require: [
        "Ext.panel.Panel"
    ],
    extend: "Ext.panel.Panel",
    alias: "widget.panelmain",
    initComponent: function () {
        this.fieldSetServer = Ext.create('Tab.view.configuration.Server');
        this.panelConfig = Ext.create('Tab.view.configuration.panelmainconfig');

        this.frame = true;
        this.region = 'center';
        this.layout = 'border',
        //this.margins = '5 0 0 0';
        //this.width = "50%";
        this.id = 'panelmain';
        this.split = true;

        this.items = [this.fieldSetServer,this.panelConfig];
        this.callParent(arguments);
    }
});

