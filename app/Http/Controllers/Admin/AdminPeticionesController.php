<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Models\Peticione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\User;
use App\Http\Controllers\Controller;
class AdminPeticionesController extends Controller{

    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(Request $request)
    {
        $peticiones = Peticione::paginate(5);
        return view('admin.peticiones.index', compact('peticiones'));
    }

    public function show(Request $request, $id)
    {
        try {
            $peticion = Peticione::findOrFail($id);
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }

        return view('admin.peticiones.show', compact('peticion'));
    }
    public function listMine(Request $request){
        try {
            $user = Auth::user();
            $peticiones = Peticione::where('user_id', $user->id)->paginate(5);
        }catch (\Exception $exception){
            return back()->withError($exception->getMessage())->whitInput();
        }
        return view('admin.peticiones.index', compact('peticiones'));
    }

    public function firmar(Request $request, $id)
    {
        try {
            $peticion = Peticione::findOrFail($id);
            $user = Auth::user();
            $firmas = $peticion->firmas;
            foreach ($firmas as $firma) {
                if ($firma->id == $user->id) {
                    return back()->withError( "Ya has firmado esta petición")->withInput();
                }
            }
            $user_id = [$user->id];
            $peticion->firmas()->attach($user_id);
            $peticion->firmantes = $peticion->firmantes + 1;
            $peticion->save();
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }
        return redirect()->back();
    }

    public function create(Request $request)
    {
        try {
            $user = Auth::user();
            $categorias = Categoria::orderBy('nombre','asc')->get();
            return view('peticiones.edit-add', compact('categorias'));
        }catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'destinatario' => 'required',
            'category'=>'required',
            'file' => 'required',
        ]);
        $input = $request->all();
        try {
            $category = Categoria::findOrFail($input['category']);
            $user = Auth::user(); //asociarlo al usuario authenticado
            $peticion = new Peticione($input);
            $peticion->categoria()->associate($category);
            $peticion->user()->associate($user);
            $peticion->firmantes = 0;
            $peticion->estado = 'pendiente';
            $res=$peticion->save();
            if ($res) {
                $res_file = $this->fileUpload($request, $peticion->id);
                if ($res_file) {
                    return redirect('/mispeticiones');
                }
                return back()->withError( 'Error creando la peticion')->withInput();
            }
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }
    }


    public function peticionesFirmadas(Request $request)
    {
        try {
            $user = Auth::user();
            $peticiones = $user->firmas()->paginate(3);
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }
        return view('peticiones.peticionesfirmadas', compact('peticiones'));
    }


    public function fileUpload(Request $req, $peticione_id = null)
    {
        $file = $req->file('file');
        $fileModel = new File;
        $fileModel->peticione_id = $peticione_id;
        if ($req->file('file')) {
            //return $req->file('file');

            $filename = $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('peticiones', $filename);
            $fileModel->name = $filename;
            $fileModel->file_path = $filename;
            $res = $fileModel->save();
            return $fileModel;
            if ($res) {
                return 0;
            } else {
                return 1;
            }

        }
        return 1;
    }




}
