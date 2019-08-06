/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 * @require     MSI.model.monitoreo.general.Impresora
 */
Ext.define('MSI.view.monitoreo.impresora.Main', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreo.impresora.main',
    requires: ['MSI.view.monitoreo.impresora.List'],

    frame: false,
    layout: 'border',
    items: [
        {
            region: 'north',
            collapsible: true,
            title: idiom.monitor.printer.filter.title,
            layout: 'column',
            id: 'monitoreo-impresora-main-filter',
            frame: false,
            defaults: {
                margin: '3 0 1 3'
            },
            items: [
                {
                    columnWidth: 0.3,
                    fieldLabel: idiom.monitor.printer.filter.printer,
                    xtype: 'combo',
                    width: 50,
                    labelPad: 5,                    
                    labelAlign: "right",
                    mode: 'local',
                    triggerAction: 'all',
                    forceSelection: true,
                    id: 'monitoreo-impresora-main-combo-impresora',
                    editable: false,
                    name: 'title',
                    displayField: 'printername',
                    valueField: 'id',
                    queryMode: 'local',
                    emptyText: 'Seleccione ... ',
                    store: Ext.create('MSI.model.monitoreo.general.Impresora')
                },
                {columnWidth: 0.3},
                {columnWidth: 0.3},
                {
                    columnWidth: 0.1,
                    layout: {
                        type: 'hbox',
                        pack: 'end',
                        align: 'middle'
                    },
                    defaults: { margins: '0 1 0 0' },
                    items: [
                        {
                            iconCls: 'icon-search',
                            xtype: 'button',
                            id: 'monitoreo-impresora-main-btn-search',
                            tooltip: idiom.monitor.printer.btn.search
                        },
                        {
                            iconCls: 'icon-eraser',
                            xtype: 'button',
                            id: 'monitoreo-impresora-main-btn-eraser',
                            tooltip: idiom.monitor.printer.btn.eraser
                        }
                    ]
                }
            ]
        },
        {
            region: 'center',
            xtype: 'monitoreo.impresora.list'
        }
    ]
});


