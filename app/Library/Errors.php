<?php

namespace App\Library;

class Errors {


	public static function getErrors($error_ID) {
		
		$return = array(	"title"		=> "Error de base de datos.",
							"message"	=> "Existe un problema de base de datos, pongase en contacto con el administrador del sistema. Error No. " . $error_ID);
		switch($error_ID) {
			case '23000':
				$return = array(	"title"		=> "Error de registro duplicado.",
									"message"	=> "El registro o la clave que intenta ingresar ya se encuentra en la base de datos.");
			break;
		}

		return $return;
	}

	//LOGIN
	const LOGIN_01_ID = "1_0001";
	const LOGIN_01_TITLE = "Acceso restringido."; 
	const LOGIN_01_MESSAGE = "Correo o password incorrectos. Verifique su información.";

	//SESSIONS
	const SESION_01_ID = "2_0001";
	const SESION_01_TITLE = "La sesión ha expirado."; 
	const SESION_01_MESSAGE = "La sesión del usuario ha finalizado, debe iniciar sesión nuevamente.";


	/* *********************************************************************
	 * *************	ERRORES DE LA INTERFAZ DEL PANEL ************
	 * ****************************************************************** */		


	// PROVEEDORES
	const PROVEEDORES_CREATE_01_ID = "3_0001";
	const PROVEEDORES_CREATE_01_TITLE = "Error de nuevo registro.";
	const PROVEEDORES_CREATE_01_MESSAGE = "No se ingresó el nombre comercial del proveedor.";

	const PROVEEDORES_CREATE_02_ID = "3_0002";
	const PROVEEDORES_CREATE_02_TITLE = "Error de nuevo registro.";
	const PROVEEDORES_CREATE_02_MESSAGE = "El proveedor no se pudo registrar. Póngase en contacto con el administrador.";

	const PROVEEDORES_EDIT_01_ID = "3_0004";
	const PROVEEDORES_EDIT_01_TITLE = "Error de nuevo registro.";
	const PROVEEDORES_EDIT_01_MESSAGE = "No se ha podido encontrar el proveedor a modificar.";

	const PROVEEDORES_EDIT_02_ID = "3_0005";
	const PROVEEDORES_EDIT_02_TITLE = "Error de nuevo registro.";
	const PROVEEDORES_EDIT_02_MESSAGE = "No se ingresó el nombre comercial del proveedor.";

	const PROVEEDORES_EDIT_03_ID = "3_0006";
	const PROVEEDORES_EDIT_03_TITLE = "Error de nuevo registro.";
	const PROVEEDORES_EDIT_03_MESSAGE = "El proveedor no se pudo registrar. Póngase en contacto con el administrador.";



	// OPERADORES
	const OPERADORES_CREATE_01_ID = "4_0001";
	const OPERADORES_CREATE_01_TITLE = "Error de nuevo registro.";
	const OPERADORES_CREATE_01_MESSAGE = "No se ingresó el nombre completo del operador.";

	const OPERADORES_CREATE_02_ID = "4_0002";
	const OPERADORES_CREATE_02_TITLE = "Error de nuevo registro.";
	const OPERADORES_CREATE_02_MESSAGE = "Los datos de la licencia no son válidos, revisa la información ingresada.";

	const OPERADORES_CREATE_03_ID = "4_0003";
	const OPERADORES_CREATE_03_TITLE = "Error de nuevo registro.";
	const OPERADORES_CREATE_03_MESSAGE = "No se adjuntó el fichero de licencia en el formulario.";

	const OPERADORES_CREATE_04_ID = "4_0004";
	const OPERADORES_CREATE_04_TITLE = "Error de nuevo registro.";
	const OPERADORES_CREATE_04_MESSAGE = "El operador no se pudo registrar. Póngase en contacto con el administrador.";

	const OPERADORES_EDIT_01_ID = "4_0005";
	const OPERADORES_EDIT_01_TITLE = "Error de modificación.";
	const OPERADORES_EDIT_01_MESSAGE = "No se ha podido encontrar el operador a modificar.";

	const OPERADORES_EDIT_02_ID = "4_0006";
	const OPERADORES_EDIT_02_TITLE = "Error de modificación.";
	const OPERADORES_EDIT_02_MESSAGE = "No se ingresó el nombre completo del operador.";

	const OPERADORES_EDIT_03_ID = "4_0007";
	const OPERADORES_EDIT_03_TITLE = "Error de modificación.";
	const OPERADORES_EDIT_03_MESSAGE = "El operador no se pudo modificar. Póngase en contacto con el administrador.";


