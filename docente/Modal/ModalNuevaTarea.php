<link rel="stylesheet" href="../docente/stylecss/stylemaass.css">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">



<!--ventana para Update--->
<div class="modal fade" id="nuevatarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div style="max-width: 450px;" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0B2545 !important;">
                <h6 class="modal-title" style="color: #fff; text-align: center;">
                    Registrar Curso
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <form method="POST" enctype="multipart/form-data" action="../docente/registrartarea.php?usuario=<?php
                                                                                                            $usuario = $_SESSION['usuario'];
                                                                                                            echo "$usuario"; ?>">





                <div class="modal-body" id="cont_modal">



                    <div class="form-group-modal">


                        <input type="hidden" name="usuario_docente" value="<?php
                                                                            $usuario = $_SESSION['usuario'];
                                                                            echo "$usuario"; ?>">


                        <label class="label-txt"><b>Registrar Datos de la Tarea</b></label><br>

                        <label>Titulo: </label><br>

                        <input type="text" class="input-text" required name="titulo" id="titulo"><br>
                        <label>Fecha de Entrega: </label><br>
                        <input type="date" class="input-text" required name="fecha_entrega" id="fecha_entrega"><br>
                        <label>Hora de Entrega: </label><br>
                        <input class="input-text" type="time" required name="hora_entrega"><br>



                        <label>Descripcion: </label><br>

                        <textarea type="text" class="input-text" required name="descripcion" placeholder="Escribe la descripcion aqui..." id="descripcion"></textarea><br>




                        <label>Selecciona Tema</label>

                        <select id="temas" name="temas">



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



                            $sql = "SELECT DISTINCT c.tema FROM curso c";
                            $result = $conn->query($sql);



                            if ($result->num_rows > 0) {
                                echo "<option value=''>SELECCIONAR...</option>";
                                while ($row = $result->fetch_assoc()) {
                                    $tema_dd = $row["tema"];
                                    echo "<option value='{$tema_dd}'>{$row["tema"]}</option>";
                                }
                            } else {
                                echo "<option value=''>No hay alumnos</option>";
                            }

                            $conn->close();
                            ?>






                        </select>



                        <?php
                        include('../conexion.php');

                        $usuario = $_SESSION['usuario'];

                        $sqlClientett   = ("SELECT usuario,apellido_paterno,apellido_materno,nombres FROM docente WHERE usuario = '$usuario'");
                        $queryClientett = mysqli_query($conexion, $sqlClientett);



                        ?>



                        <?php while ($data = mysqli_fetch_array($queryClientett)) { ?>


                            <input type="hidden" class="input-text" required name="docente" id="docente" value="<?php echo $data['apellido_paterno'] . " " . $data['apellido_materno'] . " " . $data['nombres'] ?>"><br>


                        <?php } ?>



                        <label>Selecciona Materia</label>

                        <select id="materias" name="materias">



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



                            $sql = "SELECT DISTINCT c.nombre FROM curso c";
                            $result = $conn->query($sql);



                            if ($result->num_rows > 0) {
                                echo "<option value=''>SELECCIONAR...</option>";
                                while ($row = $result->fetch_assoc()) {
                                    $alumno_dd = $row["nombre"];
                                    echo "<option value='{$alumno_dd}'>{$row["nombre"]}</option>";
                                }
                            } else {
                                echo "<option value=''>No hay alumnos</option>";
                            }

                            $conn->close();
                            ?>






                        </select><br>


                        <label>Nivel</label>

                        <select id="niveles" required name="niveles" onchange="cambiarGrados()">



                            <?php
                            // Verificar si este es el elemento seleccionado
                            $selectedPrimaria = ($data['nivel'] == 'Primaria') ? 'selected' : '';
                            $selectedSecundaria = ($data['nivel'] == 'Secundaria') ? 'selected' : '';
                            ?>
                            <option value="">SELECCIONAR...</option>
                            <option value="Primaria" <?php echo $selectedPrimaria ?>>Primaria</option>
                            <option value="Secundaria" <?php echo $selectedSecundaria ?>>Secundaria</option>


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



                            $sql = "SELECT DISTINCT a.alumno FROM alumno a";
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










                        <label>Subir Documento de la Tarea</label>
                        <label>Tamaño recomendable 50M en formato: pdf</label>
                        <input type="file" required name="subir_do_tarea" id="subir_do_tarea"><br>










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