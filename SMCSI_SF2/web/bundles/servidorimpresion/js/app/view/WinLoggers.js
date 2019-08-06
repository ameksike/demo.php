/**
 * Created by adrian on 17/03/15.
 */
Ext.define('Pikota.view.WinLoggers', {
    extend: 'Ext.window.Window',
    alias: 'widget.winLoggers',

    initComponent: function () {


        this.form = Ext.create('Ext.form.Panel', {

            labelWidth: 100,
            frame: true,
            bodyStyle: 'padding:5px 5px 0',
            labelAlign: 'top',
            layout:'fit',
            items: [{
                // Fieldset in Column 1 - collapsible via toggle button
                xtype:'fieldset',
                //title: 'asd',
                defaults: {
                    labelAlign: 'top'
                },
                //collapsible: true,

                items :[{
                    xtype: 'textfield',
                    fieldLabel: 'Nombre',
                    name: 'nameuser',
                    allowBlank: false,
                    blankText: 'Este campo es requerido',
                    id: 'nameuser',
                    anchor:'100%'

                },{
                    xtype: 'textfield',
                    fieldLabel: 'Descripcion',
                    name: 'descrip',
                    id: 'url',
                    emptyText: 'Descripcion',
                    anchor:'100%'


                }]
            }],
            buttons: [{
                text: 'Cancelar',
                iconCls: 'icon-remove',
                tooltip : 'Clic para cancelar',
                action:'closeWin'
            },{
                text: 'Aceptar',
                iconCls: 'icon-ok',
                name: 'aceptarRepo',
                id: 'aceptarRepo',
                formBind: true,
                tooltip : 'Clic para aceptar',
                action:'aceptarRepo'
            }]
        });

            this.title =  'Adicionar usuario',
            this.layout = 'fit',
            this.autoShow = true,
            this.height = 215,
            this.width = 350,
            this.modal = true,
            this.resizable = false,
            this.closable = true,
            this.closeAction = 'destroy',
            this.id = 'winLogger',
            this.name = 'winLogger',
            //this.layout = 'fit',
            this.items = [this.form]

        this.callParent(arguments);
    }
});
