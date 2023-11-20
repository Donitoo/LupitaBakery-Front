<?php 
   session_start();

   if (!isset($_SESSION['email'])){

      header('Location: ../login.php');
   } else{
       if ($_SESSION['email']!='Admin'){
          header("Location: panel/ingresar_pedido.php");
          // echo "ingresar_pedido";
       }
   }

    include '..\app\conexion.php';

    $categorie_id = '';
    $name = '';

    if (isset($_GET['categorie_id'])) {

        $categorie = oci_parse($conn, "SELECT * FROM CATEGORIE WHERE CATEGORIE_ID =".intval($_GET['categorie_id']));
        // var_dump("SELECT * FROM CATEGORIE WHERE CATEGORIE_ID =".intval($_GET['categorie_id']));
        oci_execute($categorie);

        if (oci_fetch($categorie)) {
            $categorie_id = oci_result($categorie, 'CATEGORIE_ID'); 
            $name = oci_result($categorie, 'NAME'); 
        } else {
            ECHO "NINGUN VALOR";
        }
  
    } 

    $Categorias = oci_parse($conn, 'SELECT * FROM Categorie');
    oci_execute($Categorias);

    if (isset($_POST['Name'])){

        var_dump($_POST['categorie_id']);

        if (isset($_POST['categorie_id']) && $_POST['categorie_id'] != '' )
        {
            echo "Actualizando datos: ".$_POST['categorie_id'];
            $sentencia= "UPDATE CATEGORIE SET NAME = '".$_POST['Name']."', update_date = sysdate WHERE categorie_id=".intval($_POST['categorie_id']);
            var_dump($sentencia);
            $stid = oci_parse($conn, $sentencia);
            oci_execute($stid);
            
            header("Location: index_categories.php");
        } else 
        {
            echo "Insertando datos ";
            $sentencia= "INSERT INTO CATEGORIE(NAME,REGISTER_DATE) VALUES ('".$_POST['Name']."',sysdate)";
            $stid = oci_parse($conn, $sentencia);
            oci_execute($stid);

            header("Location: index_categories.php");
           
        }

        
    }

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrar Categoria | Lupita's Bakery</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">


    <link rel="stylesheet" href="../assets/css/panel/style.css">

</head>

<body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../assets/img/logo.png" alt="" width="72" height="72">
            <h2>Registrar Categoria</h2>

        </div>

        <div class="row">
            <form action="register_categorie.php" method="POST" class="">


                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" value="<?php echo $categorie_id ?>" class="form-control" id="dba" name="categorie_id" aria-describedby="emailHelp" hidden>
                    <input type="text" value="<?php echo $name ?>" class="form-control" id="dba" name="Name" aria-describedby="emailHelp">

                </div>
              
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2023 Lupita's Bakery</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacidad</a></li>
                <li class="list-inline-item"><a href="#">Terminos</a></li>
                <li class="list-inline-item"><a href="#">Apoyo</a></li>
            </ul>
        </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script>
    // alert("Holi");
    </script>


</body>

</html>