/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('Printers.view.alert.WinEdit', {
    extend: 'Ext.window.Window',
    alias: 'widget.viewAlertWinEdit',
    title: '',
    
    width: 450,
    minWidth: 450,
    minHeight: 250,
    resizable: true,
    closeAction: 'hide',
	frame: true,
    layout: 'column', 
    
	defaults: {
		labelAlign: 'top',
		msgTarget: 'side',
		margin: '2 5 5 5'
	},
    items: [{
			title: idiom.alert.winedit.fildset,
			layout:'column',
			xtype: 'fieldset',
			columnWidth: 1,
			defaults: {
				labelAlign: 'top',
				msgTarget: 'side',
				margin: '2 5 5 5'
			},
			items: [{
					fieldLabel: idiom.alert.winedit.den.title,
					msgtip: idiom.alert.winedit.den.tip,
					blankText: idiom.alert.winedit.criteria.blankText,
					maxLengthText: idiom.alert.north.den.maxLengthText,
					xtype: 'textfield',
					vtype: 'den',
					maxLength: 31,
					columnWidth: 1/2,
					allowBlank: false,
					name: 'den'
				},{
					fieldLabel: idiom.alert.winedit.type.title,
					emptyText: idiom.alert.winedit.type.emptyText,
					msgtip: idiom.alert.winedit.type.tip,
					blankText: idiom.alert.winedit.criteria.blankText,
					xtype: 'combo',
					editable: false,
					allowBlank: false,
					store: Ext.create('Printers.model.alert.Type'),
					columnWidth: 1/2,
					name: 'type'
				},{
					fieldLabel: idiom.alert.winedit.printer.title,
					emptyText: idiom.alert.winedit.printer.emptyText,
					msgtip: idiom.alert.winedit.printer.tip,
					xtype: 'combo',
					editable: false,
					store: Ext.create('Printers.model.alert.Printer'),
					columnWidth: 1,
					name: 'printer'
			}]
		},{
			fieldLabel: idiom.alert.winedit.criteria.title,
			msgtip: idiom.alert.winedit.criteria.tip,
			blankText: idiom.alert.winedit.criteria.blankText,
			maxLengthText: idiom.alert.north.den.maxLengthText,
			maxLength: 31,
			columnWidth: 1,			
			xtype: 'textfield',
			allowBlank: false,
			name: 'criteria'
		},{
			fieldLabel: idiom.alert.winedit.action.title,
			emptyText: idiom.alert.north.action.emptyText,
			blankText: idiom.alert.winedit.criteria.blankText,
			msgtip: idiom.alert.winedit.action.tip,
			xtype: 'combo',
			editable: false,
			allowBlank: false,
			store: Ext.create('Printers.model.alert.Action'),
			columnWidth: 1/2,
			name: 'action'
		},{
			fieldLabel: idiom.alert.winedit.objetive.title,
			msgtip: idiom.alert.winedit.objetive.tip,
			maxLengthText: idiom.alert.north.den.maxLengthText,
			maxLength: 31,
			columnWidth: 1/2,
			xtype: 'textfield',
			name: 'objetive'
	}],
	buttons: [{
			iconCls: 'icon-remove',
			action: 'cancel',
			text: idiom.alert.winedit.btn.cancel.title,
			msgtip: idiom.alert.winedit.btn.cancel.tip
		},{
			iconCls: 'icon-thumbs-up',
			action: 'apply',
			text: idiom.alert.winedit.btn.apply.title,
			msgtip: idiom.alert.winedit.btn.apply.tip
		},{
			iconCls: 'icon-ok',
			action: 'ok',
			text: idiom.alert.winedit.btn.ok.title,
			msgtip: idiom.alert.winedit.btn.ok.tip
	}]
});
