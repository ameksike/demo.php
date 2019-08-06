/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.monitoreo.Usuario', {
	extend: 'MSI.controller.Module',
    delegate: function(){
	    var self = this;
        return {
            '#monitoreo-tab-user': {
                render: function () {
                    self.onRender.apply(self, arguments);
                }
            },
            '#monitoreo-usuario-main-filter-tf-user': {
                render: function () {
                    self.mainFtUser.apply(self, arguments);
                }
            },
            '#monitoreo-usuario-main-btn-search': {
                click: function () {
                    self.mainBtnSearch.apply(self, arguments);
                }
            },
            '#monitoreo-usuario-main-btn-eraser': {
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
            if (tab.id == 'monitoreo-tab-user')
                this.mainBtnSearch();
        }
    },
    onKeyPressEraser: function (k, e) {
        e.preventDefault();
        var tab = Ext.getCmp('monitoreo-tab').getActiveTab();
        if (tab) {
            if (tab.id == 'monitoreo-tab-user')
                this.mainBtnEraser();
        }
    },
    mainFtUser: function (view) {
        /*this.toolTip({
            target: view.el,
            html: idiom.monitor.user.field
        });*/
    },
    mainBtnSearch: function () {
        this.update();
    },
    mainBtnEraser: function () {
        var combos = Ext.ComponentQuery.query('#monitoreo-usuario-main-filter combo');
        for(var i in combos){
            combos[i].reset( );
        }
        var textfield = Ext.ComponentQuery.query('#monitoreo-usuario-main-filter textfield');
        for(var i in textfield){
            textfield[i].reset( );
        }
    },
    getFilters: function(){
        var con = this.getController('MSI.controller.monitoreo.Servidor');
        return con ? con.filter : [];
    },
    update:function(filters){
        filters = filters || this.getFilters();
        var data = [
            ["u.username", "%"+Ext.getCmp('monitoreo-usuario-main-filter-tf-user').getValue()+"%", "like"]
        ];
        for(var i in filters){
            data.push(filters[i]);
        }
        var grid = Ext.getCmp('monitoreo-usuario-list');
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
