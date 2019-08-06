/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('MSI.controller.Module', {
    extend: 'Ext.app.Controller',
    modules: [],
    modns: '',
    construct:function(parent){
        parent.control(this.delegate());
    },
    loading: function(score, ns){
        score = score || this;
        ns = ns || score.modns;
        for(var i in score.modules){
            if(typeof(score.modules[i]) === 'string'){
                var ali = score.modules[i].toLowerCase();
                score[ali] = this.getController(ns+'.'+score.modules[i]);
                if(score[ali].construct){
                    score[ali].construct.call(score[ali], score);
                }
                if(score[ali].init){
                    score[ali].init.call(score[ali], score);
                }
            }
        }
    },
    keymap: function(cfg){

    },
    toolTip: function (cfg) {
        return Ext.create('Ext.tip.ToolTip', cfg);
    }, 
    send: function(msg){
		msg.url = msg.url || 'index';
		msg.score = msg.score || this;
		msg.success = msg.success || function(response){
			if(msg.callback){
				msg.callback.apply(msg.score, [
                    (msg.format) ? JSON.parse(response.responseText) : response.responseText,
					response.responseText, 
					arguments, 
					msg
				]);
			}
		}
		Ext.Ajax.request(msg);
	},
    delegate: function(score){
        score = score || this;
        for(var i in score.modules)
            if(score.modules[i].delegate)
                score.control(score.modules[i].delegate());
    },
    msg: function(){
        var obj = Ext.create('MSI.controller.Msg');
        obj.msg.apply(obj, arguments);
    }
});
