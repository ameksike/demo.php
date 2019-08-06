/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.model.monitoreo.auditoria.Accion', {
    extend: 'Ext.data.Store',
    fields: ['name', 'data1'],

    autoLoad: false,
    proxy: {
        type: 'ajax',
        url: 'getAccionCh',
        reader : {
            type          : 'json',
            root          : 'data',
            successProperty: 'success'
        }
    }
});
