/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.auditoria.Main', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreo.auditoria.main',
    requires: [
        'MSI.view.monitoreo.auditoria.Reporte',
        'MSI.view.monitoreo.auditoria.List'
    ],
    frame: false,
    layout: 'border',
    items: [
        {
            region: 'north',
            collapsible: true,
            title: idiom.monitor.audit.filter.title,
            layout: 'column',
            frame: false,
            id: 'monitoreo-auditoria-main-filter',
            defaults: {
                margin: '3 0 1 3'
            },
            items: [
                {
                    columnWidth: 0.30,
                    fieldLabel: idiom.monitor.audit.filter.datein,
                    id: 'monitoreo-auditoria-main-filter-desde',
                    xtype: 'datefield',
                    labelPad: 5,                    
                    labelAlign: "right",
                    format: 'd/m/Y',
                    editable: false,
                    value: Ext.Date.add(new Date(), Ext.Date.YEAR, -5),
                    vtype: 'date'
                },
                {
                    columnWidth: 0.30,
                    fieldLabel: idiom.monitor.audit.filter.dateout,
                    xtype: 'datefield',
                    labelPad: 5,                    
                    labelAlign: "right",
                    format: 'd/m/Y',
                    id: 'monitoreo-auditoria-main-filter-hasta',
                    editable: false,
                    value: Ext.Date.add(new Date(), Ext.Date.YEAR, 1),
                    vtype: 'date'
                },
                {
                    columnWidth: 0.30,
                    fieldLabel: idiom.monitor.audit.filter.char,
                    xtype: 'combo',
                    labelPad: 5,                    
                    labelAlign: "right",
                    width: 50,
                    id: 'monitoreo-auditoria-combo-charType',
                    mode: 'local',
                    triggerAction: 'all',
                    forceSelection: true,
                    editable: false,
                    name: 'title',
                    displayField: 'name',
                    valueField: 'value',
                    queryMode: 'local',
                    value: 'pie',
                    store: Ext.create('Ext.data.Store', {
                        fields: ['name', 'value'],
                        data: [
                            {name: idiom.monitor.audit.char.pie.name , value: 'pie'},
                            {name: idiom.monitor.audit.char.bar.name, value: 'bar'},
                            {name: idiom.monitor.audit.char.line.name, value: 'line'}
                        ]
                    })
                },
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
                            id: 'monitoreo-auditoria-main-btn-search',
                            tooltip: idiom.monitor.audit.btn.search
                        },
                        {
                            iconCls: 'icon-eraser',
                            xtype: 'button',
                            id: 'monitoreo-auditoria-main-btn-eraser',
                            tooltip: idiom.monitor.audit.btn.eraser
                        }
                    ]
                }
            ]
        },
        {
            region: 'center',
            title: idiom.monitor.audit.center,
            xtype: 'monitoreo.auditoria.reporte'
        },{
            region: 'south',
            split: true,
            maxHeight: 350,
            collapsible: true,
            collapsed: true,
            xtype: 'monitoreo.auditoria.list'
        }
    ]
});
