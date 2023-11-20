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


    if (isset($_GET['categorie_id'])) {

        $categories = oci_parse($conn, "DELETE FROM  CATEGORIE WHERE CATEGORIE_ID =".intval($_GET['categorie_id']));
        oci_execute($categories);
        header("Location: index_categories.php");
    } 

    

?>
