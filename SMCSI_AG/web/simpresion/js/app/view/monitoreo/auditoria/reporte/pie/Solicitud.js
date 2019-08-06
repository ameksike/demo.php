/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.auditoria.reporte.pie.Solicitud', {
    extend: 'Ext.chart.Chart',
    alias: 'widget.monitoreo.auditoria.reporte.pie.solicitud',

    animate: true,
    store: Ext.create('MSI.model.monitoreo.auditoria.Solicitud'),
    shadow: true,
    legend: {
        position: 'right'
    },
    insetPadding: 60,
    theme: 'Base:gradients',
    series: [
        {
            type: 'pie',
            field: 'data1',
            showInLegend: true,
            donut: false,
            tips: {
                trackMouse: true,
                width: 140,
                height: 28,
                renderer: function (storeItem, item) {
                    this.setTitle(storeItem.get('name') + ': ' + storeItem.get('data1'));
                }
            },
            highlight: {
                segment: {
                    margin: 20
                }
            }/*,
            label: {
                field: 'name',
                display: 'rotate',
                contrast: true,
                font: '12px Arial'
            }*/
        }
    ]
});
