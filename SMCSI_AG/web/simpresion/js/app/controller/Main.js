/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.Main', {
    extend: 'MSI.controller.Module',
    requires: ['Ext.picker.Date'],
    init: function () {
		var self = this;
        this.control({
            '#viewport-question': {
                click: function () {
                    self.onquestion.apply(self, arguments);
                }
            }
        });
        var map = new Ext.util.KeyMap({
            target: Ext.getBody(),
            binding: [{
                key: "h",
                alt: true,
                scope: this,
                fn: this.onquestion
            }]
        });

        Ext.override(Ext.picker.Date, {
            todayText : idiom.monitor.general.date.todayText,
            minText : idiom.monitor.general.date.minText,
            maxText : idiom.monitor.general.date.maxText,
            nextText : idiom.monitor.general.date.nextText,
            prevText : idiom.monitor.general.date.prevText,
            monthYearText : idiom.monitor.general.date.monthYearText
        });
    },
    onquestion: function(key, e){
        e.preventDefault();
        if(!this.win2)
			this.win2 = Ext.create('Ext.window.Window',{
				title: idiom.help.title,
				id : 'winAux',
				width: '60%',
				height:'50%',
				closeAction: 'hide',
				maximizable: true,
				collapsible: true,
				html: '<iframe id="iframeCups" src="http://10.12.34.20:4900/bundles/servidorimpresion/help/index.html" style="width: 100%; height: 100%"></iframe>'
			});
		this.win2.show();
	}
});

