/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		07/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('SMCSI.BtnExportPDF', {
	extend: 'Ext.Button',
    alias: 'widget.smcsi.btn.export.pdf',
    
	iconCls:'icon-print',
	margin : '20 0 0 2',
	action: 'exportPDF',
	width:23,
	tooltip: idiom.report.btn.exportPDF.tooltip
});
