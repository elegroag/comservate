"use strict";

var Model = {};
var Collection = {};
var View = {};
var Routers = {};

const capitalize = function (_string) {
	if (typeof _string !== "string") return "";
	let exp = _string.toLowerCase().split(" ");
	if (exp.length == 1) {
		_string = exp[0].charAt(0).toUpperCase() + exp[0].slice(1);
	}
	if (exp.length > 1) {
		var parts = new Array();
		_.each(exp, function (parte) {
			parts.push(parte.charAt(0).toUpperCase() + parte.slice(1));
		});
		_string = parts.join(" ");
	}
	return _string;
};

const valNumeric = function (element) {
	let frag = element.value.split(/([0-9])/);
	let number = _.filter(frag, function (item) {
		return /[0-9]/.test(item) ? item : null;
	});
	$(element).val(number.join(""));
};

const formatMoney = function (valor, fixFloat = 2) {
	return (
		"$ " +
		valor.toFixed(fixFloat).replace(/,/g, function (c, i, a) {
			return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
		})
	);
};

const valMoney = function (element) {
	let ext = element.value.replace("$", "").trim().split(".");
	let segment = void 0;
	let frag;
	if (ext.length == 2) {
		frag = ext[0];
		segment = ext[1].substr(0, 2);
	} else {
		frag = ext[0];
	}
	frag = frag.split(/([0-9])/);
	let number = _.filter(frag, function (item) {
		return /[0-9]/.test(item) ? item : null;
	});
	if (segment) {
		$(element).val("$ " + number.join("") + "." + segment);
	} else {
		$(element).val(formatMoney(parseInt(number.join(""))));
	}
};

const cleanFormatMoney = function (valor) {
	return valor.replace(/[a-zA-Z_\$\-]/g, "");
};

