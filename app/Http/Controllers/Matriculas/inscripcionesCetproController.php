<?php namespace flavisur\Http\Controllers\Matriculas;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\matricula;
use flavisur\Alumno;
use flavisur\carrera;
use flavisur\semestre;
use flavisur\grupo;
use flavisur\detalle_matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class inscripcionesCetproController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('tipo_secretaria');
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
		$matriculas = matricula::with('detalles_matriculas')->findOrFail($request->matricula_id);
		$grupos = grupo::findOrFail($request->grupo_id);
		foreach ($matriculas->detalles_matriculas as $detalles) {
			if($detalles->grupos->ciclo_id == $grupos->ciclo_id)
			{
				Session::flash('message', 'No se pudo realizar la inscripcion, el alumno '.$matriculas->alumnos->nombres. ' ya se encuentra Inscrito con anterioridad en el modulo '. $grupos->ciclos->ciclo. '.');
				return redirect()->route('cetpromatricula.matriculacetpro.index');
			}	
		}
		$semestres = semestre::with('cursos')->findOrFail($grupos->ciclo_id);
		foreach ($semestres->cursos as $dtcursos) {
			$detallematricula = new detalle_matricula();
			$detallematricula->curso_id = $dtcursos->id;
			$detallematricula->grupo_id = $request->grupo_id;
			$detallematricula->matricula_id = $matriculas->id;
			$detallematricula->user_id = \Auth::user()->id;
			$detallematricula->save();
		}
		Session::flash('message', 'Se registro correctamente al alumno '.$matriculas->alumnos->nombres.' en el modulo ' .$grupos->ciclos->ciclo. '.');
		return redirect()->route('cetpromatricula.matriculacetpro.index');
		/*$matriculas = matricula::findOrFail($request->matricula_id);
		$grupos = grupo::findOrFail($request->grupo_id);
		$semestres = semestre::with('cursos')->findOrFail($grupos->ciclo_id);
		foreach ($semestres->cursos as $dtcursos) {
			$detallematricula = new detalle_matricula();
			$detallematricula->curso_id = $dtcursos->id;
			$detallematricula->grupo_id = $request->grupo_id;
			$detallematricula->matricula_id = $matriculas->id;
			$detallematricula->save();
		}
		return redirect()->route('cetpromatricula.matriculacetpro.index');*/
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
		//
	}

}
