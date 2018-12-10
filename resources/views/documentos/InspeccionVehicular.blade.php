<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formato Inspecci&oacute;n Vehicular</title>
    <link rel="stylesheet" type="text/css" href="assets/css/pdf.css" media="screen">
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        {{-- CABECERA --}}
        <table width="100%">
            <tr>
                <td width="70%">
                    <table width="100%">
                    <tr>
                        <td class="tituloH2" style="text-align: left">INSPECCI&Oacute;N DE VEH&Iacute;CULOS</td>
                    </tr>
                    </table>
                </td>
                <td width="30%" style="text-align: right"></td>
            </tr>
            <tr>
                <td class="tituloH4" colspan="2" width="100%" style="text-align: right"></td>
            </tr>
        </table>

        {{-- INFORMACIÓN GENERAL --}}
        {{--  TABLA 1 --}}
        <table width="100%" cellpadding="2" cellspacing="0">
            <tr>
                <td class="tituloBoldTH4" width="15%" style="text-align: left;">Fecha de Inspecci&oacute;n</td>
                <td class="celdaH4" width="15%" style="text-align:center">{{$objInspeccion->fecha_inspeccion}} </td>

                <td class="tituloBoldTH4" width="15%" style="text-align: left;">Kilometraje de salida</td>
                <td class="celdaH4" width="15%" style="text-align:center">{{$objInspeccion->kilometraje_salida}} Kms.</td>

                <td class="tituloBoldTH4" width="20%" style="text-align: left;">N&uacute;mero de las placas</td>
                <td class="celdaH4" width="20%" style="text-align:center">{{$objInspeccion->vehiculo->vehiculo_placa}} </td>
            </tr>
            <tr>
                <td class="tituloBoldTH4" width="15%" style="text-align: left;">Conductor</td>
                <td class="celdaH4" width="15%" style="text-align:center">{{$objInspeccion->operador->nombre}} </td>

                <td class="tituloBoldTH4" width="15%" style="text-align: left;">Vigencia de licencia</td>
                <td class="celdaH4" width="15%" style="text-align:center">{{$objInspeccion->vigencia_licencia}}</td>

                <td class="tituloBoldTH4" width="20%" style="text-align: left;">N&uacute;mero de la unidad</td>
                <td class="celdaH4" width="20%" style="text-align:center">{{$objInspeccion->numero_unidad}} </td>
            </tr>
            <tr>
                <td class="tituloBoldTH4" width="15%" style="text-align: left;">Tipo de veh&iacute;culo</td>
                <td class="celdaH4" width="15%" style="text-align:center">{{$objInspeccion->vehiculo->vehiculoTipo->vehiculo_tipo}} </td>

                <td class="tituloBoldTH4" width="15%" style="text-align: left;">Kilometraje de llegada</td>
                <td class="celdaH4" width="15%" style="text-align:center">{{$objInspeccion->kilometraje_llegada}} Kms.</td>

                <td class="tituloBoldTH4" width="20%" style="text-align: left;">N&uacute;mero de tel&eacute;fono de veh&iacute;culo</td>
                <td class="celdaH4" width="20%" style="text-align:center">{{$objInspeccion->telefono_vehiculo}} </td>
            </tr>
        </table>
        <br />

        {{--  TABLA 2 --}}
        <table width="100%" cellpadding="2" cellspacing="0">
            <tr>
                <td class="tituloBoldTH4" width="100%" style="text-align: left;">
                    Nota: Ningún vehículo puede ser utilizado si éste no cuenta con los permisos y seguros correspondientes. La 
                    persona a la que se le asigne el vehículo será responsable de la unidad, desde el orden y limpieza hasta los daños que presente, 
                    los cuales deben ser reportados. Al regresar éste debe estar limpio en el interior con el tanque de combustible no menor a 1/4.
                </td>
            </tr>
        </table>
        <br />

        {{--  TABLA 3 --}}
        <table style="page-break-after: always;" width="100%" cellpadding="2" cellspacing="0">
            <tr>
                <td class="tituloBoldTH4" width="30%" style="text-align: left;">Equipo de seguridad</td>
                <td class="tituloBoldTH4" width="10%" style="text-align:center">SI</td>
                <td class="tituloBoldTH4" width="10%" style="text-align: center;">NO</td>
                
                <td class="tituloBoldTH4" width="30%" style="text-align:left">Motor y transmisi&oacute;n (Niveles y Fugas)</td>
                <td class="tituloBoldTH4" width="10%" style="text-align: center;">OK</td>
                <td class="tituloBoldTH4" width="10%" style="text-align:center">Fuga</td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Tri&aacute;ngulos reflejantes</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->triangulos_reflejantes == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->triangulos_reflejantes == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align:left">Nivel de combustible (Lleno, 1/4, 1/2, 3/4, E)</td>
                <td class="celdaH4" width="20%" colspan="2" style="text-align: center;">{{$objInspeccion->nivel_combustible}}</td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Gato</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->gato == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->gato == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Nivel del anticongelante</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->nivel_anticongelante == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->nivel_anticongelante == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Herramientas</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->herramientas == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->herramientas == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Nivel de aceite</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->nivel_aceite == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->nivel_aceite == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Llanta de refacci&oacute;n</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->llanta_refaccion == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->llanta_refaccion == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">L&iacute;quido en el limpiador</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->liquido_limpiador == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->liquido_limpiador == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="tituloBoldTH4" width="30%" style="text-align: left;">General</td>
                <td class="tituloBoldTH4" width="10%" style="text-align:center">OK</td>
                <td class="tituloBoldTH4" width="10%" style="text-align: center;">Reparar</td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">¿Alguna fuga visible?</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->fuga_visible == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->fuga_visible == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Presi&oacute;n de las llantas</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->presion_llantas == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->presion_llantas == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Cables pasa corriente</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->cables_corriente == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->cables_corriente == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Dibujo de las llantas</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->dibujo_llantas == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->dibujo_llantas == 0)
                        X
                    @endif
                </td>
                
                <td class="tituloBoldTH4" width="30%" style="text-align: left;">Luces</td>
                <td class="tituloBoldTH4" width="10%" style="text-align:center">OK</td>
                <td class="tituloBoldTH4" width="10%" style="text-align: center;">Reparar</td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Limpieza interna y externa del veh&iacute;culo</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->limpieza == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->limpieza == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Delanteras (altas, bajas, direccionales)</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->luces_delanteras == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->luces_delanteras == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Aseguramiento de carga dentro y fuera</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->aseguramiento_carga == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->aseguramiento_carga == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Traseras (direccionales, reversa, alto)</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->luces_traseras == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->luces_traseras == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Da&ntilde;os en la carrocer&iacute;a (Ver dibujo anexo)</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->dano_carroceria == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->dano_carroceria == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Intermitentes (cuatro encendidas)</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->luces_intermitentes == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->luces_intermitentes == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Condici&oacute;n del escape</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->condicion_escape == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->condicion_escape == 0)
                        X
                    @endif
                </td>
                
                <td class="tituloBoldTH4" width="30%" style="text-align: left;">Documentaci&oacute;n</td>
                <td class="tituloBoldTH4" width="10%" style="text-align: center;">SI</td>
                <td class="tituloBoldTH4" width="10%" style="text-align:center">NO</td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Funcionamiento del limpiaparabrisas</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->limpiaparabrisa == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->limpiaparabrisa == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Tarjeta de circulaci&oacute;n</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->tarjeta_circulacion == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->tarjeta_circulacion == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Parabrisas (astillado/cuarteado)</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->parabrisa == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->parabrisa == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">P&oacute;liza de seguro</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->poliza_seguro == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->poliza_seguro == 0)
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaH4" width="30%" style="text-align: left;">Desempa&ntilde;ador, calefacci&oacute;n, A/C</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->aire_acondicionado == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->aire_acondicionado == 0)
                        X
                    @endif
                </td>
                
                <td class="celdaH4" width="30%" style="text-align: left;">Registro de mantenimiento (servicio)</td>
                <td class="celdaH4" width="10%" style="text-align:center">
                    @if($objInspeccion->registro_mantenimiento == 1)
                        X
                    @endif
                </td>
                <td class="celdaH4" width="10%" style="text-align: center;">
                    @if($objInspeccion->registro_mantenimiento == 0)
                        X
                    @endif
                </td>
            </tr>
        </table>
        

        {{--  TABLA 4 --}}
        <table width="100%" cellpadding="2" cellspacing="0">
            <tr><td class="tituloBoldTH4" width="100%" style="text-align: center;"> Comentarios </td></tr>
            <tr><td class="celdaH4" width="100%" height="600px" style="text-align:left">{{$objInspeccion->comentarios}} </td></tr>
        </table>
        <br />

        {{--  TABLA 5 --}}
        <table width="100%" cellpadding="2" cellspacing="0">
            <tr>
                <td class="celdaH4" width="100%">
                    <span style="text-align: left;">Circule cualquier da&ntilde;o notado.</span>
                    <br />
                    <img style="text-align: center;" width="350px" src="{{ Storage::disk('s3')->url($objInspeccion->imagen_dano) }}" />
                </td>
            </tr>
        </table>
        <br />

        {{--  TABLA 6 --}}
        <table width="100%" cellpadding="2" cellspacing="0">
            <tr>
                <td width="100%" style="text-align: left;">
                    <h4>Nombre y firma de quien entrega</h4>
                    <img width="300px" src="{{ Storage::disk('s3')->url($objInspeccion->url_firma_entrega) }}" />
                    <span>{{$objInspeccion->usuarioEntrega->nombre}} {{$objInspeccion->usuarioEntrega->apellido_paterno}} {{$objInspeccion->usuarioEntrega->apellido_materno}}</span>
                </td>

                <td width="100%" style="text-align: right;">
                    <h4>Nombre y firma de quien recibe</h4>
                    <img width="300px" src="{{ Storage::disk('s3')->url($objInspeccion->url_firma_recibe) }}" />
                    <span>{{$objInspeccion->operadorRecibe->nombre}} {{$objInspeccion->operadorRecibe->apellido_paterno}} {{$objInspeccion->operadorRecibe->apellido_materno}}</span>
                </td>
            </tr>
        </table>
        <br />
        <br />
        <br />

        {{--  TABLA 6 --}}
        <table width="100%" cellpadding="2" cellspacing="0">
            <tr>
                <td width="100%">                                        
                    <img width="100px" src="data:image/png;base64,{{DNS2D::getBarcodePNG($objInspeccion->pk_vehiculo_inspeccion, 'QRCODE')}}" alt="barcode" />
                    <br />
                    <span style="text-align: left;">C&oacute;digo QR autogenerado por el sistema para consulta de inspecciones.</span>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>