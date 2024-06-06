<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {

	
	public function __construct() {

		parent::__construct();
		$this->load->model('Model_Eventos');
		$this->load->helper('url');
		$this->load->library('form_validation');

	}

	public function index()
	{
		
		$this->load->view('inicio' , array( "eventos" => array() ) );

	}

	public function lista_eventos(){

		$res = new stdClass();
		$eventos = $this->Model_Eventos->lista_eventos();

		if( $eventos === false ){

			$res->response = "error";
			$res->error = $this->Model_Eventos->getError();;
	
		}else{
		
			$res->response =  "success";
			$res->eventos = $eventos;					

		}

		echo json_encode($res);
		
		exit();

	}

	public function crear_evento(){

		
		if ($this->input->is_ajax_request()) 
        {
            
            $res = new stdClass();
            
            $titulo = $this->input->post("titulo");
            $descripcion = $this->input->post("descripcion");
            $fecha_inicio = $this->input->post("fecha_inicio");
            $fecha_fin = $this->input->post("fecha_fin");

			$this->form_validation->set_rules('titulo', 'Título', 'required');
			$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
			$this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'required');
			$this->form_validation->set_rules('fecha_fin', 'Fecha Fin', 'required');

			if ($this->form_validation->run() == FALSE){
				
				$res->response = "warning";
                $res->mensaje = "Todos los campos son requeridos";
           	
			}else {

				$result = $this->Model_Eventos->crear_evento($titulo, $descripcion, $fecha_inicio, $fecha_fin);

				if( $result === false ){

					$res->response = "error";
                	$res->error = $this->Model_Eventos->getError();;
			
				}else{
				
					$res->response =  "success";
					$res->mensaje = "El evento ha sido creado con éxito";					

				}

			}

			echo json_encode($res);
            
            exit();

        }

	}

	public function borrar_evento(){
		
		$res = new stdClass();
            
        $id = $this->input->post("id");            
		$this->form_validation->set_rules('id', 'Id', 'required');	
				
		if ($this->form_validation->run() == FALSE){
				
			$res->response = "error";
			$res->error = "Ocurrio un error inesperado, por favor recargue la página y vuelva a intentarlo.";
		   
		}else {

			$result = $this->Model_Eventos->borrar_evento($id);

			if( $result === false ){

				$res->response = "error";
				$res->error = $this->Model_Eventos->getError();;
		
			}else{
			
				$res->response =  "success";
				$res->mensaje = "El evento ha sido eliminado con éxito";					

			}

		}

		echo json_encode($res);
		
		exit();
		
	}

	public function editar_evento(){

		
		if ($this->input->is_ajax_request()) 
        {
            
            $res = new stdClass();
            
			$id = $this->input->post("id");
            $titulo = $this->input->post("titulo");
            $descripcion = $this->input->post("descripcion");
            $fecha_inicio = $this->input->post("fecha_inicio");
            $fecha_fin = $this->input->post("fecha_fin");

			$this->form_validation->set_rules('id', 'Id', 'required');
			$this->form_validation->set_rules('titulo', 'Título', 'required');
			$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
			$this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'required');
			$this->form_validation->set_rules('fecha_fin', 'Fecha Fin', 'required');

			if ($this->form_validation->run() == FALSE){
				
				$res->response = "warning";
                $res->mensaje = "Todos los campos son requeridos";
           	
			}else {

				$result = $this->Model_Eventos->editar_evento($id ,$titulo, $descripcion, $fecha_inicio, $fecha_fin);

				if( $result === false ){

					$res->response = "error";
                	$res->error = $this->Model_Eventos->getError();;
			
				}else{
				
					$res->response =  "success";
					$res->mensaje = "El evento ha sido actualizado con éxito";					

				}

			}

			echo json_encode($res);
            
            exit();

        }

	}

}