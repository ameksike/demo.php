/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		31/07/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
Ext.define('DomHelper.Style', {
    singleton: true,
	list: {},
    create: function(id, container){
		id = id || 'default';
		var container = container ? container : (document.head || document.getElementsByTagName('head')[0]);
		var style = document.createElement('style');
		style.type = 'text/css';
		style.setAttribute('id', id);
		container.appendChild(style);
		this.list[id] = style;
		return this;
	},
	add: function(key, cfg, element){
		key = key || '';
		cfg = cfg || '';
		cfg = typeof(cfg) == 'object' ? this.stringify(cfg) : cfg;
		element = element || 'default';
		element = typeof(element) == 'object' ? element : this.list[element];
		
		var str = key +' '+ cfg;
		if (element.styleSheet){
			element.styleSheet.cssText = str;
		} else {
			element.appendChild(document.createTextNode(str));
		}
		return this;
	},
	stringify: function(obj){
		var str = "{ ";
		for(var i in obj)
			str += i + ":" + obj[i] + "; ";
		return str + " }";
	},
    setting: function(element, property, value, important) {
		//remove previously defined property
		if (element.style.setProperty)
			element.style.setProperty(property, '');
		else
			element.style.setAttribute(property, '');
		//insert the new style with all the old rules
		element.setAttribute('style', element.style.cssText +
			property + ':' + value + ((important) ? ' !important' : '') + ';');
	}
});
