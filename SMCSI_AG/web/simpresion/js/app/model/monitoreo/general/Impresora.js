/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.model.monitoreo.general.Impresora', {
    extend: 'Ext.data.Store',
    fields: ['printername', 'id'],
	autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'getImpresora',
        reader : {
            type          : 'json',
            root          : 'data',
            successProperty: 'success'
        }
    }
});
