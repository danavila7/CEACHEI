<?php

class ExamenesController extends BaseController {
	protected $layout = 'layouts.layout';


    public function MisNotas(){

        $filter = DataFilter::source(Evaluaciones::with('usuario')
            ->where('usuario_id',Auth::user()->id));
        $filter->attributes(array('class'=>'form-inline'));
        //$filter->add('nombre','Buscar por Nombre', 'text');
        //$filter->submit('search');
        //$filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('eva_1','1', true);
        $grid->add('eva_2','2', true);
        $grid->add('eva_3','3', true);
        $grid->add('eva_4','4', true);
        $grid->add('eva_5','5', true);
        $grid->add('eva_6','6', true);
        $grid->add('eva_7','7', true);
        $grid->add('eva_8','8', true);
        $grid->add('eva_9','9', true);
        $grid->add('eva_10','10', true);
        $grid->add('eva_11','11', true);
        $grid->add('eva_12','12', true);
        $grid->add('eva_13','13', true);
        $grid->add('eva_14','14', true);
        $grid->add('eva_15','15', true);
        $grid->add('eva_16','16', true);
        $grid->add('eva_17','17', true);
        $grid->add('eva_18','18', true);
        $grid->add('eva_19','19', true);
        $grid->add('eva_20','20', true);

        if(!Entrust::hasRole('alumno')){
        $grid->edit(url().'/evaluaciones/edit', 'Editar/Borrar','modify|delete');
        $grid->link('/evaluaciones/edit', 'Crear Nuevo', 'TR');
        }
        $grid->orderBy('id','desc');
        $grid->paginate(10); 

        return View::make('examenes.listaevaluaciones', compact('filter', 'grid'));
    }


