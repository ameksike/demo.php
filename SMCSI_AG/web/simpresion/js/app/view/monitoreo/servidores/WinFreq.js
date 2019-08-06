/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.servidores.WinFreq', {
    extend: 'Ext.window.Window',
    alias: 'widget.monitoreo.servidores.winfreq',
    title: 'Modificar frecuencia de actualizaci&oacute;n',
    id: 'monitoreo-servidores-win-freq',
    layout: {
        type: 'table',
        columns: 3
    },
    defaults: {
        margin: '3 5 3 3'
    },
    minWidth: 250,
    resizable: false,
    closeAction: 'hide',
    items: [
        {
            xtype: 'label',
            text: idiom.monitor.server.winf.label
        },
        {
            id: 'monitoreo-servidores-win-freq-nf-freq',
            xtype: 'numberfield',
            value: 150,
            allowBlank: false
        },
        {
            xtype: 'label',
            text: idiom.monitor.server.winf.label2
        }
    ],
    buttons: [
        {
            iconCls: 'icon-remove',
            text: idiom.monitor.server.winf.cancel,
            id: 'monitoreo-servidores-win-freq-btn-cancelar',
            tooltip: idiom.monitor.server.winf.btn.cancel
        },
        {
            iconCls: 'icon-ok',
            text: idiom.monitor.server.winf.ok,
            id: 'monitoreo-servidores-win-freq-btn-aceptar',
            tooltip: idiom.monitor.server.winf.btn.ok
        }
    ]
})