const Testeo = (function ($, _) {
	const render = function (out, target, msj) {
		let _html = $(`[${out}='${target}']`).html();
		_html = _html == "" ? msj : _html + "<br/>" + msj;
		$(`[${out}='${target}']`).html(_html);
		if (!$(`[name='${target}']`).hasClass("is-invalid")) {
			$(`[name='${target}']`).toggleClass("is-invalid");
		}
		setTimeout(function () {
			$(`[${out}='${target}']`).html("");
			$(`[name='${target}']`).removeClass("is-invalid");
		}, 3000);
	};
	const es_telefono = function (attr, target = void 0, out = false) {
		let telefono = /^([0-9]){7,10}$/;
		if (!telefono.test(attr)) {
			let msj =
				"<span>El campo teléfono debe ser un valor númerico entre 7 o 10 dígitos.</span>";
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};
	const es_numerico = function (attr, target = void 0, out = false) {
		let numerico = /^([0-9]+){0,20}$/;
		if (!numerico.test(attr)) {
			let msj = `<span>El campo ${target} debe ser un valor númerico</span>`;
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};
	const es_decimal = function (attr, target = void 0, out = false) {
		let numerico = /^([0-9\.\,]+){0,20}$/;
		if (!numerico.test(attr)) {
			let msj = `<span>El campo ${target} debe ser un valor númerico decimal</span>`;
			if (out) render(out, target, msj);
			return msj;
		} else {
			attr = parseFloat(attr);
			if (!attr) {
				let msj = `<span>El campo ${target} debe ser un valor númerico decimal</span>`;
				if (out) render(out, target, msj);
				return msj;
			}
		}
		return false;
	};
	const tiene_espacios = function (attr, target = void 0, out = false) {
		let espacios = /\s/;
		if (espacios.test(attr)) {
			let msj = `<span>El campo ${target} no puede contener espacios</span>`;
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};
	const esta_vacio = function (attr, target = void 0, out = false) {
		if (attr == "" || attr == void 0 || attr == undefined || attr == null) {
			let msj = `<span>El campo ${target} no puede estar indefinido o vacío</span>`;
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};
	const es_email = function (attr, target = void 0, out = false) {
		let email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!email.test(attr)) {
			let msj = "<span>La dirección de email no es un valor valido.</span>";
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};
	const es_identificacion = function (attr, target = void 0, _min = 1, _max = 100, out = false) {
		let numerico = /^([0-9]+){1,100}$/;
		if (!numerico.test(attr)) {
			let msj = `<span>El campo ${target} debe ser un valor valido.</span>`;
			if (out) render(out, target, msj);
			return msj;
		} else {
			let express = new RegExp("^([0-9]+){" + _min + "," + _max + "}", "i");
			if (!express.test(attr)) {
				let msj = `<span>El campo debe ser un valor entre ${_min} y ${_max} dígitos.</span>`;
				if (out) render(out, target, msj);
				return msj;
			}
		}
		return false;
	};
	const es_fija_longitud = function (attr, target = void 0, _longitud = 1, out = false) {
		let express = new RegExp("^([0-9]+){" + _longitud + "}", "i");
		if (!express.test(attr)) {
			let msj = `<span>El campo ${target} debe ser un valor entre ${_longitud} dígitos.</span>`;
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};

	const es_fecha = function (attr, target = void 0, out = false) {
		let fecha = /^([0-9]+){4}(\-|\/)?([0-9]+){2}(\-|\/)?([0-9]+){2}$/;
		if (!fecha.test(attr)) {
			let msj = `<span>El campo ${target} debe ser un valor de fecha valido.</span>`;
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};

	const menor_que = function (attr, target = void 0, out = false, longitud = 1) {
		if (attr == "") {
			return false;
		}
		if (_.size(attr) > parseInt(longitud)) {
			let msj = `<span>El campo ${target} no puede ser mayor de ${longitud} caracteres.</span>`;
			if (out) render(out, target, msj);
			return msj;
		}
		return false;
	};
	return {
		espacio: tiene_espacios,
		numerico: es_numerico,
		decimal: es_decimal,
		vacio: esta_vacio,
		email: es_email,
		telefono: es_telefono,
		identi: es_identificacion,
		fija_longitud: es_fija_longitud,
		date: es_fecha,
		menor: menor_que,
	};
})(jQuery, _);

const TABLE_LENGUAJE = {
	processing: "Procesando...",
	lengthMenu: "Mostrar _MENU_ resultados por pagínas",
	zeroRecords: "No se encontraron resultados",
	info: "Mostrando pagína _PAGE_ de _PAGES_.\tTotal de _TOTAL_ registros.",
	infoEmpty: "No records available",
	infoFiltered: "(filtered from _MAX_ total records)",
	emptyTable: "Ningún dato disponible en esta tabla",
	search: "Buscar",
	paginate: {
		next: "Siguiente",
		previous: "Anterior",
		first: "Primero",
		last: "Ultimo",
	},
	loadingRecords: "Cargando...",
	buttons: {
		copy: "Copiar",
		colvis: "Visibilidad",
		collection: "Colección",
		colvisRestore: "Restaurar visibilidad",
		copyKeys:
			"Presione ctrl + C para copiar los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
		copySuccess: {
			1: "Copiada 1 fila al portapapeles",
			_: "Copiadas %d fila al portapapeles",
		},
	},
};

const formSerialiceObject = function (formulario = void 0) {
	let _data_array = $("#" + formulario).serializeArray();
	let _token = {};
	let $i = 0;
	while ($i < _.size(_data_array)) {
		_token[_data_array[$i].name] = _data_array[$i].value;
		$i++;
	}
	return _token;
};

const showNotification = function (from, align, message, icon, ai = 3) {
	let type = ["primary", "info", "success", "warning", "danger"];
	$.notify(
		{
			icon: icon ? icon : "nc-icon nc-bell-55",
			message: message,
		},
		{
			type: type[ai],
			timer: 8000,
			placement: {
				from: from,
				align: align,
			},
		}
	);
};
