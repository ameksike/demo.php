/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		10/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('Printers.controller.Alert', {
    extend: 'Ext.app.Controller',
    refs: [{
			ref: 'printersAlertMain',
			selector: 'printersAlertMain'
		},{
			ref: 'viewAlertWinEdit',
			selector: 'viewAlertWinEdit'
		},{
			ref: 'printersAlertList',
			selector: 'printersAlertList'
	}],
	
    init: function() {
        var self = this;
        this.control({
            '#idtabadmin': {
                render: function () {
                    self.onRenderTabAdmin.apply(self, arguments);
                }
            },
            'printersAlertList': {
                beforerender: function () {
                    self.onRenderGrid.apply(self, arguments);
                },
                itemclick: function () {
                    self.onGridItemClick.apply(self, arguments);
                }
            },
            'printersAlertMain button[action=add]': {
				click: function () {
					self.onClickTbarBtnAdd.apply(self, arguments);
                }
			},
            'printersAlertMain button[action=edit]': {
				click: function () {
					self.onClickTbarBtnEdit.apply(self, arguments);
                }
			},
            'printersAlertMain button[action=dell]': {
				click: function () {
					self.onClickTbarBtnDell.apply(self, arguments);
                }
			},
            'printersAlertMain button[action=search]': {
				click: function () {
					self.onClickTbarBtnSearch.apply(self, arguments);
                }
			},
            'printersAlertMain button[action=clear]': {
				click: function () {
					self.onClickTbarBtnClear.apply(self, arguments);
                }
			},
			'viewAlertWinEdit button[action=cancel]': {
				click: function () {
					self.onClickWinEditBtnCancel.apply(self, arguments);
                }
			},
			'viewAlertWinEdit button[action=apply]': {
				click: function () {
					self.onClickWinEditBtnApply.apply(self, arguments);
                }
			},
			'viewAlertWinEdit button[action=ok]': {
				click: function () {
					self.onClickWinEditBtnOk.apply(self, arguments);
                }
			}
        });
        
        Ext.Component.override({
			afterRender:function(){
				var self = this;
				this.callParent();
				if(self.msgtip){
					Ext.create('Ext.tip.ToolTip', {
						target: self.getId(),
						html: self.msgtip,
						trackMouse: true
					});
					Ext.QuickTips.init();
				}
			}
		});
		
		Ext.window.MessageBox.override({
			buttonText: {
				ok: idiom.buttonText.ok,
				yes: idiom.buttonText.yes,
				no: idiom.buttonText.no,
				cancel: idiom.buttonText.cancel
			}
		});
		
		this.itemSelected = { data:{} };
		DomHelper.Style.create().add('.x-fieldset-header-text', { color: '#000000' });
    },
    onRenderTabAdmin: function(view){
		view.add({ xtype: 'printersAlertMain' });
		this.map = new Ext.util.KeyMap({
            target: Ext.getBody(),
            binding: [{
					key: "i",
					alt: true,
					defaultEventAction: 'preventDefault',
					scope: this,
					fn: function(k, e){
						if(this.isModActive()){
							this.onClickTbarBtnAdd.apply(this, arguments);
						}				
					}
				},{
					key: "m",
					alt: true,
					scope: this,
					defaultEventAction: 'preventDefault',
					fn: function(k, e){
						if(this.isModActive()){
							var btn = Ext.ComponentQuery.query('printersAlertMain button[action=edit]');
							if(!btn[0].isDisabled())
								this.onClickTbarBtnEdit.apply(this, arguments);
						}				
					}
				},{
					key: Ext.EventObject.DELETE,
					scope: this,
					defaultEventAction: 'preventDefault',
					fn: function(k, e){
						if(this.isModActive()){
							var btn = Ext.ComponentQuery.query('printersAlertMain button[action=dell]');
							if(!btn[0].isDisabled())
								this.onClickTbarBtnDell.apply(this, arguments);
						}				
					}
				},{
					key: "b",
					alt: true,
					scope: this,
					defaultEventAction: 'preventDefault',
					fn: function(k, e){
						if(this.isModActive()){
							this.onClickTbarBtnSearch.apply(this, arguments);
						}				
					}
				},{
					key: "l",
					alt: true,
					scope: this,
					defaultEventAction: 'preventDefault',
					fn: function(k, e){
						if(this.isModActive()){
							this.onClickTbarBtnClear.apply(this, arguments);
						}				
					}
				},{
					key: "x",
					alt: true,
					scope: this,
					defaultEventAction: 'preventDefault',
					fn: function(k, e){
						if(this.isModActive()){
							this.onClickWinEditBtnCancel.apply(this, arguments);
						}				
					}
				},{
					key: "p",
					alt: true,
					ctrl: true,
					scope: this,
					defaultEventAction: 'preventDefault',
					fn: function(k, e){
						if(this.isModActive()){
							this.onClickWinEditBtnApply.apply(this, arguments);
						}				
					}
				},{
					key: Ext.EventObject.ENTER,
					scope: this,
					defaultEventAction: 'preventDefault',
					fn: function(k, e){
						if(this.isModActive()){
							var win = Ext.ComponentQuery.query('viewAlertWinEdit');
							if(win[0].isVisible()) 
								this.onClickWinEditBtnOk.apply(this, arguments);
						}				
					}
				}]
        });
        Ext.apply(Ext.form.field.VTypes, {
            wdp: function (val, field) {
                return /^[\w|\d|\.]+$/.test(val);
            },
            wdpText: idiom.alert.vtypes.wdp,
            den: function (val, field) {
                return /^[\w|\d|\s]+$/.test(val);
            },
            denText: idiom.alert.vtypes.den
        });
	},
	onRenderGrid: function(view){
		var vstore = Ext.create('Printers.model.alert.List');
		var bar = view.getDockedItems();
		view.reconfigure(vstore);
		bar[1].bindStore(vstore);
	},
	isModActive: function(){
		var ptab = Ext.getCmp('tabCups').getActiveTab();
		if (ptab) {
			if (ptab.id == 'tabAdministrador'){
				var tab = Ext.getCmp('idtabadmin').getActiveTab();
				if (tab) {
					if (tab.id == 'printersAlertMain')
						return true;
				}
			}
		}
		return false;					
	},
	onClickTbarBtnAdd: function(){
		this.clear('viewAlertWinEdit');
		this.itemSelected = { data:{} };
		this.winEdit().show();
	},
	onClickTbarBtnEdit: function(){
		this.winEdit(idiom.alert.winedit.title.edit).show();
		this.itemSelected = this.getItemSelected();
		var data = this.itemSelected.data;
		for(var i in data){
			var com = Ext.ComponentQuery.query('viewAlertWinEdit [name='+i+']');
			com = com[0];
			if(com) com.setValue(data[i]);
		}
	},
	getItemSelected: function(){
		var grid = Ext.ComponentQuery.query('printersAlertList');
		var seld = grid[0].getSelectionModel().getSelection();
		return seld[0];
	},
	onClickTbarBtnDell: function(){
		var item = this.getItemSelected();
		Ext.MessageBox.confirm(idiom.alert.confirm, idiom.alert.tbar.dell.confirm, function(action){
			if(action == 'yes'){
				//this.getGrid().getStore().remove(item);
				Ext.Ajax.request({
					url: 'alert/delete',
					params: {
						dto: JSON.stringify(item.data)
					},
					item: item,
					self: this,
					success: function(response, req){
						var item = JSON.parse(response.responseText);
						req.self.showMsg(idiom.alert.tbar.dell.msg);
						req.self.reload();
						//req.self.getGridToolBar().moveFirst();
					}
				});					
			}
		}, this);
	},
	onClickTbarBtnSearch: function(){
		//this.getGridToolBar().moveFirst();
		this.reload();
	},
	reload: function(){
		var filter = Ext.getCmp('printersAlertMainForm').getValues();
		this.getGrid().getStore().load({
			params: {
				dto: JSON.stringify(filter) 
			},
			callback: function(records, operation, success) {}
		});
	},
	moveFirst: function(){
		this.getGridToolBar().moveFirst();
	},	
	onClickTbarBtnClear: function(){
		this.clear('printersAlertMain');
	},
	onClickWinEditBtnCancel: function(view){
		this.winEdit().close();
	},
	onClickWinEditBtnOk: function(view){
		var item = this.getItem();
		if(this.isValidItem(item)){
			this.update(item);
			this.winEdit().close();
		}
		else return false; 
	},
	onClickWinEditBtnApply: function(view){
		var item = this.getItem();
		
		if(this.isValidItem(item))
			this.update(item);
		else return false; 
	},
	update: function(item){
		Ext.Ajax.request({
			url: item.data.id ? 'alert/edit' : 'alert/add',
			params: {
				dto: JSON.stringify(item.data)
			},
			item: item,
			grid: this.getGrid(),
			self: this,
			success: function(response, req){
				req.self.reload();
				if(req.url == 'alert/edit'){
					//req.grid.getStore().remove(req.item);
					//req.grid.getStore().insert(req.item.index, req.item.data);
					req.self.showMsg(idiom.alert.tbar.edit.msg);
					
				}else{
					var item = JSON.parse(response.responseText);
					//req.grid.getStore().add(item.data); //  req.item.data
					req.self.clear('viewAlertWinEdit');
					req.self.showMsg(idiom.alert.tbar.add.msg);
				}
			}
		});
	},
	isValidItem: function(item){
		if(!item.data.type || item.data.type == '') return false;
		if(!item.data.action || item.data.action == '') return false;
		if(!item.data.den || item.data.den == '') return false;
		return true;
	},
	getItem: function(){
		var fields = this.filds('viewAlertWinEdit');
		for(var i in fields){
			this.itemSelected.data[fields[i].name] = fields[i].getValue();
			fields[i].validate();
		}
			
		return this.itemSelected;
	},
	winEdit: function(title){
		if(!this.winedit) this.winedit = Ext.widget('viewAlertWinEdit');
		title = title || idiom.alert.winedit.title.add;
		this.winedit.setTitle(title);
		return this.winedit;
	},
	filds: function(selector){
		return Ext.ComponentQuery.query(selector+' textfield');
	},
	clear: function(selector){
		var textfield = this.filds(selector);
		for(var i in textfield)
			if(textfield[i]) textfield[i].reset();
	},
    onGridItemClick: function (view, record, item, index, event, eOpts) {
		var com = Ext.ComponentQuery.query('printersAlertMain button[action=edit]');
		if(com[0]) com[0].setDisabled(false); 
		
		var com = Ext.ComponentQuery.query('printersAlertMain button[action=dell]');
		if(com[0]) com[0].setDisabled(false); 
    },
    getGrid: function(){
		var grid = Ext.ComponentQuery.query('printersAlertList');
		return grid[0];
	},
	getGridToolBar: function(){
		var bar = this.getGrid().getDockedItems();	
		return bar[1];
	},
	showMsg: function(msg){
		Ext.Msg.show({
			title: idiom.alert.info,
			msg: msg,
			buttons: Ext.Msg.OK,
			icon: Ext.Msg.INFO
		});	
	}
});
