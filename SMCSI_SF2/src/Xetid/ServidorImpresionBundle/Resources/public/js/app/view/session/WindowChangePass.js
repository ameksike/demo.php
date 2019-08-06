Ext.define('Pikota.view.session.WinChangePass', {
    extend: 'Ext.window.Window',
    alias: 'widget.WinChangePass',
    layout: "fit",
    modal: true,
    initComponent: function () {
        this.formPanel = Ext.create('Ext.form.Panel', {

            frame: true,
            width: 450,
            bodyPadding: 5,
            waitMsgTarget: true,

            fieldDefaults: {
                labelWidth: 150,
                msgTarget: 'side'
            },

            items: [{
                xtype: 'fieldset',
                defaultType: 'textfield',
                defaults: {
                    width: 350
                },
                items: [{
                    fieldLabel: 'Usuario',
                    emptyText: 'Usuario',
                    name: 'username_one',
                    id: 'username_one',
                    allowBlank: false,
                    padding: '5 0 0 0',
                    value: "administrador",
                    disabled:true
                    //blankText:  Packed.idioma.blankText
                }, {
                    fieldLabel: 'Contrase&ntilde;a',
                    emptyText: 'Contraseña',
                    inputType: 'password',
                    allowBlank: false,
                    name: 'password_one',
                    id: 'password_one',
                    vtype: 'password',
                    initialPassField: 'password_two'
                    //value: "administrador"
                    //blankText: Packed.idioma.blankText
                }, {
                    fieldLabel: 'Confirmar contrase&ntilde;a',
                    emptyText: 'Contraseña',
                    inputType: 'password',
                    allowBlank: false,
                    name: 'password_two',
                    id: 'password_two',
                   // value: "administrador",
                    vtype: 'password',
                    initialPassField: 'password_one'
                    //blankText: Packed.idioma.blankText
                  }
                ]
            }],

            buttons: [{
                text: 'Cancelar',
                iconCls: 'icon-remove',
                //tooltip : Packed.idioma.tooltipCancelar,
                action: 'closeWin'
            }, {
                text: 'Aceptar',
                iconCls: 'icon-ok',
                formBind: true,
                id: 'btnautentic',
                //tooltip : Packed.idioma.tooltipAceptar,
                action: 'change_password'
            }]
        });

        this.title = 'Cambiar contraseña',
            this.id = 'winchangepass',
            this.name = 'winchangepass',
            this.width = 450,
            this.height = 200,
            this.layout = 'fit',
            this.modal = true,
            this.resizable = false,
            this.autoShow = true,
            this.items = [
                this.formPanel
               // this.login
            ],
        this.callParent(arguments);
    }
});