	//VEHICULOS TIPOS
	const VEHICULOS_TIPOS_CREATE_01_ID = "5_0001";
	const VEHICULOS_TIPOS_CREATE_01_TITLE = "Error de nuevo registro.";
	const VEHICULOS_TIPOS_CREATE_01_MESSAGE = "No se ingresó el nombre del tipo de vehículo.";

	const VEHICULOS_TIPOS_CREATE_02_ID = "5_0002";
	const VEHICULOS_TIPOS_CREATE_02_TITLE = "Error de nuevo registro.";
	const VEHICULOS_TIPOS_CREATE_02_MESSAGE = "El tipo de vehículo no se pudo registrar. Póngase en contacto con el administrador.";

	const VEHICULOS_TIPOS_EDIT_01_ID = "5_0003";
	const VEHICULOS_TIPOS_EDIT_01_TITLE = "Error de nuevo registro.";
	const VEHICULOS_TIPOS_EDIT_01_MESSAGE = "No se ha podido encontrar el tipo de vehículo a modificar.";

	const VEHICULOS_TIPOS_EDIT_02_ID = "5_0004";
	const VEHICULOS_TIPOS_EDIT_02_TITLE = "Error de nuevo registro.";
	const VEHICULOS_TIPOS_EDIT_02_MESSAGE = "No se ingresó el nombre del tipo de vehículo.";

	const VEHICULOS_TIPOS_EDIT_03_ID = "5_0005";
	const VEHICULOS_TIPOS_EDIT_03_TITLE = "Error de nuevo registro.";
	const VEHICULOS_TIPOS_EDIT_03_MESSAGE = "El tipo de vehículo no se pudo registrar. Póngase en contacto con el administrador.";


	//VEHICULOS GRUPOS
	const VEHICULOS_GRUPOS_CREATE_01_ID = "6_0001";
	const VEHICULOS_GRUPOS_CREATE_01_TITLE = "Error de nuevo registro.";
	const VEHICULOS_GRUPOS_CREATE_01_MESSAGE = "No se ingresó el nombre del grupo de vehículo.";

	const VEHICULOS_GRUPOS_CREATE_02_ID = "6_0002";
	const VEHICULOS_GRUPOS_CREATE_02_TITLE = "Error de nuevo registro.";
	const VEHICULOS_GRUPOS_CREATE_02_MESSAGE = "El grupo de vehículo no se pudo registrar. Póngase en contacto con el administrador.";

	const VEHICULOS_GRUPOS_EDIT_01_ID = "6_0003";
	const VEHICULOS_GRUPOS_EDIT_01_TITLE = "Error de nuevo registro.";
	const VEHICULOS_GRUPOS_EDIT_01_MESSAGE = "No se ha podido encontrar el grupo de vehículo a modificar.";

	const VEHICULOS_GRUPOS_EDIT_02_ID = "6_0004";
	const VEHICULOS_GRUPOS_EDIT_02_TITLE = "Error de nuevo registro.";
	const VEHICULOS_GRUPOS_EDIT_02_MESSAGE = "No se ingresó el nombre del grupo de vehículo.";

	const VEHICULOS_GRUPOS_EDIT_03_ID = "6_0005";
	const VEHICULOS_GRUPOS_EDIT_03_TITLE = "Error de nuevo registro.";
	const VEHICULOS_GRUPOS_EDIT_03_MESSAGE = "El grupo de vehículo no se pudo registrar. Póngase en contacto con el administrador.";


	//VEHICULOS
	const VEHICULOS_CREATE_01_ID = "7_0001";
	const VEHICULOS_CREATE_01_TITLE = "Error de nuevo registro.";
	const VEHICULOS_CREATE_01_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const VEHICULOS_CREATE_02_ID = "7_0002";
	const VEHICULOS_CREATE_02_TITLE = "Error de nuevo registro.";
	const VEHICULOS_CREATE_02_MESSAGE = "El vehículo no se pudo registrar. Póngase en contacto con el administrador.";

	const VEHICULOS_EDIT_01_ID = "7_0003";
	const VEHICULOS_EDIT_01_TITLE = "Error de modificación.";
	const VEHICULOS_EDIT_01_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const VEHICULOS_EDIT_02_ID = "7_0004";
	const VEHICULOS_EDIT_02_TITLE = "Error de modificación.";
	const VEHICULOS_EDIT_02_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const VEHICULOS_EDIT_03_ID = "7_0005";
	const VEHICULOS_EDIT_03_TITLE = "Error de modificación.";
	const VEHICULOS_EDIT_03_MESSAGE = "El vehículo no se pudo modificar. Póngase en contacto con el administrador.";


