<?php namespace flavisur\Http\Controllers\DocentesController;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\docente;
use Illuminate\Http\Request;

class DocentesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
	} 
	public function index()
	{
		$docentes = docente::where('estado', 1)->paginate(10);
		return view('vistasdocentes/docentes', compact('docentes'));
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
		$docentes = new docente($request->all());
		$docentes->estado = 1;
		$docentes->save();
		return redirect()->route('profesores.docente.index');
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
		//dd($id);
		$docentemodel = docente::findOrFail($id);
		//dd($docentemodel);
		return view('vistasdocentes.editarDocente', compact('docentemodel'));
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
	public function destroy($id, Request $request)
	{
		$docentes = docente::findOrFail($id);
		//return $id;
		if(is_null($docentes))
			{ app::abort(404);}
		else
		{
			$docentes->fill($request->all());
			$docentes->estado = 0;
			$docentes->save();
			//$alumno->delete();

			return 'registro Eliminado con exito';
		}
	}

}
