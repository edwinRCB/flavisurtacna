<?php namespace flavisur\Http\Controllers\Matriculas;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\matricula;
use flavisur\Alumno;
use flavisur\carrera;
use flavisur\semestre;
use flavisur\grupo;
use flavisur\detalle_matricula;
use Illuminate\Http\Request;
use Fpdf;


class matriculaController extends Controller {

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
		$matriculas = matricula::with('alumnos','carreras')->NombreMatricula($request->get('nombres'))->whereHas('carreras', function($q){
			$q->where('tipo', 'INSTITUTO');
		})->where('ciudad', \Auth::user()->ciudad)->orderBy('fecha_matricula', 'desc')->where('estado',1)->paginate(20);
		/*$matriculas = matricula::with(['alumnos','carreras'=> function($q)
		{
			$q->where('estado', 1);
		}])->where('estado',1)->paginate(10);
		//dd($matriculas);*/

		return view('vistasmatriculas/matriculas', compact('matriculas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$carreras = [];
		$alumnos = Alumno::where('estado', 1);
		$carreras = carrera::where('tipo', 'INSTITUTO')->where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		//$carreras = carrera::where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		$carreras = array(0=>'seleccione Carrera')+ $carreras;
		return view('vistasmatriculas/nuevaMatricula', compact('carreras', 'alumnos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$matriculas = new matricula($request->all());
		$matriculas->modulo_id = $request->ciclo_id;
		$matriculas->estado = 1;
		$matriculas->user_id = \Auth::user()->id; //------->> recupera y asigna el id del usuario que ha matriculado
		$grupos = grupo::findOrFail($request->grupo_id);
		$matriculas->save();
		$semestres = semestre::with('cursos')->findOrFail($grupos->ciclo_id);
		foreach ($semestres->cursos as $dtcursos) {
			$detallematricula = new detalle_matricula();
			$detallematricula->curso_id = $dtcursos->id;
			$detallematricula->grupo_id = $request->grupo_id;
			$detallematricula->matricula_id = $matriculas->id;
			$detallematricula->save();

		}
		return redirect()->route('institutomatricula.matricula.index');
		//dd($semestres->cursos);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$repmatricula = matricula::with('detalles_matriculas', 'alumnos', 'carreras')->findOrFail($id);
		//dd($repmatricula->detalles_matriculas);
		//cabecera
		$fpdf = new Fpdf();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Image('img/logoflv.png',10,8,33);
        $fpdf->Cell(80);
    	// Título
    	$fpdf->Cell(30,10,'Ficha Matricula');
    	// Salto de línea
    	$fpdf->SetFont('Arial','B',10);
    	$fpdf->Ln(10);
        //$fpdf->Cell(40,10,'Hello World!');
        //$headers=['Content-Type' => 'aplication/pdf'];
        $w = 1;
        $fpdf->Cell(20,10*$w,'Carrera:');
        $fpdf->Cell(100,10*$w, utf8_decode($repmatricula->carreras->nombre));
        $fpdf->Ln();
        $fpdf->Cell(20,10*$w,'Alumno:');
        $fpdf->Cell(80,10*$w, utf8_decode($repmatricula->alumnos->nombres));
        $fpdf->Cell(15,10*$w,'Horario:');
        $fpdf->Cell(30,10*$w, utf8_decode($repmatricula->Horario));
        $fpdf->Cell(15,10*$w, 'Fecha:');
        $fpdf->Cell(15,10*$w, utf8_decode($repmatricula->fecha_matricula));
        $fpdf->Ln();
        $fpdf->Cell(15,10*$w,'#',1,0,'C');
        $fpdf->Cell(100,10*$w,'Curso',1,0,'C');
        $fpdf->Cell(50,10*$w,'Grupo',1,0,'C');
        $fpdf->Cell(20,10*$w,utf8_decode('Créditos'),1,0,'C');
        $fpdf->Ln();
        $fpdf->Line(10, 50, 180, 50);
        $fpdf->SetFont('Arial','',10);
        foreach ($repmatricula->detalles_matriculas as $detalles) {
        	$fpdf->Cell(15,10,$w,1,0,'C');
        	$fpdf->Cell(100,10,utf8_decode($detalles->cursos->nombre),1,0,'');
        	$fpdf->Cell(50,10,utf8_decode($detalles->grupos->nombre_unidad),1,0,'C');
        	$fpdf->Cell(20,10,utf8_decode($detalles->cursos->creditos),1,0,'C');
	        $fpdf->Ln();
	        $w++;
	        //$fpdf->Cell()
        }
        $fpdf->Output();
        exit;
       //return response()->view('vistasmatriculas/reporteMatricula',$fpdf->Output())->header('Content-Type', 'aplication/pdf');
        //return Response::make($fpdf->Output(), 200, $headers);

		return view('vistasmatriculas/reporteMatricula', compact('repmatricula'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	
		$grupos = [];
		$matriculaModel = matricula::with('carreras','detalles_matriculas.grupos', 'alumnos')->findOrFail($id);
		$grupos = [];
		$ciclo_id=0;
		foreach ($matriculaModel->detalles_matriculas as $detalle) {
			$ciclo_id = $detalle->grupos->ciclo_id;
			break;
		}
		$grupos = grupo::where('carrera_id', $matriculaModel->carrera_id)->where('ciclo_id', $ciclo_id)->where('estado', 1)->lists('nombre_unidad', 'id');
		$grup_id = 0;
		$grup_nom = 'Sin Grupo';
		foreach ($matriculaModel->detalles_matriculas as $detalles) {
			$grup_id = $detalles->grupo_id;
			$grup_nom = $detalles->grupos->nombre_unidad;
			break;
		}
		$grupos = array($grup_id=>$grup_nom)+ $grupos;
		return view('vistasmatriculas.editarMatricula', compact('matriculaModel', 'grupos'));
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{

		// actualiza la matricula la boleta y el grupo segun sea requerido
		$matriculaUpdate = matricula::findOrFail($id);
		//$matriculaUpdate->delete_detalle();
		$matriculaUpdate->fill($request->all());
		$matriculaUpdate->save();
		foreach ($matriculaUpdate->detalles_matriculas as $detallematricula) {
			$detallematricula->grupo_id = $request->grupo_id;
			$detallematricula->save();
		}
		/*$grupos = grupo::findOrFail($request->grupo_id);
		$semestres = semestre::with('cursos')->findOrFail($grupos->ciclo_id);
		foreach ($semestres->cursos as $dtcursos) {
			$detallematricula = new detalle_matricula();
			$detallematricula->curso_id = $dtcursos->id;
			$detallematricula->grupo_id = $request->grupo_id;
			$detallematricula->matricula_id = $matriculaUpdate->id;
			$detallematricula->save();
		}*/
		return redirect()->route('institutomatricula.matricula.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		$matricula = matricula::with('detalles_matriculas')->findOrFail($request->id);
		if(!is_null($matricula->detalles_matriculas))
			{
			foreach ($matricula->detalles_matriculas as $detalles) {
				$detalles->delete();
			}
		}
		$matricula->delete();

		return 'Registro Eliminado Correctamente';
	}

}
