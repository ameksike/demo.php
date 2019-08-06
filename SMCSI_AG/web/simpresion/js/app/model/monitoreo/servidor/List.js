/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.model.monitoreo.servidor.List', {
    extend: 'Ext.data.TreeStore',
    proxy: {
        type: 'ajax',
        url: 'getServidor'
    },
    root: {
        text: 'Servidores',
        expanded: true
    },
    folderSort: true,
    autoLoad: false,
    sorters: [
        {
            property: 'text',
            direction: 'ASC'
        }
    ]
});
