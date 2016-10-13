<?php namespace flavisur\Http\Controllers\Asistencia;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\detalle_matricula;
use flavisur\detalle_grupo;
use flavisur\matricula;
use flavisur\asistencia;
use Illuminate\Http\Request;
use Fpdf;
use Carbon\Carbon;

class asistenciaCetproController extends Controller {

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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if($request->checked == 1)
		{
			$date = Carbon::now('America/Lima');
			$date = $date->format('Y-m-d');
			$detalle = detalle_matricula::findOrFail($request->detalle_id);
			$asistencia = asistencia::where('grupo_id', $detalle->grupo_id)->where('alumno_id', $detalle->matriculas->alumno_id)
							->where('user_id', \Auth::user()->id)->where('fecha', $date)->first();
			if(is_null($asistencia))
			{
				$asistencia = new asistencia();
				$asistencia->grupo_id = $detalle->grupo_id;
				$asistencia->alumno_id = $detalle->matriculas->alumno_id;
				$asistencia->matricula_id = $detalle->matriculas->id;
				$asistencia->user_id = \Auth::user()->id;
				$asistencia->fecha = $date;
				$asistencia->save();
				return 'Registrado';
			}else
			{
				return 'Registrado';
			}
		}elseif ($request->checked==0) {
			$date = Carbon::now('America/Lima');
			$date = $date->format('Y-m-d');
			$detalle = detalle_matricula::findOrFail($request->detalle_id);
			$asistencia = asistencia::where('grupo_id', $detalle->grupo_id)->where('alumno_id', $detalle->matriculas->alumno_id)
							->where('matricula_id',$detalle->matriculas->id)->where('user_id', \Auth::user()->id)->where('fecha', $date)->first();
			if (!is_null($asistencia)) {
				$asistencia->delete();
				return 'Asistencia Eliminada';
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
		$user_id = \Auth::user()->id;
		$detgrup = detalle_grupo::where('user_id', $user_id)->findOrfail($id);
		$detmat = detalle_matricula::with('cursos', 'matriculas')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->paginate(50);
		return view('vistasNotasCETPRO/listaAlumnoAsistenciaCETPRO', compact('detmat', 'detgrup'));
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