    public function ListaEvaluaciones(){

        $filter = DataFilter::source(Evaluaciones::with('usuario'));
        $filter->attributes(array('class'=>'form-inline'));
        //$filter->add('nombre','Buscar por Nombre', 'text');
        //$filter->submit('search');
        //$filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('usuario.fullname','Alumno', 'usuario_id');
        $grid->add('eva_1','1', true);
        $grid->add('eva_2','2', true);
        $grid->add('eva_3','3', true);
        $grid->add('eva_4','4', true);
        $grid->add('eva_5','5', true);
        $grid->add('eva_6','6', true);
        $grid->add('eva_7','7', true);
        $grid->add('eva_8','8', true);
        $grid->add('eva_9','9', true);
        $grid->add('eva_10','10', true);
        $grid->add('eva_11','11', true);
        $grid->add('eva_12','12', true);
        $grid->add('eva_13','13', true);
        $grid->add('eva_14','14', true);
        $grid->add('eva_15','15', true);
        $grid->add('eva_16','16', true);
        $grid->add('eva_17','17', true);
        $grid->add('eva_18','18', true);
        $grid->add('eva_19','19', true);
        $grid->add('eva_20','20', true);

        $grid->edit(url().'/evaluaciones/edit', 'Editar/Borrar','modify|delete');
        $grid->link('/evaluaciones/edit', 'Crear Nuevo', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 

        return View::make('examenes.listaevaluaciones', compact('filter', 'grid'));
    }

    public function CrudEvaluaciones(){
        $edit = DataEdit::source(new Evaluaciones());
        $edit->label('Evaluaciones');
        $edit->link("ListaEvaluaciones","Lista Evaluaciones", "TR")->back();
        $edit->add('usuario.fullname','Alumno','autocomplete')
                ->remote('nombre', "id", url()."/searchuser")
                ->rule('required');
        $edit->add('eva_1','Eva 1', 'text')->rule('required');
        $edit->add('eva_2','Eva 2', 'text')->rule('required');
        $edit->add('eva_3','Eva 3', 'text')->rule('required');
        $edit->add('eva_4','Eva 4', 'text')->rule('required');
        $edit->add('eva_5','Eva 5', 'text')->rule('required');
        $edit->add('eva_6','Eva 6', 'text')->rule('required');
        $edit->add('eva_7','Eva 7', 'text')->rule('required');
        $edit->add('eva_8','Eva 8', 'text')->rule('required');
        $edit->add('eva_9','Eva 9', 'text')->rule('required');
        $edit->add('eva_10','Eva 10', 'text')->rule('required');
        $edit->add('eva_11','Eva 11', 'text')->rule('required');
        $edit->add('eva_12','Eva 12', 'text')->rule('required');
        $edit->add('eva_13','Eva 13', 'text')->rule('required');
        $edit->add('eva_14','Eva 14', 'text')->rule('required');
        $edit->add('eva_15','Eva 15', 'text')->rule('required');
        $edit->add('eva_16','Eva 16', 'text')->rule('required');
        $edit->add('eva_17','Eva 17', 'text')->rule('required');
        $edit->add('eva_18','Eva 18', 'text')->rule('required');
        $edit->add('eva_19','Eva 19', 'text')->rule('required');
        $edit->add('eva_20','Eva 20', 'text')->rule('required');

        return View::make('examenes.crudevaluaciones', compact('edit'));
    }

	public function ListaExamenes(){

        $filter = DataFilter::source(new Examen);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->orderBy('id','desc');
        $grid->paginate(10); 
        $grid->build();

        return View::make('examenes.listaexamenes', compact('filter', 'grid'));
    }

    public function CrudExamen(){
    	$edit = DataEdit::source(new Examen());
        $edit->label('Examenes');
        $edit->link("ListaExamenes","Lista Examenes", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');

        return View::make('examenes.crudexamen', compact('edit'));
    }

    public function AgregarPreguntaGet($id_examen){
        $examen = Examen::find($id_examen);
        $examenpreguntas = DB::table('examenpreguntas')
    		->where('id_examen', '=', $id_examen )
    		->lists('id_pregunta');

        $pregu = Pregunta::all();
        $preg = array();
        foreach($pregu as $p){
            $existe = false;
            if(in_array($p->id, $examenpreguntas)){
                $existe = true;
            }
            $preg[] = array(
                "id"=>$p->id,
                "texto"=>$p->texto,
                "existe"=>$existe
            );
        }

        if(is_null($examen)){
            return Redirect::to('ListaExamenes');
        }
        return View::make('examenes.editarexamen')->with('examen', $examen)
        										  ->with('preg', $preg);
    }

    public function EditarExamenPost(){
    	$id = Input::get("id");
        $examen = Examen::find($id);
        $examen->nombre = Input::get("nombre");
        $examen->save();
        $LastInsertId = $examen->id;

        $examen_preguntas = DB::table('examenpreguntas')
    		->where('id_examen', '=', $id )
    		->delete();

        return Redirect::to('ListaExamenes');
    }

    public function AgregarPreguntaExamenGet($id_examen, $id_pregunta){
        $examenpregunta = new ExamenPregunta;
        $examenpregunta->id_examen = $id_examen;
        $examenpregunta->id_pregunta = $id_pregunta;
        $examenpregunta->orden = 1;
        $examenpregunta->save();
        return Response::json(array('msg'=>'ok'));
    }

    public function QuitarPreguntaExamenGet($id_examen, $id_pregunta){
        $examen_preguntas = DB::table('examenpreguntas')
            ->where('id_examen', '=', $id_examen )
            ->where('id_pregunta','=',$id_pregunta)
            ->delete();
        return Response::json(array('msg'=>'lala'));
    }

    public function ListaPreguntas(){
        $filter = DataFilter::source(new Pregunta);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->orderBy('id','desc');
        $grid->paginate(10); 
        $grid->build();
        
        return View::make('examenes.listapreguntas', compact('filter', 'grid'));
    }

    public function CrudPreguntas(){
        $edit = DataEdit::source(new Pregunta());
        $edit->label('Pregunta');
        $edit->link("ListaPreguntas","Lista Preguntas", "TR")->back();
        $edit->add('texto','Texto', 'text')->rule('required');

        return View::make('examenes.crudpregunta', compact('edit'));
    }

    public function CrearPreguntaPost(){
        $pregunta = new Pregunta;
        $pregunta->texto = Input::get("texto_pregunta");
        $pregunta->save();
        $LastInsertId = $pregunta->id;

        $resp1 = new Respuesta;
        $respuesta1 =  Input::get("respuesta1");
        $correcta1 = Input::get("correcta1");
        $resp1->texto = $respuesta1;
        $resp1->correcta = intval($correcta1);
        $resp1->orden = 1;
        $resp1->id_pregunta = $LastInsertId;
        $resp1->save();

        $resp2 = new Respuesta;
        $respuesta2 =  Input::get("respuesta2");
        $correcta2 = Input::get("correcta2");
        $resp2->texto = $respuesta2;
        $resp2->correcta = intval($correcta2);
        $resp2->orden = 2;
        $resp2->id_pregunta = $LastInsertId;
        $resp2->save();

        $resp3 = new Respuesta;
        $respuesta3 =  Input::get("respuesta3");
        $correcta3 = Input::get("correcta3");
        $resp3->texto = $respuesta3;
        $resp3->correcta = intval($correcta3);
        $resp3->orden = 3;
        $resp3->id_pregunta = $LastInsertId;
        $resp3->save();

        $resp4 = new Respuesta;
        $respuesta4 =  Input::get("respuesta4");
        $correcta4 = Input::get("correcta4");
        $resp4->texto = $respuesta4;
        $resp4->correcta = intval($correcta4);
        $resp4->orden = 4;
        $resp4->id_pregunta = $LastInsertId;
        $resp4->save();

        return Redirect::to('ListaPreguntas');


    }

     public function EditarPreguntaGet($id_pregunta){
        $pregunta = Pregunta::find($id_pregunta);
        $respuestas = DB::table('respuestas')
    		->where('id_pregunta', '=', $id_pregunta )
    		->get();
        if(is_null($pregunta))
        {
            return Redirect::to('ListaPreguntas');
        }
        return View::make('examenes.editarpregunta')->with('pregunta', $pregunta)
        											->with('respuestas', $respuestas);
    }

    public function EditarPreguntaPost(){
    	$id_pregunta = Input::get("id");
        $pregunta = Pregunta::find($id_pregunta);
        $pregunta->save();
        $LastInsertId = $pregunta->id;

        $respuesta1 =  Input::get("respuesta1");
        $correcta1 = Input::get("correcta1");
        $r1 = array(
        	'texto' => $respuesta1,
        	'correcta' => $correcta1
        	);
        DB::table('respuestas')
    		->where('id_pregunta', '=', $id_pregunta )
    		->where('orden', '=', 1)
    		->update($r1);

        $respuesta2 =  Input::get("respuesta2");
        $correcta2 = Input::get("correcta2");
        $r2 = array(
        	'texto' => $respuesta2,
        	'correcta' => $correcta2
        	);
        DB::table('respuestas')
    		->where('id_pregunta', '=', $id_pregunta )
    		->where('orden', '=', 2)
    		->update($r2);

        $respuesta3 =  Input::get("respuesta3");
        $correcta3 = Input::get("correcta3");
        $r3 = array(
        	'texto' => $respuesta3,
        	'correcta' => $correcta3
        	);
        DB::table('respuestas')
    		->where('id_pregunta', '=', $id_pregunta )
    		->where('orden', '=', 3)
    		->update($r3);

        $respuesta4 =  Input::get("respuesta4");
        $correcta4 = Input::get("correcta4");
        $r4 = array(
        	'texto' => $respuesta4,
        	'correcta' => $correcta4
        	);
        $resp4 = DB::table('respuestas')
    		->where('id_pregunta', '=', $id_pregunta )
    		->where('orden', '=', 4)
    		->update($r4);

        return Redirect::to('ListaPreguntas');
    }

    public function BorrarPreguntaGet(){
        $id = Input::get('id');
        $pregunta = Pregunta::find($id);
        $examen_respuesta = DB::table('examenpreguntas')
    		->where('id_pregunta', '=', $id )
    		->first();

        if(!is_null($examen_respuesta)){
        	return Response::json(array('msg'=>'0'));
        }else{
        	$respuestas = DB::table('respuestas')
    		->where('id_pregunta', '=', $id )
    		->delete();
        	//borra preguntas
        	$pregunta->delete();
        	return Response::json(array('msg'=>'1'));
        }
    }

    public function ListaExamenAlumnosGet($id_examen){
        $examen = Examen::find($id_examen);
        $examenusuarios = DB::table('examenusuarios')
            ->where('id_examen', '=', $id_examen )
            ->lists('id_usuario');

        $usuarios = array();

        if($examenusuarios){
            $usuarios = DB::table('usuarios')
                    ->whereIn('id', $examenusuarios)->get();
        }




        return View::make('examenes.listaexamenalumnos')
                                                    ->with('examen', $examen)
                                                    ->with('usuarios', $usuarios);
    }

    public function RealizarExamenGet($id_usuario, $id_examen){
            $examen = Examen::find($id_examen);
            $examen_preguntas = DB::table('examenpreguntas')
            ->where('id_examen', '=', $id_examen )
            ->lists('id_pregunta');

            $preguntas = array();
            if($examen_preguntas){
                $preguntas = DB::table('preguntas')
                ->whereIn('id', $examen_preguntas )
                ->get();
            }
            

            $pregresp = array();

            foreach($preguntas as $p){
                $respuestas = DB::table('respuestas')
                ->where('id_pregunta', $p->id )
                ->get();
                $pregresp = array(
                    "texto" => $p->texto,
                    "respuestas" => $respuestas
                    );
            }

          return View::make('examenes.realizaexamen')
                                                    ->with('examen', $examen)
                                                    ->with('id_usuario', $id_usuario)
                                                    ->with('pregresp', $pregresp);
    }



}
