<!DOCTYPE html>
<html>
    <head>
        <title>Consulta</title>
        <link href="../css/css.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div class="corpo">
        <form method="post">
            <div class="form">
                <label>RM:</label></br>
                <input type="number" max="99999" name="rm" required=""/></br>
                <input type="submit" value="Enviar" id="enviar" name="enviar"></br></br>
    <?php
        if (filter_input(INPUT_POST, 'enviar')) {
            extract(filter_input_array(INPUT_POST, FILTER_DEFAULT), EXTR_OVERWRITE);

            require_once  ("../classes/alunos.class.php");
            $consulta = new aluno();
            $consulta->consulta($rm);
        }
    ?>
            </div>
        </form>
        </div>
    </body>
</html>