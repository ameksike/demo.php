/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.impresora.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.monitoreo.impresora.list',
    title: idiom.monitor.printer.grid.title,
    id: 'monitoreo-impresora-list',
    columns: [
        {header: idiom.monitor.printer.grid.printer, dataIndex: 'printers', flex: 1, sortable: true},
        {header: idiom.monitor.printer.grid.page, flex: 1, dataIndex: 'page', sortable: true},
        {header: idiom.monitor.printer.grid.work, flex: 1, dataIndex: 'work', sortable: true},
        {header: idiom.monitor.printer.grid.request, columns: [
            {header: idiom.monitor.printer.grid.allow, dataIndex: 'allow', width: 200, sortable: true},
            {header: idiom.monitor.printer.grid.deny, dataIndex: 'deny', width: 200, sortable: true},
            {header: idiom.monitor.printer.grid.warn, dataIndex: 'warn', width: 200, sortable: true},
            {header: idiom.monitor.printer.grid.cancel, dataIndex: 'cancel', width: 200, sortable: true}
        ]}
    ],
    initComponent: function() {
		this.store = Ext.create('MSI.model.monitoreo.impresora.List');
		this.bbar = Ext.create('Ext.PagingToolbar', {
			store: this.store,
			displayInfo: true,
			displayMsg: idiom.monitor.printer.displayMsg,
			emptyMsg: idiom.monitor.printer.emptyMsg,
			beforePageText: idiom.monitor.general.grid.beforePageText,
			afterPageText: idiom.monitor.general.grid.afterPageText,
			firstText: idiom.monitor.general.grid.firstText,
			prevText: idiom.monitor.general.grid.prevText,
			nextText: idiom.monitor.general.grid.nextText,
			lastText: idiom.monitor.general.grid.lastText,
			refreshText: idiom.monitor.general.grid.refreshText
		});
		this.callParent(arguments);
	}
});