	//GASTOS ADICIONALES
	const GASTOS_ADICIONALES_CREATE_01_ID = "8_0001";
	const GASTOS_ADICIONALES_CREATE_01_TITLE = "Error de nuevo registro.";
	const GASTOS_ADICIONALES_CREATE_01_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const GASTOS_ADICIONALES_CREATE_02_ID = "8_0002";
	const GASTOS_ADICIONALES_CREATE_02_TITLE = "Error de nuevo registro.";
	const GASTOS_ADICIONALES_CREATE_02_MESSAGE = "El gasto adicional no se pudo registrar. Póngase en contacto con el administrador.";

	const GASTOS_ADICIONALES_EDIT_01_ID = "8_0003";
	const GASTOS_ADICIONALES_EDIT_01_TITLE = "Error de nuevo registro.";
	const GASTOS_ADICIONALES_EDIT_01_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const GASTOS_ADICIONALES_EDIT_02_ID = "8_0004";
	const GASTOS_ADICIONALES_EDIT_02_TITLE = "Error de nuevo registro.";
	const GASTOS_ADICIONALES_EDIT_02_MESSAGE = "No se ha podido encontrar el gasto adicional a modificar.";

	const GASTOS_ADICIONALES_EDIT_03_ID = "8_0005";
	const GASTOS_ADICIONALES_EDIT_03_TITLE = "Error de nuevo registro.";
	const GASTOS_ADICIONALES_EDIT_03_MESSAGE = "El gasto adicional no se pudo registrar. Póngase en contacto con el administrador.";


	//INCIDENTES
	const INCIDENTES_CREATE_01_ID = "9_0001";
	const INCIDENTES_CREATE_01_TITLE = "Error de nuevo registro.";
	const INCIDENTES_CREATE_01_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const INCIDENTES_CREATE_02_ID = "9_0002";
	const INCIDENTES_CREATE_02_TITLE = "Error de nuevo registro.";
	const INCIDENTES_CREATE_02_MESSAGE = "El incidente no se pudo registrar. Póngase en contacto con el administrador.";

	const INCIDENTES_EDIT_01_ID = "9_0003";
	const INCIDENTES_EDIT_01_TITLE = "Error de modificación.";
	const INCIDENTES_EDIT_01_MESSAGE = "No se ha podido encontrar el incidente a modificar.";

	const INCIDENTES_EDIT_02_ID = "9_0004";
	const INCIDENTES_EDIT_02_TITLE = "Error de modificación";
	const INCIDENTES_EDIT_02_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const INCIDENTES_EDIT_03_ID = "9_0005";
	const INCIDENTES_EDIT_03_TITLE = "Error de modificación";
	const INCIDENTES_EDIT_03_MESSAGE = "El incidente no se pudo modificar. Póngase en contacto con el administrador.";

	//USUARIOS
	const USUARIOS_CREATE_01_ID = "10_0001";
	const USUARIOS_CREATE_01_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_01_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const USUARIOS_CREATE_02_ID = "10_0002";
	const USUARIOS_CREATE_02_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_02_MESSAGE = "El usuario o el correo ingresados, no se encuentran disponibles. Pruebe con uno diferente.";

	const USUARIOS_CREATE_03_ID = "10_0003";
	const USUARIOS_CREATE_03_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_03_MESSAGE = "Los datos del nuevo usuario no pudieron registrarse. Verifique la información.";

	const USUARIOS_CREATE_04_ID = "10_0004";
	const USUARIOS_CREATE_04_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_04_MESSAGE = "Las contraseñas no coinciden. Verifique la información.";

	const USUARIOS_EDIT_01_ID = "5_0005";
	const USUARIOS_EDIT_01_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_01_MESSAGE = "No se ingresó el nombre completo del usuario.";

	const USUARIOS_EDIT_02_ID = "5_0006";
	const USUARIOS_EDIT_02_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_02_MESSAGE = "La fecha ingresada no se encuentra en un formato admitido.";

	const USUARIOS_EDIT_03_ID = "5_0007";
	const USUARIOS_EDIT_03_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_03_MESSAGE = "Los datos del usuario no pudieron modificarse. Verifique la información.";

