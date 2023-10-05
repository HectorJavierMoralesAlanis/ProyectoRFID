<?php
    //echo "dao";
    //Se crea la clase DAO
    class DAO{
        //Se crea la variable conexion
        private $conexion;

        //Se crea la funcion construct
        public function __construct(){
            //try and cath
            try{
                //Se guardara la conexion a la base de datos
                $this->conexion = new PDO("mysql:host=localhost;dbname=listas","admin","587e608a4d7c61b1a289769b4f0eed9f2ba5e0edd903e117");
                
            }catch (Exception $ex){
                //Mensajen de error
                echo $ex->getMessage();
            }
        }

        //Funcion para ejecutar la consultas SELECT 
        public function ejecutarConsulta($sql="",$valores=array()){
            if($sql!=""&&strlen($sql)>0){
                //se crea la variable consulta donde se prepara la consulta
                $consulta = $this->conexion->prepare($sql);
                //se ejecuta la consulta
                $consulta->execute($valores);
                //si intval da 0 entonces entra y se crea la variable resultados para ordenar los datos y retornarlos si es falso regresa el mensaje de error
                if(intval($consulta->errorCode())===0){
                    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
                    return $resultados;
                }else{
                    return intval($consulta->errorCode());
                }
            }else {
                return 0;
            }
        }
        
        //Funcion para ejecutar las consultas INSERT,UPDATE,DELETE
        public function insertarConsulta($sql="",$valores=array()){
            if($sql!=""&&strlen($sql)>0){
                try{
                    $this->conexion->beginTransaction();//Incia la trasnsaccion para poder hacer las consultas
                    //Se prepara la consulta en la variable consulta
                    $consulta=$this->conexion->prepare($sql);
                    //Se ejecuta la consulta
                    $consulta->execute($valores);
                    //Si intval es igual a 0 entonces entra y se crea la variable resultados para confirmar  la accion y regresar las filas afectadas y si es negativa el rollback regresa al estado antes de que se consultara  
                    if(intval($consulta->errorCode())===0){
                        $this->conexion->commit();//confirma la accion realizada
                        $filasAfectadas=$consulta->rowCount();
                        return $filasAfectadas;
                    }else{
                        $this->conexion->rollBack();
                        return -1;
                    }
                }catch(Exception $ex){
                    $this->conexion->rollBack();//regresa a un estado anterior
                    return $this->conexion->errorInfo();
                }
            }else{
                return 0;
            }
        
        }
    }
    
?>