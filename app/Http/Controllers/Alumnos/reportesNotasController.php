<?php namespace flavisur\Http\Controllers\Alumnos;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\matricula;
use flavisur\Alumno;
use flavisur\grupo;
use flavisur\carrera;
use Illuminate\Http\Request;
use Fpdf;
use Carbon\Carbon;

class reportesNotasController extends Controller {

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
		$idmat = $id;
		$matricula = matricula::findOrFail($idmat);
		//$carrera = carrera::with('semestres')->findOrFail($matricula->carrera_id);
		//if($matricula->carrera_id == 4)
		{
			return view('vistasalumnos/reporteOpeMant', compact('idmat'));
		}
		/*elseif($matricula->carrera_id == 2)
		{
			return view('vistasalumnos/reporteSeguridad', compact('idmat'));
		}*/
		

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request)
	{

		$repmatricula = matricula::with('detalles_matriculas', 'detalles_matriculas.grupos', 'alumnos', 'carreras', 'inscripciones' )->findOrFail($request->id_matricula);
		//dd($repmatricula);
		if($repmatricula->carreras->tipo=='INSTITUTO')
		{
	        $fpdf = new Fpdf();
		    $fpdf->AddPage();
		    $fpdf->SetFont('Arial','B',16);
		    $fpdf->Image('img/logoflv.png',10,10,33);
		    $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    $fpdf->Cell(140,10, utf8_decode('Instituto Superior Tecnológico Flavisur'),1,0,'C');
		    	// Salto de línea
		    $fpdf->SetFont('Arial','B',10);
		    $fpdf->Ln();
		    $date = Carbon::now();
		    $w = 1;
		    $fpdf->Cell(30,8*$w,'CODIGO(DNI):',1,0,'');
		    $fpdf->Cell(40,8*$w, utf8_decode($repmatricula->alumnos->dni),1,0,'');
		    $fpdf->Cell(25,8*$w,'ESTUDIANE:',1,0,'');
		    $fpdf->Cell(95,8*$w, utf8_decode($repmatricula->alumnos->nombres),1,0,'');
		    $fpdf->Ln();
		    $fpdf->Cell(30,8*$w,'CARRERA):',1,0,'');
		    $fpdf->Cell(160,8*$w, utf8_decode($repmatricula->carreras->nombre),1,0,'');
	        $fpdf->Ln();
	        $fpdf->Cell(15,10*$w,'#', 1,0, 'C');
	        $fpdf->Cell(60,10*$w,'Curso', 1,0, 'C');
	        $fpdf->Cell(15,10*$w,'ciclo', 1,0, 'C');
	        $fpdf->Cell(25,10*$w,'1raUnidad', 1,0, 'C');
	        $fpdf->Cell(25,10*$w,'2daUnidad', 1,0, 'C');
	        $fpdf->Cell(25,10*$w,'3raUnidad', 1,0, 'C');
	        $fpdf->Cell(25,10*$w,'Promedio', 1,0, 'C');
	        $fpdf->Ln();
	        $fpdf->SetFont('Arial','',12);
	        foreach ($repmatricula->detalles_matriculas as $detalles) {
	        	$fpdf->Cell(15,10,$w, 1,0, 'C');
	        	$fpdf->Cell(60,10,utf8_decode($detalles->cursos->nombre),1,0, 'C');
	        	$fpdf->Cell(15,10,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
	        	$fpdf->Cell(25,10,$detalles->pr_unidad, 1,0, 'C');
	        	$fpdf->Cell(25,10,$detalles->sg_unidad, 1,0, 'C');
	        	$fpdf->Cell(25,10,$detalles->tr_unidad, 1,0, 'C');
	        	$fpdf->Cell(25,10,$detalles->promedio, 1,0, 'C');
		        $fpdf->Ln();
		        $w++;
		        //$fpdf->Cell()
	        }
	        $fpdf->SetFont('Arial','B',10);
	        	$fpdf->Cell(40,8, 'FECHA DE ENTREGA' ,1,0, 'C');
		        $date = Carbon::now();
		        $fpdf->Cell(80,8, $date->format('d-m-Y'),1,0,'C');
		        $fpdf->Cell(14,8, 'FIRMA',1,0,'C');
		        $fpdf->Cell(56,8, '',1,0,'C');
	        $fpdf->Output();
	        exit;
        }
        elseif ($repmatricula->carreras->tipo=='CETPRO') {
        	if($repmatricula->carreras->descripcion=='elaborado')
        	{
	        	$fpdf = new Fpdf();
		        $fpdf->AddPage();
		        $fpdf->SetFont('Arial','B',16);
		        $fpdf->Image('img/logoflv.png',10,10,33);
		        $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    	$fpdf->Cell(140,10, utf8_decode('CENTRO TECNICO PRODUCTIVO FLAVISUR'),1,0,'');
		    	// Salto de línea
		    	$fpdf->SetFont('Arial','B',10);
		    	$fpdf->Ln();
		        $date = Carbon::now();
		        $w = 1;
		        $fpdf->Cell(30,8*$w,'CODIGO(DNI):',1,0,'');
		        $fpdf->Cell(40,8*$w, utf8_decode($repmatricula->alumnos->dni),1,0,'');
		        $fpdf->Cell(25,8*$w,'ESTUDIANE:',1,0,'');
		        $fpdf->Cell(95,8*$w, utf8_decode($repmatricula->alumnos->nombres),1,0,'');
		        $fpdf->Ln();
		        $fpdf->Cell(22,8*$w,'#', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'C.F', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'SCOOP', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'EXCA', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'C.GRU', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'V.VOL', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'C.MIN', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'T.ORU', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'T.LLA', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'RETRO', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'MONT', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'MOTO', 1,0, 'C');
		        $fpdf->Cell(14,8*$w,'ROD', 1,0, 'C');
		        $fpdf->Ln();
		        $fpdf->SetFont('Arial','',10);
		        $n=1;
		        $pdfnotas=[];
		        $CF=[];
		        $SCOOP=[];
		        $EXCA=[];
		        $CGRU=[];
		        $VVOL=[];
		        $CMIN=[];
		        $TORU=[];
		        $TLLA=[];
		        $RETRO=[];
		        $MONT=[];
		        $MOTO=[];
		        $ROD=[];
		        $x=0;
		        $y=0;
		        $z=0;
		        $a=0;
		        $b=0;
		        $c=0;
		        $d=0;
		        $e=0;
		        $f=0;
		        $g=0;
		        $h=0;
		        $i=0;
		        //foreach ($repmatricula->detalles_matriculas as $detalles) {
		        //	$fpdf->Cell(22,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
		        ///////////////////////////////////////////////////////////////
		        foreach ($repmatricula->detalles_matriculas as $notas) {

			        	if($notas->grupos->ciclos->ciclo == 'C.F.')
			        	{
			        		$CF[$x] = $notas->promedio;
			        		$x++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'SCOOP')
			        	{
			        		$SCOOP[$y] = $notas->promedio;
			        		$y++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'EXCA')
			        	{
			        		$EXCA[$z] = $notas->promedio;
			        		$z++;
			        	}		   
			        	if($notas->grupos->ciclos->ciclo == 'C.GRU')
			        	{
			        		$CGRU[$a] = $notas->promedio;
			        		$a++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'V.VOL')
			        	{
			        		$VVOL[$b] = $notas->promedio;
			        		$b++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'C.MIN')
			        	{
			        		$CMIN[$c] = $notas->promedio;
			        		$c++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'T.ORU')
			        	{
			        		$TORU[$d] = $notas->promedio;
			        		$d++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'T.LLA')
			        	{
			        		$TLLA[$e] = $notas->promedio;
			        		$e++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'RETRO')
			        	{
			        		$RETRO[$f] = $notas->promedio;
			        		$f++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'MONT')
			        	{
			        		$MONT[$g] = $notas->promedio;
			        		$g++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'MOTO')
			        	{
			        		$MOTO[$h] = $notas->promedio;
			        		$h++;
			        	}
			        	if($notas->grupos->ciclos->ciclo == 'ROD')
			        	{
			        		$ROD[$i] = $notas->promedio;
			        		$i++;
			        	}
		        	}
		        $index=0;
		        foreach ($repmatricula->detalles_matriculas as $detalles)
		        {
		        	$fpdf->Cell(22,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
		        	if(!$request->CF)
		        	{	
		        		
		        		$fpdf->Cell(14,8,"-", 1,0, 'C');
		        	}
		        	else
		        	{
		        		
		        		if(empty($CF))
		        		{
		        			$fpdf->Cell(14,8,"NP", 1,0, 'C');	
		        		}else
		        		{
		        			$fpdf->Cell(14,8,$CF[$index], 1,0, 'C');
		        		}
		        	}
			        if(!$request->SCOOP)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($SCOOP))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$SCOOP[$index], 1,0, 'C');
			        	}
			        }
			        if(!$request->EXCA)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($EXCA))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$EXCA[$index], 1,0, 'C');
			        	}
			        }
			       	if(!$request->CGRU)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($CGRU))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$CGRU[$index], 1,0, 'C');
			        	}
			        }
			        if(!$request->VVOL)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($VVOL))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$VVOL[$index], 1,0, 'C');
			        	}
			        }
			        if(!$request->CMIN)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($CMIN))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$CMIN[$index], 1,0, 'C');
			        	}
			        }	
			        if(!$request->TORU)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($TORU))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$TORU[$index], 1,0, 'C');
			        	}
			        }
			        if(!$request->TLLA)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($TLLA))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$TLLA[$index], 1,0, 'C');
			        	}
			        }
					if(!$request->RETRO)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($RETRO))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$RETRO[$index], 1,0, 'C');
			        	}
			        }
			        if(!$request->MONT)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($MONT))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$MONT[$index], 1,0, 'C');
			        	}
			        }
			        if(!$request->MOTO)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($MOTO))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$MOTO[$index], 1,0, 'C');
			        	}
			        }
			        if(!$request->ROD)
			        {
			        	$fpdf->Cell(14,8,"-", 1,0, 'C');
			        }
			        else
			        {
			        	if(empty($ROD))
			        	{
			        		$fpdf->Cell(14,8,"NP", 1,0, 'C');
			        	}
			        	else
			        	{
			        		$fpdf->Cell(14,8,$ROD[$index], 1,0, 'C');
			        	}
			        }
		        	$fpdf->Ln();
		        	if($index==4)
		        		{break;}
			        $index++;
		        }

		        $fpdf->SetFillColor(255,255,51);
		        $fpdf->Cell(22,8,utf8_decode('PROMEDIO'),1,0, 'C', True);
		        if(!$request->CF)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($CF))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($CF)/count($CF))),1,0, 'C',True);
		        	}
		        }	        
		        if(!$request->SCOOP)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($SCOOP))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($SCOOP)/count($SCOOP))),1,0, 'C',True);
		        	}
		        }
		       	if(!$request->EXCA)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($EXCA))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($EXCA)/count($EXCA))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->CGRU)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($CGRU))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($CGRU)/count($CGRU))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->VVOL)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($VVOL))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($VVOL)/count($VVOL))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->CMIN)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($CMIN))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($CMIN)/count($CMIN))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->TORU)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		      		if(empty($TORU))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($TORU)/count($TORU))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->TLLA)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($TLLA))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($TLLA)/count($TLLA))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->RETRO)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($RETRO))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($RETRO)/count($RETRO))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->MONT)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($MONT))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($MONT)/count($MONT))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->MOTO)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($MOTO))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($MOTO)/count($MOTO))),1,0, 'C',True);
		        	}
		        }
		        if(!$request->ROD)
		        {
		        	$fpdf->Cell(14,8,'-',1,0, 'C',True);
		        }
		        else
		        {
		        	if(empty($ROD))
		        	{
		        		$fpdf->Cell(14,8,'NP',1,0, 'C',True);
		        	}
		        	else
		        	{
		        		$fpdf->Cell(14,8,round((array_sum($ROD))/count($ROD)),1,0, 'C',True);
		        	}
		        }
		        $fpdf->Ln();
		        $fpdf->Cell(40,8, 'FECHA DE ENTREGA' ,1,0, 'C');
		        $date = Carbon::now();
		        $fpdf->Cell(80,8*$w, $date->format('d-m-Y'),1,0,'C');
		        $fpdf->Cell(14,8*$w, 'FIRMA',1,0,'C');
		        $fpdf->Cell(56,8*$w, '',1,0,'C');
		        $fpdf->Output();
		        exit;
		    }
		    else
		    {
		    	$fpdf = new Fpdf();
		        $fpdf->AddPage();
		        $fpdf->SetFont('Arial','B',16);
		        $fpdf->Image('img/logoflv.png',10,10,33);
		        $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    	$fpdf->Cell(140,10, utf8_decode('CENTRO TECNICO PRODUCTIVO FLAVISUR'),1,0,'');
		    	// Salto de línea
		    	$fpdf->SetFont('Arial','B',10);
		    	$fpdf->Ln();
		        $date = Carbon::now();
		        $w = 1;
		        $fpdf->Cell(30,8*$w,'CODIGO(DNI):',1,0,'');
		        $fpdf->Cell(40,8*$w, utf8_decode($repmatricula->alumnos->dni),1,0,'');
		        $fpdf->Cell(25,8*$w,'ESTUDIANE:',1,0,'');
		        $fpdf->Cell(95,8*$w, utf8_decode($repmatricula->alumnos->nombres),1,0,'');
		        $fpdf->Ln();
		        $fpdf->Cell(30,8*$w,'CARRERA):',1,0,'');
		        $fpdf->Cell(160,8*$w, utf8_decode($repmatricula->carreras->nombre),1,0,'');
		        $fpdf->Ln();
		       	$fpdf->Cell(22,8*$w,'#', 1,0, 'C');
		        $fpdf->Cell(80,8*$w,'Curso', 1,0, 'C');
		        $fpdf->Cell(50,8*$w,'Modulo', 1,0, 'C');
		        $fpdf->Cell(38,8*$w,'Promedio', 1,0, 'C');
		        $fpdf->SetFont('Arial','',10);
		        $fpdf->Ln();
		        $w=1;
				$temporal='';
				$promedio_final=[];
				$pf=0;
				$valor=0;
				if($request->MODI)
				{
		        foreach ($repmatricula->detalles_matriculas as $detalles) {
			        if($detalles->IdCiclo == $request->MODI)
				        {
					        $fpdf->Cell(22,8,$w, 1,0, 'C');
						    $fpdf->Cell(80,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
						    $fpdf->Cell(50,8,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
						    $fpdf->Cell(38,8,$detalles->promedio, 1,0, 'C');
						    $promedio_final[$pf]=$detalles->promedio;
						    $pf++;
							$fpdf->Ln();
							$valor=1;
							$w++;
						}
				}
				if($valor==1)
				{
					$fpdf->SetFillColor(255,255,51);
			        $fpdf->SetFont('Arial','B',10);
					$fpdf->Cell(22,8,'-', 1,0, 'C',True);
					$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
					$pf=0;
					$fpdf->Ln();
					$valor = 0;
					$fpdf->SetFont('Arial','',10);
				}
				}
				if($request->MODII)
				{
				foreach ($repmatricula->detalles_matriculas as $detalles) {
				        if($detalles->IdCiclo == $request->MODII)
				        {
					        $fpdf->Cell(22,8,$w, 1,0, 'C');
						    $fpdf->Cell(80,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
						    $fpdf->Cell(50,8,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
						    $fpdf->Cell(38,8,$detalles->promedio, 1,0, 'C');
						    $promedio_final[$pf]=$detalles->promedio;
						    $pf++;
							$fpdf->Ln();
							$valor=1;
							$w++;
						}
				}
				if($valor==1)
				{
					$fpdf->SetFillColor(255,255,51);
			        $fpdf->SetFont('Arial','B',10);
					$fpdf->Cell(22,8,'-', 1,0, 'C',True);
					$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
					$pf=0;
					$fpdf->Ln();
					$valor = 0;
					$fpdf->SetFont('Arial','',10);
				}
				}
				if($request->MODIII)
				{
				foreach ($repmatricula->detalles_matriculas as $detalles) {
				        if($detalles->IdCiclo == $request->MODIII)
				        {
					        $fpdf->Cell(22,8,$w, 1,0, 'C');
						    $fpdf->Cell(80,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
						    $fpdf->Cell(50,8,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
						    $fpdf->Cell(38,8,$detalles->promedio, 1,0, 'C');
						    $promedio_final[$pf]=$detalles->promedio;
						    $pf++;
							$fpdf->Ln();
							$valor=1;
							$w++;
						}
				}
				if($valor==1)
				{
					$fpdf->SetFillColor(255,255,51);
			        $fpdf->SetFont('Arial','B',10);
					$fpdf->Cell(22,8,'-', 1,0, 'C',True);
					$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
					$pf=0;
					$fpdf->Ln();
					$valor = 0;
					$fpdf->SetFont('Arial','',10);
				}
				}
				if($request->MODIV)
				{	
				foreach ($repmatricula->detalles_matriculas as $detalles) {
				    	if($detalles->IdCiclo == $request->MODIV)
				        {
					        $fpdf->Cell(22,8,$w, 1,0, 'C');
						    $fpdf->Cell(80,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
						    $fpdf->Cell(50,8,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
						    $fpdf->Cell(38,8,$detalles->promedio, 1,0, 'C');
						    $promedio_final[$pf]=$detalles->promedio;
						    $pf++;
							$fpdf->Ln();
							$valor=1;
							$w++;
						}
				}
				if($valor==1)
				{
					$fpdf->SetFillColor(255,255,51);
			        $fpdf->SetFont('Arial','B',10);
					$fpdf->Cell(22,8,'-', 1,0, 'C',True);
					$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
					$pf=0;
					$fpdf->Ln();
					$valor = 0;
					$fpdf->SetFont('Arial','',10);
				}
				}
				if($request->MODV)
				{
				foreach ($repmatricula->detalles_matriculas as $detalles) {
				    	if($detalles->IdCiclo == $request->MODV)
				        {
					        $fpdf->Cell(22,8,$w, 1,0, 'C');
						    $fpdf->Cell(80,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
						    $fpdf->Cell(50,8,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
						    $fpdf->Cell(38,8,$detalles->promedio, 1,0, 'C');
						    $promedio_final[$pf]=$detalles->promedio;
						    $pf++;
							$fpdf->Ln();
							$valor=1;
							$w++;
						}
				}
				if($valor==1)
				{
					$fpdf->SetFillColor(255,255,51);
			        $fpdf->SetFont('Arial','B',10);
					$fpdf->Cell(22,8,'-', 1,0, 'C',True);
					$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
					$pf=0;
					$fpdf->Ln();
					$valor = 0;
					$fpdf->SetFont('Arial','',10);
				}
				}
				if($request->MODVI)
				{
				foreach ($repmatricula->detalles_matriculas as $detalles) {
				    	if($detalles->IdCiclo == $request->MODVI)
				        {
					        $fpdf->Cell(22,8,$w, 1,0, 'C');
						    $fpdf->Cell(80,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
						    $fpdf->Cell(50,8,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
						    $fpdf->Cell(38,8,$detalles->promedio, 1,0, 'C');
						    $promedio_final[$pf]=$detalles->promedio;
						    $pf++;
							$fpdf->Ln();
							$valor=1;
							$w++;
						}
				}
				if($valor==1)
				{
					$fpdf->SetFillColor(255,255,51);
			        $fpdf->SetFont('Arial','B',10);
					$fpdf->Cell(22,8,'-', 1,0, 'C',True);
					$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
					$pf=0;
					$fpdf->Ln();
					$valor = 0;
					$fpdf->SetFont('Arial','',10);
				}
				}
				if($request->MODVII)
				{
				foreach ($repmatricula->detalles_matriculas as $detalles) {
				    	if($detalles->IdCiclo == $request->MODVII)
				        {
					        $fpdf->Cell(22,8,$w, 1,0, 'C');
						    $fpdf->Cell(80,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
						    $fpdf->Cell(50,8,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
						    $fpdf->Cell(38,8,$detalles->promedio, 1,0, 'C');
						    $promedio_final[$pf]=$detalles->promedio;
						    $pf++;
							$fpdf->Ln();
							$valor=1;
							$w++;
						}
				}
				if($valor==1)
				{
					$fpdf->SetFillColor(255,255,51);
			        $fpdf->SetFont('Arial','B',10);
					$fpdf->Cell(22,8,'-', 1,0, 'C',True);
					$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
					$pf=0;
					$fpdf->Ln();
					$valor = 0;
					$fpdf->SetFont('Arial','',10);
				}
				}			        
		        //$fpdf->Cell()
	        	/*$fpdf->SetFillColor(255,255,51);
		        $fpdf->SetFont('Arial','B',10);
				$fpdf->Cell(22,8,'-', 1,0, 'C',True);
				$fpdf->Cell(130,8,utf8_decode('Promedio de Modulo:        '),1,0, 'R',True);
				if(array_sum($promedio_final)==0)
				{
							$fpdf->Cell(38,8,'0', 1,0, 'C',True);
				}
				else
				{
					$fpdf->Cell(38,8,round(array_sum($promedio_final)/count($promedio_final)), 1,0, 'C',True);
				}*/
				$fpdf->Ln();
		        $fpdf->Cell(40,8, 'FECHA DE ENTREGA' ,1,0, 'C');
		        $date = Carbon::now();
		        $fpdf->Cell(80,8, $date->format('d-m-Y'),1,0,'C');
		        $fpdf->Cell(14,8, 'FIRMA',1,0,'C');
		        $fpdf->Cell(56,8, '',1,0,'C');
		        $fpdf->Output();
		        exit;
		    } 
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
