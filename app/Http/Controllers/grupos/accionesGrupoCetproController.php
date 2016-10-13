<?php namespace flavisur\Http\Controllers\grupos;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\grupo;
use flavisur\detalle_grupo;
use flavisur\detalle_matricula;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Fpdf;
use Carbon\Carbon;

class accionesGrupoCetproController extends Controller {

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
		$grupo = grupo::findOrfail($id);
		$detgrup = detalle_grupo::with('users')->where('grupo_id', $grupo->id)->first();
		$detmat = detalle_matricula::with('cursos', 'matriculas', 'matriculas.alumnos', 'grupos')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();
		return view('vistasgruposCETPRO.listaAlumnosGrupoCETPRO', compact('detmat', 'detgrup'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request)
	{
		//dd($request->grupo_id);
	    $grupo = grupo::findOrFail($request->grupo_id);
	    if($grupo->estado == 1)
	    {
			Session::flash('message', 'No se realizo cambios, el grupo ya esta activado');
			return redirect()->route('generalgrupo.grupocetpro.index'); 
	    }
	    else
	    {
	 		$grupo->estado = 1;
			$grupo->save();
			Session::flash('message', 'El grupo fue activado');
			return redirect()->route('generalgrupo.grupocetpro.index');   	
	    }
		$grupo->estado = 1;
		$grupo->save();
		Session::flash('message', 'El grupo fue activado');
		return redirect()->route('generalgrupo.grupocetpro.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		dd('accionesGddddddddddrupoCetproController');
		$grupo = grupo::findOrFail($id);
		$grupo->estado = 0;
		$grupo->save();
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
