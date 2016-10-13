<?php namespace flavisur\Http\Controllers\Planestudios;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\semestre;
use flavisur\carrera;
use Illuminate\Http\Request;

class SemestreController extends Controller {

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
		$semestres = semestre::with('carreras')->where('estado', 1)->paginate(15);
		/*$semestres = semestre::with(array('carreras'=>function($query){
			$query->where('estado',1);
		}))->where('estado', 1)->paginate(20);*/
		//dd($semestres);
		return view('vistasplanestudio/semestres', compact('semestres') );
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
		$semestres = new semestre($request->all());
		$semestres->estado = 1;
		//$request->input('ciclo')
		//dd($semestres);
		$semestres->save();
		return redirect()->route('planestudio.carrera.index');
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
		return 'desde edit';
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
	public function destroy($id, Request $request)
	{
		$semestre = semestre::findOrFail($id);
		if(is_null($semestre))
			{ return 'registro no encontrado' ;}
		else
		{
			$semestre->fill($request->all());
			$semestre->estado=0;
			$semestre->save();
			return ' Eliminado correctamente';
		}
	}
	public function getModulosCetpro()
	{
		
	}

}
