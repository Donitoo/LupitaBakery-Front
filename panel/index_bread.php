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

     $stid = oci_parse($conn, 'SELECT * FROM Bread');
      oci_execute($stid);
        
        

  ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel de Control | Lupita's Bakery</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">


    <!-- <link rel="stylesheet" href="assets/css/panel/style.css"> -->

</head>

<body>

    <body class="bg-light">

        <div class="container">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><img src="../assets/img/logo.png" alt=""></a>
                </li>
            </ul>


            <ul class="nav justify-content-end">

      
            <span class="nav-link"><?php echo $_SESSION['email']." |" ?></span>
                <a class="nav-link" href="index.php">Panel</a>
                <a class="nav-link" href="register_bread.php">Agregar Pan</a>
                <a class="nav-link" href="cerrarSesion.php">Cerrar Sesion</a>
           

            </ul>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
           
                    
             
                    $row= 0;
                    while (oci_fetch($stid)) 
    {
        ?>
                    <tr>
                        <th scope="row"><?php echo $row++; ?></th>
                        <td><?php echo oci_result($stid, 'TYPE'); ?></td>
                        <td><?php echo "$".number_format(floatval(str_replace(',', '.', oci_result($stid, 'PRICE'))), 2, ',', '.'); ?></td>

                        <td>
                            <a href="<?php echo "register_bread.php?bread_id=".oci_result($stid, 'BREAD_ID') ?>"><span class="btn btn-primary btn-sm">Editar</span></a>
                            <a href="<?php echo "delete_bread.php?bread_id=".oci_result($stid, 'BREAD_ID') ?>"><span class="btn btn-danger btn-sm">Eliminar</span></a>
                        </td>
                    </tr>
                    <?php
    }
    ?>

                </tbody>
            </table>
        </div>


    </body>



   

    <!-- Js : Jquery 3.2.1 -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/panel.js"></script>

</html>