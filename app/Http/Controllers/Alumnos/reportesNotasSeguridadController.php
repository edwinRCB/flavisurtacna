<?php namespace flavisur\Http\Controllers\Alumnos;

use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\matricula;
use flavisur\Alumno;
use flavisur\grupo;
use Fpdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class reportesNotasSeguridadController extends Controller {

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
	public function show(Request $request)
	{
		$repmatricula = matricula::with('detalles_matriculas', 'detalles_matriculas.grupos', 'alumnos', 'carreras', 'inscripciones' )->findOrFail($request->id_matricula);
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

				$fpdf->Ln();
		        $fpdf->Cell(40,8, 'FECHA DE ENTREGA' ,1,0, 'C');
		        $date = Carbon::now();
		        $fpdf->Cell(80,8, $date->format('d-m-Y'),1,0,'C');
		        $fpdf->Cell(14,8, 'FIRMA',1,0,'C');
		        $fpdf->Cell(56,8, '',1,0,'C');
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
