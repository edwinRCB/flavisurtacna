<?php namespace flavisur\Http\Controllers\Notas;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\detalle_matricula;
use flavisur\detalle_grupo;
use flavisur\matricula;
use Illuminate\Http\Request;
use Fpdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class notasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('tipo_docente');
	} 

	public function index()
	{
		$user_id = \Auth::user()->id;
		//$DocenteCursos = detalle_matricula::where('user_id', $user_id)->paginate(10);
		//return view('vistasNotas/listaCursoDocente', compact('DocenteCursos'));
		$detallesgrupos = detalle_grupo::with('cursos', 'grupos')->whereHas('grupos', function($q){
			$q->whereHas('carreras',function($q2){
				$q2->where('tipo','INSTITUTO')->where('estado', 1);	
			})->where('estado', 1);
		})->where('estado', 1)->where('user_id', $user_id)->paginate(20);
		//dd($detallesgrupos);
		return view('vistasNotas/listaCursoDocente', compact('detallesgrupos'));

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
		$detgrup = detalle_grupo::findOrfail($id);
		$detmat = detalle_matricula::with('cursos', 'matriculas')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->paginate(50);
		//dd($detmat);
		if($detgrup->curso_id == 38)
		{
			Session::flash('message', 'Las notas de este curso automaticamente seran duplicadas para el curso de MECANISMO DIFERENCIAL');
		}
		return view('vistasNotas/listaAlumnosNotas', compact('detmat', 'detgrup'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$detgrup = detalle_grupo::with('users','grupos')->findOrfail($id);
		$detmat = detalle_matricula::with('matriculas' )->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();

			$fpdf = new Fpdf('L','mm','A4');
		    $fpdf->AddPage();
		    $fpdf->SetFont('Arial','B',16);
		    $fpdf->Image('img/logoflv.png',10,10,33);
		    $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    $fpdf->Cell(230,10, utf8_decode('     INSTITUTO DE EDUCACIÓN SUPERIOR TECNOLÓGICO PRIVADO FLAVISUR'),1,0,'');
		    	// Salto de línea
		    $fpdf->SetFont('Arial','B',10);
		    $fpdf->Ln();
		    $date = Carbon::now();
		    $w = 1;
		    $fpdf->Cell(30,6,'Docente:',1,0,'');
		    $fpdf->Cell(180,6, utf8_decode($detgrup->users->name),1,0,'');
		    $fpdf->Cell(20,6,'Fecha:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($date->format('d-m-Y')),1,0,'C');
		    $fpdf->Ln();
		    $fpdf->Cell(30,6,'CARRERA:',1,0,'');
		    $fpdf->Cell(110,6, utf8_decode($detgrup->grupos->ciclos->carreras->nombre),1,0,'');	
		    $fpdf->Cell(20,6,'Ciclo:',1,0,'');
		    $fpdf->Cell(15,6, utf8_decode($detgrup->grupos->ciclos->ciclo),1,0,'C');		    
		    $fpdf->Cell(15,6,'Curso:',1,0,'');
		    $fpdf->Cell(90,6, utf8_decode($detgrup->cursos->nombre),1,0,'C');
	        $fpdf->Ln();
	        $fpdf->Cell(30,6,'Semestre:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($detgrup->grupos->nombre_unidad),1,0,'C');	
		    $fpdf->Cell(20,6, utf8_decode('U.D.N° 01:'),1,0,'');
		    $fpdf->Cell(30,6,'',1,0,'C');
		    $fpdf->Cell(20,6, utf8_decode('U.D.N° 02:'),1,0,'');
		    $fpdf->Cell(30,6,'',1,0,'C');	
		    $fpdf->Cell(20,6, utf8_decode('U.D.N° 03:'),1,0,'');
		    $fpdf->Cell(30,6,'',1,0,'C');		
		    $fpdf->ln();
		    //$fpdf->Cell(20,8*$w,'Horario:',1,0,'');
		    //$fpdf->Cell(50,8*$w, utf8_decode($detgrup->grupos->Horario),1,0,'C');
		    //$fpdf->Cell(15,8*$w,'Inicio:',1,0,'');
		    $fpdf->Cell(40,6, 'Inicio:'. utf8_decode($detgrup->grupos->inicio),1,0,'C');	
		   // $fpdf->Cell(15,8*$w,'Fin:',1,0,'');
		    $fpdf->Cell(40,6, 'Fin:'. utf8_decode($detgrup->grupos->fin),1,0,'C');
		    $fpdf->Cell(20,6, utf8_decode('CAP TERM'),1,0,'');
		    $fpdf->Cell(30,6,'',1,0,'C');
		    $fpdf->Cell(20,6, utf8_decode('CAP TERM'),1,0,'');
		    $fpdf->Cell(30,6,'',1,0,'C');
		    $fpdf->Cell(20,6, utf8_decode('CAP TERM'),1,0,'');
		    $fpdf->Cell(30,6,'',1,0,'C');
	        $fpdf->Ln();

	        $fpdf->Ln();
	        $fpdf->SetFillColor(242,247,104);
	        $fpdf->Cell(5,6,'#', 1,0, 'C');
	        $fpdf->Cell(75,6,'Alumno', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'Act', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'Proc', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'Conc', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'1ra U', 1,0, 'C', true);
	        $fpdf->Cell(12.5,6,'Act', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'Proc', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'Conc', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'2da U', 1,0, 'C', true);
	        $fpdf->Cell(12.5,6,'Act', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'Proc', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'Conc', 1,0, 'C');
	        $fpdf->Cell(12.5,6,'3ra U', 1,0, 'C', true);
	        $fpdf->Cell(5,6,'', 0,0, 'C');
	        $fpdf->Cell(20,6,'Promedio', 1,0, 'C', true);
	        $fpdf->Cell(25,6, utf8_decode('Recuperación'), 1,0, 'C');
	        $fpdf->Ln();
	        $fpdf->SetFont('Arial','',10);
	        foreach ($detmat as $detalles) {
        	$fpdf->Cell(5,5,$w, 1,0, 'C');
        	$fpdf->Cell(75,5,utf8_decode($detalles->matriculas->alumnos->nombres),1,0);
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,$detalles->pr_unidad, 1,0, 'C', true);
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,$detalles->sg_unidad, 1,0, 'C', true);        	
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,'', 1,0, 'C');
        	$fpdf->Cell(12.5,5,$detalles->tr_unidad, 1,0, 'C', true);
        	$fpdf->Cell(5,5,'', 0,0, 'C');
        	$fpdf->Cell(20,5,$detalles->promedio, 1,0, 'C', true);
        	$fpdf->Cell(25,5,"", 1,0, 'C');
	        $fpdf->Ln();
	        $w++;
	        //$fpdf->Cell()
        	}
        	$fpdf->ln();
	        $fpdf->SetFont('Arial','B',10);
	        $fpdf->Cell(50,7,'Observaciones del Profesor:', 0,0,'');
	        $fpdf->Cell(130,7,'.................................................................................................................', 0,0,'');
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(40,7,'...................................', 0,0,'');
	        $fpdf->ln();
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	        $fpdf->Cell(35,7,'Firma del Profesor:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	       	$fpdf->Cell(45,7, utf8_decode('Recepción Academica Firma:'), 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(45,7, utf8_decode('     V°B° Dirección'), 0,0,'');
	        $fpdf->Output();
		    exit;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		/*$notasAlumno = detalle_matricula::findOrfail($request->detallematricula_id);
		$notasAlumno->fill($request->all());
		$notasAlumno->promedio = round(($request->pr_unidad + $request->sg_unidad + $request->tr_unidad)/3);
		$notasAlumno->save();*/
		return "Registro actualizado Correctamente";
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
	public function getPDF1unidad($id)
	{
		$detgrup = detalle_grupo::with('users','grupos')->findOrfail($id);
		$detmat = detalle_matricula::with('matriculas' )->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();

			$fpdf = new Fpdf('L','mm','A4');
		    $fpdf->AddPage();
		    $fpdf->SetFont('Arial','B',16);
		    $fpdf->Image('img/logoflv.png',10,10,33);
		    $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    $fpdf->Cell(230,10, utf8_decode('     INSTITUTO DE EDUCACIÓN SUPERIOR TECNOLÓGICO PRIVADO FLAVISUR'),1,0,'');
		    	// Salto de línea
		    $fpdf->SetFont('Arial','B',10);
		    $fpdf->Ln();
		    $date = Carbon::now();
		    $w = 1;
		    $fpdf->Cell(30,6,'Docente:',1,0,'');
		    $fpdf->Cell(180,6, utf8_decode($detgrup->users->name),1,0,'');
		    $fpdf->Cell(20,6,'Fecha:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($date->format('d-m-Y')),1,0,'C');
		    $fpdf->Ln();
		    $fpdf->Cell(30,6,'CARRERA:',1,0,'');
		    $fpdf->Cell(110,6, utf8_decode($detgrup->grupos->ciclos->carreras->nombre),1,0,'');	
		    $fpdf->Cell(20,6,'Ciclo:',1,0,'');
		    $fpdf->Cell(15,6, utf8_decode($detgrup->grupos->ciclos->ciclo),1,0,'C');		    
		    $fpdf->Cell(15,6,'Curso:',1,0,'');
		    $fpdf->Cell(90,6, utf8_decode($detgrup->cursos->nombre),1,0,'C');
	        $fpdf->Ln();
	        $fpdf->Cell(30,6,'Semestre:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($detgrup->grupos->nombre_unidad),1,0,'C');	
		    $fpdf->Cell(40,6, utf8_decode('Nombre Unidad:'),1,0,'');
		    $fpdf->Cell(80,6,'',1,0,'C');	
		    
		    //$fpdf->Cell(20,8*$w,'Horario:',1,0,'');
		    //$fpdf->Cell(50,8*$w, utf8_decode($detgrup->grupos->Horario),1,0,'C');
		    //$fpdf->Cell(15,8*$w,'Inicio:',1,0,'');
		    $fpdf->Cell(40,6, 'Inicio:',1,0,'');	
		   // $fpdf->Cell(15,8*$w,'Fin:',1,0,'');
		    $fpdf->Cell(40,6, 'Fin:',1,0,'');
		    $fpdf->ln();
		    $fpdf->Cell(40,6, utf8_decode('Capacidad terminal:'),1,0,'');
		    $fpdf->Cell(102,6,'',1,0,'C');
		    $fpdf->Cell(35,6, utf8_decode('Actitudinal'),1,0,'');
		    $fpdf->Cell(35,6, utf8_decode('Procedimental'),1,0,'');
		    $fpdf->Cell(35,6, utf8_decode('Conceptual'),1,0,'');
		    $fpdf->Cell(33,6, utf8_decode('Primera Unidad'),1,0,'');
	        $fpdf->Ln();
	        $fpdf->SetFillColor(242,247,104);
	        $fpdf->Cell(5,6,'#', 1,0, 'C');
	        $fpdf->Cell(75,6,'Alumno', 1,0, 'C');
	        $fpdf->Cell(55,6,'Asistencia', 1,0, 'C');
	        $fpdf->Cell(7,6,'T.A', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(15,6,'ProUnid.', 1,0, 'C', true);
	        $fpdf->Cell(18,6,'Obs.', 1,0, 'C');
	        $fpdf->Ln();
	        $fpdf->SetFont('Arial','',10);

	        foreach ($detmat as $detalles) {
        	$fpdf->Cell(5,5,$w, 1,0, 'C');
        	$fpdf->Cell(75,5,utf8_decode($detalles->matriculas->alumnos->nombres),1,0);
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	/////
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

			$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

        	$fpdf->Cell(15,5,$detalles->pr_unidad, 1,0, 'C', true);
        	$fpdf->Cell(18,5,'', 1,0, 'C');
	        $fpdf->Ln();
	        $w++;
	        //$fpdf->Cell()
        	}
        	$fpdf->ln();
	        $fpdf->SetFont('Arial','B',10);
	        $fpdf->Cell(50,7,'Observaciones del Profesor:', 0,0,'');
	        $fpdf->Cell(130,7,'.................................................................................................................', 0,0,'');
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(40,7,'...................................', 0,0,'');
	        $fpdf->ln();
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	        $fpdf->Cell(35,7,'Firma del Profesor:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	       	$fpdf->Cell(45,7, utf8_decode('Recepción Academica Firma:'), 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(45,7, utf8_decode('     V°B° Dirección'), 0,0,'');
	        $fpdf->Output();
		    exit;
	}
	public function getPDF2unidad($id)
	{
		$detgrup = detalle_grupo::with('users','grupos')->findOrfail($id);
		$detmat = detalle_matricula::with('matriculas' )->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();

			$fpdf = new Fpdf('L','mm','A4');
		    $fpdf->AddPage();
		    $fpdf->SetFont('Arial','B',16);
		    $fpdf->Image('img/logoflv.png',10,10,33);
		    $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    $fpdf->Cell(230,10, utf8_decode('     INSTITUTO DE EDUCACIÓN SUPERIOR TECNOLÓGICO PRIVADO FLAVISUR'),1,0,'');
		    	// Salto de línea
		    $fpdf->SetFont('Arial','B',10);
		    $fpdf->Ln();
		    $date = Carbon::now();
		    $w = 1;
		    $fpdf->Cell(30,6,'Docente:',1,0,'');
		    $fpdf->Cell(180,6, utf8_decode($detgrup->users->name),1,0,'');
		    $fpdf->Cell(20,6,'Fecha:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($date->format('d-m-Y')),1,0,'C');
		    $fpdf->Ln();
		    $fpdf->Cell(30,6,'CARRERA:',1,0,'');
		    $fpdf->Cell(110,6, utf8_decode($detgrup->grupos->ciclos->carreras->nombre),1,0,'');	
		    $fpdf->Cell(20,6,'Ciclo:',1,0,'');
		    $fpdf->Cell(15,6, utf8_decode($detgrup->grupos->ciclos->ciclo),1,0,'C');		    
		    $fpdf->Cell(15,6,'Curso:',1,0,'');
		    $fpdf->Cell(90,6, utf8_decode($detgrup->cursos->nombre),1,0,'C');
	        $fpdf->Ln();
	        $fpdf->Cell(30,6,'Semestre:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($detgrup->grupos->nombre_unidad),1,0,'C');	
		    $fpdf->Cell(40,6, utf8_decode('Nombre Unidad:'),1,0,'');
		    $fpdf->Cell(80,6,'',1,0,'C');	
		    
		    //$fpdf->Cell(20,8*$w,'Horario:',1,0,'');
		    //$fpdf->Cell(50,8*$w, utf8_decode($detgrup->grupos->Horario),1,0,'C');
		    //$fpdf->Cell(15,8*$w,'Inicio:',1,0,'');
		    $fpdf->Cell(40,6, 'Inicio:',1,0,'');	
		   // $fpdf->Cell(15,8*$w,'Fin:',1,0,'');
		    $fpdf->Cell(40,6, 'Fin:',1,0,'');
		    $fpdf->ln();
		    $fpdf->Cell(40,6, utf8_decode('Capacidad terminal:'),1,0,'');
		    $fpdf->Cell(102,6,'',1,0,'C');
		    $fpdf->Cell(35,6, utf8_decode('Actitudinal'),1,0,'');
		    $fpdf->Cell(35,6, utf8_decode('Procedimental'),1,0,'');
		    $fpdf->Cell(35,6, utf8_decode('Conceptual'),1,0,'');
		    $fpdf->Cell(33,6, utf8_decode('Segunda Unidad'),1,0,'');
	        $fpdf->Ln();
	        $fpdf->SetFillColor(242,247,104);
	        $fpdf->Cell(5,6,'#', 1,0, 'C');
	        $fpdf->Cell(75,6,'Alumno', 1,0, 'C');
	        $fpdf->Cell(55,6,'Asistencia', 1,0, 'C');
	        $fpdf->Cell(7,6,'T.A', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(15,6,'ProUnid.', 1,0, 'C', true);
	        $fpdf->Cell(18,6,'Obs.', 1,0, 'C');
	        $fpdf->Ln();
	        $fpdf->SetFont('Arial','',10);

	        foreach ($detmat as $detalles) {
        	$fpdf->Cell(5,5,$w, 1,0, 'C');
        	$fpdf->Cell(75,5,utf8_decode($detalles->matriculas->alumnos->nombres),1,0);
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	/////
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

			$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

        	$fpdf->Cell(15,5,$detalles->sg_unidad, 1,0, 'C', true);
        	$fpdf->Cell(18,5,'', 1,0, 'C');
	        $fpdf->Ln();
	        $w++;
	        //$fpdf->Cell()
        	}
        	$fpdf->ln();
	        $fpdf->SetFont('Arial','B',10);
	        $fpdf->Cell(50,7,'Observaciones del Profesor:', 0,0,'');
	        $fpdf->Cell(130,7,'.................................................................................................................', 0,0,'');
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(40,7,'...................................', 0,0,'');
	        $fpdf->ln();
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	        $fpdf->Cell(35,7,'Firma del Profesor:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	       	$fpdf->Cell(45,7, utf8_decode('Recepción Academica Firma:'), 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(45,7, utf8_decode('     V°B° Dirección'), 0,0,'');
	        $fpdf->Output();
		    exit;
	}
	public function getPDF3unidad($id)
	{
		$detgrup = detalle_grupo::with('users','grupos')->findOrfail($id);
		$detmat = detalle_matricula::with('matriculas' )->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();

			$fpdf = new Fpdf('L','mm','A4');
		    $fpdf->AddPage();
		    $fpdf->SetFont('Arial','B',16);
		    $fpdf->Image('img/logoflv.png',10,10,33);
		    $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    $fpdf->Cell(230,10, utf8_decode('     INSTITUTO DE EDUCACIÓN SUPERIOR TECNOLÓGICO PRIVADO FLAVISUR'),1,0,'');
		    	// Salto de línea
		    $fpdf->SetFont('Arial','B',10);
		    $fpdf->Ln();
		    $date = Carbon::now();
		    $w = 1;
		    $fpdf->Cell(30,6,'Docente:',1,0,'');
		    $fpdf->Cell(180,6, utf8_decode($detgrup->users->name),1,0,'');
		    $fpdf->Cell(20,6,'Fecha:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($date->format('d-m-Y')),1,0,'C');
		    $fpdf->Ln();
		    $fpdf->Cell(30,6,'CARRERA:',1,0,'');
		    $fpdf->Cell(110,6, utf8_decode($detgrup->grupos->ciclos->carreras->nombre),1,0,'');	
		    $fpdf->Cell(20,6,'Ciclo:',1,0,'');
		    $fpdf->Cell(15,6, utf8_decode($detgrup->grupos->ciclos->ciclo),1,0,'C');		    
		    $fpdf->Cell(15,6,'Curso:',1,0,'');
		    $fpdf->Cell(90,6, utf8_decode($detgrup->cursos->nombre),1,0,'C');
	        $fpdf->Ln();
	        $fpdf->Cell(30,6,'Semestre:',1,0,'');
		    $fpdf->Cell(50,6, utf8_decode($detgrup->grupos->nombre_unidad),1,0,'C');	
		    $fpdf->Cell(40,6, utf8_decode('Nombre Unidad:'),1,0,'');
		    $fpdf->Cell(80,6,'',1,0,'C');	
		    
		    //$fpdf->Cell(20,8*$w,'Horario:',1,0,'');
		    //$fpdf->Cell(50,8*$w, utf8_decode($detgrup->grupos->Horario),1,0,'C');
		    //$fpdf->Cell(15,8*$w,'Inicio:',1,0,'');
		    $fpdf->Cell(40,6, 'Inicio:',1,0,'');	
		   // $fpdf->Cell(15,8*$w,'Fin:',1,0,'');
		    $fpdf->Cell(40,6, 'Fin:',1,0,'');
		    $fpdf->ln();
		    $fpdf->Cell(40,6, utf8_decode('Capacidad terminal:'),1,0,'');
		    $fpdf->Cell(102,6,'',1,0,'C');
		    $fpdf->Cell(35,6, utf8_decode('Actitudinal'),1,0,'');
		    $fpdf->Cell(35,6, utf8_decode('Procedimental'),1,0,'');
		    $fpdf->Cell(35,6, utf8_decode('Conceptual'),1,0,'');
		    $fpdf->Cell(33,6, utf8_decode('Tercera Unidad'),1,0,'');
	        $fpdf->Ln();
	        $fpdf->SetFillColor(242,247,104);
	        $fpdf->Cell(5,6,'#', 1,0, 'C');
	        $fpdf->Cell(75,6,'Alumno', 1,0, 'C');
	        $fpdf->Cell(55,6,'Asistencia', 1,0, 'C');
	        $fpdf->Cell(7,6,'T.A', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'', 1,0, 'C');
	        $fpdf->Cell(7,6,'Pr', 1,0, 'C');
	        $fpdf->Cell(15,6,'ProUnid.', 1,0, 'C', true);
	        $fpdf->Cell(18,6,'Obs.', 1,0, 'C');
	        $fpdf->Ln();
	        $fpdf->SetFont('Arial','',10);

	        foreach ($detmat as $detalles) {
        	$fpdf->Cell(5,5,$w, 1,0, 'C');
        	$fpdf->Cell(75,5,utf8_decode($detalles->matriculas->alumnos->nombres),1,0);
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(5,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	/////
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

					$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');
        	$fpdf->Cell(7,5,'', 1,0, 'C');

        	$fpdf->Cell(15,5,$detalles->tr_unidad, 1,0, 'C', true);
        	$fpdf->Cell(18,5,'', 1,0, 'C');
	        $fpdf->Ln();
	        $w++;
	        //$fpdf->Cell()
        	}
        	$fpdf->ln();
	        $fpdf->SetFont('Arial','B',10);
	        $fpdf->Cell(50,7,'Observaciones del Profesor:', 0,0,'');
	        $fpdf->Cell(130,7,'.................................................................................................................', 0,0,'');
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(40,7,'...................................', 0,0,'');
	        $fpdf->ln();
	        $fpdf->Cell(15,7,'Fecha:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	        $fpdf->Cell(35,7,'Firma del Profesor:', 0,0,'');
	        $fpdf->Cell(50,7,'________________________', 0,0,'');
	       	$fpdf->Cell(45,7, utf8_decode('Recepción Academica Firma:'), 0,0,'');
	        $fpdf->Cell(40,7,'.........................', 0,0,'');
	        $fpdf->Cell(45,7, utf8_decode('     V°B° Dirección'), 0,0,'');
	        $fpdf->Output();
		    exit;
	}
	public function updateNotas(Request $request)
	{
		//'pr_unidad','sg_unidad','tr_unidad'
		$notasAlumno = detalle_matricula::findOrfail($request->detallematricula_id);
		if($notasAlumno->cursos->nombre!='Operación de Maquinaria Pesada')
		{
			if($notasAlumno->cursos->id != 38)
			{
				if($request->nronota=='n1')
				{
					if($request->nota == $notasAlumno->pr_unidad)
					{
						return "";
					}
					$notasAlumno->pr_unidad = $request->nota;
					$notasAlumno->promedio = round(($request->nota + $notasAlumno->sg_unidad + $notasAlumno->tr_unidad)/3);
					$notasAlumno->save();
					return $notasAlumno->matriculas->alumnos->nombres .': Nota de 1ra Unidad Registrado.';
				}
				elseif ($request->nronota=='n2') {
					if($request->nota == $notasAlumno->sg_unidad)
					{
						return "";
					}
					$notasAlumno->sg_unidad = $request->nota;
					$notasAlumno->promedio = round(($notasAlumno->pr_unidad + $request->nota + $notasAlumno->tr_unidad)/3);
					$notasAlumno->save();
					return $notasAlumno->matriculas->alumnos->nombres .': Nota de 2da Unidad Registrado.';
				}
				elseif ($request->nronota=='n3') {
					if($request->nota == $notasAlumno->tr_unidad)
					{
						return "";
					}
					$notasAlumno->tr_unidad = $request->nota;
					$notasAlumno->promedio = round(($notasAlumno->pr_unidad + $notasAlumno->sg_unidad + $request->nota)/3);
					$notasAlumno->save();
					return $notasAlumno->matriculas->alumnos->nombres .': Nota de 3ra Unidad Registrado.';
				}
			}
			else{
				//----Busca el primer registro con las condiciones dadas y duplicara la nota del curso con el id 38-----///
				$notasAlumnoDuplicado = detalle_matricula::where('curso_id', 39)->where('matricula_id', $notasAlumno->matricula_id)->firstOrFail();
				//return $notasAlumno2->cursos->nombre;
				if($request->nronota=='n1')
				{
					if($request->nota == $notasAlumno->pr_unidad)
					{
						return "";
					}
					$notasAlumno->pr_unidad = $request->nota;
					//asignando la misma nota al curso elegido-->duplicando nota//////////////
					$notasAlumnoDuplicado->pr_unidad = $request->nota;////////////////////////
					//////////////////////////////////////////////////////////////////////////
					$notasAlumno->promedio = round(($request->nota + $notasAlumno->sg_unidad + $notasAlumno->tr_unidad)/3);
					/////mismo promedio///////////////////////////////////////////////////
					$notasAlumnoDuplicado->promedio = $notasAlumno->promedio;/////////////
					//////////////////////////////////////////////////////////////////////
					$notasAlumno->save();
					///////////////////////////////////////////
					$notasAlumnoDuplicado->save();/////////////
					///////////////////////////////////////////
					return $notasAlumno->matriculas->alumnos->nombres .': Nota de 1ra Unidad Registrado.';
				}
				elseif ($request->nronota=='n2') {
					if($request->nota == $notasAlumno->sg_unidad)
					{
						return "";
					}
					$notasAlumno->sg_unidad = $request->nota;
					//////////////////////////////////////////////////////////
					$notasAlumnoDuplicado->sg_unidad = $request->nota;////////
					//////////////////////////////////////////////////////////
					$notasAlumno->promedio = round(($notasAlumno->pr_unidad + $request->nota + $notasAlumno->tr_unidad)/3);
					////////////////////////////////////////////////////////////////////
					$notasAlumnoDuplicado->promedio = $notasAlumno->promedio;///////////
					////////////////////////////////////////////////////////////////////
					$notasAlumno->save();
					/////////////////////////////////////
					$notasAlumnoDuplicado->save();///////
					/////////////////////////////////////
					return $notasAlumno->matriculas->alumnos->nombres .': Nota de 2da Unidad Registrado.';
				}
				elseif ($request->nronota=='n3') {
					if($request->nota == $notasAlumno->tr_unidad)
					{
						return "";
					}
					$notasAlumno->tr_unidad = $request->nota;
					////////////////////////////////////////////////////////////
					$notasAlumnoDuplicado->tr_unidad = $request->nota;//////////
					////////////////////////////////////////////////////////////
					$notasAlumno->promedio = round(($notasAlumno->pr_unidad + $notasAlumno->sg_unidad + $request->nota)/3);
					/////////////////////////////////////////////////////////////////
					$notasAlumnoDuplicado->promedio = $notasAlumno->promedio;////////
					/////////////////////////////////////////////////////////////////
					$notasAlumno->save();
					////////////////////////////////////////
					$notasAlumnoDuplicado->save();//////////
					////////////////////////////////////////
					return $notasAlumno->matriculas->alumnos->nombres .': Nota de 3ra Unidad Registrado.';
				}
			}
		}else
		{
			if($request->nronota=='n1')
			{
				if($request->nota == $notasAlumno->pr_unidad)
				{
					return "";
				}
				$notasAlumno->pr_unidad = $request->nota;
				$notasAlumno->promedio = round(($request->nota + $notasAlumno->sg_unidad )/2);
				$notasAlumno->save();
				return $notasAlumno->matriculas->alumnos->nombres .': Nota de 1ra Unidad Registrado.';
			}
			elseif ($request->nronota=='n2') {
				if($request->nota == $notasAlumno->sg_unidad)
				{
					return "";
				}
				$notasAlumno->sg_unidad = $request->nota;
				$notasAlumno->promedio = round(($notasAlumno->pr_unidad + $request->nota)/2);
				$notasAlumno->save();
				return $notasAlumno->matriculas->alumnos->nombres .': Nota de 2da Unidad Registrado.';
			}
		}
	}

}
