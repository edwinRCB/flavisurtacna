<?php namespace flavisur\Http\Controllers\Reportes;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
//use flavisur\CustomCollection;
use Illuminate\Http\Request;
use flavisur\detalle_matricula;
use flavisur\matricula;
use flavisur\carrera;
//use flavisur\modeloAlumnoNotas;
use Illuminate\Database\Eloquent\Collection;
use Fpdf;
use Carbon\Carbon;

class reportesCetproController extends Controller {

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
	public function index()
	{
		$carreras = carrera::where('tipo', 'CETPRO')->where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		//$carreras = carrera::where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		$carreras = array(0=>'seleccione Carrera')+ $carreras;
		//$carreras = carrera::where('tipo', 'CETPRO')->lists('nombre', 'id');
		return view('/vistasReportes/reportesFechas', compact('carreras'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$carreras = carrera::where('tipo', 'CETPRO')->where('estado', 1)->orderBy('nombre')->lists('nombre','id');
		$carreras = array(0=>'seleccione Carrera')+ $carreras;
		return view('/vistasReportes/reporteNotas', compact('carreras'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		return '$request->idalumno';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		//dd($request->inicio);
		/*$alumnos = detalle_matricula::with('grupos', 'matriculas', 'matriculas.alumnos', 'grupos.ciclos')->whereHas('grupos', function($q) use ($request){
			$q->where('ciclo_id', $request->modulo_id)->where('carrera_id', $request->carrera_id)
			->where('inicio','>=', $request->inicio)
			->where('inicio','<=', $request->fin);
		})->get()->sortBy(function($q){
				return $q->matriculas->alumnos->nombres;
			});*/
		$alumnos = detalle_matricula::with('grupos', 'matriculas', 'matriculas.alumnos', 'grupos.ciclos')->whereHas('grupos', function($q) use ($request){
			$q->where('ciclo_id', $request->modulo_id)->where('carrera_id', $request->carrera_id);
		})->whereHas('matriculas', function($query) use ($request){
			$query->where('fecha_matricula','>=', $request->inicio)
				->where('fecha_matricula', '<=', $request->fin)
				->where('ciudad', \Auth::user()->ciudad);
		})->get()->sortBy(function($q){
				return $q->matriculas->alumnos->nombres;
			});
		/*$alumnos = detalle_matricula::with('grupos', 'matriculas', 'matriculas.alumnos')->whereHas('grupos', function($q) use ($request){
			$q->where('ciclo_id', $request->modulo_id)->where('carrera_id', $request->carrera_id)
			->where();
		})->where('created_at','>=', $request->inicio)
			->where('created_at','<=', $request->fin)
			->get()->sortBy(function($q){
				return $q->matriculas->alumnos->nombres;
			});*/
		//$model = new modeloAlumnoNotas();
		//$detalle = new Collection($model);
		foreach ($alumnos as $value) {
		}
		$id = 0;
		$fpdf = new Fpdf();
		$fpdf->AddPage();
		$fpdf->SetFont('Arial','B',16);
		$fpdf->Image('img/logoflv.png',10,10,33);
		$fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		$fpdf->Cell(140,10, utf8_decode('CENTRO TECNICO PRODUCTIVO FLAVISUR'),1,0,'');
		    	// Salto de línea
		$fpdf->SetFont('Arial','B',8);
		$fpdf->Ln();
		$contador = 0;
		$fpdf->Cell(70,8, 'Alumnos', 1,0, 'C');
		$fpdf->Cell(20,8, 'Fech/Matr', 1,0, 'C');
		$fpdf->Cell(10,8, 'MAQ', 1,0, 'C');
		$fpdf->Cell(20,8, 'Fecha/grupo', 1,0, 'C');
		$fpdf->Cell(30,8, 'Aula/Turno', 1,0, 'C');
		$fpdf->Cell(20,8, 'Edad', 1,0, 'C');
		$fpdf->Cell(20,8, 'Sexo', 1,0, 'C');
		
		$fpdf->Ln();
		$cursos=[];
		$color = 0;
		$fpdf->SetFillColor(255,255,51);
		foreach ($alumnos as $value) {

				$contador += 1;
				if($contador == 5)
				{
					if($color == 0)
					{
						$fpdf->Cell(70,8, utf8_decode($value->matriculas->alumnos->nombres), 1,0, 'C');
						$fpdf->Cell(20,8, utf8_decode($value->matriculas->fecha_matricula), 1,0, 'C');
						$fpdf->Cell(10,8, utf8_decode($value->grupos->ciclos->ciclo), 1,0, 'C');
						$fpdf->Cell(20,8, utf8_decode($value->grupos->inicio), 1,0, 'C');
						$fpdf->Cell(30,8, utf8_decode($value->grupos->nombre_unidad."|".$value->grupos->Horario ), 1,0, 'C');
						$fpdf->Cell(20,8, utf8_decode($value->matriculas->alumnos->Edad), 1,0, 'C');
						$fpdf->Cell(20,8, utf8_decode($value->matriculas->alumnos->sexo), 1,0, 'C');
						$color =1;
					}
					else
					{
						$fpdf->Cell(70,8, utf8_decode($value->matriculas->alumnos->nombres), 1,0, 'C', true);
						$fpdf->Cell(20,8, utf8_decode($value->matriculas->fecha_matricula), 1,0, 'C', true);
						$fpdf->Cell(10,8, utf8_decode($value->grupos->ciclos->ciclo), 1,0, 'C', true );
						$fpdf->Cell(20,8, utf8_decode($value->grupos->inicio), 1,0, 'C', true);
						$fpdf->Cell(30,8, utf8_decode($value->grupos->nombre_unidad."|".$value->grupos->Horario ), 1,0, 'C', true);
						$fpdf->Cell(20,8, utf8_decode($value->matriculas->alumnos->Edad), 1,0, 'C', true);
						$fpdf->Cell(20,8, utf8_decode($value->matriculas->alumnos->sexo), 1,0, 'C', true);
						$color = 0;
					}
					$fpdf->Ln();
					$contador = 0;
				}
		}

		$fpdf->Output();
		exit;

		//$alumnos = detalle_matricula::findOrfail(30);
		return view('vistasReportes/reporteDetallado', compact('alumnos'));
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
	public function showNotasCetpro(Request $request)
	{
		//$matricula = matricula::with('detalles_matriculas', 'detalles_matriculas.cursos')
		//			->where('alumno_id', $request->idalumno)->where('carrera_id', 1)->firstOrFail();
		$detalle_matricula = detalle_matricula::with('cursos', 'grupos', 'matriculas', 'grupos.ciclos')
					->whereHas('matriculas', function($q) use ($request){
						$q->where('alumno_id', $request->idalumno)->where('carrera_id', $request->idcarrera);
					})->whereHas('grupos', function($query) use ($request){
						$query->where('ciclo_id', $request->idmodulo);
					})->get();
		return $detalle_matricula;
	}

}
