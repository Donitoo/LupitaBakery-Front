<?php 
   session_start();

   if (!isset($_SESSION['email'])){

      header('Location: ../login.php');
   } else{
       if ($_SESSION['email']!='Admin'){
          header("Location: panel/ingresar_pedido.php");
       }
   }

    include '..\app\conexion.php';


    if (isset($_GET['bread_id'])) {

        $bread = oci_parse($conn, "DELETE FROM  BREAD WHERE BREAD_ID =".intval($_GET['bread_id']));
        oci_execute($bread);
        header("Location: index_bread.php");
    } 

    

?>
