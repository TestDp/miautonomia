<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/09/2018
 * Time: 12:07 PM
 */

namespace App\Http\Controllers\MAutonomia;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MA\Negocio\Logica\MAutonomia\EncuestaServicio;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class EncuestaController extends Controller
{

    protected  $encuestaServicio;
    public function __construct(EncuestaServicio $encuestaServicio){
        $this->encuestaServicio = $encuestaServicio;
    }

    //Metodo para cargar  la vista de crear Encuesta
    public function VistaCrearEncuesta(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $view = View::make('MAutonomia/Encuesta/crearEncuesta');
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MAutonomia/Encuesta/crearEncuesta');
    }

    //Metodo para guarda la encuesta
    public  function GuardarEncuesta(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        if($request->ajax()){
            $sede = $request->all();
            $idEmpreesa = Auth::user()->Sede->Empresa->id;
            $sede['Empresa_id'] = $idEmpreesa;
            $repuesta = $this->encuestaServicio->GuardarEncuesta($request);
            if($repuesta == true){
                $sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
                $view = View::make('MEmpresa/Sede/listaSedes')->with('listSedes',$sedes);
                $sections = $view->renderSections();
                return Response::json($sections['content']);
            }
            else{
                return $this->proveedorServicio->GuardarProveedor($request);
            }
        }else return view('MEmpresa/Sede/listaSedes');
    }

    //Metodo para obtener toda  la lista de encuestas del usuario
    public  function ObtenerEncuestas(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idUsuario = Auth::user()->id;
        $encuestas = $this->encuestaServicio->ObtenerListaEncuesta($idUsuario);
        $view = View::make('MAutonomia/Encuesta/listaEncuestas')->with('listEncuesta',$encuestas);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('MAutonomia/Encuesta/listaEncuestas');
    }

}