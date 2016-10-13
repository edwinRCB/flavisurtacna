<?php namespace flavisur\Http\Controllers\Usuarios;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\User;
use Illuminate\Http\Request;

class usuarioController extends Controller {

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
	public function index(Request $request)
	{
			$usuarios = User::Usuario($request->get('usuario'))->paginate(20);
			return view('vistasUsuarios/usuarios', compact('usuarios'));	
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
		$usuario = new User($request->all());
		$usuario->clave = $request->password;
		$usuario->save();
		return redirect()->route('admin.usuarios.index');
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
		dd('usuarioController');
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
