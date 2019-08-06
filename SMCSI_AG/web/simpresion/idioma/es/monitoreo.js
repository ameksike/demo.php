/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
idiom.monitor = {
    'title': 'Monitoreo de servidores',
    'general': {
        'title': 'Monitoreo General',
        'user': 'El tamaño m&aacute;ximo requerido es de 30 caracteres',
        'ip': 'El tamaño m&aacute;ximo requerido es de 15 caracteres',
        'filter': {
            'title': 'Filtar por conceptos',
            'printer': 'Impresora:',
            'user': 'Usuario:',
            'action': 'Acci&oacute;n:',
            'ip': 'Direcci&oacute;n IP:'
        },
        'btn': {
            'search': 'Buscar impresiones <b>(Alt+B)</b>',
            'eraser': 'Limpiar filtro(s) <b>(Alt+L)</b>'
        },
        'validate':{
			maxLengthText: 'El tamaño m&aacute;ximo requerido es de 30 caracteres',
			maxLengthText2: 'El tamaño m&aacute;ximo requerido es de 15 caracteres',
			user: 'El campo solo admite letras del alfabeto ingl&eacute;s, d&iacute;gitos y los caracteres (.) (-) (_)'
		},
        'details': 'Detalles',
        'names': '<b>Nombre y Apellidos:</b>',
        'groups': '<b>Grupo del Usuario:</b>',
        'docs': '<b>T&iacute;tulo del trabajo:</b>',
        'printer': '<b>Grupo de impresora:</b>',
        'grid':{
            'title': 'Historial de impresiones',
            'allow': 'Permitidas',
            'deny': 'Denegadas',
            'cancel': 'Canceladas',
            'warn': 'Advertidas',
            'user': 'Usuario',
            'action': 'Acci&oacute;n',
            'printer': 'Impresora',
            'cost': 'Costo',
            'page': 'P&aacute;ginas',
            'work': 'Trabajos',
            'total': 'Total',
            'ip': 'Direcci&oacute;n IP',
            'date': 'Fecha',
            'displayMsg': 'Mostrando {0} - {1} de {2}',
            'emptyMsg': "No existen datos para mostrar.",
			beforePageText: 'Página',
			afterPageText: 'de {0}',
			firstText: 'Primera Página',
			prevText: 'Página anterior',
			nextText: 'Página siguiente',
			lastText: 'Última Página',
			refreshText: 'Actualizar'
        },
        'date': {
            todayText : 'Hoy',
            minText : 'Esta fecha es anterior a la fecha m&iacute;nima',
            maxText : 'Esta fecha es posterior a la fecha m&aacute;xima',
            nextText : 'Mes Pr&oacute;ximo (Control+Right)',
            prevText : 'Mes Anterior (Control+Left)',
            monthYearText : 'Escoja el mes (Control+Up/Down para moverse por los años)'
        },
        action: {
			'warn' : 'Alvertencia',
			'allow': 'Permitida',
			'deny' : 'Denegada',
			'cancel': 'Cancelada'
		}
    },
    'audit': {
        'title': 'Auditor&iacute;a',
        'center': 'Reportes Estad&iacute;sticos',
        'btn': {
            'search': 'Buscar impresiones <b>(Alt+B)</b>',
            'eraser': 'Limpiar filtro(s) <b>(Alt+L)</b>'
        },
        'filter': {
            'title': 'Filtar por conceptos',
            'char': 'Tipo de gr&aacute;fica:',
            'dateout': 'Hasta:',
            'datein': 'Desde:'
        },
        'region': {
            'request': 'Solicitudes de impres&iacute;on',
            'printer': 'Impresiones',
            'action': 'Tipo de acci&oacute;n',
            'cost': 'Costo de impresi&oacute;n'
        },
        'char': {
            'bar': {
                'name': 'Barra'
            },
            'line': {
                'name': 'Curva'
            },
            'pie': {
                'name': 'Pastel'
            }
        },
        'grid':{
            'title': 'Historial de impresiones',
            'allow': 'Permitidas',
            'deny': 'Denegadas',
            'cancel': 'Canceladas',
            'warn': 'Advertidas',
            'user': 'Usuario',
            'action': 'Acci&oacute;n',
            'printer': 'Impresora',
            'cost': 'Costo',
            'page': 'P&aacute;ginas',
            'work': 'Trabajos',
            'total': 'Total',
            'ip': 'Direcci&oacute;n IP',
            'date': 'Fecha',
            'displayMsg': 'Mostrando {0} - {1} de {2}',
            'emptyMsg': "No existen datos para mostrar"
        },
        'msg':{
			'date': 'La fecha límite debe ser mayor que la inicial.'
		}
    },
    'printer': {
        'title': 'Monitoreo de Impresoras',
        'list': 'No existen datos que mostrar.',
        'info': 'Informaci&oacute;n',
        'filter': {
            'title': 'Filtar por conceptos',
            'printer': 'Impresora:'
        },
        'btn': {
            'search': 'Buscar impresiones <b>(Alt+B)</b>',
            'eraser': 'Limpiar filtro(s) <b>(Alt+L)</b>'
        },
        'grid': {
            'title': 'Listado de impresoras',
            'printer': 'Impresora',
            'user': 'Usuario',
            'page': 'P&aacute;ginas',
            'work': 'Trabajos',
            'request': 'Solicitudes',
            'allow': 'Permitidas',
            'deny': 'Denegadas',
            'cancel': 'Canceladas',
            'warn': 'Advertidas'
        },
        'emptyMsg': "No existen datos para mostrar",
        'displayMsg': 'Mostrando {0} - {1} de {2}'
    },
    'user': {
        'title': 'Monitoreo de Usuarios',
        'list': 'No existen datos que mostrar.',
        'info': 'Informaci&oacute;n',
        'field': 'El campo solo admite n&uacute;meros y letras',
        'emptyMsg': "No existen datos para mostrar",
        'displayMsg': 'Mostrando {0} - {1} de {2}',
        'btn': {
            'search': 'Buscar impresiones <b>(Alt+B)</b>',
            'eraser': 'Limpiar filtro(s) <b>(Alt+L)</b>'
        },
        'filter': {
            'title': 'Filtar por conceptos',
            'user': 'Usuario:'
        },
        'grid': {
            'title': 'Listado de usuarios',
            'user': 'Usuario',
            'page': 'P&aacute;ginas',
            'work': 'Trabajos',
            'request': 'Solicitudes',
            'allow': 'Permitidas',
            'deny': 'Denegadas',
            'cancel': 'Canceladas',
            'warn': 'Advertidas'
        }
    },
    'server': {
        'title': 'Servidores de impresión',
        'msgsave': 'El estado de los servidores ha sido guardado satisfactoriamente.',
        'info': 'Informaci&oacute;n',
        'btn': {
            'freq': 'Establecer frecuencia de actualizaci&oacute;n de monitoreo <b>(Alt+F)</b>',
            'save': 'Guardar el estado de los servidores <b>(Alt+G)</b>'
        },
        'winf': {
            'btn': {
                'cancel': 'Cerrar ventana sin guardar los datos <b>(Alt+X)</b>',
                'ok': 'Guardar los datos y cerrar ventana <b>(Enter)</b>'
            },
            'cancel': 'Cancelar',
            'ok': 'Aceptar',
            'label': 'Actualizar cada:',
            'label2': 'segundos'
        }
    }
};
idiom.help = {
	'title': 'Ayuda',
	'tooltip': 'Ayuda <b>(Alt+H)</b>'
};
