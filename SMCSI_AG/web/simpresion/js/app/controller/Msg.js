/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		31/07/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.Msg', {
    singleton: true,
    constructor : function(config){
        this.lst = {};
        if(!this.msgdiv)
            this.msgDiv = Ext.DomHelper.append(document.body, {id: 'msgDiv'}, true);
    },
    createBox: function(msg, cls){
        return Ext.String.format('<div class="{0}">{1}</div>', cls, msg);
    },
    createMsg: function(cfg){
        var cfg = cfg || {};
        cfg.cls = cfg.cls || 'msgDefault';
        cfg.text = cfg.text || ' - ';
        cfg.div = cfg.div || this.msgDiv;
        return Ext.DomHelper.append(cfg.div, this.createBox(cfg.text, cfg.cls), true);
    },
    show: function (cfg ) {
        var cfg = cfg || {};
        cfg.cls = cfg.cls || 'msgDefault';
        cfg.index = cfg.index || cfg.cls;
        cfg.text = cfg.text || ' - ';
        if(!this.lst[cfg.index ])
            this.lst[cfg.index ] = this.createMsg(cfg);
        this.lst[cfg.index ].fadeIn({
            opacity: 1,
            easing: 'backIn'
        });
    },
    hide:function(index){
		index = index || this.lst;
		if(typeof(index) == 'object'){
			for(var i in index)
                this.hide(i);
		}
        if(this.lst[index]){
            this.lst[index].fadeOut({
                opacity: 0,
                easing: 'backIn',
                duration: 500
            });
        }
    }
});
