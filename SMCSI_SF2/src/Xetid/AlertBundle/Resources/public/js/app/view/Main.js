/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('Printers.view.alert.Main', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.printersAlertMain',
    layout: 'border',
    id: 'printersAlertMain',
    title: idiom.alert.title,
    items: [{
			region: 'north',
            xtype: 'fieldset',
            collapsible: true,
            title: idiom.alert.north.title,
            items:[{
				xtype: 'form',
				margin: '2 5 5 5',
				id: 'printersAlertMainForm',
				fieldDefaults: {
					labelAlign: 'top',
					msgTarget: 'side'
				},
				items: [{
					xtype: 'container',
					layout: 'column',
					defaults: {
						margin: '0 3% 7% 10%'
					},
					items: [{
						xtype: 'textfield',
						vtype: 'den',
						columnWidth: 1/7.4,
						fieldLabel: idiom.alert.north.den.title,
						msgtip: idiom.alert.north.den.tip,
						maxLength: 31,
						maxLengthText: idiom.alert.north.den.maxLengthText,
						name: 'den'
					},{
						xtype: 'combo',
						editable: false,
						columnWidth: 1/7,
						fieldLabel: idiom.alert.north.type.title,
						emptyText: idiom.alert.north.type.emptyText,
						msgtip: idiom.alert.north.type.tip,
						store: Ext.create('Printers.model.alert.Type'),
						name: 'type'
					},{
						xtype: 'combo',
						editable: false,
						columnWidth: 1/7,
						fieldLabel: idiom.alert.north.printer.title,
						emptyText: idiom.alert.north.printer.emptyText,
						msgtip: idiom.alert.north.printer.tip,
						store: Ext.create('Printers.model.alert.Printer'),
						name: 'printer'
					},{
						xtype: 'textfield',
						//vtype: 'wdp',
						columnWidth: 1/6.4,
						fieldLabel: idiom.alert.north.criteria.title,
						maxLength: 31,
						maxLengthText: idiom.alert.north.den.maxLengthText,
						msgtip: idiom.alert.north.criteria.tip,
						name: 'criteria'
					},{
						xtype: 'combo',
						editable: false,
						columnWidth: 1/7,
						fieldLabel: idiom.alert.north.action.title,
						emptyText: idiom.alert.north.action.emptyText,
						msgtip: idiom.alert.north.action.tip,
						store: Ext.create('Printers.model.alert.Action'),
						name: 'action'
					},{
						xtype: 'textfield',
						columnWidth: 1/7,
						fieldLabel: idiom.alert.north.objetive.title,
						msgtip: idiom.alert.north.objetive.tip,
						maxLength: 31,
						maxLengthText: idiom.alert.north.den.maxLengthText,
						name: 'objetive'
					},{
						xtype: 'container',
						columnWidth: 1/7.2,
						flex: 20,
						items: [{
							xtype: 'button',
							iconCls: 'icon-search',
							margin: '20 0 0 2',
							action: 'search',
							width: 23,
							tooltip: 'Filtrar búsquedad <b>(Alt+B)</b>'
						}, {
							width: 23,
							xtype: 'button',
							iconCls: 'icon-refresh',
							margin: '20 0 0 2',
							action: 'clear',
							tooltip: 'Limpiar búsquedad <b>(Alt+L)</b>'
						}]
					}]
				}]
			}]
        },{
            region: 'center',
            xtype: 'printersAlertList'
        }
    ],
    tbar: [{
			text: idiom.alert.tbar.add.title,
			iconCls: 'icon-plus',
			action: 'add',
			id: 'printer-main-tbar-btn-add',
			tooltip: idiom.alert.tbar.add.tip
		},{
			text: idiom.alert.tbar.edit.title,
			iconCls: 'icon-screenshot',
			action: 'edit',
			disabled: true,
			tooltip: idiom.alert.tbar.edit.tip
		},{
			text: idiom.alert.tbar.dell.title,
			iconCls: 'icon-remove',
			action: 'dell',
			disabled: true,
			tooltip: idiom.alert.tbar.dell.tip
	}]
});


