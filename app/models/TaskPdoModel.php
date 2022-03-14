<?php

//include ('Ramsey\Uuid');

class TaskPdoModel{
    private $DATABASE_HOST;
    private $DATABASE_USER;
    private $DATABASE_PASS;
    private $DATABASE_NAME;
    
    public function __construct(){
        //--> Habría que hacerlo con el archivo ENV que ya viene en el MVC de base.
        $this->DATABASE_HOST = 'localhost';
        $this->DATABASE_USER = 'root';
        $this->DATABASE_PASS = 'root';
        $this->DATABASE_NAME = 'Todolist';
    }

    public function pdo_connect_mysql(){
        try {
            return new PDO('mysql:host=' . $this->DATABASE_HOST . ';dbname=' . $this->DATABASE_NAME . ';charset=utf8', $this->DATABASE_USER, $this->DATABASE_PASS);
        } catch (PDOException $exception) {
            // Si hay error con la conexión, para el script y muestra el error.
            exit('Failed to connect to database!');
        }
    }
    public function listAllTask() {    
        // Conectamos a la base de datos Mysql.
        $pdo = $this->pdo_connect_mysql();
        // Preparamos la sentencia y recogemos los datos de tareas.
        $stmt = $pdo->prepare('SELECT * FROM Tareas');
        $stmt->execute();
        // Recorremos los registros para mostrarlos.
        $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Devolvemos los registros encontrados
        return $tareas;
    } 

    public function getAllStatus() {    
        // Conectamos a la base de datos Mysql.
        //$pdo = $this->pdo_connect_mysql();
        // Preparamos la sentencia y recogemos los datos de tareas.
        //$stmt = $pdo->prepare('SELECT estado FROM Tareas');
        //$stmt->execute();
        // Recorremos los registros para mostrarlos.
        //$estados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $estados = ['pendiente', 'inprogress', 'complete'];
        echo '<br>GetAllStatus <br>';
        var_dump($estados);
        // Devolvemos los registros encontrados
        return $estados;
    } 

    public function getTask($id) {  
        $this->id = $id;  
        // Connect to MySQL database
        $pdo = $this->pdo_connect_mysql();
        // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
        $stmt = $pdo->prepare('SELECT * FROM Tareas WHERE idTareas= ' . $this->id . ' LIMIT 1');
        // echo 'SQL -> ' . $stmt->queryString . '<br>';
        $stmt->execute();
        // Fetch the records so we can display them in our template.
        $tarea = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$tarea) {
            exit('<p style="color:red">No existen tareas con este ID: ' . $this->id . '</p>');
        }
        return $tarea;
    } 

    public function changeStatusTask($user, $status){
        echo  __FILE__ . " ".  __FUNCTION__;
        $this->user = $user;  
        $this->status = $status;  
        var_dump($this->user);
        $this->id = $this->user[0]['idTareas'];
        
        // Connect to MySQL database
        $pdo = $this->pdo_connect_mysql();
        // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
        $stmt = $pdo->prepare("UPDATE Tareas SET estado = '" . $this->status . "' WHERE idTareas = " . $this->id);
        $stmt->execute();
        
        // Fetch the records so we can display them in our template.
        $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

        //Comprobar si hay algún error en PDO.
        // $this->checkErroPdo($tarea);
        if (!$tarea) {
            // exit('<p style="color:red">No existen tareas con este ID: ' . $this->id . '</p>');
            echo "\nPDO::errorInfo():\n";
            print_r($stmt->errorInfo());
        }
    }

    public function updateTask($user){
        echo  __FILE__ . " ".  __FUNCTION__;
        var_dump($user);
        $this->user = $user;
        $this->id = $this->user[0]['idTareas'];


        $this->titulo = $_GET['titulo'];
        $this->descripcion = $_GET['descripcion'];
        $this->estado = $_GET['estado'];
        $this->fec_modif = date('Y-m-d');
        $this->fec_fintarea = $_GET['fec_fintarea'];

        if (isset($this->user)) {
            echo 'Entra en IF ISSET';
            // $this->titulo = $this->user[0]['titulo'];
            // $this->descripcion = $this->user[0]['descripcion'];
            // $this->estado = $this->user[0]['estado'];
            // $this->fec_modif = date('Y-m-d');
            // $this->fec_fintarea = $this->user[0]['fec_fintarea'];

            // Connect to MySQL database
            $pdo = $this->pdo_connect_mysql();
            // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
            $stmt = $pdo->prepare("UPDATE Tareas SET titulo = '" . $this->titulo . "',  descripcion = '" . $this->descripcion . "',estado = '" . $this->estado . "', fec_modif = '" . $this->fec_modif . "', fec_fintarea = '" . $this->fec_fintarea . "' WHERE idTareas = " . $this->id);
            
            var_dump($stmt);
            $stmt->execute();
            
            // Fetch the records so we can display them in our template.
            $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

            //Comprobar si hay algún error en PDO.
            // $this->checkErroPdo($tarea);
            if (!$tarea) {
                // exit('<p style="color:red">No existen tareas con este ID: ' . $this->id . '</p>');
                echo "\nPDO::errorInfo():\n";
                print_r($stmt->errorInfo());
            }      
        }else{
            //Mostrar error por no tener datos
            echo "\nNo hay datos para actualizar:\n";
        }

    }
                 
}

?>