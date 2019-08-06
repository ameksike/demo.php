/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		07/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('Printers.controller.Report', {
    extend: 'Ext.app.Controller',
    refs: [{
			ref: 'fsHistorial',
			selector: 'fsHistorial'
		},{
			ref: 'fsImpresoras',
			selector: 'fsImpresoras'
		},{
			ref: 'fsUsers',
			selector: 'fsUsers'
    }],
    init: function() {
        var self = this;
        this.control({
            'fsHistorial button[action=exportPDF]': {
                click: function () {
                    self.onClickBtnExportPDFHistory.apply(self, arguments);
                },
                render: function () {
                    self.onRenderBtnExportPDFHistory.apply(self, arguments);
                }
            },
            'fsImpresoras button[action=exportPDF]': {
                click: function () {
                    self.onClickBtnExportPDFPrinter.apply(self, arguments);
                },
                render: function () {
                    self.onRenderBtnExportPDFPrinter.apply(self, arguments);
                }
            } ,
            'fsUsers button[action=exportPDF]': {
                click: function () {
                    self.onClickBtnExportPDFUser.apply(self, arguments);
                },
                render: function () {
                    self.onRenderBtnExportPDFUser.apply(self, arguments);
                }
            } 
        });
    },
    onClickBtnExportPDFPrinter:function(k, e){
		var value = Ext.getCmp('tfuserimpresoras').getValue();
		this.showReport('printerList', {
			filtre :value
		}, idiom.report.visor.title.printerList);
	},
	onRenderBtnExportPDFPrinter:function(){
		var map = new Ext.util.KeyMap({
            target: Ext.getBody(),
            binding: [{
				key: "e",
				alt: true,
				scope: this,
				fn: function(k, e){
					e.preventDefault();
					var ptab = Ext.getCmp('tabCups').getActiveTab();
					if (ptab) {
						if (ptab.id == 'tabAdministrador'){
							var tab = Ext.getCmp('idtabadmin').getActiveTab();
							if (tab) {
								if (tab.id == 'tabprinters')
									this.onClickBtnExportPDFPrinter();
							}
						}
						
					}					
				}
			}]
        });
	},
    onClickBtnExportPDFUser:function(){
		var value = Ext.getCmp('tfusersfiltre').getValue();
		this.showReport('userList', {
			filtre :value
		}, idiom.report.visor.title.userList );
	},
	onRenderBtnExportPDFUser:function(){
		var map = new Ext.util.KeyMap({
            target: Ext.getBody(),
            binding: [{
				key: "e",
				alt: true,
				scope: this,
				fn: function(k, e){
					e.preventDefault();
					var ptab = Ext.getCmp('tabCups').getActiveTab();
					if (ptab) {
						if (ptab.id == 'tabAdministrador'){
							var tab = Ext.getCmp('idtabadmin').getActiveTab();
							if (tab) {
								if (tab.id == 'tabusers')
									this.onClickBtnExportPDFUser();
							}
						}
					}					
				}
			}]
        });
	},
	onClickBtnExportPDFHistory: function(){
		var accion = Ext.getCmp('cmbaccion');
        var printer = Ext.getCmp('cmbimpresoras');
        var user = Ext.getCmp('tfuser').getValue();
        var date = Ext.getCmp('fecha').getRawValue();
        var valueAction = (accion.getValue()!=null) ? accion.findRecordByValue(accion.getValue()).raw.id : '';
        var valuePrinter = (printer.getValue()!=null) ? printer.findRecordByValue(printer.getValue()).raw.id : '';
		var tree1 = Ext.getCmp('treeFiltro').getSelectionModel().getSelection();
		var tree2 = Ext.getCmp('treeUsers').getSelectionModel().getSelection();
		var tree3 = Ext.getCmp('treeImpres').getSelectionModel().getSelection();

		this.showReport('printerHistory', {
			json: Ext.encode({
				'usuario': user,
				'action': valueAction,
				'printer': valuePrinter,
				'date': date,
				'filter' : (tree1.length != 0) ? tree1[0].raw.id : '',
				'idGroupUser' : (tree2.length != 0) ? tree2[0].raw.id : '', 
				'idGroupPrinters' : (tree3.length != 0) ? tree3[0].raw.id : ''
			})
		}, idiom.report.visor.title.printerHistory);
	},
	onRenderBtnExportPDFHistory: function(){
		var map = new Ext.util.KeyMap({
            target: Ext.getBody(),
            binding: [{
				key: "e",
				alt: true,
				scope: this,
				fn: function(k, e){
					e.preventDefault();
					var tab = Ext.getCmp('tabCups').getActiveTab();
					if (tab) {
						if (tab.id == 'panelHistory')
							this.onClickBtnExportPDFHistory();
					}
				}
			}]
        });
	},
	getURL: function(action, params){
		var action = '/report/'+action+'/pdf';
		var filter = '';
		for(var i in params)
			filter += i+"="+params[i]+'&';
        var url = window.location.href + action + '?' + filter;
        return url.replace('php//', 'php/');
	}, 
	showReport: function(action, params, title){
		title = title || idiom.report.visor.title.default;
		var self = this;
		var win = Ext.create('Ext.window.Window', {
			title: title,
			height: 400,
			width: 600,
			layout: 'fit',
			maximizable: true,
			collapsible: true,
			listeners: {
				render: function(view){
					var visor = Ext.get(view.id+'-pdfvisor');
					var myMask = new Ext.LoadMask(view, {msg:idiom.report.visor.loadMask});
					myMask.show();
					visor.dom.onload = function(){
						myMask.hide();
					}
				}
			}
		});
		win.add({
			html: "<iframe id='"+win.id+"-pdfvisor' src='"+this.getURL(action, params)+"' style='width:100%; height:100%; border:0px'></iframe>"
		});
		win.show();
	}
});
