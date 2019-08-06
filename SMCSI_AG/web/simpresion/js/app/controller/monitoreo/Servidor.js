/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.monitoreo.Servidor', {
    extend: 'MSI.controller.Module',
    requires: ['Ext.window.MessageBox', 'MSI.controller.Msg'],
    init: function () {
        this.polling = false;
        this.freq = 150;
        this.setFreq();
        this.filter = [];
    },
    delegate: function () {
        var self = this;
        return {
            '#monitoreo-servidores-main-btn-save': {
                click: function () {
                    self.mainBtnSave.apply(self, arguments);
                }
            },
            '#monitoreo-servidores-main': {
                itemclick: function () {
                    self.onItemclick.apply(self, arguments);
                },
                beforerender: function () {
                    self.onRender.apply(self, arguments);
                }
            },
            '#monitoreo-servidores-main-btn-freq': {
                click: function () {
                    self.mainBtnFreq.apply(self, arguments);
                }
            },
            '#monitoreo-servidores-win-freq-btn-cancelar': {
                click: function () {
                    self.winFreqBtnCancelar.apply(self, arguments);
                }
            },
            '#monitoreo-servidores-win-freq-btn-aceptar': {
                click: function () {
                    self.winFreqBtnAceptar.apply(self, arguments);
                }
            }
        };
    },
    mainBtnSave: function (view) {
        var sav = {"true": [], "false": []};
        var tree = Ext.getCmp('monitoreo-servidores-main');
        var children = tree.getRootNode().childNodes;
        for (var i in children) {
            sav[children[i]['data']['checked']].push(children[i]['data']['id']);
        }
        this.send({
            'url': 'saveStatus',
            'params': {
                "nodos": JSON.stringify(sav)
            },
            callback: function () {
                Ext.Msg.show({
                    title: idiom.monitor.server.info,
                    msg: idiom.monitor.server.msgsave,
                    buttons: Ext.Msg.OK,
                    icon: Ext.Msg.INFO
                });
            }
        });
    },
    onItemclick: function (view, record, item, index, event, eOpts) {
        this.filter = [];
        switch (record.getDepth()) {
            case 0:
                this.update([]);
                break;
            case 1:
                this.filter.push(["j.serverid", record.data.id, '=']);
                this.update(this.filter);
                break;
            case 3:
                this.filter.push([record.raw.field + ".id", record.raw.tid, '=']);
                this.filter.push(["j.serverid", record.parentNode.parentNode.data.id, '=']);
                this.update(this.filter);
                break;
        }
    },
    onRender: function (com) {
        var map = new Ext.util.KeyMap({
            target: Ext.getBody(),
            binding: [
                {
                    key: "g",
                    alt: true,
                    scope: this,
                    fn: function (k, e) {
                        e.preventDefault();
                        this.mainBtnSave();
                    }
                },
                {
                    key: "f",
                    alt: true,
                    scope: this,
                    fn: function (k, e) {
                        e.preventDefault();
                        this.mainBtnFreq();
                    }
                }
            ]
        });
        var self = this;
        com.on('load', function(store){
            self.emptyLoad.call(self, store);
        });
    },
    emptyLoad: function(store){
		var data = store.tree.root.childNodes;
        if (data.length < 1 || data == undefined){
            MSI.controller.Msg.show({
                text: idiom.monitor.general.grid.emptyMsg,
                cls: 'servernodes'
            });
            Ext.getCmp('monitoreo-tab').setDisabled(true);
        }
        else{
			MSI.controller.Msg.hide('servernodes');
			Ext.getCmp('monitoreo-tab').setDisabled(false);
		} 
    },
    getView: function () {
        return Ext.getCmp('monitoreo-servidores-main');
    },
    updateServer: function () {
        var tree = Ext.getCmp('monitoreo-servidores-main');
        tree.getStore().load();
    },
    updateMonitor: function (filter) {
        this.getController('MSI.controller.monitoreo.General').update(filter);
        this.getController('MSI.controller.monitoreo.Impresora').update(filter);
        this.getController('MSI.controller.monitoreo.Usuario').update(filter);
    },
    update: function (filter) {
        this.getController('MSI.controller.monitoreo.Auditoria').update(filter);
        this.updateMonitor(filter);
    },
    notify: function () {
        this.updateMonitor(this.filter);
    },
    setFreq: function (value) {
        var self = this;
        this.freq = value || this.freq;
        if (this.polling) window.clearInterval(this.polling);
        this.polling = window.setInterval(function () {
            self.notify.call(self);
        }, this.freq * 1000);
    },
    mainBtnFreq: function (view) {
        this.showWinFreq();
    },
    winFreqBtnAceptar: function () {
        var winfreq = Ext.getCmp('monitoreo-servidores-win-freq');
        this.setFreq(Ext.getCmp('monitoreo-servidores-win-freq-nf-freq').value);
        winfreq.close();
    },
    winFreqBtnCancelar: function () {
        Ext.getCmp('monitoreo-servidores-win-freq').close();
    },
    showWinFreq: function () {
        if (!this.winfreq)
            this.winfreq = Ext.create('MSI.view.monitoreo.servidores.WinFreq');
        Ext.getCmp('monitoreo-servidores-win-freq-nf-freq').setValue(this.freq);
        this.winfreq.show();
    }
});
