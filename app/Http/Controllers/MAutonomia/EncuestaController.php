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
use MA\Negocio\Logica\MAutonomia\CategoriaServicio;
use MA\Negocio\Logica\MAutonomia\EncuestaServicio;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class EncuestaController extends Controller
{

    protected  $encuestaServicio;
    protected  $categoriaServicio;
    public function __construct(EncuestaServicio $encuestaServicio,CategoriaServicio $categoriaServicio){
        $this->encuestaServicio = $encuestaServicio;
        $this->categoriaServicio = $categoriaServicio;
    }

    //Metodo para cargar  la vista de crear Encuesta
    public function VistaCrearEncuesta(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $categorias = $this->categoriaServicio->ObtenerListaCategorias();
        $view = View::make('MAutonomia/Encuesta/crearEncuesta')->with('listCategorias',$categorias);;
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
            $repuesta = $this->encuestaServicio->GuardarEncuesta($request);
            if($repuesta == true){
                $encuestas = $this->encuestaServicio->ObtenerListaEncuesta($request->user_id);
                $view = View::make('MAutonomia/Encuesta/listaEncuestas')->with('listEncuesta',$encuestas);
                $sections = $view->renderSections();
                return Response::json($sections['content']);
            }
            else{
                return $this->proveedorServicio->GuardarProveedor($request);
            }
        }else return view('MAutonomia/Encuesta/listaEncuestas');
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


    public function obtenerFormularioEncuesta($idEncuesta)
    {

        $encuesta = $this->encuestaServicio->obtenerFormularioEncuesta($idEncuesta);
        $ElementosArray= array('encuesta' => $encuesta);
        return view('Layouts/PrincipalEncuesta',['ElementosArray' =>$ElementosArray]);

    }

}