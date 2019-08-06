/**
 * Created by adrian on 17/03/15.
 */

Ext.define("Pikota.views.cuota", {
    extend: 'Ext.window.Window',
    alias : 'widget.cuota',

    initComponent:function(){

        this.treeCuotas = Ext.widget('treeCuotas');

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
                defaults: {
                    width: 275
                },
                layout:'column',
                items: [{

                    columnWidth: .5,
                    items:[{
                        xtype: 'textfield',
                        fieldLabel: 'Nombre',
                        emptyText: 'Nombre',
                        name: 'tfuserCuota',
                        id: 'tfuserCuota',
                        allowBlank: false,
                        blankText: 'Este campo es obligatorio',
                        padding :'5 0 0 0',
                        vtype: 'alfaEspase',
                        minLength: 5,
                        minLengthText: 'La longitud minima es 5.',
                        maxLength: 20,
                        maxLengthText: 'La longitud maxima es 20.'
                        //blankText:  Packed.idioma.blankText
                    },
                        {
                            xtype     : 'textareafield',
                            grow      : true,
                            name      : 'taDescrip',
                            id        : 'taDescrip',
                            fieldLabel: 'Descripción',
                            emptyText : 'Descripción',
                            anchor    : '92%',
                            height    : 180
                        },{
                            xtype: 'container',
                            anchor: '100%',
                            layout: 'hbox',
                            items:[{
                                    xtype: 'numberfield',
                                    fieldLabel: 'Cuota',
                                    emptyText: 'Cuota',
                                    name: 'numbercuota',
                                    id: 'numbercuota',
                                    //allowBlank: false,
                                    width: 120,
                                    // padding :'5 0 0 0',
                                    maxValue: 500,
                                    minValue: 0,
                                    maxText : 'El número máximo permitido es {0}',
                                    disabled: true
                                },{
                                    xtype:'button',
                                    iconCls:'icon-flag-alt',
                                    margin : '20 0 0 5',
                                    name: 'btnasignar',
                                    id: 'btnasignar',
                                    action: 'asignar',
                                    disabled: true,
                                    //flex:1,
                                    //width:23,
                                    tooltip:'Asignar cuota'
                                }]

                        }]
                    //html: 'Content'
                },{

                    columnWidth: .5,
                    items:[this.treeCuotas]
                }]

                /*items: [
                ]*/
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
                //tooltip : Packed.idioma.tooltipAceptar,
                action:'actioncuota'
            }]
        });

        this.title = 'Adicionar grupo de usuarios',
        this.id = 'winCuota',
        this.name = 'winCuota',
        this.width = 500,
        this.height = 420,
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
