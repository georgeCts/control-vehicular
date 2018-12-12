<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\Vehiculos;
use App\VehiculosTipos;
use App\VehiculosStatus;
use App\VehiculosMedidasUso;
use App\VehiculosMedidasCombustible;
use App\VehiculosGrupos;
use App\VehiculosInfCompra;
use App\VehiculosInfCredito;
use App\VehiculosDocumentos;
use App\UsuariosBitacoras;
use App\Incidentes;
use App\Proveedores;

class VehiculosController extends Controller
{
    public function index() {
        $lstVehiculos = Vehiculos::where('eliminado', 0)->get();
        $lstStatus = VehiculosStatus::where('eliminado', 0)->get();

        return view('contents.vehiculos.Inventario', ['lstVehiculos' => $lstVehiculos, 'lstStatus' => $lstStatus]);
    }

    public function registro() {
        $lstVehiculosTipos = VehiculosTipos::where('eliminado', 0)->get();
        $lstVehiculoStatus = VehiculosStatus::where('eliminado', 0)->get();
        $lstVehiculoMedidasUso = VehiculosMedidasUso::where('eliminado', 0)->get();
        $lstVehiculoMedidasCombustible = VehiculosMedidasCombustible::where('eliminado', 0)->get();
        $lstVehiculosGrupos = VehiculosGrupos::where('eliminado', 0)->get();

        return view('contents.vehiculos.Registrar', ['lstVehiculosTipos'    => $lstVehiculosTipos,
                                                     'lstVehiculoStatus'    => $lstVehiculoStatus,
                                                     'lstVehiculoMedidasUso'            => $lstVehiculoMedidasUso,
                                                     'lstVehiculoMedidasCombustible'    => $lstVehiculoMedidasCombustible,
                                                     'lstVehiculosGrupos'   => $lstVehiculosGrupos]);
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/registrar', 'panel/vehiculos');

        if( FormatValidation::isValidString($request['txtNombreVehiculo']) && FormatValidation::isValidString($request['txtVehiculoMarca'])
            && FormatValidation::isValidString($request['txtVehiculoModelo']) && FormatValidation::isInteger($request['txtVehiculoAno'])) {
            
            $objVehiculo = new Vehiculos();
            $objVehiculo->vehiculo_nombre   = FormatValidation::getValidString($request['txtNombreVehiculo']);
            $objVehiculo->vehiculo_marca    = FormatValidation::getValidString($request['txtVehiculoMarca']);
            $objVehiculo->vehiculo_modelo   = FormatValidation::getValidString($request['txtVehiculoModelo']);
            $objVehiculo->vehiculo_ano      = FormatValidation::getInteger($request['txtVehiculoAno']);

            $objVehiculo->pk_vehiculo_tipo          = FormatValidation::getPrimaryKey($request['cmbTipoVehiculo']);
            $objVehiculo->pk_vehiculo_status        = FormatValidation::getPrimaryKey($request['cmbStatus']);
            $objVehiculo->pk_vehiculo_medida_uso    = FormatValidation::getPrimaryKey($request['cmbMedidaUso']);
            $objVehiculo->pk_vehiculo_medida_combustible = FormatValidation::getPrimaryKey($request['cmbMedidaCombustible']);

            if(FormatValidation::isInteger($request['cmbGrupo'], 9999, 1)) {
                $objVehiculo->pk_vehiculo_grupo = FormatValidation::getInteger($request['cmbGrupo']);
            }

            $objVehiculo->vehiculo_numero_serie = FormatValidation::getValidString($request['txtNumeroSerie']);
            $objVehiculo->vehiculo_placa        = FormatValidation::getValidString($request['txtLicenciaPlaca']);
            $objVehiculo->vehiculo_color        = FormatValidation::getValidString($request['txtColor']);
            $objVehiculo->vehiculo_seguro       = FormatValidation::getValidString($request['txtCompaniaSeguro']);
            $objVehiculo->vehiculo_poliza       = FormatValidation::getValidString($request['txtPolizaSeguro']);

            if($request['txtVigenciaPoliza'] != '') {
                $objVehiculo->vehiculo_poliza_vigencia = FormatValidation::getDateAtom($request['txtVigenciaPoliza']);
            }

            try {
                if($objVehiculo->create()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Agregó al inventario al vehículo con ID: ".$objVehiculo->pk_vehiculo." / Nombre: ".$objVehiculo->vehiculo_nombre;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::VEHICULOS_CREATE_TITLE, Messages::VEHICULOS_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::VEHICULOS_CREATE_02_TITLE, Errors::VEHICULOS_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_CREATE_01_TITLE, Errors::VEHICULOS_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function editar($pkVehiculo) {
        $return = redirect('panel/vehiculos');
        $objVehiculo = Vehiculos::where('pk_vehiculo', $pkVehiculo)->first();

        if($objVehiculo != null) {
            $lstVehiculosTipos = VehiculosTipos::where('eliminado', 0)->get();
            $lstVehiculoMedidasUso = VehiculosMedidasUso::where('eliminado', 0)->get();
            $lstVehiculoMedidasCombustible = VehiculosMedidasCombustible::where('eliminado', 0)->get();
            $lstVehiculosGrupos = VehiculosGrupos::where('eliminado', 0)->get();

            $return = view('contents.vehiculos.Editar', ['objVehiculo' => $objVehiculo,
                                                        'lstVehiculosTipos'    => $lstVehiculosTipos,
                                                        'lstVehiculoMedidasUso'            => $lstVehiculoMedidasUso,
                                                        'lstVehiculoMedidasCombustible'    => $lstVehiculoMedidasCombustible,
                                                        'lstVehiculosGrupos'   => $lstVehiculosGrupos]);
        }

        return $return;
    }

    public function update(Request $request) {
        $objVehiculo = Vehiculos::where('pk_vehiculo', $request['pk_vehiculo'])->first();

        $objReturn = new ActionReturn('panel/vehiculos/editar/'.$request['pk_vehiculo'], 'panel/vehiculos');

        if($objVehiculo != null) {

            if( FormatValidation::isValidString($request['txtNombreVehiculo']) && FormatValidation::isValidString($request['txtVehiculoMarca'])
                && FormatValidation::isValidString($request['txtVehiculoModelo']) && FormatValidation::isInteger($request['txtVehiculoAno'])) {
                
                $objVehiculo->vehiculo_nombre   = FormatValidation::getValidString($request['txtNombreVehiculo']);
                $objVehiculo->vehiculo_marca    = FormatValidation::getValidString($request['txtVehiculoMarca']);
                $objVehiculo->vehiculo_modelo   = FormatValidation::getValidString($request['txtVehiculoModelo']);
                $objVehiculo->vehiculo_ano      = FormatValidation::getInteger($request['txtVehiculoAno']);
    
                $objVehiculo->pk_vehiculo_tipo          = FormatValidation::getPrimaryKey($request['cmbTipoVehiculo']);
                $objVehiculo->pk_vehiculo_medida_uso    = FormatValidation::getPrimaryKey($request['cmbMedidaUso']);
                $objVehiculo->pk_vehiculo_medida_combustible = FormatValidation::getPrimaryKey($request['cmbMedidaCombustible']);
    
                if(FormatValidation::isInteger($request['cmbGrupo'], 9999, 1)) {
                    $objVehiculo->pk_vehiculo_grupo = FormatValidation::getInteger($request['cmbGrupo']);
                }
    
                $objVehiculo->vehiculo_numero_serie = FormatValidation::getValidString($request['txtNumeroSerie']);
                $objVehiculo->vehiculo_placa        = FormatValidation::getValidString($request['txtLicenciaPlaca']);
                $objVehiculo->vehiculo_color        = FormatValidation::getValidString($request['txtColor']);
                $objVehiculo->vehiculo_seguro       = FormatValidation::getValidString($request['txtCompaniaSeguro']);
                $objVehiculo->vehiculo_poliza       = FormatValidation::getValidString($request['txtPolizaSeguro']);
    
                if($request['txtVigenciaPoliza'] != '') {
                    $objVehiculo->vehiculo_poliza_vigencia = FormatValidation::getDateAtom($request['txtVigenciaPoliza']);
                }
    
                try {
                    if($objVehiculo->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó del inventario el vehículo con ID: ".$objVehiculo->pk_vehiculo." / Nombre: ".$objVehiculo->vehiculo_nombre;
                        $objBitacora->create();
    
                        $objReturn->setResult(true, Messages::VEHICULOS_EDIT_TITLE, Messages::VEHICULOS_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::VEHICULOS_EDIT_03_TITLE, Errors::VEHICULOS_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::VEHICULOS_EDIT_02_TITLE, Errors::VEHICULOS_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_EDIT_01_TITLE, Errors::VEHICULOS_EDIT_01_MESSAGE);
        }


        return $objReturn->getRedirectPath();
    }

    public function cambioStatus($pkVehiculo, $pkStatus) {
        $return = "false";

        $objVehiculo = Vehiculos::where('pk_vehiculo', $pkVehiculo)->first();
        if($objVehiculo != null) {
            $objVehiculo->pk_vehiculo_status = $pkStatus;
            try {
                if($objVehiculo->update()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Actualizó el status del vehículo con ID: ".$objVehiculo->pk_vehiculo;
                    $objBitacora->create();
                    $return = "true";
                }
            } catch(Exception $exception) {
                $return = "false";
            }
        }

        return $return;
    }

    public function perfil($pkVehiculo) {
        $return = redirect('panel/vehiculos');
        $objVehiculo = Vehiculos::where('pk_vehiculo', $pkVehiculo)->first();

        if($objVehiculo != null) {
            $objCompra      = VehiculosInfCompra::where('eliminado', 0)->where('pk_vehiculo', $objVehiculo->pk_vehiculo)->first();
            $objCredito     = VehiculosInfCredito::where('eliminado', 0)->where('pk_vehiculo', $objVehiculo->pk_vehiculo)->first();
            $lstIncidentes  = Incidentes::where('eliminado', 0)->where('pk_vehiculo', $objVehiculo->pk_vehiculo)->orderBy('pk_incidente', 'DESC')->get();
            $lstDocumentos  = VehiculosDocumentos::where('eliminado', 0)->where('pk_vehiculo', $objVehiculo->pk_vehiculo)->orderBy('pk_vehiculo_documento', 'DESC')->get();

            $return = View('contents.vehiculos.perfil.Index', [ 'objVehiculo'      => $objVehiculo,
                                                                'objCompra'        => $objCompra,
                                                                'objCredito'       => $objCredito,
                                                                'lstIncidentes'    => $lstIncidentes,
                                                                'lstDocumentos'    => $lstDocumentos]);
        }

        return $return;
    }

    public function compra($pkVehiculo) {
        $return = redirect('panel/vehiculos');
        $objCompra = VehiculosInfCompra::where('pk_vehiculo', $pkVehiculo)->first();

        if($objCompra != null) {
            $lstProveedores = Proveedores::where('eliminado', 0)->get();
            $return = View('contents.vehiculos.perfil.Compra', ['objCompra'         => $objCompra,
                                                                'lstProveedores'    => $lstProveedores]);
        }

        return $return;
    }

    public function updateCompra(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/dat_compra/'.$request['hddPkVehiculo'], 'panel/vehiculos/perfil_veh/'.$request['hddPkVehiculo']);
        $objCompra = VehiculosInfCompra::where('pk_vehiculo', $request['hddPkVehiculo'])->first();

        if($objCompra != null) {
            if($request['txtFechaCompra'] != "") {
                $objCompra->compra_fecha = FormatValidation::getDateAtom($request['txtFechaCompra']);
            }

            if($request['txtFechaGarantia'] != "") {
                $objCompra->garantia_limite_fecha = FormatValidation::getDateAtom($request['txtFechaGarantia']);
            }

            if(FormatValidation::isPrimaryKey($request['cmbProveedor'])) {
                $objCompra->pk_proveedor = FormatValidation::getPrimaryKey($request['cmbProveedor']);
            }

            $objCompra->compra_precio               = FormatValidation::getDecimal($request['txtPrecioCompra']);
            $objCompra->compra_odometro             = FormatValidation::getDecimal($request['txtOdometroCompra']);
            $objCompra->garantia_limite_odometro    = FormatValidation::getDecimal($request['txtOdometroGarantia']);
            $objCompra->notas                       = FormatValidation::getValidString($request['txtNotas']);

            try {
                if($objCompra->update()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Modificó los datos de compra del vehículo con ID: ".$objCompra->pk_vehiculo." / Nombre: ".$objCompra->vehiculo->vehiculo_nombre;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::VEHICULOS_COMPRA_EDIT_TITLE, Messages::VEHICULOS_COMPRA_EDIT_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::VEHICULOS_COMPRA_EDIT_01_TITLE, Errors::VEHICULOS_COMPRA_EDIT_01_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_COMPRA_EDIT_01_TITLE, Errors::VEHICULOS_COMPRA_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function credito($pkVehiculo) {
        $return = redirect('panel/vehiculos');
        $objCredito = VehiculosInfCredito::where('pk_vehiculo', $pkVehiculo)->first();

        if($objCredito != null) {
            $return = View('contents.vehiculos.perfil.Credito', ['objCredito' => $objCredito]);
        }

        return $return;
    }

    public function updateCredito(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/dat_credito/'.$request['hddPkVehiculo'], 'panel/vehiculos/perfil_veh/'.$request['hddPkVehiculo']);
        $objCredito = VehiculosInfCredito::where('pk_vehiculo', $request['hddPkVehiculo'])->first();

        if($objCredito != null) {
            if($request['txtFechaInicial'] != "" && $request['txtFechaFinal'] != "") {
                $objCredito->fecha_inicial = FormatValidation::getDateAtom($request['txtFechaInicial']);
                $objCredito->fecha_final = FormatValidation::getDateAtom($request['txtFechaFinal']);
            }

            $objCredito->pago_mensual            = FormatValidation::getDecimal($request['txtPagoMensual']);
            $objCredito->monto_financiado        = FormatValidation::getDecimal($request['txtMontoFinanciado']);
            $objCredito->tasa_interes            = FormatValidation::getDecimal($request['txtTasaInteres']);
            $objCredito->valor_residual          = FormatValidation::getDecimal($request['txtValorResidual']);
            $objCredito->institucion_financiera  = FormatValidation::getValidString($request['txtInstitucion']);
            $objCredito->numero_cuenta           = FormatValidation::getValidString($request['txtNumeroCuenta']);
            $objCredito->notas                   = FormatValidation::getValidString($request['txtNotas']);

            try {
                if($objCredito->update()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Modificó los datos de crédito del vehículo con ID: ".$objCredito->pk_vehiculo." / Nombre: ".$objCredito->vehiculo->vehiculo_nombre;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::VEHICULOS_CREDITO_EDIT_TITLE, Messages::VEHICULOS_CREDITO_EDIT_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::VEHICULOS_CREDITO_EDIT_01_TITLE, Errors::VEHICULOS_CREDITO_EDIT_01_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_CREDITO_EDIT_01_TITLE, Errors::VEHICULOS_CREDITO_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
}
