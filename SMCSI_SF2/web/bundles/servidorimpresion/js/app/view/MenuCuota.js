/**
 * Created by adrian on 23/03/15.
 */

Ext.define('Pikota.views.menuCuota', {
    extend: "Ext.menu.Menu",
    alias: 'widget.menuCuota',

    initComponent: function () {
        this.id = 'menuCuota';
        this.items = [/*{
            text: 'Asignar cuota',
            iconCls:'icon-flag',
            action:'asigcuota'
        },*/{
            text: 'Modificar grupo',
            iconCls:'icon-edit',
            action:'modcuota'
        }];

        this.callParent(arguments);
    }
});