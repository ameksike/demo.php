/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.auditoria.reporte.line.Impresion', {
    extend: 'Ext.chart.Chart',
    alias: 'widget.monitoreo.auditoria.reporte.line.impresion',

    shadow: true,
    animate: true,
    store: Ext.create('MSI.model.monitoreo.auditoria.Impresion'),
    style: 'background:#fff',
    theme: 'Base:gradients',
    axes: [
        {
            type: 'Numeric',
            minimum: 0,
            position: 'left',
            fields: ['data1'],
            title: ' ',
            minorTickSteps: 1,
            grid: {
                odd: {
                    opacity: 1,
                    fill: '#ddd',
                    stroke: '#bbb',
                    'stroke-width': 0.5
                }
            }
        },
        {
            type: 'Category',
            position: 'bottom',
            fields: ['name'],
            title: ' '
        }
    ],
    series: [
        {
            type: 'line',
            highlight: {
                size: 7,
                radius: 7
            },
            smooth: true,
            fill: true,
            axis: 'left',
            xField: 'name',
            yField: 'data1',
            markerConfig: {
                type: 'circle',
                size: 4,
                radius: 4,
                'stroke-width': 0
            },
            tips: {
                trackMouse: true,
                width: 140,
                height: 28,
                renderer: function (storeItem, item) {
                    this.setTitle(storeItem.get('name') + ': ' + storeItem.get('data1'));
                }
            }
        }
    ]
});
