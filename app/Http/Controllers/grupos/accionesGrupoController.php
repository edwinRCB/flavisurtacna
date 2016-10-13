<?php namespace flavisur\Http\Controllers\grupos;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\grupo;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class accionesGrupoController extends Controller {

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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request  $request)
	{
		$grupo = grupo::findOrFail($request->grupo_id);
		if($grupo->estado == 1)
		{
			Session::flash('message', 'No se realizo cambios, el grupo ya esta activado');
			return redirect()->route('generalgrupo.grupo.index');
		}
		else
		{
			$grupo->estado = 1;
			$grupo->save();
			Session::flash('message', 'El grupo fue activado correctamente');
			return redirect()->route('generalgrupo.grupo.index');
		}

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
