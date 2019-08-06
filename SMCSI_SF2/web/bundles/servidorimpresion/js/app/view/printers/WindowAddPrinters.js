/**
 * Created by adrian on 17/03/15.
 */
Ext.define('Pikota.view.WinAddPrinters', {
    extend: 'Ext.window.Window',
    alias: 'widget.WinAddPrinters',
    layout:"fit",
    width: "75%",
    height: "90%",
    modal: true,
    initComponent: function () {
        this.html = '<iframe id="iframeCups" src="' + dirCups + '" width="100%" height="100%"></iframe>';
        //this.title = 'Adicionar Impresora',
        this.bbar = [
            "->",
            {
                text: 'Finalizar',
                iconCls: 'icon-ok',
                name: 'add',
                id: 'finaddprinters',
                hidden: true,
                formBind: true,
                tooltip: 'Clic para aceptar',
                action: 'finalizar'
            }, {
                text: 'Finalizar',
                iconCls: 'icon-ok',
                name: 'mod',
                id: 'finmodprinters',
                formBind: true,
                hidden : true,
                tooltip: 'Clic para aceptar',
                action: 'finalizar'
            }
        ];
        this.callParent(arguments);
    }
});

