/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.auditoria.Reporte', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.monitoreo.auditoria.reporte',
    requires: [
        'MSI.view.monitoreo.auditoria.reporte.pie.Impresion',
        'MSI.view.monitoreo.auditoria.reporte.pie.Solicitud',
        'MSI.view.monitoreo.auditoria.reporte.pie.Accion',
        'MSI.view.monitoreo.auditoria.reporte.pie.Costo',

        'MSI.view.monitoreo.auditoria.reporte.bar.Impresion',
        'MSI.view.monitoreo.auditoria.reporte.bar.Solicitud',
        'MSI.view.monitoreo.auditoria.reporte.bar.Accion',
        'MSI.view.monitoreo.auditoria.reporte.bar.Costo',

        'MSI.view.monitoreo.auditoria.reporte.line.Impresion',
        'MSI.view.monitoreo.auditoria.reporte.line.Solicitud',
        'MSI.view.monitoreo.auditoria.reporte.line.Accion',
        'MSI.view.monitoreo.auditoria.reporte.line.Costo',
    ],
    autoScroll: true,
    frame: false,
    layout:'column',
    defaults: {
        margin: '3% 3% 3% 10%',
        minHeight: 390,
        maxHeight: 390
    },
    items: [
        {
            columnWidth: 1/2,
            title: idiom.monitor.audit.region.request,
            layout: 'fit',
            id: 'monitoreo-auditoria-reporte-solicitud',
            items: {xtype: 'monitoreo.auditoria.reporte.pie.impresion'}
        },
        {
            columnWidth: 1/2,
            title: idiom.monitor.audit.region.printer,
            layout: 'fit',
            id: 'monitoreo-auditoria-reporte-impresion',
            items: {xtype: 'monitoreo.auditoria.reporte.pie.solicitud'}
        },
        {
            columnWidth: 1/2,
            title: idiom.monitor.audit.region.action,
            layout: 'fit',
            id: 'monitoreo-auditoria-reporte-accion',
            items: {xtype: 'monitoreo.auditoria.reporte.pie.accion'}
        },
        {
            columnWidth: 1/2,
            title: idiom.monitor.audit.region.cost,
            layout: 'fit',
            id: 'monitoreo-auditoria-reporte-costo',
            items: {xtype: 'monitoreo.auditoria.reporte.pie.costo'}
        }
    ]
});
