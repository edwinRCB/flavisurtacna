<?php namespace flavisur\Http\Controllers\Planestudios;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\curso;
use Illuminate\Http\Request;

class CursoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('tipo_usuario');
	} 
	public function index()
	{
		$cursos = curso::where('estado', 1)->paginate(10);
		return view('vistasplanestudio/cursos', compact('cursos'));
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
		$cursos = new curso($request->all());
		$cursos->estado = 1;
		$cursos->save();
		return redirect()->route('planestudio.curso.index');
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
		$curso = curso::findOrFail($id);
		return view('vistasplanestudio.modificarCurso', compact('curso'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$curso = curso::findOrFail($id);
		$curso->fill($request->all());
		$curso->save();
		return redirect()->route('planestudio.curso.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$curso = curso::findOrFail($id);
		if(is_null($curso))
			{	app::abort(404);}
		else
		{
			$curso->fill($request->all());
			$curso->estado = 0;
			$curso->save();
			return 'curso Eliminado con exito';
		}
	}

}
