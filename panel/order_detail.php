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

    if(isset($_GET['order_id'])){
        $sentencia = "SELECT B.TYPE,OI.BREAD_QUANTITY,OI.SUBTOTAL FROM Order_Item OI INNER JOIN Bread B ON OI.bread_id = B.bread_id WHERE order_id=".$_GET['order_id'];

        $orders = oci_parse($conn, $sentencia);
        oci_execute($orders);
      
    }else{
        header('Location: index.php');
    }

    // $consultaCliente = "SELECT * FROM client WHERE email= '".$_SESSION['user_id']."' " ;
   
    // $cliente = $clientes->fetch_assoc();
    // var_dump($clientes);
    

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
                <a class="nav-link" href="cerrarSesion.php">Cerrar Sesion</a>
           

            </ul>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                
                        <th scope="col">Pan</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                      
                    </tr>
                </thead>
                <tbody>
                <?php
                    $row= 0;
                    while (oci_fetch($orders)) 
                    {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row++; ?></th>
                    
                        <td><?php echo oci_result($orders, 'TYPE'); ?></td>
                        <td><?php echo oci_result($orders, 'BREAD_QUANTITY'); ?></td>
                        <td><?php echo number_format(floatval(str_replace(',', '.', oci_result($orders, 'SUBTOTAL'))), 2, ',', '.'); ?></td>
                        
                        
                    </tr>
                    <?php
                     }
                    ?>

                </tbody>
            </table>
        </div>


    </body>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script> -->


    <!-- Js : Jquery 3.2.1 -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/panel.js"></script>

</html>