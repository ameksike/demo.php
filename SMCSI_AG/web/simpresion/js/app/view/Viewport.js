/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.Viewport', {
    extend: 'Ext.container.Viewport',
    layout: 'fit',
    items: [{
		xtype: 'tabpanel',
		layout: 'fit',
		items: [{
			title: idiom.monitor.title,
			xtype: 'monitoreo.main'
		}],
		tools:[{
			type: 'help',
			iconCls: 'icon-question',
			id: 'viewport-question',
			tooltip: idiom.help.tooltip
		}]
	}]
});
