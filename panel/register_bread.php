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

    $bread_id = '';
    $categoriaId = '';
    $type = '';
    $price = '';

    if (isset($_GET['bread_id'])) {

        $bread = oci_parse($conn, "SELECT * FROM BREAD WHERE BREAD_ID =".intval($_GET['bread_id']));
        oci_execute($bread);

        if (oci_fetch($bread)) {
            $bread_id = oci_result($bread, 'BREAD_ID'); 
            $categoriaId = oci_result($bread, 'CATEGORIE_ID'); 
            $type = oci_result($bread, 'TYPE'); 
            $price = oci_result($bread, 'PRICE'); 
        } else {
            ECHO "NINGUN VALOR";
        }
        // var_dump($bread_id,$categoriaId,$type,$price);
    } 

    $Categorias = oci_parse($conn, 'SELECT * FROM Categorie_view');
    oci_execute($Categorias);

    if (isset($_POST['Type']) && isset($_POST['Price']) && isset($_POST['Categoria_Id'])){

        var_dump($_POST['bread_id']);
        if (isset($_POST['bread_id']) && $_POST['bread_id'] != '' )
        {
            
            echo "Actualizando datos: ".$_POST['bread_id'];
            $sentencia= "UPDATE Bread SET categorie_id = ".$_POST['Categoria_Id'].", type = '".$_POST['Type']."', price = '".$_POST['Price']."' WHERE BREAD_ID=".intval($_POST['bread_id']);
            var_dump($sentencia);
            $stid = oci_parse($conn, $sentencia);
            oci_execute($stid);
            
            header("Location: index_bread.php");
        } else 
        {
            echo "Insertando datos ";
            $sentencia= "INSERT INTO Bread(categorie_id,type,price) VALUES (".$_POST['Categoria_Id'].",'".$_POST['Type']."','".$_POST['Price']."')";
            $stid = oci_parse($conn, $sentencia);
            oci_execute($stid);

            header("Location: index_bread.php");
           
        }

        
    }

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrar Pan | Lupita's Bakery</title>
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
            <h2>Registrar Pan</h2>

        </div>

        <div class="row">
            <form action="register_bread.php" method="POST" class="">


                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Categoria</label>
                    <select id="selectClientes" name="Categoria_Id">

                        <?php
                                while (oci_fetch($Categorias)) {
                                    
                                    $selected = '';

                                    if ($categoriaId != '')
                                    {
                                        $CATEGORIE_ID = oci_result($Categorias, 'CATEGORIE_ID');
                                        if ($categoriaId  == $CATEGORIE_ID)
                                        {
                                            $selected = 'selected';
                                        } 
                                    }

                                    echo "<option value=".oci_result($Categorias, 'CATEGORIE_ID')." $selected>".oci_result($Categorias, 'NAME')."</option>";
                                }
                                ?>
                    </select>


                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tipo</label>
                    <input type="text" value="<?php echo $bread_id ?>" class="form-control" id="dba" name="bread_id" aria-describedby="emailHelp" hidden>
                    <input type="text" value="<?php echo $type ?>" class="form-control" id="dba" name="Type" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Precio</label>
                    <input type="text" class="form-control" id="phone" name="Price" aria-describedby="emailHelp"
                    value="<?php 
                            echo $price != '' ? number_format(floatval(str_replace(',', '.', $price)), 2, ',', '.'): "0,00"
                        ?>" >

                </div>


                <button type="submit" class="btn btn-primary">Guardar</button>
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