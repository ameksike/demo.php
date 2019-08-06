/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.model.monitoreo.general.Historial', {
    extend: 'Ext.data.Store',
    fields: [
        'id',
        'user',
        'action',
        'impress',
        'page',
        'work',
        'total',
        'ip',
        'date',

        'serverid',
        'guser',
        'gprinter',
        'fullname',
        'title'
    ],
    pageSize: 10,
    autoLoad: false,
    proxy: {
        type: 'ajax',
        url: 'getHistorial',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'count',
            successProperty: 'success'
        },
        simpleSortMode: true
    }
});
