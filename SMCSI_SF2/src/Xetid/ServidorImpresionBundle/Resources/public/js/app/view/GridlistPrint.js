Ext.define('Printers.view.user.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.printerslist',

    title: 'Historial de impresiones',
    region: 'center',
    margin: '0 10 0 10',
    initComponent: function() {
        this.storeGrid = Ext.create('Printers.store.gridprinter');
		this.id = 'gridGrupoUsers';
        this.store = this.storeGrid;

        this.viewConfig = {
            loadingText: 'Cargando datos'
        },

        this.columns = [
            {header: 'Usuario',  dataIndex: 'user',  flex: 1},
            {header: 'Acci&oacute;n', dataIndex: 'action', flex: 1},
            {header: 'Impresora', dataIndex: 'impresora', flex: 1},
            {header: 'P&aacute;ginas', dataIndex: 'pag', flex: 1},
            {
                header: 'Costo',
                columns: [
                    {header: 'Página ($)',dataIndex: 'priceperpage',flex: 1},
                    {header: 'Trabajo ($)',dataIndex: 'priceperjob', flex:1 },
                    {header: 'Total ($)', dataIndex: 'costo', flex: 1}
                ]
            },

            {header: 'Direcci&oacute;n IP', dataIndex: 'dirip', flex: 1},
            {header: 'Fecha', dataIndex: 'fecha', flex: 1},

        ]
        this.bbar = Ext.create('Ext.PagingToolbar', {
            store: this.storeGrid,
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
