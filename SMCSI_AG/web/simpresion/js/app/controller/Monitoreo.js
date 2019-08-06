/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.Monitoreo', {
    extend: 'MSI.controller.Module',
    views: [
        'monitoreo.Main',
        'monitoreo.servidores.Main',
        'monitoreo.general.Main',
        'monitoreo.auditoria.Main',
        'monitoreo.impresora.Main',
        'monitoreo.usuario.Main'
    ],
    modns: 'MSI.controller.monitoreo',
    modules: [
        'Auditoria',
        'General',
        'Impresora',
        'Usuario',
        'Servidor'
    ],
    init: function () {
        var self = this;
        this.loading();
        Ext.apply(Ext.form.field.VTypes, {
            time: function (val, field) {
                var timeTest = /^([1-9]|1[0-9]):([0-5][0-9])(\s[a|p]m)$/i;
                return timeTest.test(val);
            },
            timeText: 'Not a valid time.  Must be in the format "12:34 PM".',
            timeMask: /[\d\s:amp]/i,

            words: function (val, field) {
                return /^(\w)+$/.test(val);
            },
            wordsText: 'El campo solo admite n&uacute;meros y letras',
            wordsMask: /[\w]/i,

            IPAddress: function (v) {
                return /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/.test(v);
            },
            IPAddressText: 'El campo solo admite n&uacute;meros naturales separados por un punto',
            IPAddressMask: /[\d\.]/i,
			user: function (val, field) {
                return /^[\w|\d|\.|\-|\_]+$/.test(val);
            },
            userText: idiom.monitor.general.validate.user
        });
    }
});

