<?php

class Model_Eventos extends CI_Model{

    private $error;

    public function __construct(){
        parent::__construct();
        $this->load->database('db_eventos');
    }

    
    public function lista_eventos(){

        try {
            
            $result = $this->db->query("SELECT * FROM eventos order by fecha_registro desc");
             
            return $result->result();  
            
        } catch (Exception $e) {

            $this->error = 'Error: '.$e->getMessage().".";
            return false;

        }

    }

    public function crear_evento($titulo, $descripcion, $fecha_inicio, $fecha_fin){

        try {
            
            $parametros = array( $titulo, $descripcion, $fecha_inicio, $fecha_fin );

            $result = $this->db->query("INSERT INTO eventos (titulo, descripcion, fecha_inicio, fecha_fin , fecha_registro) VALUES ( ?, ?, ?, ?, NOW() );" , $parametros);
     
            return true;  
            
        } catch (Exception $e) {

            $this->error = 'Error: '.$e->getMessage().".";
            return false;

        }

    }

    public function borrar_evento($id){

        try {
            
            $parametros = array( $id );

            $result = $this->db->query("DELETE FROM eventos WHERE id = ? ;" , $parametros);
     
            return true;  
            
        } catch (Exception $e) {

            $this->error = 'Error: '.$e->getMessage().".";
            return false;

        }

    }

    public function editar_evento($id, $titulo, $descripcion, $fecha_inicio, $fecha_fin){

        try {
            
            $parametros = array($titulo, $descripcion, $fecha_inicio, $fecha_fin, $id );

            $result = $this->db->query("UPDATE eventos
            SET titulo = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?
            WHERE id = ?;" , $parametros);
     
            return true;  
            
        } catch (Exception $e) {

            $this->error = 'Error: '.$e->getMessage().".";
            return false;

        }

    }


    public function getError(){
        return $this->error;
    }

}