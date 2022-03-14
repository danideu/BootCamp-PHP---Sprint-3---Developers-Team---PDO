<?php


class TaskController extends ApplicationController
{    
    public function __construct()
    {
        $this->tabla = "Todolist";
    }
	public function indexAction()
	{
		$this->view->message = "hello from test::index";

	}
	
	// public function checkAction()
	// {
	// 	echo "hello from test::check";
	// }

    // public function createTaskAction() {       

    //     if (isset($_POST['titulo']) || isset($_POST['descripcion'])) {
    //         // Recoger los valores de los campos
    //         $titulo = $_POST['titulo'];
    //         $descripcion = $_POST['descripcion'];

    //         // Validar la información contra bd o js
    //         $task = new stdClass();               
    //         //@TODO Cambiar por una clase Util     
    //         $taskJsonModel = new TaskJsonModel(); 
    //         $task->idTareas = $taskJsonModel->generateUuid();
    //         $task->titulo = $titulo;
    //         $task->descripcion = $descripcion;
    //         $task->estado = TaskJsonModel::ESTADO_PDTE;            
    //         $task->fec_creacion = $taskJsonModel->getDateFormat();
    //         $task->fec_modif = "";
    //         $task->fec_fintarea = "";

    //         // Guardamos la task
    //         $taskJsonModel->saveTask($task);     
    //     }
    // }
    
    // public function deleteTaskAction($idTask) {
    //     // Obtenemos el objeto task
    //     $task = $this->getTask($idTask);
        
    //     // Eliminamos la task seleccionada
    //     $taskJsonModel = new TaskJsonModel();
    //     $users = $taskJsonModel->listAllTask();
    //     $taskJsonModel->deleteTask($users, $task);
        
    //     // Refrescamos la lista
    //     $this->view->showtask = $taskJsonModel->listAllTask();
    // }

    public function getTask($id){
        echo  __FILE__ . " ".  __FUNCTION__;
        $this->id = $id;
        $taskPdoModel = new TaskPdoModel(); 
        $user = $taskPdoModel->getTask($this->id);
        return $user;
        var_dump($user);
    }

    public function updateTaskAction() {
        echo  __FILE__ . " ".  __FUNCTION__;
        echo "<br>UpdateTaskAction<br>";
        $id = $_GET['idTarea'];
        $user = $this->getTask($id);
        $taskPdoModel = new TaskPdoModel();
        $estados = $taskPdoModel->getAllStatus();
        // var_dump($user);
        $this->view->estados = $estados;
        $this->view->updatetask = $user;
        // $action == 'update' ? 'Actualizamos el registro' : $this->view->updatetask = $user ;
    }

    // public function changestatus(){
    //     echo  __FILE__ . " ".  __FUNCTION__;
    //     $id = $_GET['idTarea'];
    //     $user = $this->getTask($id);
    //     $taskPdoModel = new TaskPdoModel();     
    //     // $allUsers = $taskJsqonModel->listAllTask();  
    //     $taskPdoModel->changeStatusTask($user);
    // }

    public function showTaskAction() {      
       //Declaramos un objeto de tipo Model  

       $taskPdoModel = new TaskPdoModel();
    //    $tasks = $taskPdoModel->listAllTask();
    //    $this->view->showtask = $taskPdoModel->listAllTask();

       // Chequeamos si es cambio de estado
       if (isset($_GET['op'])){ 
           
            $option = $_GET['op'];
            $id = $_GET['idTarea'];

            switch ($option){
                case "changestatus":
                    echo 'ENTRA EN CHANGESTATUS<br>';
                    $user = $this->getTask($id);
                    $status = $_GET['status'];
                    $taskPdoModel = new TaskPdoModel();       
                    $taskPdoModel->changeStatusTask($user, $status);
                    break;
                case "update":
                    //Recogemos los valores que se han modificado desde la página de Update.
                    // $titulo = $_GET['titulo'];
                    // $descripcion = $_GET['descripcion'];
                    // $estado = $_GET['estado'];
                    // $fec_modif = date('Y-m-d');
                    // $fec_fintarea = $_GET['fec_fintarea'];

                    $userUpdate = [];

                    // Enviamos a la página del Listado
                    // echo '<h1>Actualizamos el registro</h1>';
                    // echo 'Título: ' . $titulo . '<br>';
                    // echo 'Descripción: ' . $descripcion . '<br>';
                    // echo 'Estado: ' . $estado . '<br>';
                    // echo 'Fecha Modif: ' . $fec_modif . '<br>';
                    // echo 'Fecha Fin Tarea: ' . $fec_fintarea . '<br>';

                    // Actualizamos registro según los datos obtenidos
                    $user = $this->getTask($id);
                    $taskPdoModel = new TaskPdoModel(); 
                    // $allUsers = $taskPdoModel->listAllTask();
                    $taskPdoModel->updateTask($user);                    
                    break;
    //             // case "delete":
    //             //     // echo "Delete task action";
    //             //     $user = $this->getTask($id);
    //             //     $taskJsonModel = new TaskJsonModel(); 
    //             //     $allUsers = $taskJsonModel->listAllTask();
    //             //     $taskJsonModel->deleteTask($allUsers, $user); 
    //             //     break;
    //             case "create":
    //                 $this->createTaskAction();
    //                 break;     
    //             case "delete":
    //                 $this->deleteTaskAction($id);
    //                 break;
                default:
                    echo "Este valor no corresponde a ninguna acción";
    //         }
    //     //    if ($option == 'changestatus'){
    //     //         $id = $_GET['idTarea'];
    //     //         $user = $this->getTask($id);
    //     //         $taskJsonModel = new TaskJsonModel();       
    //     //         $allUsers = $taskJsonModel->listAllTask();
    //     //         $taskJsonModel->changeStatusTask($allUsers, $user);
            }
        }
        // Pasamos los parametros del controller a la vista 
        $this->view->showtask = $taskPdoModel->listAllTask();
    }
    
}

?>

