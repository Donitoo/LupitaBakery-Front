<?php
session_start();
if (!isset($_SESSION['email'])) {
    // header('Location: login.php');
} else {
    if ($_SESSION['email'] != 'Admin') {
        // echo "Client";
        header("Location: panel/ingresar_pedido.php");
    } 
}

include 'app/conexion.php';
$ingresar = false;

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    echo $conn;
    $p = $_POST['email'];
    $q = $_POST['password'];

    //My_Procedures.iniciar_sesion  Retorna TRUE/FALSE
    $stid = oci_parse($conn, 'begin :r := My_Procedures.iniciar_sesion(:p,:q); end;');
    oci_bind_by_name($stid, ':p', $p);
    oci_bind_by_name($stid, ':q', $q);
    oci_bind_by_name($stid, ':r', $r, -1, OCI_B_INT);

    oci_execute($stid);         // Ejecuta
    oci_free_statement($stid);  // Libera recurso
    
    VAR_DUMP($p);
    VAR_DUMP($q);
    VAR_DUMP($r);



    if ($r) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['user_id'] = $r;
        /*
        $Client_view = oci_parse($conn, 'SELECT * FROM Client_view');
        oci_execute($Client_view);
        
        while (oci_fetch($Client_view)) {
            $_SESSION['user_id'] = oci_result($Client_view, 'CLIENT_ID');
        }
        */
    }

    oci_close($conn);

    if ($r) {
        if ($_SESSION['email'] == 'Admin') {
            header("Location: panel/index.php");
            // echo "Admin";
        } else {
            // echo "Logueado";
            header("Location: panel/ingresar_pedido.php");
        }
    } else {
?>
        <script>
            alert('Disculpe, no se encuentra registrado o datos incorrectos');
        </script>
<?php

    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesion | Lupita's Bakery</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">


    <link rel="stylesheet" href="assets/css/panel/style.css">
    <!-- <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .logo-img{
        text-aling : center;
    }
    </style> -->
</head>

<body>
    <div class="container">
        <section class="contact-box">
            <!-- no-gutters : No tenga espacios-->
            <div class="row no-gutters bg-light">
                <div class="col-xl-12 col-lg-12 register-bg ">
                    <div class="row justify-content-center align-self-center">

                        <img src="assets/img/logo.png" class="logo" alt="Semana de la Calidad 2020">

                    </div>



                </div>
                <div class="col-xl-12 col-lg-12">
                    <!-- Container -->
                    <div class="container align-self-center p-6">
                        <form action="login.php" method="POST">
                            <div class="form-row mb-1">
                                <div class="form-group col-md-6">
                                    <label for="Email" class="font-weight-400">Correo
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="email" id="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Password" class="font-weight-400">Contraseña
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password" id="Password">
                                </div>
                            </div>


                            <div class="form-group col-md-12" id="validarCampos" hidden>
                                <div class="alert alert-danger font-weight-500 text-center" role="alert">
                                    Debe completar todos los campos (*)
                                </div>
                            </div>

                            <!-- <input class="btn btn-bg col-md-2 width-100" id="btnRegister" type="submit">Login</input> -->
                            <button type="submit" class="btn btn-bg col-md-2 width-100">Iniciar sesion</button>
                        </form>

                        <br>
                        <small class="d-inline-block text-muted mt-4">Si no estas registrado, <a href="panel/register_client.php">registrate aqui</a></small>
                    </div>
                    <!-- /Container -->
                </div>
            </div>



        </section>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

<!-- Js : Jquery 3.2.1 -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/panel.js"></script>

</html>