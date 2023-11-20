<?php
date_default_timezone_set('America/Lima');
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../login.php');
}

include '..\app\conexion.php';

$descuento = 0;

$clients = oci_parse($conn, "SELECT * FROM Client_view WHERE EMAIL NOT IN ('Admin') ");
oci_execute($clients);



$Breads = oci_parse($conn, 'SELECT * FROM Bread');
oci_execute($Breads);




if(!isset($_POST['Registro']) ){
 
}else {
    // echo "REGISTRADO";echo "<br>";
   // var_dump($_POST['client_id']) ;echo "<br>";
    //var_dump($_POST['Type']) ;echo "<br>";
    //var_dump($_POST['Quantity']) ;echo "<br>";

    $client_id = $_POST['client_id'];

    $b= array();
    foreach ($_POST['Type'] as $clave => $valor) {
        array_push($b,$valor);
    }

    $c= array();
    foreach ($_POST['Quantity'] as $clave => $valor) {
        array_push($c,intval($valor));
    }

     $stid = oci_parse($conn, "begin  My_Procedures.new_return(:p1,:p2,:p3); end;");
     oci_bind_by_name($stid, ':p1', $client_id);
     oci_bind_array_by_name($stid, ":p2", $b, count($b), 20, SQLT_CHR);
     oci_bind_array_by_name($stid, ":p3", $c, count($c), 20, SQLT_INT );
     oci_execute($stid);

    // header('Location: ../login.php');
}






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


    <link rel="stylesheet" href="../assets/css/panel/style.css">

</head>

<body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <a href="index.php"><img class="d-block mx-auto mb-4" src="../assets/img/logo.png" alt="" width="72" height="72"></a>
            <h2>Registro de Retorno</h2>
            
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4" id="carritoCompras">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Retorno</span>
                    <span class="badge badge-secondary badge-pill" id="contadorPanes">0</span>
                </h4>
                <ul class="list-group mb-3">
                    <!-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0" id="nombrePan"></h6>
                            <small class="text-muted">Unit cost: $<span id="precioUnitario">1.48</span></small>
                        </div>
                        <span class="text-muted">$<span id="Tb1">0</span></span>
                    </li> -->
                </ul>
                
                <span class="list-group-item d-flex justify-content-between">
                    <span>Total (Soles)</span>
                    <strong>S/.<span id="T">0</span></strong>
                </span>


            </div>
            <div class="col-md-8 order-md-1">

                <h4 class="mb-3">Cliente</h4>
                <select id="selectClientes">
                <option selected>--Cliente--</option>
                            <?php
                            while (oci_fetch($clients)) {
                                echo "<option value=".oci_result($clients, 'CLIENT_ID').">".oci_result($clients, 'DBA')."</option>";
                            }
                            ?>
                        </select>  
                <form class="form-inline" >
                <div class="form-group mb-2">
                       

                    </div>
                    <div class="form-group mb-2">
                        <select id="selectPanes">
                            <?php
                            while (oci_fetch($Breads)) {
                                echo "<option>".oci_result($Breads, 'TYPE')."</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">Cantidad</label>
                        <input type="text" class="form-control" id="quantity" placeholder="Quantity">
                    </div>
                    <button class="btn btn-info mb-2" id="addBread">Agregar Pan</button>
                </form>
                <!-- action="ingresar_pedido.php" method="POST" -->
                <form class="needs-validation" novalidate="" action="ingresar_retorno.php" method="POST" >
                <input type="hidden" name="client_id" id="IDClient">
                    <hr class="mb-4">

                    <div class="row">

                        <table class="table" id="panes">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pan</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>


                    <hr class="mb-4">
                    <button class="btn btn-info btn-lg btn-block" type="submit" name="Registro">Continue para
                        comprobar</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2023 Lupita Bakery</p>
            <!-- <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul> -->
        </footer>
    </div>


    <script src="../assets/js/jquery-3-3-1.js"></script>

    <script>
        // alert("Holi");
        var total = 0;
        var client_id = 0;
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

            var x;

            $(document).on('change', '#selectClientes', function(event) {
                var select_item = $("#selectClientes").val();
                // $('#IDClient').val($("#selectClientes option:selected").text());
                $('#IDClient').val(select_item);
                
            });

            $('#addBread').on('click', function() {
                event.preventDefault();

                var precioUnitario = 0.15;
                var rowCount = $('#panes tr').length;
                var selectPanes = $('select[id="selectPanes"] option:selected').text();
                var quantity = $("#quantity").val();
        
                var subTotal = parseInt(quantity) * 0.15;
                total = Total(subTotal);
                $("#contadorPanes").text(rowCount);
                $("#T").text(total.toFixed(2));
                // $("#nombrePan").text(selectPanes);
                $("#carritoCompras ul").append(
                    "<li class='list-group-item d-flex justify-content-between lh-condensed'> <div><h6 class='my-0' id='nombrePan'>" +
                    selectPanes + "</h6><small class='text-muted'>Unit cost: $<span id='precioUnitario'>" +
                    precioUnitario + "</span></small></div><span class='text-muted'>$<span id='Tb1'>" +
                    subTotal.toFixed(2) + "</span></span></li>");
                var htmlTags = '<tr>' +
                    '<th scope="row">' + rowCount + '</th>' +
                    '<td>' + selectPanes + '</td>' +
                    '<td>' + quantity + '</td>' +
                    '<td>' + subTotal.toFixed(2) + '</td>' +
                    '<input type="hidden" id="t-'+rowCount +'" name="Type[]" value="'+ selectPanes+'">'+
                    '<input type="hidden" id="q-'+rowCount +'" name="Quantity[]" value="'+ quantity+'">'+
                '</tr>';
                $('#panes tbody').append(htmlTags);

            });

            function Total(x) {
                return total + x;
            }



        })();
    </script>
<script src="jquery.js"></script>
<script src="main.js"></script>
</body>

</html>