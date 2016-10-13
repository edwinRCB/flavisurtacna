<?php namespace flavisur\Http\Controllers\Matriculas;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\matricula;
use flavisur\Alumno;
use flavisur\carrera;
use flavisur\semestre;
use flavisur\grupo;
use flavisur\detalle_matricula;
use flavisur\detalle_inscripcion;
use flavisur\inscripcion;
use Illuminate\Http\Request;
use Fpdf;

class inscripcionesController extends Controller {

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
	public function index(Request $request)
	{
		$matriculas = matricula::with('alumnos','carreras')->NombreMatricula($request->get('nombres'))->whereHas('carreras', function($q){
			$q->where('tipo', 'CETPRO');
		})->take(100)->where('estado',1)->orderBy('fecha_matricula', 'desc')->paginate(20);
		return view('/vistasMatriculasCETPRO/matriculasCETPROprueba', compact('matriculas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$carreras = [];
		$alumnos = Alumno::where('estado', 1);
		$carreras = carrera::where('tipo', 'CETPRO')->where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		//$carreras = carrera::where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		$carreras = array(0=>'seleccione Carrera')+ $carreras;
		return view('vistasmatriculasCETPRO/nuevaMatriculaCETPRO2', compact('carreras', 'alumnos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//dd($request->fecha_matricula);
		$matriculas = new matricula($request->all());
		$matriculas->estado = 1;
		$matriculas->user_id = \Auth::user()->id; //------->> recupera y asigna el id del usuario que ha matriculado
		$matriculas->save();
		$grupos = grupo::findOrFail($request->grupo_id);
		
		$semestres = semestre::with('cursos')->findOrFail($grupos->ciclo_id);
		$inscripcion = new inscripcion();
		$inscripcion->matricula_id = $matriculas->id;
		$inscripcion->grupo_id = $request->grupo_id;
		$inscripcion->fecha_inscripcion = $request->fecha_matricula;
		$inscripcion->estado = 1;
		$inscripcion->save();
		foreach ($semestres->cursos as $dtcursos) {
			$detalle_inscripcion = new detalle_inscripcion();
			$detalle_inscripcion->curso_id = $dtcursos->id;
			$detalle_inscripcion->grupo_id = $request->grupo_id;
			$detalle_inscripcion->inscripcion_id = $inscripcion->id;
			$detalle_inscripcion->save();

		}
		return redirect()->route('cetpromatricula.inscripciones.index');
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
