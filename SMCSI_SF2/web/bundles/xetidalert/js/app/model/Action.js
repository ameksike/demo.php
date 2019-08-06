/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		10/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('Printers.model.alert.Action', {
    extend: 'Ext.data.Store',
    fields: [
        'id',
		'text'
    ],
    pageSize: 10,
    autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'alert/action',
        reader: {
            type: 'json',
            root: 'data',
            successProperty: 'success'
        },
        simpleSortMode: true
    }
});
