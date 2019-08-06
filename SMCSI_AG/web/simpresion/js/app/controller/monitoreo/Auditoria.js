/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.monitoreo.Auditoria', {
    extend: 'MSI.controller.Module',

    delegate: function () {
        var self = this;
        return {
            '#monitoreo-tab-auditoria': {
                render: function () {
                    self.onRender.apply(self, arguments);
                }
            },
            '#monitoreo-auditoria-combo-charType': {
                select: function () {
                    self.charTypeSelect.apply(self, arguments);
                }
            },
            '#monitoreo-auditoria-main-btn-search': {
                render: function () {
                    self.mainBtnSearch.apply(self, arguments);
                },
                click: function () {
                    self.mainBtnSearch.apply(self, arguments);
                }
            },
            '#monitoreo-auditoria-main-btn-eraser': {
                click: function () {
                    self.mainBtnEraser.apply(self, arguments);
                }
            },
            '#monitoreo-auditoria-list': {
                render: function () {
                    self.updateGrid.apply(self, arguments);
                }
            }
        };
    },
    onRender: function (com) {
        var map = new Ext.util.KeyMap({
            target: Ext.getBody(),
            binding: [
                {
                    key: "b",
                    alt: true,
                    scope: this,
                    fn: this.onKeyPressSearch
                },
                {
                    key: "l",
                    alt: true,
                    scope: this,
                    fn: this.onKeyPressEraser
                }
            ]
        });
        this.update();
    },
    onKeyPressSearch: function (k, e) {
        e.preventDefault();
        var tab = Ext.getCmp('monitoreo-tab').getActiveTab();
        if (tab) {
            if (tab.id == 'monitoreo-tab-auditoria')
                this.mainBtnSearch();
        }
    },
    onKeyPressEraser: function (k, e) {
        e.preventDefault();
        var tab = Ext.getCmp('monitoreo-tab').getActiveTab();
        if (tab) {
            if (tab.id == 'monitoreo-tab-auditoria')
                this.mainBtnEraser();
        }
    },
    charTypeSelect: function (combo) {
        var type = 'monitoreo.auditoria.reporte.' + combo.getValue() + '.';
        var lstc = ['costo', 'accion', 'impresion', 'solicitud'];
        for (var i in lstc) {
            var cmp = Ext.getCmp('monitoreo-auditoria-reporte-' + lstc[i]);
            if (cmp) {
                cmp.remove(0, true);
                cmp.add({xtype: type + lstc[i]});
                this.updateChild(cmp, this.getFilters());
            }
        }
    },
    getFilters: function(){
        var con = this.getController('MSI.controller.monitoreo.Servidor');
        return con ? con.filter : [];
    },
    mainBtnSearch: function () {
        this.update();
    },
    mainBtnEraser: function () {
        Ext.getCmp('monitoreo-auditoria-main-filter-hasta').reset();
        Ext.getCmp('monitoreo-auditoria-main-filter-desde').reset();
    },
    update: function (filters) {
        filters = filters || this.getFilters();
        this.updateChart(filters);
        this.updateGrid(0, 0, filters);
    },
    updateChart: function(filters){
        filters = filters || this.getFilters();
        this.updateChild(Ext.getCmp('monitoreo-auditoria-reporte-accion'), filters);
        this.updateChild(Ext.getCmp('monitoreo-auditoria-reporte-costo'), filters);
        this.updateChild(Ext.getCmp('monitoreo-auditoria-reporte-impresion'), filters);
        this.updateChild(Ext.getCmp('monitoreo-auditoria-reporte-solicitud'), filters);
    },
    updateChild: function (comp, data) {
        this.updateChartEl(comp.items.items[0], data, comp.getEl());
    },
    isValidRangeDate: function(datein, dateout){
		return (new Date(dateout)) >= (new Date(datein));
	},
    updateChartEl:function(el, data, parentEl){
		
		
		var datein  = Ext.getCmp('monitoreo-auditoria-main-filter-desde').getValue();
		var dateout = Ext.getCmp('monitoreo-auditoria-main-filter-hasta').getValue();
		
		if(this.isValidRangeDate(datein, dateout)){
			if(el){
				el.getStore().removeAll();
				el.getStore().load({
					params: {
						filters: JSON.stringify(data),
						datein: Ext.getCmp('monitoreo-auditoria-main-filter-desde').getRawValue(),
						dateout: Ext.getCmp('monitoreo-auditoria-main-filter-hasta').getRawValue()
					},
					scope: {
						'self': this,
						'el' : parentEl
					},
					callback: function(records, operation, success) {
						if(!records.length || records.length < 1){
								MSI.controller.Msg.show({
									text: idiom.monitor.general.grid.emptyMsg,
									div: this.el,
									cls: 'chartaudit',
									index: (this.el) ? this.el.id : 'chartaudit'
								});
						}else{
								MSI.controller.Msg.hide((this.el) ? this.el.id : 'chartaudit');
						}
					}
				});
			}
		}else{
			Ext.Msg.show({
				title: idiom.monitor.server.info,
				msg: idiom.monitor.audit.msg.date,
				buttons: Ext.Msg.OK,
				icon: Ext.Msg.INFO
			});
		}
    },
    updateGrid: function (t, f, data) {
        data = data || [];
        var grid = Ext.getCmp('monitoreo-auditoria-list');
        if (grid) {
            grid.getStore().load({
                params: {
                    'filters': JSON.stringify(data)
                }
            });
        }
    }
});
