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

class grupoCetproController extends Controller {

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
			$grupos = grupo::Carrera($request->get('carrera_id'))->Modulo($request->get('modulo_id'))->with('ciclos','carreras')->whereHas('carreras', function($q){
				$q->where('tipo','CETPRO');
		})->where('ciudad', \Auth::user()->ciudad)->where('estado',1)->orderBy('inicio','desc')->paginate(20);
		}
		else
		{
			$grupos = grupo::Carrera($request->get('carrera_id'))->with('ciclos','carreras')->whereHas('carreras', function($q){
				$q->where('tipo','CETPRO');
			})->where('ciudad', \Auth::user()->ciudad)->orderBy('inicio','desc')->paginate(20);
		}

		$carreras = [];
		// deme todas las especialidades ordenadas por nombre y de ellas agarar solo el nombre y el id
		$carreras = carrera::orderBy('nombre')->where('tipo', 'CETPRO')->where('estado',1)->lists('nombre', 'id'); 
		$carreras = array(0=>'Todas las Carreras')+$carreras;

		return view('vistasgruposCETPRO/gruposCETPRO', compact('grupos', 'carreras'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$carreras = [];
		$carreras = carrera::where('estado', 1)->where('tipo', 'CETPRO')->orderBy('nombre')->lists('nombre', 'id');
		$carreras = array(0=>'Seleccione Carrera')+ $carreras;
		return view('vistasgruposCETPRO/nuevoGrupoCETPRO', compact('carreras'));
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
		return redirect()->route('generalgrupo.grupocetpro.index');
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
		$detmat = detalle_matricula::with('cursos', 'matriculas', 'grupos')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();
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
        $fpdf->Cell(35,10*$w,'Fecha Entrega:');
        $fpdf->Cell(15,10*$w, $date->format('d-m-Y'));
        $fpdf->Ln();
        $fpdf->Cell(30,10*$w,'Curso:');
        $fpdf->Cell(40,10*$w, utf8_decode($detgrup->cursos->nombre));
        $fpdf->Cell(20,10*$w,'Grupo:');
        $fpdf->Cell(15,10*$w, utf8_decode($detgrup->grupos->nombre_unidad));
        $fpdf->Ln();
        $fpdf->Cell(15,10*$w,'#', 1,0, 'C');
        $fpdf->Cell(100,10*$w,'Alumno', 1,0, 'C');
        $fpdf->Cell(30,10*$w,'ciclo', 1,0, 'C');
        $fpdf->Cell(45,10*$w,'Promedio', 1,0, 'C');
        $fpdf->Ln();
        $fpdf->Line(10, 50, 200, 50);
        $fpdf->SetFont('Arial','',12);
        foreach ($detmat as $detalles) {
        	$fpdf->Cell(15,10,$w, 1,0, 'C');
        	$fpdf->Cell(100,10,utf8_decode($detalles->matriculas->alumnos->nombres),1,0, 'C');
        	$fpdf->Cell(30,10,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
        	$fpdf->Cell(45,10,$detalles->promedio, 1,0, 'C');
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
		$grupos = grupo::with('ciclos', 'detalles_grupos')->findOrFail($id);

		$modulos = semestre::where('carrera_id', $grupos->carrera_id)->where('estado', 1)->lists('ciclo', 'id'); 
		$modulos = array($grupos->ciclos->id => $grupos->ciclos->ciclo)+$modulos;

		$users = User::where('tipo','docente')->orderBy('name', 'asc')->lists('name', 'id');
		//$users = User::lists('name', 'id');
		$users = array(0=>'Seleccione Docente')+ $users;
		//asigna los cursos que pertenecen al ciclo de una determinada carrera, la lista se muestra en un select box en la vista
		$ciclos = semestre::with('cursos')->where('id', $grupos->ciclo_id)->firstOrFail();
		$cursos = $ciclos->cursos->lists('nombre', 'id');
		$cursos = array(0=>'Seleccione Curso')+ $cursos;
		//dd($cur);

		return view('vistasgruposCETPRO.editarGrupoCETPRO', compact('grupos', 'users', 'cursos', 'modulos'));
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
		return redirect()->route('generalgrupo.grupocetpro.index');
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
	public function findSemestres(Request $request)
	{
		$semestres = [];
		$id = $request->idcarrera;
		//dd($request);
		// deme todas las especialidades ordenadas por nombre y de ellas agarar solo el nombre y el id
		$semestres = semestre::where('carrera_id', $id)->where('estado', 1)->lists('ciclo', 'id'); 
	
		return $semestres;
	}
	public function getGruposCetpro(Request $request)
	{
		$gruposCetpro = [];
		$id = $request->idmodulo;
		//$gruposCetpro = grupo::where('ciclo_id', $id)->where('estado', 1)->lists('nombre_unidad', 'id');
		$gruposCetpro = grupo::where('ciclo_id', $id)->where('estado', 1)->get();
		return $gruposCetpro;
	}
}
