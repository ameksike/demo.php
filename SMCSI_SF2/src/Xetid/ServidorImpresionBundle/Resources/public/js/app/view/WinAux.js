/**
 * Created by adrian on 17/03/15.
 */

Ext.define("Pikota.views.Aux", {
    extend: 'Ext.window.Window',
    alias : 'widget.aux',

    initComponent:function(){

        this.formPanel = Ext.create('Ext.form.Panel', {

            frame: true,
            width: 340,
            bodyPadding: 5,
            waitMsgTarget: true,
            layout:'fit',
            fieldDefaults: {

                labelWidth: 85,
                msgTarget: 'side',
                labelAlign : 'top'
            },

            items: [{
                xtype: 'fieldset',
                defaultType: 'textfield',
                defaults: {
                    width: 275
                },
                items: [{
                    fieldLabel: this.fieldLabelTf,
                    emptyText: this.fieldLabelTf,
                    name: 'user',
                    id: 'user',
                    allowBlank: false,
                    blankText: 'Este campo es obligatorio',
                    padding :'5 0 0 0',
                    vtype: (this.fieldLabelTf == 'Nombre') ? 'alfaEspase':'alphanum',
                    value: this.valueName,
                    minLength:5,
                    minLengthText:'La longitud minima es 5.',
                    maxLength: 20,
                    maxLengthText: 'La longitud maxima es 20.'
                    //blankText:  Packed.idioma.blankText
                },
                    {
                        xtype     : (this.fieldLabelTf == 'Nombre') ? 'textareafield' : 'textfield',
                        grow      : true,
                        name      : 'descrip',
                        id        : 'descrip',
                        fieldLabel: this.fieldLabelTa,
                        emptyText : this.fieldLabelTa,
                        anchor    : '92%',
                        value     : this.valueDescription,
                        height    : (this.fieldLabelTf == 'Nombre') ? 180 : ''
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
                id: 'btnaddAux',
                //tooltip : Packed.idioma.tooltipAceptar,
                action:'addAux'
            }]
        });

        //this.title = 'Adicionar grupo',
        this.id = 'winAux',
        this.name = 'winAux',
        this.width = 350,
        this.height = (this.fieldLabelTf == 'Nombre') ? 360 : 235,
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
