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

class RegistrosAntiguosOP2Controller extends Controller {

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
		//dd('OP2');
		$semestres = [];
		$semestres = semestre::where('carrera_id', 5)->where('estado', 1)->lists('ciclo', 'id'); 
		$semestres = array(0 =>'seleccione')+$semestres;
		return view('vistasRegistrosAntiguos/RegistrarNotasAntiguasII', compact('semestres'));
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
	public function store()
	{
		//
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
			$matricula = matricula::where('carrera_id', 5)->where('alumno_id', $request->alumno_id)->firstOrFail();
		}

		$semestre = semestre::with('cursos')->findOrFail($request->semestres_id);
		if($semestre->id == 13){$grupodid = 14;}
		if($semestre->id == 14){$grupodid = 15;}
		if($semestre->id == 15){$grupodid = 16;}
		if($semestre->id == 16){$grupodid = 17;}
		if($semestre->id == 17){$grupodid = 18;}
		if($semestre->id == 18){$grupodid = 19;}
		if($semestre->id == 19){$grupodid = 20;}
		if($semestre->id == 20){$grupodid = 21;}
		if($semestre->id == 21){$grupodid = 22;}
		if($semestre->id == 22){$grupodid = 23;}
		if($semestre->id == 23){$grupodid = 24;}
		if($semestre->id == 24){$grupodid = 25;}
		$grupos = grupo::findOrFail($grupodid);

		if($request->matricula)
		{
			$buscamatriculado = matricula::where('carrera_id', 5)->where('alumno_id', $request->alumno_id)->first();
			if(is_null($buscamatriculado))
			{
				
				$matriculas = new matricula();
				$matriculas->carrera_id = 5;
				$matriculas->alumno_id = $request->alumno_id;
				$matriculas->modulo_id = $request->semestres_id;
				$matriculas->fecha_matricula = $request->fecha_matricula;
				$matriculas->ciudad = $request->ciudad;
				$matriculas->estado = 1;
				$matriculas->user_id = \Auth::user()->id; //------->> recupera y asigna el id del usuario que ha matriculado
				
				$matriculas->save();

			
				//foreach ($semestre->cursos as $dtcursos) {
					$detallematricula = new detalle_matricula();
					$detallematricula->curso_id = $request->curso_id;
					$detallematricula->grupo_id = $grupodid;
					$detallematricula->matricula_id = $matriculas->id;
					//if($dtcursos->id == $request->curso_id)
					{
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
				//}
				return "Matriculado y notas registradas correctamente";
			}else
			{
				return "1";
			}

		}else
		{
			$verifica = 0;
			$verificarMatriculas = matricula::with('detalles_matriculas')->where('carrera_id', 5)->where('alumno_id', $request->alumno_id)->first();
			if(is_null($verificarMatriculas))
			{
				return 'No se encontro matricula';
	
			}
			else
			{
				foreach ($verificarMatriculas->detalles_matriculas as $detalles) {

					if($detalles->grupos->ciclo_id == $grupos->ciclo_id && $detalles->curso_id == $request->curso_id)
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
					return "Registros Actualizados Correctamente";
				}
			}
			if($verifica == 0)
			{
				//return 'nuevo registro detalle';
				//foreach ($semestre->cursos as $dtcursos) {
					$detallematricula = new detalle_matricula();
					$detallematricula->curso_id = $request->curso_id;
					$detallematricula->grupo_id = $grupodid;
					$detallematricula->matricula_id = $matricula->id;
					$detallematricula->promedio= $request->operacionpr;
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
				//}
				return "Nuevos Datos Registrados Correctamente";
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
	public function getCursos(Request $request)
	{
		$semestres = semestre::with('cursos')->findOrFail($request->idsemestre); //where('id', $grupoid->ciclo_id); 

		return $semestres->cursos;
	}

}