	const USUARIOS_EDIT_04_ID = "5_0008";
	const USUARIOS_EDIT_04_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_04_MESSAGE = "Las contraseñas no coinciden. Verifique la información.";


	//INSPECCIONES
	const INSPECCIONES_CREATE_01_ID = "11_0001";
	const INSPECCIONES_CREATE_01_TITLE = "Error de nuevo registro.";
	const INSPECCIONES_CREATE_01_MESSAGE = "No se pudo encontrar el vehículo. Verifique la información.";

	const INSPECCIONES_CREATE_02_ID = "11_0002";
	const INSPECCIONES_CREATE_02_TITLE = "Error de nuevo registro.";
	const INSPECCIONES_CREATE_02_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const INSPECCIONES_CREATE_03_ID = "11_0003";
	const INSPECCIONES_CREATE_03_TITLE = "Error de nuevo registro.";
	const INSPECCIONES_CREATE_03_MESSAGE = "La inspecci+on no se pudo registrar. Póngase en contacto con el administrador.";

	//VEHICULOS COMPRA
	const VEHICULOS_COMPRA_EDIT_01_ID = "12_0001";
	const VEHICULOS_COMPRA_EDIT_01_TITLE = "Error de modificación.";
	const VEHICULOS_COMPRA_EDIT_01_MESSAGE = "No se pudo encontrar el registro de compra. Verifique la información.";

	const VEHICULOS_COMPRA_EDIT_02_ID = "12_0002";
	const VEHICULOS_COMPRA_EDIT_02_TITLE = "Error de modificación.";
	const VEHICULOS_COMPRA_EDIT_02_MESSAGE = "Los datos de compra del vehículo no pudieron modificarse. Verifique la información.";

	//VEHICULOS CREDITO
	const VEHICULOS_CREDITO_EDIT_01_ID = "13_0001";
	const VEHICULOS_CREDITO_EDIT_01_TITLE = "Error de modificación.";
	const VEHICULOS_CREDITO_EDIT_01_MESSAGE = "No se pudo encontrar el registro de crédito. Verifique la información.";

	const VEHICULOS_CREDITO_EDIT_02_ID = "13_0002";
	const VEHICULOS_CREDITO_EDIT_02_TITLE = "Error de modificación.";
	const VEHICULOS_CREDITO_EDIT_02_MESSAGE = "Los datos de crédito del vehículo no pudieron modificarse. Verifique la información.";
	
	//RECORDATORIOS
	const RECORDATORIOS_CREATE_01_ID = "14_0001";
	const RECORDATORIOS_CREATE_01_TITLE = "Error de nuevo registro.";
	const RECORDATORIOS_CREATE_01_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const RECORDATORIOS_CREATE_02_ID = "14_0002";
	const RECORDATORIOS_CREATE_02_TITLE = "Error de nuevo registro.";
	const RECORDATORIOS_CREATE_02_MESSAGE = "Los datos del recordatorio no pudieron registrarse. Verifique la información.";

	const RECORDATORIOS_CREATE_03_ID = "14_0002";
	const RECORDATORIOS_CREATE_03_TITLE = "Error de nuevo registro.";
	const RECORDATORIOS_CREATE_03_MESSAGE = "El correo del recordatorio no se pudo enviar, verifica que los correos de los usuarios sean válidos.";

	const RECORDATORIOS_EDIT_01_ID = "14_0003";
	const RECORDATORIOS_EDIT_01_TITLE = "Error de modificación.";
	const RECORDATORIOS_EDIT_01_MESSAGE = "No se encontró el recordatorio a modificar. Verifique la información.";

	const RECORDATORIOS_EDIT_02_ID = "14_0004";
	const RECORDATORIOS_EDIT_02_TITLE = "Error de modificación.";
	const RECORDATORIOS_EDIT_02_MESSAGE = "No se ingresaron correctamente los campos requeridos (*).";

	const RECORDATORIOS_EDIT_03_ID = "14_0005";
	const RECORDATORIOS_EDIT_03_TITLE = "Error de modificación.";
	const RECORDATORIOS_EDIT_03_MESSAGE = "Los datos del recordatorio no pudieron registrarse. Verifique la información.";

	const RECORDATORIOS_EDIT_04_ID = "14_0006";
	const RECORDATORIOS_EDIT_04_TITLE = "Error de envío.";
	const RECORDATORIOS_EDIT_04_MESSAGE = "El correo del recordatorio no se pudo enviar, verifica que los correos de los usuarios sean válidos.";
}

?>