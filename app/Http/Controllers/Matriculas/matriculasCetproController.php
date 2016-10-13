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
use Fpdf;

class matriculasCetproController extends Controller {

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
		})->where('ciudad', \Auth::user()->ciudad)->where('estado',1)->orderBy('fecha_matricula', 'desc')->paginate(20);
		return view('/vistasMatriculasCETPRO/matriculasCETPRO', compact('matriculas'));
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
		return view('vistasMatriculasCETPRO/nuevaMatriculaCETPRO', compact('carreras', 'alumnos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function store(Request $request)
	{
		//dd($request->alumno_id);
		$buscamatriculado = matricula::where('alumno_id', $request->alumno_id)->where('carrera_id', $request->carrera_id)->first();
		if(is_null($buscamatriculado))
		{
			$matriculas = new matricula($request->all());
			$matriculas->estado = 1;
			$matriculas->user_id = \Auth::user()->id; //------->> recupera y asigna el id del usuario que ha matriculado
			$grupos = grupo::findOrFail($request->grupo_id);
			$matriculas->save();
			$semestres = semestre::with('cursos')->findOrFail($grupos->ciclo_id);
			foreach ($semestres->cursos as $dtcursos) {
				$detallematricula = new detalle_matricula();
				$detallematricula->curso_id = $dtcursos->id;
				$detallematricula->grupo_id = $request->grupo_id;
				$detallematricula->matricula_id = $matriculas->id;
				$detallematricula->user_id = \Auth::user()->id;
				$detallematricula->save();

			}
			return redirect()->route('cetpromatricula.matriculacetpro.index');
		}
		else
		{
			if($request->carrera_id == $buscamatriculado->carrera_id)
			{
				//dd('Alumno se encuentra matriculado en la carrera');
				Session::flash('message', 'El alumno '.$buscamatriculado->alumnos->nombres.' ya se encuentra matriculado en la carrera de '.$buscamatriculado->carreras->nombre);
				return redirect()->back();
			}
			else
			{
				$matriculas = new matricula($request->all());
				$matriculas->estado = 1;
				$matriculas->user_id = \Auth::user()->id; //------->> recupera y asigna el id del usuario que ha matriculado
				$grupos = grupo::findOrFail($request->grupo_id);
				$matriculas->save();
				$semestres = semestre::with('cursos')->findOrFail($grupos->ciclo_id);
				foreach ($semestres->cursos as $dtcursos) {
					$detallematricula = new detalle_matricula();
					$detallematricula->curso_id = $dtcursos->id;
					$detallematricula->grupo_id = $request->grupo_id;
					$detallematricula->matricula_id = $matriculas->id;
					$detallematricula->user_id = \Auth::user()->id;
					$detallematricula->save();
				}
				return redirect()->route('cetpromatricula.matriculacetpro.index');
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$modulos= [];
		$matricula = matricula::with('carreras','alumnos')->findOrFail($id);
		//$carreras = carrera::where('tipo', 'CETPRO')->where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		$modulos = $matricula->carreras->semestres->lists('ciclo','id');
		$modulos = array('0'=>'Seleccione Modulo')+$modulos;
		return view('vistasMatriculasCETPRO.inscribirCursoCETPRO', compact('matricula','modulos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$matriculaModel = matricula::with('carreras', 'alumnos', 'detalles_matriculas')->findOrFail($id);
		return view('vistasMatriculasCETPRO.cambiarGrupoCetpro', compact('matriculaModel'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
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
	public function verificarAlumno(Request $request)
	{
		$vermatriculas = matricula::with('carreras')->whereHas('carreras', function($q){
			$q->where('tipo', 'CETPRO');
		})->where('alumno_id', $request->idalumno)->get();
		if(count($vermatriculas)==0)
		{
			return 0;
		}
		elseif (count($vermatriculas)>0) {
			return $vermatriculas;
		}
	}

}
