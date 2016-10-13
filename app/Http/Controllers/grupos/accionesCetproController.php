<?php namespace flavisur\Http\Controllers\grupos;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\grupo;
use flavisur\carrera;
use flavisur\semestre;
use flavisur\curso;
use flavisur\User;
use flavisur\detalle_grupo;
use flavisur\detalle_matricula;
use Illuminate\Http\Request;
use Fpdf;
use Carbon\Carbon;

class accionesCetproController extends Controller {

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

		$detgrup = detalle_grupo::with('users')->findOrfail($id);
		//$detmat = detalle_matricula::with('cursos', 'matriculas', 'grupos')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();
		$detmat = detalle_matricula::with('cursos', 'matriculas')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->paginate(50);


		return view('vistasgruposCETPRO/editarListaAlumnosCETPRO', compact('detmat', 'detgrup'));
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
