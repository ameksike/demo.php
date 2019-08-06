/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.usuario.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.monitoreo.usuario.list',
    title: idiom.monitor.user.grid.title,
    id: 'monitoreo-usuario-list',
    columns: [
        {header: idiom.monitor.user.grid.user, dataIndex: 'users', flex: 1, sortable: true},
        {header: idiom.monitor.user.grid.page, flex: 1, dataIndex: 'page', sortable: true},
        {header: idiom.monitor.user.grid.work, flex: 1, dataIndex: 'work', sortable: true},
        {header: idiom.monitor.user.grid.request, columns: [
            {header: idiom.monitor.user.grid.allow, dataIndex: 'allow', width: 200, sortable: true},
            {header: idiom.monitor.user.grid.deny, dataIndex: 'deny', width: 200, sortable: true},
            {header: idiom.monitor.user.grid.warn, dataIndex: 'warn', width: 200, sortable: true},
            {header: idiom.monitor.user.grid.cancel, dataIndex: 'cancel', width: 200, sortable: true}
        ]}
    ],
    initComponent: function() {
		this.store = Ext.create('MSI.model.monitoreo.usuario.List');
		this.bbar = Ext.create('Ext.PagingToolbar', {
			store: this.store,
			displayInfo: true,
			displayMsg: idiom.monitor.user.displayMsg,
			emptyMsg: idiom.monitor.user.emptyMsg,
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
