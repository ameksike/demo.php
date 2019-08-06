/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.servidores.Main', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.monitoreo.servidores.main',
    id: 'monitoreo-servidores-main',

    split: true,
    title: idiom.monitor.server.title,
    store: Ext.create('MSI.model.monitoreo.servidor.List'),
    collapseMode: 'mini',
    tbar: [
        {
            xtype: 'button',
            iconCls: 'icon-save',
            id: 'monitoreo-servidores-main-btn-save',
            tooltip: idiom.monitor.server.btn.save
        },
        {
            iconCls: 'icon-trello',
            xtype: 'button',
            id: 'monitoreo-servidores-main-btn-freq',
            tooltip: idiom.monitor.server.btn.freq
        }
    ]
});
