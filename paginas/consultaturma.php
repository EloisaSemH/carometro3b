<!DOCTYPE html>
<html>
    <head>
        <title>3ºB</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            $turma = $_POST['turma'];
            $qtdcol = $_POST['coluna'];
            require_once  ("../classes/turma.class.php");    
            $tabela = new tabelaFlex($turma, $qtdcol);
        ?>
        </div>
    </body>
</html>
