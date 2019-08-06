/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		10/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('Printers.model.alert.List', {
    extend: 'Ext.data.Store',
    fields: [
        'id',
		'den',
		'type',
		'printer',
		'criteria',
		'action',
		'objetive'
    ],
    pageSize: 10,
    autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'alert/list',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'count',
            successProperty: 'success'
        },
        simpleSortMode: true
    }
});
