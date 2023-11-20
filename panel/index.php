<?php 
    session_start();

     if (!isset($_SESSION['email'])){

         header('Location: ../login.php');
     } else{
         if ($_SESSION['email']!='Admin'){
            header("Location: ingresar_pedido.php");
            // echo "ingresar_pedido";
         } 
     }

     include '..\app\conexion.php';

     $sentencia= "SELECT * FROM Orden_View " ;
     $stid = oci_parse($conn,$sentencia );
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
                <a class="nav-link" href="ingresar_retorno.php">Retorno</a>
                <a class="nav-link" href="index_clients.php">Clientes</a>
                <a class="nav-link" href="index_bread.php">Panes</a>
                <a class="nav-link" href="index_Categories.php">Categorias</a>
                <a class="nav-link" href="cerrarSesion.php">Cerrar Sesion</a>
           

            </ul>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">FECHA DE ENTREGA</th>
                        <th scope="col">NUMERO DE ORDEN</th>
                        <th scope="col">DBA</th>
                        <th scope="col">CORREO</th>
                        <th scope="col">TELEFONO</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">PRECIO TOTAL</th>
                        <th scope="col">#</th>
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
                        <td><?php echo oci_result($stid, 'DELIVERY_DATE');?></td>
                        <td><?php echo oci_result($stid, 'ORDER_ID'); ?></td>
                        <td><?php echo oci_result($stid, 'DBA'); ?></td>
                        <td><?php echo oci_result($stid, 'EMAIL');?></td>
                        <td><?php echo oci_result($stid, 'PHONE');?></td>
                        <td><?php echo oci_result($stid, 'BREAD_QUANTITY');?></td>
                        <td><?php echo "$".number_format(floatval(str_replace(',', '.', oci_result($stid, 'TOTAL'))), 2, ',', '.');?></td>
                        <td>
                            <a href="<?php echo "order_detail.php?order_id=".oci_result($stid, 'ORDER_ID') ?>"><span class="btn btn-primary btn-sm">Ver Pedidos</span></a>
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