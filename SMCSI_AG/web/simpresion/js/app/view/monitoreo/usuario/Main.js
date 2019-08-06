/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.usuario.Main', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreo.usuario.main',
    requires: ['MSI.view.monitoreo.usuario.List'],

    frame: false,
    layout: 'border',
    items: [
        {
            region: 'north',
            collapsible: true,
            title: idiom.monitor.user.filter.title,
            id: 'monitoreo-usuario-main-filter',
            layout: 'column',
            defaults: {
                margin: '3 0 1 0'
            },
            items: [
                {
                    columnWidth: 0.3,
                    fieldLabel: idiom.monitor.user.filter.user,
                    width: 150,
                    id: 'monitoreo-usuario-main-filter-tf-user',
                    xtype: 'textfield',
                    vtype: 'user',
                    labelPad: 5,                    
                    labelAlign: "right",
					maxLength: 31,
					maxLengthText: idiom.monitor.general.validate.maxLengthText
                },
                {columnWidth: 0.3},
                {columnWidth: 0.3},
                {
                    columnWidth: 0.1,
                    layout: {
                        type: 'hbox',
                        pack: 'end',
                        align: 'rith'
                    },
                    defaults: { margins: '0 1 0 0' },
                    items: [
                        {
                            iconCls: 'icon-search',
                            xtype: 'button',
                            id: 'monitoreo-usuario-main-btn-search',
                            tooltip: idiom.monitor.user.btn.search
                        },
                        {
                            iconCls: 'icon-eraser',
                            xtype: 'button',
                            id: 'monitoreo-usuario-main-btn-eraser',
                            tooltip: idiom.monitor.user.btn.eraser
                        }
                    ]
                }
            ]
        },
        {
            region: 'center',
            xtype: 'monitoreo.usuario.list'
        }
    ]
});


