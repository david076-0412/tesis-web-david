<link rel="stylesheet" href="../docente/stylecss/stylemaass.css">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">



<!--ventana para Update--->
<div class="modal fade" id="nuevocurso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0B2545 !important;">
                <h6 class="modal-title" style="color: #fff; text-align: center;">
                    Registrar Curso
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <form method="POST" enctype="multipart/form-data" action="../docente/registrarcurso.php?usuario=<?php
                                                                                                            $usuario = $_SESSION['usuario'];
                                                                                                            echo "$usuario"; ?>">



                <input type="hidden" name="usuario" value="<?php
                                                            $usuario = $_SESSION['usuario'];
                                                            echo "$usuario"; ?>">




                <div class="modal-body" id="cont_modal">



                    <div class="form-group-modal">


                        <input type="hidden" name="usuario_docente" value="<?php
                                                                            $usuario = $_SESSION['usuario'];
                                                                            echo "$usuario"; ?>">


                        <label class="label-txt"><b>Registrar Datos del Curso</b></label><br>

                        <label>Nombre del Curso: </label><br>

                        <input type="text" class="input-text" required name="nombre" id="nombre" onkeypress="soloLetras(event)"><br>


                        <label>Tema: </label><br>

                        <input type="text" class="input-text" required name="tema" id="tema"><br>

                        <?php
                        
                        $usuario = $_SESSION['usuario'];

                        $query_docente = "SELECT d.usuario, d.apellido_paterno, d.apellido_materno, d.nombres from docente d WHERE d.usuario='$usuario'";
                        $resultado_docente= $conexion->query($query_docente);

                        $fila_docente = $resultado_docente->fetch_assoc();

                        $apellido_paterno = $fila_docente['apellido_paterno'];

                        $apellido_materno = $fila_docente['apellido_materno'];

                        $nombres = $fila_docente['nombres'];

                        ?>


                        <input type="hidden" required name="apellido_paterno_docente" id="apellido_paterno_docente" value="<?php echo $apellido_paterno ?>">


                        <input type="hidden" required name="apellido_materno_docente" id="apellido_materno_docente" value="<?php echo $apellido_materno ?>">


                        <input type="hidden" required name="nombres_docente" id="nombres_docente" value="<?php echo $nombres ?>">



                        <label>Nivel</label>

                        <select id="niveles" required name="niveles" onchange="cambiarGrados()">
                            <option value="">SELECCIONAR...</option>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                        </select><br>


                        <label>Grado</label>

                        <select id="grados" required name="grados">

                            <option value="">SELECCIONAR...</option>

                        </select><br>






                        <label>Selecciona Alumnos</label>

                        <select id="alumnos" name="alumnos[]" multiple>



                            <?php
                            // Aquí deberías realizar la conexión a la base de datos y la consulta SQL
                            $servidor = "localhost";
                            $usuario = "root";
                            $password = "9$8753JK5";
                            $db = "bd_tesis";

                            $conn = new mysqli($servidor, $usuario, $password, $db);

                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }



                            $sql = "SELECT id, usuario_apoderado, alumno, usuario FROM alumno";
                            $result = $conn->query($sql);



                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $alumno_dd = $row["alumno"];
                                    echo "<option value='{$alumno_dd}'>{$row["alumno"]}</option>";
                                }
                            } else {
                                echo "<option value=''>No hay alumnos</option>";
                            }

                            $conn->close();
                            ?>






                        </select><br>













                        <label>Subir Material</label>
                        <label>Tamaño recomendable 50M en formato: pdf</label>
                        <input type="file" required name="subir_material" id="subir_material"><br>








                    </div>




                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!--<button type="submit" class="btn btn-primary">Guardar Cambios</button>-->
                </div>


            </form>

        </div>
    </div>
</div>
<!---fin ventana Update --->


<script>
    function soloLetras(e) {
        var key = e.keyCode || e.which;
        var tecla = String.fromCharCode(key).toLowerCase();
        var letras = "áéíóúabcdefghijklmnñopqrstuvwxyz";

        if (letras.indexOf(tecla) == -1) {
            e.preventDefault();
        }
    }
</script>




<script>
    function cambiarGrados() {
        // Obtener el valor seleccionado en la categoría
        var nivelesSeleccionada = $("#niveles").val();

        $("#grados").empty();


        if (nivelesSeleccionada == null) {
            $("#grados").append('<option value="">SELECCIONAR...</option>');
        } else {
            addGradeOptions(nivelesSeleccionada);
        }

    }


    cambiarGrados();


    function addGradeOptions(level) {

        $("#grados").empty();


        $("#grados").append('<option value="">SELECCIONAR...</option>');




        if (level === "Primaria") {


            $("#grados").append('<option value="Primero">Primero</option>');
            $("#grados").append('<option value="Segundo">Segundo</option>');
            $("#grados").append('<option value="Tercero">Tercero</option>');
            $("#grados").append('<option value="Cuarto">Cuarto</option>');
            $("#grados").append('<option value="Quinto">Quinto</option>');
            $("#grados").append('<option value="Sexto">Sexto</option>');



        } else if (level === "Secundaria") {

            $("#grados").append('<option value="Primero">Primero</option>');
            $("#grados").append('<option value="Segundo">Segundo</option>');
            $("#grados").append('<option value="Tercero">Tercero</option>');
            $("#grados").append('<option value="Cuarto">Cuarto</option>');
            $("#grados").append('<option value="Quinto">Quinto</option>');



        }


    }
</script>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('alumnos', {
        rounded: true, // default true
        shadow: true, // default false
        placeholder: 'Search', // default Search...
        tagColor: {
            textColor: '#327b2c',
            borderColor: '#92e681',
            bgColor: '#eaffe6',
        },
        onChange: function(values) {
            console.log(values)
        }
    })
</script>