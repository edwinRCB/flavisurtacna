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

class grupoController extends Controller {

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
	public function index(Request $request)
	{
		if($request->get('carrera_id')!=0)
		{
			$grupos = grupo::Carrera($request->get('carrera_id'))->with('ciclos','carreras')->whereHas('carreras', function($q){
				$q->where('tipo','INSTITUTO');
			})->where('ciudad', \Auth::user()->ciudad)->where('estado',1)->orderBy('inicio','desc')->paginate(30);
		}
		else
		{
			$grupos = grupo::Carrera($request->get('carrera_id'))->with('ciclos','carreras')->whereHas('carreras', function($q){
				$q->where('tipo','INSTITUTO');
			})->where('ciudad', \Auth::user()->ciudad)->orderBy('inicio','desc')->paginate(30);
		}


		$carreras = [];
		// deme todas las especialidades ordenadas por nombre y de ellas agarar solo el nombre y el id
		$carreras = carrera::orderBy('nombre')->where('tipo', 'INSTITUTO')->where('estado', 1)->lists('nombre', 'id'); 
		$carreras = array(0=>'Todas las Carreras')+$carreras;
		//dd($carreras);
		return view('vistasgrupos/grupos', compact('grupos', 'carreras'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$carreras = [];
		$carreras = carrera::where('estado', 1)->where('tipo', 'INSTITUTO')->orderBy('nombre')->lists('nombre', 'id');
		$carreras = array(0=>'Seleccione Carrera')+ $carreras;
		return view('vistasgrupos/nuevoGrupo', compact('carreras'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$grupos = new grupo($request->all());
		$ciclos = semestre::findOrFail($request->ciclo_id);
		$grupos->estado = 1;
		$grupos->save();
		foreach ($ciclos->cursos as $curso) {
			$detallegrupo = new detalle_grupo();
			$detallegrupo->grupo_id = $grupos->id;
			$detallegrupo->curso_id = $curso->id;
			$detallegrupo->user_id = 1;
			$detallegrupo->estado = 1;
			$detallegrupo->save();
		}
		return redirect()->route('generalgrupo.grupo.index');
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
		$detmat = detalle_matricula::with('cursos', 'matriculas', 'grupos')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)
		->get()->sortBy(function($alum){
			return $alum->matriculas->alumnos->nombres;
		});
		//cabecera
		$fpdf = new Fpdf();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Image('img/logoflv.png',10,8,33);
        $fpdf->Cell(50);
    	// Título
    	$fpdf->Cell(30,10, utf8_decode('Instituto Superior Tecnológico Flavisur'));
    	// Salto de línea
    	$fpdf->SetFont('Arial','B',12);
    	$fpdf->Ln(20);
        //$fpdf->Cell(40,10,'Hello World!');
        //$headers=['Content-Type' => 'aplication/pdf'];
        $date = Carbon::now();

        $w = 1;
        $fpdf->Cell(20,10*$w,'Docente:');
        $fpdf->Cell(90,10*$w, utf8_decode($detgrup->users->name));
        $fpdf->Cell(35,10*$w,'Fecha:');
        $fpdf->Cell(15,10*$w, $date->format('d-m-Y'));
        $fpdf->Ln();
        $fpdf->Cell(15,10*$w,'Curso:');
        $fpdf->Cell(80,10*$w, utf8_decode($detgrup->cursos->nombre));
        $fpdf->Cell(15,10*$w,'Grupo:');
        $fpdf->Cell(20,10*$w, utf8_decode($detgrup->grupos->nombre_unidad));
        $fpdf->Cell(17,10*$w,'Horario:');
        $fpdf->Cell(15,10*$w, utf8_decode($detgrup->grupos->Horario));
        $fpdf->Ln();
         $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10*$w,'#', 1,0, 'C');
        $fpdf->Cell(90,10*$w,'Alumno', 1,0, 'C');
        $fpdf->Cell(11,10*$w,'Ciclo', 1,0, 'C');
        $fpdf->Cell(20,10*$w,'1raUnidad', 1,0, 'C');
        $fpdf->Cell(20,10*$w,'2daUnidad', 1,0, 'C');
        $fpdf->Cell(20,10*$w,'3raUnidad', 1,0, 'C');
        $fpdf->Cell(20,10*$w,'Promedio', 1,0, 'C');
        $fpdf->Ln();
        $fpdf->Line(10, 50, 200, 50);
        $fpdf->SetFont('Arial','',10);
        foreach ($detmat as $detalles) {
        	$fpdf->Cell(10,10,$w, 1,0, 'C');
        	$fpdf->Cell(90,10,utf8_decode($detalles->matriculas->alumnos->nombres),1,0, 'L');
        	$fpdf->Cell(11,10,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
        	$fpdf->Cell(20,10,$detalles->pr_unidad, 1,0, 'C');
        	$fpdf->Cell(20,10,$detalles->sg_unidad, 1,0, 'C');
        	$fpdf->Cell(20,10,$detalles->tr_unidad, 1,0, 'C');
        	$fpdf->Cell(20,10,$detalles->promedio, 1,0, 'C');
	        $fpdf->Ln();
	        $w++;
	        //$fpdf->Cell()
        }
        $fpdf->Output();
        exit;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//tipo de ususario
		/*$users = User::whereHas('perfil', function($q)
		{
			$q->where('tipousuario', 'docente');
		})->lists('name','id');*/
		$users = User::where('tipo','docente')->orderBy('name', 'asc')->lists('name', 'id');
		$grupos = grupo::with('ciclos', 'detalles_grupos')->findOrFail($id);
		//$users = User::lists('name', 'id');
		$users = array(0=>'Seleccione Docente')+ $users;
		//asigna los cursos que pertenecen al ciclo de una determinada carrera, la lista se muestra en un select box en la vista
		$ciclos = semestre::with('cursos')->where('id', $grupos->ciclo_id)->firstOrFail();
		$cursos = $ciclos->cursos->lists('nombre', 'id');
		$cursos = array(0=>'Seleccione Curso')+ $cursos;
		//dd($cur);

		return view('vistasgrupos.editarGrupo', compact('grupos', 'users', 'cursos'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$grupos = grupo::findOrFail($id);
		$grupos->fill($request->all());
		$grupos->save();
		return redirect()->route('generalgrupo.grupo.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$grupos = grupo::findOrFail($request->id);

		if (\Request::ajax())
		{
			$grupos->estado = 0;
			$grupos->save();
 
		return response()->json(['message' => 'El grupo fue Desactivado']);
		}
		else
		{
			return 'peticion no es ajax';
		}
		/*if(is_null($grupos))
		{
			app::abort(404);
		}
		else
		{
			//$grupos->fill($request->all());
			$grupos->estado = 0;
			$grupos->save();
			Session::flash('message', 'El grupo fue Desactivado');
			return 'Grupo Cerrado Correctamente';
		}*/
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function findSemestres(Request $request)
	{
		$semestres = [];
		$id = $request->idcarrera;
		//dd($request);
		// deme todas las especialidades ordenadas por nombre y de ellas agarar solo el nombre y el id
		$semestres = semestre::where('carrera_id', $id)->where('estado', 1)->lists('ciclo', 'id'); 
	
		return $semestres;
	}
	public function getGrupos(Request $request)
	{
		$grupos = [];
		$id = $request->idciclo;
		//$grupos = grupo::where('ciclo_id', $id)->where('estado', 1)->lists('nombre_unidad', 'id');
		$grupos = grupo::where('ciclo_id', $id)->where('estado', 1)->get();
		return $grupos;
	}
	public function getCursos(Request $request)
	{
		//$cursos = [];
		$id = $request->idgrupo;
		$grupoid = grupo::findOrFail($id);
		$semestres = semestre::with('cursos')->findOrFail($grupoid->ciclo_id); //where('id', $grupoid->ciclo_id); 

		return $semestres->cursos;
	}
}
