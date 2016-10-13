<?php namespace flavisur\Http\Controllers\Alumnos;

use flavisur\Http\Requests\alumnoRequest;
use flavisur\Http\Requests;
use flavisur\Http\Controllers\Controller;
use flavisur\Alumno;
use Illuminate\Http\Request;
use flavisur\matricula;
use Fpdf;
use Carbon\Carbon;


class AlumnosController extends Controller {

	//protected $request;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	/*public function __construct(Request $request)
	{
		this->$request = $request;
	}*/
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('tipo_secretaria');
	} 
	public function index(Request $request)
	{
		//dd($request->get('nombres'));
		$alumnos = Alumno::Nombres($request->get('nombres'))
			->DNI($request->get('dni'))
			->where('estado', 1)->orderBy('id','desc')->paginate(10);
			//$alumnos->setPath('');
		//$alumnos = Alumno::paginate(5);
		//dd($alumnos);
		return view('vistasalumnos/alumnos', compact('alumnos'));
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
	public function store(alumnoRequest $request)
	{
		$alumno = new Alumno($request->all());
		
		$alumno->estado = 1;
		$alumno->user_id = \Auth::user()->id;
		//dd($alumno);
		$alumno->save();
		return redirect()->route('alu.alumnos.index');
		//\Redirec::route('alu.alumnos.index');
		//dd($request->all());
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
		$matriculas = matricula::with('detalles_matriculas','carreras', 'alumnos')->where('alumno_id', $id)->get();
		//dd($matriculas);
		return view('vistasalumnos/reportesNotas', compact('matriculas'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$alumnomodel = Alumno::findOrFail($id);
		return view('vistasalumnos.editar', compact('alumnomodel'));
		//return view('vistasalumnos.editar');
		//dd($alumnomodel);
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$alumnomodel = Alumno::findOrFail($id);
		$alumnomodel->fill($request->all());
		//$alumnomodel->fill(Request::all());
		//dd($request->nombres);
		$alumnomodel->save();
		return redirect()->route('alu.alumnos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$alumno = Alumno::findOrFail($request->id);
		//return $id;
		if(is_null($alumno))
			{ app::abort(404);}
		else
		{
			$alumno->fill($request->all());
			$alumno->estado = 0;
			$alumno->save();
			//$alumno->delete();

			return response()->json(['message' => 'Registro Eliminado Correctamente']);
		}
	}

	public function getAlumnos(Request $request)
	{

		$term = $request->term;
		//$term = 'cal';
		$alumnos = Alumno::where('estado', 1)->where('nombres','LIKE', $term.'%')->orderBy('nombres','asc')->get(array('id','nombres'));
		//$alumnos = Alumno::where('estado', 1)->where('nombres','LIKE', '%'.$term.'%')->lists('nombres','id');
		$result = [];

        foreach($alumnos as $alumno) {
            
                $result[] = ['value'=> $alumno->nombres, 'id' => $alumno->id];
            
        }
		return json_encode($result);
		//return $alumnos;
	}
	public function getPDF($id)
	{

		//cabecera
		$repmatricula = matricula::with('detalles_matriculas', 'alumnos', 'carreras', 'inscripciones' )->findOrFail($id);
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
	        $fpdf->Cell(10,10*$w,'#', 1,0, 'C');
	        $fpdf->Cell(90,10*$w,'Curso', 1,0, 'C');
	        $fpdf->Cell(10,10*$w,'ciclo', 1,0, 'C');
	        $fpdf->Cell(20,10*$w,'1raUnidad', 1,0, 'C');
	        $fpdf->Cell(20,10*$w,'2daUnidad', 1,0, 'C');
	        $fpdf->Cell(20,10*$w,'3raUnidad', 1,0, 'C');
	        $fpdf->Cell(20,10*$w,'Promedio', 1,0, 'C');
	        $fpdf->Ln();
	        $fpdf->SetFont('Arial','',10);
	        foreach ($repmatricula->detalles_matriculas as $detalles) {
	        	$fpdf->Cell(10,10,$w, 1,0, 'C');
	        	$fpdf->Cell(90,10,utf8_decode($detalles->cursos->nombre),1,0, '');
	        	$fpdf->Cell(10,10,utf8_decode($detalles->grupos->ciclos->ciclo),1,0, 'C');
	        	$fpdf->Cell(20,10,$detalles->pr_unidad, 1,0, 'C');
	        	$fpdf->Cell(20,10,$detalles->sg_unidad, 1,0, 'C');
	        	$fpdf->Cell(20,10,$detalles->tr_unidad, 1,0, 'C');
	        	$fpdf->Cell(20,10,$detalles->promedio, 1,0, 'C');
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
	        	$fpdf = new Fpdf();
		        $fpdf->AddPage();
		        $fpdf->SetFont('Arial','B',16);
		        $fpdf->Image('img/logoflv.png',10,10,33);
		        $fpdf->Cell(50,10,"",1,0,'');
		    	// Título
		    	$fpdf->Cell(140,10, utf8_decode('CENTRO TECNICO PRODUCTIVO FLAVISUR'),1,0,'');
		    	// Salto de línea
		    	$fpdf->SetFont('Arial','B',8);
		    	$fpdf->SetFillColor(255,255,51);
		    	$fpdf->Ln();
		        $date = Carbon::now();
		        $w = 1;
		        $fpdf->Cell(30,8*$w,'CODIGO(DNI):',1,0,'');
		        $fpdf->Cell(40,8*$w, utf8_decode($repmatricula->alumnos->dni),1,0,'');
		        $fpdf->Cell(25,8*$w,'ESTUDIANE:',1,0,'');
		        $fpdf->Cell(95,8*$w, utf8_decode($repmatricula->alumnos->nombres),1,0,'');
		        $fpdf->Ln();
		        $fpdf->Cell(10,8*$w,'#', 1,0, 'C', True);
		        if($repmatricula->carrera_id==5)
		        {
		        	$fpdf->Cell(75,8*$w,'Modulo', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'CT1', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'CT2', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'CT3', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'CT4', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'CT5', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'CT6', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'Pro.', 1,0, 'C', True);

		        }else
		        {
			        $fpdf->Cell(75,8*$w,'Modulo', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'E.O', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'T.I.', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'C.P.', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'P.C.', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'E.P', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'E.F', 1,0, 'C', True);
			        $fpdf->Cell(15,8*$w,'Pro.', 1,0, 'C', True);
		        }

		        $fpdf->Ln();
		        $fpdf->SetFont('Arial','',8);
		        $n=1;
		        foreach ($repmatricula->detalles_matriculas as $detalles) {
		        	$fpdf->SetFont('Arial','',8);
		        	$fpdf->Cell(10,8,utf8_decode($n),1,0, 'C');
		        	$fpdf->Cell(75,8,utf8_decode($detalles->cursos->nombre),1,0, 'C');
		        	$fpdf->SetFont('Arial','',10);
		        	$fpdf->Cell(15,8,utf8_decode($detalles->nota1),1,0, 'C');
		        	$fpdf->Cell(15,8,utf8_decode($detalles->nota2),1,0, 'C');
		        	$fpdf->Cell(15,8,utf8_decode($detalles->nota3),1,0, 'C');
		        	$fpdf->Cell(15,8,utf8_decode($detalles->pr_unidad),1,0, 'C');
		        	$fpdf->Cell(15,8,utf8_decode($detalles->sg_unidad),1,0, 'C');
		        	$fpdf->Cell(15,8,utf8_decode($detalles->tr_unidad),1,0, 'C');
		        	$fpdf->Cell(15,8,utf8_decode($detalles->promedio),1,0, 'C');
		        	$fpdf->Ln();
		        	$n++;
		        }
		        $fpdf->Cell(40,8, 'FECHA DE ENTREGA' ,1,0, 'C');
		        $date = Carbon::now();
		        $fpdf->Cell(80,8*$w, $date->format('d-m-Y'),1,0,'C');
		        $fpdf->Cell(14,8*$w, 'FIRMA',1,0,'C');
		        $fpdf->Cell(56,8*$w, '',1,0,'C');
		        $fpdf->Output();
		        exit;		    
        }
	}
}
