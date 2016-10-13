<?php namespace flavisur\Http\Controllers\Alumnos;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\carrera;
use flavisur\semestre;
use flavisur\matricula;
use flavisur\detalle_matricula;
use flavisur\Alumno;
use flavisur\grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class vaciarRegistrosController extends Controller {

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
		$semestres = [];
		$semestres = semestre::where('carrera_id', 4)->where('estado', 1)->lists('ciclo', 'id'); 
		$semestres = array(0 =>'seleccione')+$semestres;
		return view('vistasRegistrosAntiguos/RegistrarNotasAntiguas', compact('semestres'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		dd("Ingrese");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return 'Ingrese correctamente';
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
	public function update(Request $request)
	{
		$grupodid = 0;
		if(!$request->matricula){
		$alumno = Alumno::findOrFail($request->alumno_id);
		$matricula = matricula::where('carrera_id', 4)->where('alumno_id', $request->alumno_id)->firstOrFail();

		}
		$semestre = semestre::with('cursos')->findOrFail($request->semestres_id);
		
		if($semestre->id == 1){$grupodid = 1;}
		if($semestre->id == 2){$grupodid = 3;}
		if($semestre->id == 3){$grupodid = 4;}
		if($semestre->id == 4){$grupodid = 5;}
		if($semestre->id == 5){$grupodid = 6;}
		if($semestre->id == 6){$grupodid = 7;}
		if($semestre->id == 7){$grupodid = 8;}
		if($semestre->id == 8){$grupodid = 9;}
		if($semestre->id == 9){$grupodid = 10;}
		if($semestre->id == 10){$grupodid = 11;}
		if($semestre->id == 11){$grupodid = 12;}
		if($semestre->id == 12){$grupodid = 13;}
		$grupos = grupo::findOrFail($grupodid);
		if($request->matricula)
		{

			$buscamatriculado = matricula::where('carrera_id', 4)->where('alumno_id', $request->alumno_id)->first();
			//$buscamatriculado = matricula::with('alumnos')->findOrFail(974);

			if(is_null($buscamatriculado))
			{
				
				$matriculas = new matricula();
				$matriculas->carrera_id = 4;
				$matriculas->alumno_id = $request->alumno_id;
				$matriculas->modulo_id = $request->semestres_id;
				$matriculas->fecha_matricula = $request->fecha_matricula;
				$matriculas->ciudad = $request->ciudad;
				$matriculas->estado = 1;
				$matriculas->user_id = \Auth::user()->id; //------->> recupera y asigna el id del usuario que ha matriculado
				$matriculas->save();
				foreach ($semestre->cursos as $dtcursos) {
					$detallematricula = new detalle_matricula();
					$detallematricula->curso_id = $dtcursos->id;
					$detallematricula->grupo_id = $grupodid;
					$detallematricula->matricula_id = $matriculas->id;
					$detallematricula->nota1= $request->examenoral;
					$detallematricula->nota2= $request->trabajoinvestigacion;
					$detallematricula->nota3= $request->conductapuntual;
					$detallematricula->pr_unidad= $request->presentacioncuaderno;
					$detallematricula->sg_unidad= $request->examenpractico;
					$detallematricula->tr_unidad= $request->examenfinal;
					$detallematricula->promedio= round(($request->examenoral+$request->trabajoinvestigacion+$request->conductapuntual
													+$request->presentacioncuaderno+$request->examenpractico+$request->examenfinal)/6);
					$detallematricula->user_id = \Auth::user()->id;
					$detallematricula->save();
				}
				return "Matriculado y notas registradas correctamente";
			}else
			{
				return "1";
			}

		}
		else
		{
			$verifica = 0;

			$verificarMatriculas = matricula::with('detalles_matriculas')->where('carrera_id', 4)->where('alumno_id', $request->alumno_id)->first();
			if(is_null($verificarMatriculas))
			{
				return 'No se encontro matricula';
	
			}
			else
			{
				foreach ($verificarMatriculas->detalles_matriculas as $detalles) {
					if($detalles->grupos->ciclo_id == $grupos->ciclo_id)
					{
						$detalles->nota1= $request->examenoral;
						$detalles->nota2= $request->trabajoinvestigacion;
						$detalles->nota3= $request->conductapuntual;
						$detalles->pr_unidad= $request->presentacioncuaderno;
						$detalles->sg_unidad= $request->examenpractico;
						$detalles->tr_unidad= $request->examenfinal;
						$detalles->promedio= round(($request->examenoral+$request->trabajoinvestigacion+$request->conductapuntual
														+$request->presentacioncuaderno+$request->examenpractico+$request->examenfinal)/6);
						$detalles->user_id = \Auth::user()->id;
						$detalles->save();
						$verifica = 1;
					}
				}
				if($verifica==1)
				{
					return "Registro actualizado correctamente";
				}
			}
			if($verifica == 0)
			{
				//return 'nuevo registro detalle';
				foreach ($semestre->cursos as $dtcursos) {
					$detallematricula = new detalle_matricula();
					$detallematricula->curso_id = $dtcursos->id;
					$detallematricula->grupo_id = $grupodid;
					$detallematricula->matricula_id = $matricula->id;
					
					//if($dtcursos->id == 1)
					{
						$detallematricula->promedio= $request->operacionpr;
						$detallematricula->nota1= $request->examenoral;
						$detallematricula->nota2= $request->trabajoinvestigacion;
						$detallematricula->nota3= $request->conductapuntual;
						$detallematricula->pr_unidad= $request->presentacioncuaderno;
						$detallematricula->sg_unidad= $request->examenpractico;
						$detallematricula->tr_unidad= $request->examenfinal;
						$detallematricula->promedio= round(($request->examenoral+$request->trabajoinvestigacion+$request->conductapuntual
													+$request->presentacioncuaderno+$request->examenpractico+$request->examenfinal)/6);
					}

					$detallematricula->user_id = \Auth::user()->id;
					$detallematricula->save();
				}
				return "Nuevos Datos Registrado Correctamente";
			}
		}
		
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
