<!DOCTYPE html>
<html>
    <head>
        <title>Excluir?</title>
        <link href="../css/css.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php
            $rm = $_POST['rm'];
            require_once  ("../classes/conexao.class.php");        
            $banco = new bancoDados();
            $dados = $banco->sqlQuery("call p_consultaalunoRM($rm)", '../index.php');
        ?>
        <div class="corpo">
            <form name="verifica"  method="post" enctype="multipart/form-data">

                <div class="form">
                    <label>RM:</label></br>
                    <input type="number" max="99999" name="rm" required="" value="<?php echo $dados['rm']; ?>" readonly/>
                </div>

                <div class="form">  
                    <label>Nome:</label></br>
                    <input type="text" maxlength='64' name="nome" required="" value="<?php echo utf8_encode($dados['nome']); ?>" readonly/>
                </div>

                <div class="form">
                    <label>Turma:</label></br>
                    <input type="number" max="3" min="1" name="turma" required="" value="<?php echo $dados['turma']; ?>" readonly/>
                </div>

                <div class="form">
                    <?php
                        if (file_exists('../imagens/alunos/' . $dados['foto']) && $dados['foto'] != '') {
                            echo '<img src="../imagens/alunos/'. $dados['foto'] . '" alt="Imagem do aluno"><br/>';
                        } else {
                            echo '<img src="../imagens/alunos/semfoto.jpg" class="rounded-circle mx-auto d-block"><br/>';
                        }
                    ?>
                </div>

                <div class="form">
                   <input type="submit" value="Excluir" id="excluir" name="excluir">
                </div>
            </form>
        </div>

        <?php
            if (filter_input(INPUT_POST, 'excluir')) {
                extract(filter_input_array(INPUT_POST, FILTER_DEFAULT), EXTR_OVERWRITE);
                require_once  ("../classes/conexao.class.php");        
                $banco = new bancoDados();
                $banco->sqlQuerySemNumRows("call p_deletaaluno($rm)", '../index.php', 'Aluno deletado com sucesso!');
            }
        ?>
    </body>
</html>