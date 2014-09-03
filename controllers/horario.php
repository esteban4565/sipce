<?php

class Horario extends Controllers {

    //Cuando se crea el constructor se verifica si inicio sesion y si tiene permiso
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }

    //La funcion Index carga dos variables, "title" es utilizada para el Header de la pagina
    //profeLista posee un array con todos los docentes que se encuentran en la tabla persona de la BD
    //Estas variables seran utilizadas en el View del Objeto (views/horario/index y views/horario/edit)
    public function index() {
        $this->view->title = 'Horario';
        $this->view->profeLista = $this->model->profeLista();

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('horario/index');
        $this->view->render('footer');
    }

    public function create() {
        $data = array(
            'title' => $_POST['title'],
            'content' => $_POST['content']
        );
        $this->model->create($data);
        header('location: ' . URL . 'note');
    }

    //La funcion edit recibe por parametro la cedula de un profesor, carga 4 variables. la primera (horario)
    //posee la distribucion del horario del profesor en la institucion, si la funcion "profeSingleList" del "horario_model"
    //no devuelve nada, significa que no se ha establecido el horario del profesor, por lo tanto solo se envia al View
    //la cedula del docente, luego se consulta las asignaturas que imparte el docente (asignaturasDocente), las secciones 
    //de la institucion (gruposLista) y por ultimo se manda el title para el header (Editar Horario)
    public function edit($cedula) {
        $this->view->horario = $this->model->profeSingleList($cedula);
        if (empty($this->view->horario)) {
            $this->view->horario[0]['ced_docente'] = $cedula;
            $this->view->title = 'Editar Horario';
            $this->view->estado = 0;
        } else {
            $this->view->title = 'Modificar Horario';
            $this->view->estado = 1;
        }

        $this->view->asignaturasDocente = $this->model->asignaturasDocente($cedula);
        $this->view->grupos = $this->model->gruposLista();

        //Se manda a ejecutar el header, contenido principal (views/horario/edit) y el footer
        $this->view->render('header');
        $this->view->render('horario/edit');
        $this->view->render('footer');
    }

    public function ingresarHorario($cedula) {
        //Este while ingresa el horario del dia Lunes del profesor
        $dia = 1;
        $matrizHorario = null;
        while ($dia < 6) {
            $leccion = 1;
            while ($leccion < 13) {
                $cod_grupo = 'cod_seccion_L' . $leccion;
                $cod_asignatura = 'asignatura_L' . $leccion;
                $matrizHorario[$dia][$leccion]['cod_grupo'] = $_POST[$cod_grupo];
                $matrizHorario[$dia][$leccion]['cod_asignatura'] = $_POST[$cod_asignatura];
                $leccion++;
            }
            $dia++;
        }

        $this->model->ingresarHorario($cedula, $matrizHorario, $_POST['estado']);
        
        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        header('location: ' . URL . 'horario');
    }

    public function actualizarDatosDocente() {
        $this->model->actualizarDatosDocente();
        $this->index();
    }
    
    public function delete($id) {
        $this->model->delete($id);
        header('location: ' . URL . 'note');
    }

}
