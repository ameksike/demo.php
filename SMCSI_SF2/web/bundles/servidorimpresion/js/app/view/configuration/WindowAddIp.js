/**
 * Created by adrian on 17/03/15.
 */

Ext.define("Printers.views.AddIp", {
    extend: 'Ext.window.Window',
    alias: 'widget.AddIp',

    initComponent: function () {

        this.formPanel = Ext.create('Ext.form.Panel', {

            frame: true,
            width: 340,
            bodyPadding: 5,
            waitMsgTarget: true,

            fieldDefaults: {

                labelWidth: 85,
                msgTarget: 'side'
            },

            items: [{
                xtype: 'fieldset',
                defaultType: 'textfield',
                defaults: {
                    width: 275
                },
                items: [{
                    fieldLabel: 'Direccion Ip',
                    emptyText : 'Direccion Ip',
                    name      : 'idIps',
                    id        : 'idIps',
                    allowBlank: false,
                    vtype: 'IPAddress',
                    padding: '5 0 0 0'
                }]
            }],

            buttons: [{
                text: 'Cancelar',
                iconCls: 'icon-remove',
                //tooltip : Packed.idioma.tooltipCancelar,
                action: 'closeWin'
            }, {
                text: 'Aplicar',
                iconCls: 'icon-ok',
                formBind: true,
                id: 'id_btn_applyIps',
                //tooltip : Packed.idioma.tooltipAceptar,
                action: 'addIps'
            }, {
                text: 'Aceptar',
                iconCls: 'icon-ok',
                formBind: true,
                id: 'id_btn_addIps',
                //tooltip : Packed.idioma.tooltipAceptar,
                action: 'addIps'
            }]
        });

            this.title = 'Adicionar IP',
            this.id = 'winaddips',
            this.name = 'winaddips',
            this.width = 350,
            //this.height = 160,
            this.layout = 'fit',
            this.modal = true,
            this.resizable = false,
            this.autoShow = true,
            this.items = [
                this.formPanel
            ],
            this.callParent(arguments);
    }
});
