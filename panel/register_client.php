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

    $CLIENT_ID = '';
    $DBA = '';
    $DISCOUNT = '';
    $PHONE = '';
    $EMAIL = '';
    $PASSWORD = '';
    $FLAG = '';

/*
    SELECT
    CLIENT_ID,
    DBA,
    REGISTER_DATE,
    DISCOUNT,
    PHONE,
    EMAIL,
    PASSWORD,
    UPDATE_DATE,
    FLAG
FROM
    CLIENT
WHERE
    CLIENT_ID = 'VARCHAR2(6)';

*/
    if (isset($_GET['client_id'])) {

        $client = oci_parse($conn, "SELECT * FROM CLIENT WHERE CLIENT_ID =".intval($_GET['client_id']));
        oci_execute($client);

        if (oci_fetch($client)) {
            $CLIENT_ID = oci_result($client, 'CLIENT_ID'); 
            $DBA = oci_result($client, 'DBA'); 
            $DISCOUNT = oci_result($client, 'DISCOUNT'); 
            $PHONE = oci_result($client, 'PHONE'); 
            $EMAIL = oci_result($client, 'EMAIL'); 
            $PASSWORD = oci_result($client, 'PASSWORD'); 
            $FLAG = oci_result($client, 'FLAG'); 

        } else {
            ECHO "NINGUN VALOR";
        }
        // var_dump($client_id,$categoriaId,$type,$price);
    } 

    if (isset($_POST['DBA'])  && isset($_POST['Phone']) && isset($_POST['Email']) && isset($_POST['Password'])  ){

        var_dump($_POST['client_id']);
        if (isset($_POST['client_id']) && $_POST['client_id'] != '' )
        {
            
            echo "Actualizando datos: ".$_POST['client_id'];

            if (isset($_POST['Flag'])) {
                $FLAG = 1 ;
                echo "El checkbox ha sido marcado.";
            } else {
                $FLAG = 0 ;
                echo "El checkbox no ha sido marcado.";
            }

            $sentencia= "UPDATE Client SET UPDATE_DATE = sysdate, DBA = '".$_POST['DBA']."', phone = '".$_POST['Phone']."', email = '".$_POST['Email']."', password = '".$_POST['Password']."', flag = ".$FLAG." WHERE client_id=".intval($_POST['client_id']);
            echo "<br>";
            var_dump($sentencia);
            $stid = oci_parse($conn, $sentencia);
            oci_execute($stid);
            
            header("Location: index_clients.php");
        } else 
        {
            echo "Insertando datos <br><br>";
  
            if (isset($_POST['Flag'])) {
                $FLAG = 1 ;
                echo "El checkbox ha sido marcado.";
            } else {
                $FLAG = 0 ;
                echo "El checkbox no ha sido marcado.";
            }

            $sentencia= "INSERT INTO Client(DBA,phone,email,password, register_date, FLAG) VALUES ('".$_POST['DBA']."','".$_POST['Phone']."','".$_POST['Email']."','".$_POST['Password']."', sysdate, ".$FLAG.")";
            var_dump($sentencia);
            $stid = oci_parse($conn, $sentencia);
            oci_execute($stid);

            header("Location: index_clients.php");
           
        }

        
    }
      
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrar Cliente | Lupita's Bakery</title>
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
            <h2>Registrar Cliente</h2>

        </div>

        <div class="row">
            <form action="register_client.php" method="POST">
                <div class="mb-3">
                    <input type="text" value="<?php echo $CLIENT_ID ?>" class="form-control" id="client_id" name="client_id" aria-describedby="emailHelp" hidden>
                    <label for="exampleInputEmail1" class="form-label">DBA</label>
                    <input type="text" value="<?php echo $DBA ?>" class="form-control" id="dba" name="DBA" aria-describedby="emailHelp" required>

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Telefono</label>
                    <input type="text" value="<?php echo $PHONE ?>" class="form-control" id="phone" name="Phone" aria-describedby="emailHelp" required>

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Direccion de Correo</label>
                    <input type="email" value="<?php echo $EMAIL ?>" class="form-control" id="exampleInputEmail1" name="Email"
                        aria-describedby="emailHelp" required>

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" value="<?php echo $PASSWORD ?>" class="form-control" id="exampleInputPassword1" name="Password" required>
                </div>

                <div class="mb-3">
                    <input class="form-label" type="checkbox" value="2" id="invalidCheck" name="Flag" 
                    <?php 
                    if (isset($_GET['client_id']))
                    {
                        if ($FLAG) echo "checked";
                    } else 
                    {
                        echo "checked";
                    }                        
                    ?> 
                    >
                    <label class="form-check-label" for="invalidCheck">Activo</label>
                </div>
                <br>
                

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2023 Lupita's Bakery</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacidad</a></li>
                <li class="list-inline-item"><a href="#">Terminos</a></li>
                <li class="list-inline-item"><a href="#">Aapoyo</a></li>
            </ul>
        </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script>
    // alert("Holi");


    (function() {
        'use strict';

        window.addEventListener('load', function() {

            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);





    })();
    </script>


</body>

</html>