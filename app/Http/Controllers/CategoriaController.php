<?php

namespace hello_laravel_heroku\Http\Controllers;

use Illuminate\Http\Request;
use hello_laravel_heroku\Http\Requests;
use hello_laravel_heroku\Categoria;
use Illuminate\Support\Facades\Redirect;
use hello_laravel_heroku\Http\Requests\CategoriaFormRequest;
use DB;
class CategoriaController extends Controller
{
    //
    public function __construct(){

    }
    public function index(Request $request){
    	if($request){
    		$query=trim($request->('searchText'));
    		$categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')->where('condicion','=','1')->orderBy('id','desc')->paginate(7);
    		return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=$query]);
    	}
    }
    public function create(){
    	return view("almacen.categoria.create");
    }
    public function store(CategoriaFormRequest $request){
    	$categoria=new Categoria;
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->condicion='1';
    	$categoria->save();
    	return Redirect::to('almacen/categoria');
    }
    public function show($id){
    	return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit(){
    	return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(){
    	$categoria=Categoria::findOrFail($id);
    	$categoria->nombre->$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->update();
    	return Redirect::to('almacen/categoria');
    }
    public function destroy($id){
    	$categoria=Categoria::findOrFail($id);
    	$categoria->condicion='0';
    	$categoria->update();
    	return Redirect::to('almacen/categoria');
    }
}
