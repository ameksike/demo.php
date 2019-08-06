/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.model.monitoreo.usuario.List', {
    extend: 'Ext.data.Store',
    fields: [
        'serverid',
        'uid',
        'users',
        'work',
        'page',
        'allow',
        'deny',
        'warn'
    ],
    pageSize: 10,
    autoLoad: false,
    proxy: {
        type: 'ajax',
        url: 'getUsuario',
        reader : {
            type          : 'json',
            root          : 'data',
            totalProperty : 'count',
            successProperty: 'success'
        }
    }
});
