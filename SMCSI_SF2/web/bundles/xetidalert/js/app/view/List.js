/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('Printers.view.alert.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.printersAlertList',
    title:  idiom.alert.center.grid.title,
    id: 'printersAlertList',
    columns: [
        {header: idiom.alert.center.grid.den, 		dataIndex: 'den', flex: 1, width: 75, sortable: true},
        {header: idiom.alert.center.grid.type, 		dataIndex: 'type', flex: 1, width: 75, sortable: true},
        {header: idiom.alert.center.grid.printer, 	dataIndex: 'printer', flex: 1, width: 75, sortable: true},
        {header: idiom.alert.center.grid.criteria , dataIndex: 'criteria', flex: 1, width: 75, sortable: true},
        {header: idiom.alert.center.grid.action , 	dataIndex: 'action', flex: 1, width: 75, sortable: true},
        {header: idiom.alert.center.grid.objetive, 	dataIndex: 'objetive', flex: 1, width: 75, sortable: true}
    ],
    bbar: {
		xtype: 'pagingtoolbar',
		displayInfo: true,
		displayMsg: idiom.alert.center.grid.displayMsg,
		emptyMsg: idiom.alert.center.grid.emptyMsg,
		beforePageText: idiom.alert.center.grid.beforePageText,
		afterPageText: idiom.alert.center.grid.afterPageText,
		firstText: idiom.alert.center.grid.firstText,
		prevText: idiom.alert.center.grid.prevText,
		nextText: idiom.alert.center.grid.nextText,
		lastText: idiom.alert.center.grid.lastText,
		refreshText: idiom.alert.center.grid.refreshText
	}
});
