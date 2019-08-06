/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.general.Main', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreo.general.main',
    requires: ['MSI.view.monitoreo.general.List'],

    frame: false,
    layout: 'border',
    items: [
        {
            region: 'north',
            collapsible: true,
            title: idiom.monitor.general.filter.title,
            layout: 'column',
            id: 'monitoreo-general-main-filter',
            frame: false,
            defaults: {
                margin: '3 0 1 3'
            },
            items: [
                {
                    columnWidth: 0.23,
                    fieldLabel: idiom.monitor.general.filter.user,
                    id: 'monitoreo-general-main-filter-tf-user',
                    xtype: 'textfield',
                    labelPad: 5,                    
                    labelAlign: "right",
                    vtype: 'user',
					maxLength: 31,
					maxLengthText: idiom.monitor.general.validate.maxLengthText
                },
                {
                    columnWidth: 0.22,
                    fieldLabel: idiom.monitor.general.filter.action,
                    xtype: 'combo',
                    id: 'monitoreo-general-main-filter-combo-accion',
                    width: 50,
                    mode: 'local',
                    labelPad: 5,                    
                    labelAlign: "right",
                    triggerAction: 'all',
                    forceSelection: true,
                    editable: false,
                    name: 'title',
                    displayField: 'name',
                    valueField: 'value',
                    queryMode: 'local',
                    emptyText: 'Seleccione ... ',
                    store: Ext.create('MSI.model.monitoreo.general.Accion')
                },
                {
                    columnWidth: 0.22,
                    fieldLabel: idiom.monitor.general.filter.printer,
                    xtype: 'combo',
                    width: 50,
                    mode: 'local',
                    labelPad: 5,                    
                    labelAlign: "right",
                    id: 'monitoreo-general-main-filter-combo-impresora',
                    triggerAction: 'all',
                    forceSelection: true,
                    editable: false,
                    name: 'title',
                    displayField: 'printername',
                    valueField: 'id',
                    queryMode: 'local',
                    emptyText: 'Seleccione ... ',
                    store: Ext.create('MSI.model.monitoreo.general.Impresora')
                },
                {
                    columnWidth: 0.23,
                    fieldLabel: idiom.monitor.general.filter.ip,
                    id: 'monitoreo-general-main-filter-tf-ip',
                    xtype: 'textfield',
                    labelPad: 5,                    
                    labelAlign: "right",
                    vtype: 'IPAddress',
					maxLength: 15,
					maxLengthText: idiom.monitor.general.validate.maxLengthText2,
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
                            id: 'monitoreo-general-main-btn-search',
                            tooltip: idiom.monitor.general.btn.search

                        },
                        {
                            iconCls: 'icon-eraser',
                            xtype: 'button',
                            id: 'monitoreo-general-main-btn-eraser',
                            tooltip: idiom.monitor.general.btn.eraser
                        }
                    ]
                }
            ]
        },
        {
            region: 'center',
            xtype: 'monitoreo.general.list'
        },
        {
            region: 'south',
            collapsible: true,
            collapsed: true,
            title: idiom.monitor.general.details,
            layout: 'fit',
            frame: false,
            height: 150,
            items: {
                margin: '5 1 1 10',
                layout: {
                    type: 'table',
                    columns: 2
                },
                defaults: {frame: false, margin: '0 10 0 15', minWidth:800 },
                items: [
                    {
                        xtype: 'label',
                        html: idiom.monitor.general.names
                    },
                    {
                        xtype: 'label',
                        html: idiom.monitor.general.groups
                    },
                    {
                        xtype: 'label',
                        id: 'monitoreo-general-detail-user',
                        html: ''
                    },
                    {
                        xtype: 'label',
                        id: 'monitoreo-general-detail-usergroup',
                        html: ''
                    },
                    {
                        colspan: 2,
                        html: "<br>"
                    },
                    {
                        xtype: 'label',
                        html: idiom.monitor.general.docs
                    },
                    {
                        columnWidth: 0.5,
                        xtype: 'label',
                        html: idiom.monitor.general.printer
                    },
                    {
                        xtype: 'label',
                        id: 'monitoreo-general-detail-title',
                        text: ' '
                    },
                    {
                        columnWidth: 0.5,
                        xtype: 'label',
                        id: 'monitoreo-general-detail-impress',
                        html: ' '
                    }
                ]
            }
        }
    ]
});


