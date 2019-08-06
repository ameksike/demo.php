/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.Main', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreo.main',

    layout: 'border',
    id: 'monitoreo-Main',
    items: [
        {
            region: 'west',
            xtype: 'monitoreo.servidores.main',
            margins: '5 0 0 5',
            width: 200,
            collapsible: true,
            split: true,
            layout: 'fit'
        },
        {
            region: 'center',
            xtype: 'tabpanel',
            id: 'monitoreo-tab',
            layout: 'fit',
            margins: '5 5 0 0',
            items: [
                {
                    id: 'monitoreo-tab-auditoria',
                    title: idiom.monitor.audit.title,
                    layout: 'fit',
                    items: [
                        { xtype: 'monitoreo.auditoria.main'}
                    ]
                },
                {
                    id: 'monitoreo-tab-general',
                    title: idiom.monitor.general.title,
                    layout: 'fit',
                    items: [
                        { xtype: 'monitoreo.general.main'}
                    ]
                },
                {
                    title: idiom.monitor.user.title,
                    id: 'monitoreo-tab-user',
                    layout: 'fit',
                    items: [
                        { xtype: 'monitoreo.usuario.main'}
                    ]
                },
                {
                    title: idiom.monitor.printer.title,
                    id: 'monitoreo-tab-printer',
                    layout: 'fit',
                    items: [
                        { xtype: 'monitoreo.impresora.main'}
                    ]
                }
            ]
        }
    ]
});
