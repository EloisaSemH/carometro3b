<!DOCTYPE html>
<html>
    <head>
        <title>Editar</title>
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
            <form name="cadastro"  method="post" enctype="multipart/form-data">
                <div class="form"
                    <label>RM:</label></br>
                    <input type="number" max="99999" name="rm" required="" value="<?php echo $dados['rm']; ?>" readonly/>
                </div>

                <div class="form">  
                    <label>Nome:</label></br>
                    <input type="text" maxlength='64' name="nome" required="" value="<?php echo utf8_encode($dados['nome']); ?>"/>
                </div>

                <div class="form">
                    <label>Turma:</label></br>
                    <input type="number" max="3" min="1" name="turma" required="" value="<?php echo $dados['turma']; ?>"/>
                </div><br/>

                <div class="form">
                    <?php
                        if (file_exists('../imagens/alunos/' . $dados['foto']) && $dados['foto'] != '') {
                            echo '<img src="../imagens/alunos/'. $dados['foto'] . '" alt="Imagem do aluno"><br/>';
                        } else {
                            echo '<img src="../imagens/alunos/semfoto.jpg" class="rounded-circle mx-auto d-block"><br/>';
                        }
                    ?>
                    <label>Envie outra foto:</label></br>
                    <input type="file" name="foto">
                </div>

                <div class="form">
                   <input type="submit" value="Salvar alterações" id="salvar" name="salvar">
                </div>
            </form>
        </div>
        <?php
            if (filter_input(INPUT_POST, 'salvar')) {
                extract(filter_input_array(INPUT_POST, FILTER_DEFAULT), EXTR_OVERWRITE);
                $nome = utf8_decode($nome);
                require_once  ("../classes/alunos.class.php");
                $consulta = new aluno();
                
                $consulta->edita('nome', $nome, $dados['rm']);

                $consulta->edita('turma', $turma, $dados['rm']);
                }      

                @$imagem = $_FILES['foto'];
                $nomeimagem = $imagem['name'];
                $nomeimagem = utf8_decode($nomeimagem);

                if($dados['foto'] != "" && $nomeimagem != ""){
                    unlink('../imagens/alunos/' . $dados['foto']);
                    $imagembanco = $rm . '_' . $nomeimagem;                 
                    move_uploaded_file($imagem['tmp_name'], '../imagens/alunos/' . $imagembanco);
                } elseif ($dados['foto'] != "" && $nomeimagem == "") {
                    $imagembanco = $dados['foto'];
                } elseif ($dados['foto'] == "" && $nomeimagem != ""){
                    $imagembanco = $rm . '_' . $nomeimagem;                    
                    move_uploaded_file($imagem['tmp_name'], '../imagens/alunos/' . $imagembanco);
                }


            if (filter_input(INPUT_POST, 'salvar')) {
                $consulta->edita('foto', $imagembanco, $dados['rm']);
            }
        ?>
    </body>
</html>
