/**
 * Created by adrian on 17/03/15.
 */

Ext.define("Printers.views.Autentication", {
    extend: 'Ext.window.Window',
    alias : 'widget.autentication',

    initComponent:function(){

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
                    fieldLabel: 'Usuario',
                    emptyText: 'Usuario',
                    name: '_username',
                    id: '_username',
                    allowBlank: false,
                    blankText: 'Este campo es obligatorio',
                    padding :'5 0 0 0',
                    value: "administrador"
                    //blankText:  Packed.idioma.blankText
                }, {
                    fieldLabel:  'Contrase&ntilde;a',
                    emptyText: 'Contraseña',
                    inputType: 'password',
                    allowBlank: false,
                    blankText: 'Este campo es obligatorio',
                    name: '_password',
                    id: '_password',
                    //value : "administrador"
                    //blankText: Packed.idioma.blankText
                }
                ]
            }],

            buttons: [{
                text: 'Cancelar',
                iconCls: 'icon-remove',
                //tooltip : Packed.idioma.tooltipCancelar,
                action:'closeWin'
            },{
                text:'Aceptar',
                iconCls: 'icon-ok',
                formBind: true,
                id:'btnautentic',
                //tooltip : Packed.idioma.tooltipAceptar,
                action:'aceptarWin'
            }]
        });

        this.title = 'Autenticar usuario',
            this.id = 'winAutentication',
            this.name = 'winAutentication',
            this.width = 350,
            this.height = 160,
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
