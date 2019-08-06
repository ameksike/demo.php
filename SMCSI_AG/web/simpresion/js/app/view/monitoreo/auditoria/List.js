/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 * @require     MSI.model.monitoreo.general.Historial
 */
Ext.define('MSI.view.monitoreo.auditoria.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.monitoreo.auditoria.list',
    title: idiom.monitor.audit.grid.title,
    id: 'monitoreo-auditoria-list',
    columns: [
        {header: idiom.monitor.audit.grid.user, dataIndex: 'user', flex: 1, width: 75, sortable: true},
        {header: idiom.monitor.audit.grid.action , dataIndex: 'action', flex: 1, width: 75, sortable: true, renderer: function(val){
            return idiom.monitor.general.action[val.toLowerCase()];
        }},
        {header: idiom.monitor.audit.grid.printer, dataIndex: 'impress', flex: 1, width: 75, sortable: true},
        {header: idiom.monitor.audit.grid.cost, columns: [
            {header: idiom.monitor.audit.grid.page, dataIndex: 'page', flex: 1, width: 75, sortable: true},
            {header: idiom.monitor.audit.grid.work, dataIndex: 'work', flex: 1, width: 75, sortable: true},
            {header: idiom.monitor.audit.grid.total, dataIndex: 'total', flex: 1, width: 75, sortable: true}
        ]},
        {header: idiom.monitor.audit.grid.ip, dataIndex: 'ip', flex: 1, width: 75, sortable: true},
        {header: idiom.monitor.audit.grid.date, dataIndex: 'date', flex: 1, width: 75, sortable: true} //, renderer: Ext.util.Format.dateRenderer('d/m/Y')
    ],
    initComponent: function() {
		this.store = Ext.create('MSI.model.monitoreo.general.Historial');
		this.bbar = Ext.create('Ext.PagingToolbar', {
			store: this.store,
			displayInfo: true,
			displayMsg: idiom.monitor.audit.grid.displayMsg,
			emptyMsg: idiom.monitor.audit.grid.emptyMsg,
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
