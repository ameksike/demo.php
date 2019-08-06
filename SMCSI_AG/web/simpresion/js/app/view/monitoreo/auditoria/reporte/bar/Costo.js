/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.view.monitoreo.auditoria.reporte.bar.Costo', {
    extend: 'Ext.chart.Chart',
    alias: 'widget.monitoreo.auditoria.reporte.bar.costo',

    animate: true,
    store: Ext.create('MSI.model.monitoreo.auditoria.Costo'),
    shadow: true,
    axes: [
        {
            type: 'Numeric',
            position: 'left',
            fields: ['data1'],
            title: ' ',
            grid: true,
            minimum: 0
        },
        {
            type: 'Category',
            position: 'bottom',
            fields: ['name'],
            title: ' ',
            label: {
                rotate: {
                    degrees: 270
                }
            }
        }
    ],
    series: [
        {
            type: 'column',
            axis: 'left',
            gutter: 80,
            xField: 'name',
            yField: ['data1'],
            tips: {
                trackMouse: true,
                width: 150,
                height: 28,
                renderer: function (storeItem, item) {
                    this.setTitle(storeItem.get('name') + ': ' + storeItem.get('data1'));
                }
            },
            style: {
                fill: '#38B8BF'
            }
        }
    ]
});
