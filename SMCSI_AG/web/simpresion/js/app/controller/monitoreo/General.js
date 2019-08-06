/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.monitoreo.General', {
    extend: 'MSI.controller.Module',
    delegate: function () {
        var self = this;
        return {
            '#monitoreo-tab-general': {
                render: function () {
                    self.onRender.apply(self, arguments);
                }
            },
            '#monitoreo-general-main-filter-tf-user': {
                render: function () {
                    self.mainTfUser.apply(self, arguments);
                }
            },
            '#monitoreo-general-main-filter-tf-ip': {
                render: function () {
                    self.mainTfIpaddress.apply(self, arguments);
                }
            },
            '#monitoreo-general-main-btn-search': {
                click: function () {
                    self.mainBtnSearch.apply(self, arguments);
                }
            },
            '#monitoreo-general-main-btn-eraser': {
                click: function () {
                    self.mainBtnEraser.apply(self, arguments);
                }
            },
            '#monitoreo-general-list': {
                itemclick: function () {
                    self.itemclick.apply(self, arguments);
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
            if (tab.id == 'monitoreo-tab-general')
                this.mainBtnSearch();
        }
    },
    onKeyPressEraser: function (k, e) {
        e.preventDefault();
        var tab = Ext.getCmp('monitoreo-tab').getActiveTab();
        if (tab) {
            if (tab.id == 'monitoreo-tab-general')
                this.mainBtnEraser();
        }
    },
    mainTfUser: function (view) {
        /*this.toolTip({
            target: view.el,
            html: idiom.monitor.general.user
        });*/
    },
    mainTfIpaddress: function (view) {
        /*this.toolTip({
            target: view.el,
            html: idiom.monitor.general.ip
        });*/
    },
    mainBtnSearch: function () {
        this.update();
    },
    mainBtnEraser: function () {
        var combos = Ext.ComponentQuery.query('#monitoreo-general-main-filter combo');
        for (var i in combos) combos[i].reset();
        var textfield = Ext.ComponentQuery.query('#monitoreo-general-main-filter textfield');
        for (var i in textfield)  textfield[i].reset();
    },
    itemclick: function (view, record, item, index, event, eOpts) {
        Ext.getCmp('monitoreo-general-detail-user').el.dom.innerHTML = record.data.fullname;
        Ext.getCmp('monitoreo-general-detail-usergroup').setText(record.data.guser);
        Ext.getCmp('monitoreo-general-detail-title').setText(record.data.title);
        Ext.getCmp('monitoreo-general-detail-impress').setText(record.data.gprinter);
    },
    getFilters: function(){
        var con = this.getController('MSI.controller.monitoreo.Servidor');
        return con ? con.filter : [];
    },
    update: function (filters) {
        filters = filters || this.getFilters();
        console.log(filters);
        var action = Ext.getCmp('monitoreo-general-main-filter-combo-accion').getValue();
        var addres = Ext.getCmp('monitoreo-general-main-filter-tf-ip').getValue();
        var addres = addres == '127.0.0.1' ? 'localhost' : addres;
        var data = [
            ["u.username", "%" + Ext.getCmp('monitoreo-general-main-filter-tf-user').getValue() + "%", "like"],
            ["j.action", "%" + (action != null ? action : '') + "%", "like"],
            ["p.printername", "%" + Ext.getCmp('monitoreo-general-main-filter-combo-impresora').getRawValue() + "%", "like"],
            ["j.hostname", "%" + addres + "%", "like"]
        ];
        for (var i in filters) {
            data.push(filters[i]);
        }
        var grid = Ext.getCmp('monitoreo-general-list');
        if (grid) {
            grid.getStore().load({
                params: {
                    filters: JSON.stringify(data),
                    datein: Ext.Date.format(Ext.Date.add(new Date(), Ext.Date.DAY, -6), 'd/m/Y'),
                    dateout: Ext.Date.format(new Date(), 'd/m/Y')
                }
            });
        }
    }
});
