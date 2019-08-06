Ext.define('Printers.view.user.fsHistorial' ,{
    extend: 'Ext.form.FieldSet',
    alias: 'widget.fsHistorial',
   
    initComponent: function() {
		this.storeImpresoras = Ext.create('Printers.store.impresoras');
		this.storeAccion = Ext.create('Printers.store.accion');
		
        this.form = Ext.widget({
        xtype: 'form',
        id: 'multiColumnForm',
        margin: '2 5 5 5',
        bodyPadding: '5 40 5 40',
        fieldDefaults: {
            labelAlign: 'top',
            msgTarget: 'side'
        },
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
                    fieldLabel: 'Usuario',
                    name: 'user',
                    margin: '0 5 5 5',
                    id: 'tfuser',
                    anchor:'95%'

                 
                }]
            },{
                xtype: 'container',
                flex: 20,
                layout: 'anchor',
                items: [{
                    xtype:'combo',
                    fieldLabel: 'Acción',
                    name: 'accion',
                    anchor:'95%',
                    id: 'cmbaccion',
                    margin: '0 5 5 5',
                    emptyText: 'Acción',
                    displayField: 'name',  
                    store: this.storeAccion,
                    queryMode: 'local',    
                    typeAhead: true,    
                    editable : false  
                }]
            },{
                xtype: 'container',
                flex: 20,
                layout: 'anchor',
                items: [{
                    xtype:'combo',
                    fieldLabel: 'Impresoras',
                    name: 'impresoras',
                    anchor:'95%',
                    id: 'cmbimpresoras',
                    emptyText: 'Impresoras',
                    displayField: 'name',  
                    store: this.storeImpresoras,
                    queryMode: 'local',    
                    typeAhead: true,
                    margin: '0 5 5 5',
                    editable : false  
                }]
            },{
                xtype: 'container',
				flex: 20,
                layout: 'anchor',
                items: [{
                    xtype:'datefield',
                    fieldLabel: 'Fecha',
                    name: 'fecha',
                    id: 'fecha',
                    anchor:'95%',
                    margin: '0 5 5 5',
                    vtypeText:"El valor es incorrecto.",
                    format:'Y-m-d',
                    invalidText:"{0} no es una fecha valida - debe estar en el formato {1}"
                }]
            },{
                xtype: 'container',
				flex: 20,
                //layout: 'anchor',
                items: [{ xtype:'smcsi.btn.export.pdf' },{
                    xtype:'button',
                    iconCls:'icon-search',
                    //text:'btn1',
                    margin : '20 0 0 2',
                    name: 'btnBusq',
                    action: 'ShearchGridMain',
                    width:23,
                    tooltip:'Filtrar búsquedad <b>(Alt+B)</b>'
                },{
                    xtype:'button',
                    iconCls:'icon-refresh',
                    margin : '20 0 0 2',
                    name: 'btnClearGrid',
                    id: 'btnClearGrid',
                    action: 'ClearGridMain',
                    width:23,
                    tooltip:'Limpiar búsquedad <b>(Alt+L)</b>'
                }]
            }]
        }]});
        this.title = 'Filtrar búsqueda';
        this.collapsible = true;
        this.margin='0 10 0 10';
        this.region = 'north';
        this.items = [this.form];
        this.collapsed = false;
        this.callParent(arguments);
    }
});
