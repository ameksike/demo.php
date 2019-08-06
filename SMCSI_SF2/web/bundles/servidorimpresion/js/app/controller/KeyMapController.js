/**
 * Created by adrian on 24/03/15.
 */
Ext.define('Printers.controller.keymap', {

    alias: 'widget.keymapController',

    init: function (){},

    pressAltG: function(_this){

            this.newGrupo = new Ext.KeyMap(Ext.getBody(), {
                key: Ext.EventObject.G,
                alt: true,
                //  defaultEventAction:'stopEvent',
                fn: function () {
                    var btn = Ext.getCmp('btnaddGrups');
                    if(!btn.isDisabled()){
                        _this.addGrups();
                    }

                },
                scope: _this
            });

    },

    pressAltR: function (_this) {

        this.delGrupo = new Ext.KeyMap(Ext.getBody(), {
            key: Ext.EventObject.R,
            alt: true,
            //  defaultEventAction:'stopEvent',
            fn: function () {

                var btn = Ext.getCmp('btnadelGrups');
                if(!btn.isDisabled()){
                    _this.delGrups();
                }
            },
            scope: _this
        });
    },

    pressAltB: function (_this) {

        this.filtrar = new Ext.KeyMap(Ext.getBody(), {
            key: Ext.EventObject.B,
            alt: true,
            //  defaultEventAction:'stopEvent',
            fn: function () {
                _this.shearchGridMainGridMains();

            },
            scope: _this
        });
    },

    pressAltL: function (_this) {

        this.limpiar = new Ext.KeyMap(Ext.getBody(), {
            key: Ext.EventObject.L,
            alt: true,
            //  defaultEventAction:'stopEvent',
            fn: function () {
                    _this.reloadGridMains();

            },
            scope: _this
        });
    },

    pressAltS: function (_this) {

            this.adduser = new Ext.KeyMap(Ext.getBody(), {
                key: Ext.EventObject.S,
                alt: true,
                fn: function () {
                    _this.addWin();
                },
                scope: _this
            });


    },

    pressAltH: function(_this){

            this.guardar = new Ext.KeyMap(Ext.getBody(), {
                key: Ext.EventObject.H, // or Ext.EventObject.ENTER
                alt: true,
                fn: function () {
                    _this.savechanges();
                },
                scope: _this
            });

    },

    pressAltX: function(_this, win){

        this.close = new Ext.KeyMap(win.getEl(), {
            key: Ext.EventObject.X,
            alt: true,
            //  defaultEventAction:'stopEvent',
            fn: function () {
                win.close();
            },
            scope: _this
        });
    },

    pressEnter: function(_this, win){

        this.enter = new Ext.KeyMap(win.getEl(), {
            key: Ext.EventObject.ENTER,
            //  defaultEventAction:'stopEvent',
            fn: function () {
                switch (win.getId()) {
                    case 'winAutentication':
                        var btn = Ext.getCmp('btnautentic');
                        if(!btn.isDisabled()){
                            _this.submitlogin(btn);
                        }
                        break;
                    case 'winAux':
                        var btn = Ext.getCmp('btnaddAux');
                        if(!btn.isDisabled()){
                            _this.addAux(btn);
                        }
                    break;


                }

            },
            scope: _this
        });
    }
});