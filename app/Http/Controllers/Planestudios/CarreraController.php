<?php namespace flavisur\Http\Controllers\Planestudios;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\carrera;
use flavisur\semestre;
use flavisur\cursosemestre;
use flavisur\curso;
use Illuminate\Http\Request;

class CarreraController extends Controller {

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
		//$carreras = carrera::with('semestres')->get();
		$carreras = carrera::where('estado', 1)->paginate(5);
		//$alumnos = Alumno::paginate(5);
		//dd($carreras);
		return view('vistasplanestudio/carreras', compact('carreras'));
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
		$carreras = new carrera($request->all());
		$carreras->estado = 1;
		$carreras->save();
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
		//$carreras = carrera::findOrFail($id);
		$carreras = carrera::with(['semestres'=> function($q)
		{
			$q->where('estado', 1);
		}])->findOrFail($id);

		//dd($carreras);
		if($carreras->tipo == 'INSTITUTO')
		{
			$cursos4 = curso::where('estado', 1)->where('descripcion','INSTITUTO')->get();
		}
		elseif ($carreras->tipo == 'CETPRO') {
			$cursos4 = curso::where('estado', 1)->where('descripcion','CETPRO')->get();
		}

		return view('vistasplanestudio.modificarCarrera', compact('carreras', 'cursos4'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$carreras = carrera::findOrFail($id);
		$carreras->fill($request->all());
		$carreras->save();
		return redirect()->route('planestudio.carrera.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$carrera = carrera::findOrFail($id);
		if(is_null($carrera))
			{ app::abort(404);}
		else
		{
			$carrera->fill($request->all());
			$carrera->estado = 0;
			$carrera->save();
			//$alumno->delete();

			return 'Carrera Eliminada con exito';
		}
	}

}
