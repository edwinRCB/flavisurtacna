<?php namespace flavisur\Http\Controllers\Notas;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\detalle_matricula;
use flavisur\detalle_grupo;
use flavisur\matricula;
use flavisur\asistencia;
use Illuminate\Http\Request;
use Fpdf;
use Carbon\Carbon;

class notasCetproController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $alumnos43;
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('tipo_docente');
	} 
	public function index()
	{
		$user_id = \Auth::user()->id;
		$detallesgrupos = detalle_grupo::with('cursos', 'grupos')->whereHas('grupos', function($q){
			$q->whereHas('carreras', function($q2){
				$q2->where('tipo','CETPRO')->where('estado', 1);
			})->where('estado', 1);
		})->where('estado', 1)->where('user_id', $user_id)->paginate(10);
		return view('vistasNotasCETPRO/listaCursoDocenteCETPRO', compact('detallesgrupos'));
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
		$user_id = \Auth::user()->id;
		$detgrup = detalle_grupo::where('user_id', $user_id)->findOrfail($id);
		$detmat = detalle_matricula::with('cursos', 'matriculas')->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->paginate(50);
		if($detgrup->grupos->carrera_id == 5)
		{
			return view('vistasNotasCETPRO/listaAlumnoNotasCETPROopm2', compact('detmat', 'detgrup'));
		}else
		{
			return view('vistasNotasCETPRO/listaAlumnoNotasCETPRO', compact('detmat', 'detgrup'));
		}
		return view('vistasNotasCETPRO/listaAlumnoNotasCETPRO', compact('detmat', 'detgrup'));
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
		//$detmat = detalle_matricula::with('matriculas' )->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get();	
		$detmat = detalle_matricula::with('matriculas' )->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->whereHas('matriculas.alumnos', function($q){
			$q->orderBy('nombres', 'asc');
		})->get()->sortBy(function($alum){
			return $alum->matriculas->alumnos->nombres;
		});	
		$asistencia = asistencia::with('alumnos')->where('grupo_id', $detgrup->grupo_id)->get()
						->sortBy(function($asisAlum){
							return $asisAlum->alumnos->nombres;
						});
		/*detmat = detalle_matricula::with('matriculas' )->where('grupo_id', $detgrup->grupo_id)->where('curso_id', $detgrup->curso_id)->get()->sortBy(function($alum){
			return $alum->matriculas->alumnos->nombres;
		});*/
			$fpdf = new Fpdf('L','mm','A4');
		    $fpdf->AddPage();
		    $fpdf->SetFont('Arial','B',16);
		    $fpdf->Image('img/logoflv.png',10,10,33);
		    $fpdf->Cell(50,8,"",1,0,'');
		    	// Título
		    $fpdf->Cell(230,8, utf8_decode('                   CENTRO TÉCNICO PRODUCTIVO FLAVISUR TACNA'),1,0,'');
		    	// Salto de línea
		    $fpdf->SetFont('Arial','B',10);
		    $fpdf->Ln();
		    $date = Carbon::now();
		    $w = 1;
		    $fpdf->Cell(30,6*$w,'Docente:',1,0,'');
		    $fpdf->Cell(180,6*$w, utf8_decode($detgrup->users->name),1,0,'');
		    $fpdf->Cell(20,6*$w,'Fecha:',1,0,'');
		    $fpdf->Cell(50,6*$w, utf8_decode($date->format('d-m-Y')),1,0,'C');
		    $fpdf->Ln();
		    $fpdf->Cell(30,6*$w,'CARRERA:',1,0,'');
		    $fpdf->Cell(130,6*$w, utf8_decode($detgrup->grupos->ciclos->carreras->nombre),1,0,'');	
		    $fpdf->Cell(20,6*$w,utf8_decode('MÁQUINA:'),1,0,'');
		    $fpdf->Cell(40,6*$w, utf8_decode($detgrup->grupos->ciclos->ciclo),1,0,'C');		    
		    $fpdf->Cell(20,6*$w,'Curso:',1,0,'');
		    $fpdf->Cell(40,6*$w, utf8_decode($detgrup->cursos->nombre),1,0,'C');
	        $fpdf->Ln();
	        $fpdf->Cell(30,6*$w,'Aula:',1,0,'');
		    $fpdf->Cell(40,6*$w, utf8_decode($detgrup->grupos->nombre_unidad),1,0,'C');	
		    $fpdf->Cell(20,6*$w,'Horario:',1,0,'');
		    $fpdf->Cell(50,6*$w, utf8_decode($detgrup->grupos->Horario),1,0,'C');
		    $fpdf->Cell(15,6*$w,'Inicio:',1,0,'');
		    $fpdf->Cell(55,6*$w, utf8_decode($detgrup->grupos->inicio),1,0,'C');	
		    $fpdf->Cell(15,6*$w,'Fin:',1,0,'');
		    $fpdf->Cell(55,6*$w, utf8_decode($detgrup->grupos->fin),1,0,'C');	
	        $fpdf->Ln();
	        $fpdf->Cell(8,6*$w, utf8_decode('N°'), 1,0, 'C');
	        $fpdf->Cell(70,6*$w,'Alumno', 1,0, 'C');
	        $fpdf->Cell(48,6*$w,utf8_decode('Criterios de Evaluación'), 1,0, 'C');
	        $fpdf->Cell(10,6*$w,'', 1,0, 'C');
	        $fpdf->Cell(6,6*$w,'', 0,0, 'C');
	        $fpdf->Cell(10,6*$w, utf8_decode('N°.'), 1,0, 'C');
	        $fpdf->Cell(128,6*$w,'Control de asistencia', 1,0, 'C');
	        //$fpdf->Cell(7,6*$w,'Tot.', 1,0, 'C');
	        //$fpdf->Cell(21,6*$w,'Obs.', 1,0, 'C');
	        $fpdf->Ln();
	        if($detgrup->grupos->carrera_id == 5)
	        {
	        	$fpdf->Cell(8,6*$w, "", 1,0, 'C');
		        $fpdf->Cell(70,6*$w,'', 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"CT1", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"CT2", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"CT3", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"CT4", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"CT5", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"CT6", 1,0, 'C');
		        $fpdf->Cell(10,6*$w,'Pr.', 1,0, 'C');
		        $fpdf->Cell(6,6*$w,'', 0,0, 'C');
		        $fpdf->Cell(10,6*$w, "", 1,0, 'C');
	        }else{
	        	$fpdf->Cell(8,6*$w, "", 1,0, 'C');
		        $fpdf->Cell(70,6*$w,'', 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"I.O.", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"T.I.", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"C.P.", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"P.C.", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"E.P.", 1,0, 'C');
		        $fpdf->Cell(8,6*$w,"E.F.", 1,0, 'C');
		        $fpdf->Cell(10,6*$w,'Pr.', 1,0, 'C');
		        $fpdf->Cell(6,6*$w,'', 0,0, 'C');
		        $fpdf->Cell(10,6*$w, "", 1,0, 'C');
	        }

	    	$n=0;
			//$inicio = $to->diff($from, true);
			$inicio = Carbon::parse($detgrup->grupos->inicio);
			$fin = Carbon::parse($detgrup->grupos->fin);

			$ndias = $inicio->diffInDays($fin);
			$fpdf->SetFont('Arial','',8);
			$fpdf->SetFillColor(234, 21, 50);
	    	do {

	    		$dia = strtotime ( '+'.$n.' day' , strtotime ($detgrup->grupos->inicio) ) ;
	    		$variable = date ( 'l' , $dia );
				$dia = date ( 'j' , $dia );
				switch ($variable) {			
					case 'Saturday':
						$fpdf->Cell(4,6,$dia, 1,0, 'C', True);
						break;			
					case 'Sunday':
						$fpdf->Cell(4,6,$dia, 1,0, 'C', True);
						break;
					default :
						$fpdf->Cell(4,6,$dia, 1,0, 'C');
						break;
				}     	

	    		$n++;
	    	} while ($n<=$ndias);
	        //$fpdf->Cell(5,4.5,"TOTAL ASISTENCIAS.", 1,0, 'C');
	        //$fpdf->Cell(25,6*$w,"2da Sem.", 1,0, 'C');
	        //$fpdf->Cell(25,6*$w,"3ra Sem.", 1,0, 'C');
	        //$fpdf->Cell(25,6*$w,"4ta Sem.", 1,0, 'C');
	        //$fpdf->Cell(7,6*$w,'Inas', 1,0, 'C');
	        //$fpdf->Cell(21,6*$w,"", 1,0, 'C');

	        $fpdf->Ln();
	        $fpdf->SetFont('Arial','',9);
	        foreach ($detmat as $detalles) {
        	$fpdf->Cell(8,4.5,$w, 1,0, 'C');
        	$fpdf->Cell(70,4.5,utf8_decode($detalles->matriculas->alumnos->nombres),1,0);
        	$fpdf->Cell(8,4.5,$detalles->nota1, 1,0, 'C');
        	$fpdf->Cell(8,4.5,$detalles->nota2, 1,0, 'C');
        	$fpdf->Cell(8,4.5,$detalles->nota3, 1,0, 'C');
        	$fpdf->Cell(8,4.5,$detalles->pr_unidad, 1,0, 'C');
        	$fpdf->Cell(8,4.5,$detalles->sg_unidad, 1,0, 'C');
        	$fpdf->Cell(8,4.5,$detalles->tr_unidad, 1,0, 'C');
        	$fpdf->Cell(10,4.5,$detalles->promedio, 1,0, 'C');
        	$fpdf->Cell(6,4.5,"", 0,0, 'C');
        	$fpdf->Cell(10,4.5,$w, 1,0, 'C');
        	foreach($asistencia as $asisAlumno)
        	{
        		if($detalles->matriculas->alumnos->id == $asisAlumno->alumno_id)
        		{
        			$n2 = 0;
        			$fasistida = Carbon::parse($asisAlumno->fecha);
        			$inicio2 = Carbon::parse($detgrup->grupos->inicio);
					$fin2 = Carbon::parse($detgrup->grupos->fin);
        			$ndias2 = $inicio2->diffInDays($fin2);
	        		do {
			    		//$fgrupo = strtotime ( '+'.$n.' day' , strtotime ($detgrup->grupos->inicio) ) ;
			    		$fgrupo = Carbon::parse($detgrup->grupos->inicio);
			    		$fgrupo->addDays($n2);
			    		if ($fasistida->eq($fgrupo)) {
        					$fpdf->Cell(4,4.5,"A", 1,0, 'C');
        					break;
        				}else
        				{
        					$fpdf->Cell(4,4.5,"F", 1,0, 'C');
        				}
			    		$n2++;
			    	} while ($n2<=$ndias2);		
        		}
        	}
        	
        	/*$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(5,4.5,"", 1,0, 'C');
        	$fpdf->Cell(7,4.5,"", 1,0, 'C');
        	$fpdf->Cell(21,4.5,"", 1,0, 'C');*/
	        $fpdf->Ln();
	        $w++;
	        //$fpdf->Cell()
        	}
        	if($detgrup->grupos->carrera_id != 5)
	        {
        		$fpdf->cell(100,4.5, utf8_decode("I.0.= Intervencón Oral - T.I.= Trabajo de Investigación - C.O.= Conducta y Puntualidad - P.C.= Presentación de Cuaderno - E.P.= Examen Práctico - E.F.= Examen Final - Pr.= Promedio"),0,0,'');
        	}
	        $fpdf->SetFont('Arial','',12);
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
		$notasAlumno = detalle_matricula::findOrfail($request->detallematricula_id);
		$notasAlumno->fill($request->all());
		$notasAlumno->save();
		return  $notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente';
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
	public function getAlumnosNotas()
	{return json_encode($this->alumnos43);
		$result = [];
		foreach ($this->alumnos43 as $al) {
			$result[] = ['value'=> $al->matriculas->alumnos->nombres];
		}
		return json_encode($this->alumnos43);
	}
	public function updateNotasCETPRO(Request $request)
	{
		$notasAlumno = detalle_matricula::findOrfail($request->detallematricula_id);
		if($request->nronota == 'nota1')
		{
			if($notasAlumno->nota1 != $request->nota)
			{
				$notasAlumno->nota1 = $request->nota;
				$notasAlumno->promedio = round(($notasAlumno->nota1+$notasAlumno->nota2+$notasAlumno->nota3
						+$notasAlumno->pr_unidad+$notasAlumno->sg_unidad+$notasAlumno->tr_unidad)/6);
				$notasAlumno->save();
				$mensaje = array('msj'=>$notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente', 'promedio'=>$notasAlumno->promedio );
				return  $mensaje;
				//return  $notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente';
			}
			elseif ($notasAlumno->nota1 == $request->nota) {
				return "";
			}
		}
		if($request->nronota == 'nota2')
		{
			if($notasAlumno->nota2 != $request->nota)
			{
				$notasAlumno->nota2 = $request->nota;
				$notasAlumno->promedio = round(($notasAlumno->nota1+$notasAlumno->nota2+$notasAlumno->nota3
						+$notasAlumno->pr_unidad+$notasAlumno->sg_unidad+$notasAlumno->tr_unidad)/6);
				$notasAlumno->save();
				$mensaje = array('msj'=>$notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente', 'promedio'=>$notasAlumno->promedio );
				return  $mensaje;
			}
			elseif ($notasAlumno->nota2 == $request->nota) {
				return "";
			}
		}
		if($request->nronota == 'nota3')
		{
			if($notasAlumno->nota3 != $request->nota)
			{
				$notasAlumno->nota3 = $request->nota;
				$notasAlumno->promedio = round(($notasAlumno->nota1+$notasAlumno->nota2+$notasAlumno->nota3
						+$notasAlumno->pr_unidad+$notasAlumno->sg_unidad+$notasAlumno->tr_unidad)/6);
				$notasAlumno->save();
				$mensaje = array('msj'=>$notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente', 'promedio'=>$notasAlumno->promedio );
				return  $mensaje;
			}
			elseif ($notasAlumno->nota3 == $request->nota) {
				return "";
			}
		}
		if($request->nronota == 'nota4')
		{
			if($notasAlumno->pr_unidad != $request->nota)
			{
				$notasAlumno->pr_unidad = $request->nota;
				$notasAlumno->promedio = round(($notasAlumno->nota1+$notasAlumno->nota2+$notasAlumno->nota3
						+$notasAlumno->pr_unidad+$notasAlumno->sg_unidad+$notasAlumno->tr_unidad)/6);
				$notasAlumno->save();
				$mensaje = array('msj'=>$notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente', 'promedio'=>$notasAlumno->promedio );
				return  $mensaje;
			}
			elseif ($notasAlumno->pr_unidad == $request->nota) {
				return "";
			}
		}
		if($request->nronota == 'nota5')
		{
			if($notasAlumno->sg_unidad != $request->nota)
			{
				$notasAlumno->sg_unidad = $request->nota;
				$notasAlumno->promedio = round(($notasAlumno->nota1+$notasAlumno->nota2+$notasAlumno->nota3
						+$notasAlumno->pr_unidad+$notasAlumno->sg_unidad+$notasAlumno->tr_unidad)/6);
				$notasAlumno->save();
				$mensaje = array('msj'=>$notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente', 'promedio'=>$notasAlumno->promedio );
				return  $mensaje;
			}
			elseif ($notasAlumno->sg_unidad == $request->nota) {
				return "";
			}
		}
		if($request->nronota == 'nota6')
		{
			if($notasAlumno->tr_unidad != $request->nota)
			{
				$notasAlumno->tr_unidad = $request->nota;
				$notasAlumno->save();
				$notasAlumno->promedio = round(($notasAlumno->nota1+$notasAlumno->nota2+$notasAlumno->nota3
						+$notasAlumno->pr_unidad+$notasAlumno->sg_unidad+$notasAlumno->tr_unidad)/6);
				$mensaje = array('msj'=>$notasAlumno->matriculas->alumnos->nombres .': Nota registrada correctamente', 'promedio'=>$notasAlumno->promedio );
				$notasAlumno->save();
				return  $mensaje;
			}
			elseif ($notasAlumno->tr_unidad == $request->nota) {
				return "";
			}
		}
	}

}
