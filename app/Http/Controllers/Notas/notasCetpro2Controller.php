<?php namespace flavisur\Http\Controllers\Notas;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\detalle_grupo;
use flavisur\detalle_inscripcion;
use Illuminate\Http\Request;

class notasCetpro2Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('tipo_docente');
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
		$detgrup = detalle_grupo::findOrfail($id);
		$detalle_inscripcion = detalle_inscripcion::with('cursos', 'inscripciones', 'grupos')->where('grupo_id', $detgrup->grupo_id)
			->where('curso_id', $detgrup->curso_id)->paginate(10);
		//$detmat = detalle_matricula::with('cursos', 'matriculas')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->paginate(10);
		//dd($detmat);
		return view('vistasNotasCETPRO/listaAlumnoNotasCETPRO2', compact('detalle_inscripcion'));
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
		$notasAlumnocetpro = detalle_inscripcion::findOrfail($request->detalleinscripcion_id);
		$notasAlumnocetpro->fill($request->all());
		$notasAlumnocetpro->save();
		return 'Notas registradas correctamente';
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
