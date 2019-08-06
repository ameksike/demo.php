Ext.define('Pikota.view.user.GridGroupPrinters' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.gridGroupPrinters',
    region: 'center',
    initComponent: function() {

    var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 2
    });

    this.id = 'gridGroupPrinters',
    this.storePrinter= Ext.create('Pikota.store.printers');
	this.store =this.storePrinter,
    this.plugins =  [cellEditing],

        this.columns = [
        { text: 'Denominación',  dataIndex: 'printername',  width:200},
        { text: 'Descripción', dataIndex: 'description', flex: 1, editor: {
            allowBlank: false
        }},
        {text: 'Grupo', dataIndex: 'groupname', width: 200},
        { text: 'Precio por página ($)', dataIndex: 'priceperpage',flex: 1,renderer: 'usMoney',editor: {
            xtype: 'numberfield',
            allowBlank: false,
            minValue: 0,
            maxValue: 100000
        }},
        { text: 'Precio por trabajo ($)', dataIndex: 'priceperjob',flex: 1,renderer: 'usMoney',editor: {
            xtype: 'numberfield',
            //allowBlank: false,
            minValue: 0,
            maxValue: 100000
        }},
        { text: 'Máximo número de páginas', dataIndex: 'maxjobsize',flex: 1,editor: {
            xtype: 'numberfield',
            //allowBlank: false,
            minValue: 0,
            maxValue: 500
        }}
		];
		
		this.tbar = [{text: 'Guardar cambios',iconCls:'icon-save',id: 'save_printers',action:'savechanges',tooltip:'Guardar cambios <b>(Alt+H)</b>'}],
        this.viewConfig = {
            loadingText: 'Cargando datos',
            plugins: {
                ptype: 'gridviewdragdrop',
                //dropGroup: 'fourGridDDGroup',
                dragGroup: 'threeGridDDGroup',
                dragText: "{0} Fila seleccionada{1}"
            }
        },

            this.bbar = Ext.create('Ext.PagingToolbar', {
                store: this.storePrinter,
                displayInfo: true,
                emptyMsg: '0 Resultado a mostrar',
                displayMsg: 'Mostrando de {0} - {1} de {2}',
                beforePageText: 'Página',
                afterPageText: 'de {0}',
                firstText: 'Primera Página',
                prevText: 'Página anterior',
                nextText: 'Página siguiente',
                lastText: 'Última Página',
                refreshText: 'Actualizar'

            })
        this.callParent(arguments);
    }
});
