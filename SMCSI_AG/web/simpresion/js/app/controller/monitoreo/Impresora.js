/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.monitoreo.Impresora', {
	extend: 'MSI.controller.Module',
    delegate: function(){
	    var self = this;
        return {
            '#monitoreo-tab-printer': {
                render: function () {
                    self.onRender.apply(self, arguments);
                }
            },
            '#monitoreo-impresora-main-btn-search': {
                click: function () {
                    self.mainBtnSearch.apply(self, arguments);
                }
            },
            '#monitoreo-impresora-main-btn-eraser': {
                click: function () {
                    self.mainBtnEraser.apply(self, arguments);
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
            if (tab.id == 'monitoreo-tab-printer')
                this.mainBtnSearch();
        }
    },
    onKeyPressEraser: function (k, e) {
        e.preventDefault();
        var tab = Ext.getCmp('monitoreo-tab').getActiveTab();
        if (tab) {
            if (tab.id == 'monitoreo-tab-printer')
                this.mainBtnEraser();
        }
    },
    mainBtnSearch: function () {
       this.update();
    },
    mainBtnEraser: function () {
        var combos = Ext.ComponentQuery.query('#monitoreo-impresora-main-filter combo');
        for (var i in combos) {
            combos[i].reset();
        }
    },
    getFilters: function(){
        var con = this.getController('MSI.controller.monitoreo.Servidor');
        return con ? con.filter : [];
    },
    update:function(filters){
        filters = filters || this.getFilters();
        var data = [
            ["u.printername", "%"+Ext.getCmp('monitoreo-impresora-main-combo-impresora').getRawValue()+"%", "like"]
        ];
        for(var i in filters){
            data.push(filters[i]);
        }
        var grid = Ext.getCmp('monitoreo-impresora-list');
        if (grid) {
            grid.getStore().load({
                params:{
                    filters: JSON.stringify(data),
                    datein: Ext.Date.format(Ext.Date.add(new Date(), Ext.Date.DAY, -6), 'd/m/Y'),
                    dateout: Ext.Date.format(new Date(), 'd/m/Y')
                }
            });
        }
    }
});
