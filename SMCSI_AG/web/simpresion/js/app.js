/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.application({
    name: 'MSI',
    appFolder:  '../../../simpresion/js/app',
    autoCreateViewport: true,
    controllers: [
        'Module',
        'Main',
        'Monitoreo'
    ]
});
