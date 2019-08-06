Ext.application({
    name: 'Printers',

    appFolder: 'app',
	controllers : [ 'Users', 'Report', 'Alert' ],
    launch: function() {
        Ext.apply(Ext.form.field.VTypes, {
            IPAddress: function (v) {
                //return /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/.test(v);
                return /^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/.test(v);
            },
            IPAddressText: 'Debe ser una IP válida',
            IPAddressMask: /[\d\.]/i
        });
        Ext.apply(Ext.form.field.VTypes, {
            password: function (val, field) {
                if (field.initialPassField) {
                    var pwd = Ext.getCmp(field.initialPassField);
                    return (val == pwd.getValue());
                }
                return true;
            },
            passwordText: 'Contraseñas incorrectas'
        });
        Ext.apply(Ext.form.field.VTypes, {
           alfaEspase: function (v) {
                return /^([a-zA-ZáéíóúñüÑ]+ ?[a-zA-ZáéíóúñüÑ]*)+$/.test(v);
            },
            alfaEspaseText: 'Solo admite letras, espacios y debe empesar con una letra'

        });
        Ext.apply(Ext.form.field.VTypes, {
            denominacion: function (v) {
                return /^([a-zA-ZáéíóúñüÑ]+[a-zA-ZáéíóúñüÑ0-9]*)+$/.test(v);
            },
            denominacionText: 'Solo admite caracteres alfanuméricos'

        });
        Ext.apply(Ext.form.field.VTypes, {
            noInventario: function (v) {
                return /^([a-zA-ZáéíóúñüÑ0-9]*)+$/.test(v);
            },
            noInventarioText: 'El campo solo admite números y letras'

        });
        Ext.apply(Ext.form.field.VTypes, {
            local: function (v) {
                return /^([a-zA-ZáéíóúñüÑ]+[a-zA-ZáéíóúñüÑ0-9_]*)+$/.test(v);
            },
            localText: 'El campo solo admite letras, números y el caracter especial (_)'

        });
        Ext.apply(Ext.form.field.VTypes, {
            operario: function (v) {
                return /^([a-zA-ZáéíóúñüÑ]+ ?[a-zA-ZáéíóúñüÑ]*)+$/.test(v);
            },
            operarioText: 'El campo solo admite letras y espacio'

        });
	    Ext.widget ('principal');
    }
});
