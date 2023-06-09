<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\WebServiceManagerCurl;

class AdminController extends Controller
{
    protected $urlApiSAG = 'http://161.132.181.82:85/sag-app/public/api';

    public function findCotizacionAjax(Request $request) 
    {
        if ($request->ajax()) {

            $nro_cotizacion = $request->nro;
            $data = [];
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/ruido/find-cliente-by-cotizacion?nro=' . $nro_cotizacion, );
            $listado = $webService->get();
            
            if (count($listado) > 0) {
                $message = 'Ok';
                $data['cliente'] = $listado[0];
            } else {
                $message = 'No se encontro datos';
                $data = [];
            }
            
            $response = [
                'message' => $message,
                'data' => $data
            ];
    
            return response()->json($response, 200);
            
        }

    }
}
