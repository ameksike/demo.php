/**
 * Created by adonis on 7/07/15.
 */
Ext.define('Tab.view.configuration.Server' ,{
    extend: 'Ext.form.FieldSet',
    alias: 'widget.Server',

    initComponent: function() {
        this.form = Ext.widget({
            xtype: 'form',
            //frame : true,
            id: 'idDatosServidor',
            margin: '2 5 5 5',
            bodyPadding: '5 40 5 40',
            fieldDefaults: {
                labelAlign: 'top',
                msgTarget: 'side'
            },
            tbar:[{
                text: 'Guardar',
                iconCls: 'icon-save',
                id: 'saveConfigS',
                action: 'saveConfigS',
                tooltip: 'Guardar datos del servidor de impresión<b>(Alt+G)</b>'
            }],
            items: [{
                xtype: 'container',
                anchor: '100%',
                layout: 'hbox',
                items:[{
                    xtype: 'container',
                    flex: 20,
                    layout: 'anchor',
                    items: [{
                        xtype:'textfield',
                        fieldLabel: 'Denominación',
                        name: 'iddenominacion',
                        margin: '0 5 5 5',
                        id: 'idenominacion',
                        allowBlank: false,
                        blankText: 'Este campo es obligatorio',
                        maxLength: 40,
                        maxLengthText: 'El tamaño máximo requerido es de 40 caracteres.',
                        anchor:'95%',
                        vtype: 'denominacion'
                    }]
                },{
                    xtype: 'container',
                    flex: 20,
                    layout: 'anchor',
                    items: [{
                        xtype:'textfield',
                        fieldLabel: 'Número de inventario',
                        name: 'idNoInventario',
                        anchor:'95%',
                        id: 'idNoInventario',
                        margin: '0 5 5 5',
                        allowBlank: false,
                        blankText: 'Este campo es obligatorio',
                        maxLength: 30,
                        maxLengthText: 'El tamaño máximo requerido es de 30 caracteres.',
                        displayField: 'name',
                        vtype: 'noInventario'
                    }]
                },{
                    xtype: 'container',
                    flex: 20,
                    layout: 'anchor',
                    items: [{
                        xtype:'textfield',
                        fieldLabel: 'Local',
                        name: 'idlocal',
                        anchor:'95%',
                        id: 'idlocal',
                        margin: '0 5 5 5',
                        allowBlank: false,
                        blankText: 'Este campo es obligatorio',
                        maxLength: 40,
                        maxLengthText: 'El tamaño máximo requerido es de 40 caracteres.',
                        displayField: 'name',
                        vtype: 'local'
                    }]
                },{
                    xtype: 'container',
                    flex: 20,
                    layout: 'anchor',
                    items: [{
                        xtype:'textfield',
                        fieldLabel: 'Operario',
                        name: 'idoperario',
                        anchor:'95%',
                        id: 'idoperario',
                        margin: '0 5 5 5',
                        allowBlank: false,
                        blankText: 'Este campo es obligatorio',
                        maxLength: 50,
                        maxLengthText: 'El tamaño máximo requerido es de 50 caracteres.',
                        displayField: 'name',
                        vtype: 'operario'
                    }]
                }]
            }]});

        this.title = 'Datos del servidor de impresión';
        this.collapsible = true;
        this.margin='0 10 0 10';
        //this.heigth = 100;
        // this.layout = 'fit',
        this.region = 'north';
        this.collapsed = false;
        this.items = [this.form];

        this.callParent(arguments);
    }
});
