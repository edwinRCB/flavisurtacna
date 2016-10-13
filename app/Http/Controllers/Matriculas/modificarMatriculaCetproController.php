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

class modificarMatriculaCetproController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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
		dd('hola');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$grupoNuevo = grupo::findOrFail($request->grupo_id);
		$detalleaux = detalle_matricula::with('grupos.ciclos')->findOrFail($request->detalle_id);
		$detalleVerificar = detalle_matricula::with('grupos.ciclos')->where('matricula_id', $detalleaux->matricula_id)->get();
		foreach ($detalleVerificar as $detallev) 
		{
			if($detallev->grupos->ciclos->ciclo == $grupoNuevo->ciclos->ciclo)
			{
				Session::flash('message', 'El alumno ya se encuentra inscrito en el modulo: '.$detallev->grupos->ciclos->ciclo. 'verifique los datos');
				return redirect()->back();
			}
		}

		$id_matricula = $detalleaux->matricula_id;
		$detallesMatriculas = detalle_matricula::where('matricula_id', $detalleaux->matricula_id)->where('grupo_id', $detalleaux->grupo_id)->get();
		foreach ($detallesMatriculas as $dtmatriculas) {
			$dtmatriculas->delete();
		}
		foreach ($grupoNuevo->detalles_grupos as $dtgrupos) 
		{
				$detallematricula = new detalle_matricula();
				$detallematricula->curso_id = $dtgrupos->curso_id;
				$detallematricula->grupo_id = $request->grupo_id;
				$detallematricula->matricula_id = $id_matricula;
				$detallematricula->user_id = \Auth::user()->id;
				$detallematricula->save();
		}
		$matricula = matricula::with('alumnos')->findOrFail($id_matricula);
		Session::flash('message', 'Se cambio de Modulo Correctamente del alumno: '.$matricula->alumnos->nombres. ', del Modulo:'.$detalleaux->grupos->ciclos->ciclo.' al Modulo, '.$grupoNuevo->ciclos->ciclo );
		return redirect()->route('cetpromatricula.matriculacetpro.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $detallesMatriculas = detalle_matricula::with('grupos')->findOrFail($id);
		$matriculaModel = matricula::with('carreras', 'alumnos')->findOrFail($detallesMatriculas->matricula_id);
		$modulos = [];
		$modulos = semestre::where('carrera_id', $matriculaModel->carrera_id)->where('estado', 1)->lists('ciclo', 'id'); 
		$modulos = array('0'=>'Seleccione Modulo')+$modulos;
		return view('vistasMatriculasCETPRO.cambiarModuloCETPRO', compact('matriculaModel', 'modulos', 'detallesMatriculas'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$detallesMatriculas = detalle_matricula::with('grupos')->findOrFail($id);
		$matriculaModel = matricula::with('carreras', 'alumnos')->findOrFail($detallesMatriculas->matricula_id);
		//$grupos = [];
		//$grupos = grupo::where('carrera_id', $matriculaModel->carrera_id)->where('ciclo_id', $detallesMatriculas->grupos->ciclo_id)->where('estado', 1)->lists('nombre_unidad','id');
		$grupos = grupo::where('carrera_id', $matriculaModel->carrera_id)->where('ciclo_id', $detallesMatriculas->grupos->ciclo_id)
		->where('estado', 1)->get();
		return view('vistasMatriculasCETPRO.editarGrupoCetpro', compact('matriculaModel', 'grupos','detallesMatriculas'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//dd($request->grupo_id);
		$detalleaux = detalle_matricula::findOrFail($id);
		$detallesMatriculas = detalle_matricula::where('matricula_id', $detalleaux->matricula_id)->where('grupo_id', $detalleaux->grupo_id)->paginate(20);
		$grupoActual = grupo::findOrFail($detalleaux->grupo_id);
		$grupoNuevo = grupo::findOrFail($request->grupo_id);
		$idmatricula;
		foreach ($detallesMatriculas as $detalle) {
			$detalle->grupo_id = $request->grupo_id;
			$detalle->save();
		}
		//dd($idmatricula);
		$matricula = matricula::with('alumnos')->findOrFail($detalleaux->matricula_id);
		Session::flash('message', 'Se cambio de grupo Correctamente del alumno: '.$matricula->alumnos->nombres. ', del grupo:'.$grupoActual->nombre_unidad.' al grupo, '.$grupoNuevo->nombre_unidad );
		return redirect()->route('cetpromatricula.matriculacetpro.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		$detalles_matricula = detalle_matricula::findOrFail($request->id);
		$eliminar_detallem = detalle_matricula::where('grupo_id',$detalles_matricula->grupo_id)
			->where('matricula_id', $detalles_matricula->matricula_id)->get();
		foreach ($eliminar_detallem as $eliminardetalle) {
			$eliminardetalle->delete();
		}
		return 'registros eliminados correctamente';

	}

}
