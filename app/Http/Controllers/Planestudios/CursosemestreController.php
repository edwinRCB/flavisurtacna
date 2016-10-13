<?php namespace flavisur\Http\Controllers\Planestudios;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\cursosemestre;
use flavisur\semestre;
use flavisur\curso;
use Illuminate\Http\Request;

class CursosemestreController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('tipo_usuario');
	} 
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$semestrescursos = new cursosemestre($request->all());
		$semestrescursos->estado = 1;
		$semestrescursos->save();
		//alert("registrado correctamente");
		return 'Curso agregado al ciclo correctamente';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{	
		$ids = explode(",", $id);
		$curso = curso::find($ids[0]);
		$semestre = semestre::find($ids[1]);
		$semestre->cursos()->detach($curso);
		return "Eliminado correctamente";
	}

}
