<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro</title>
        <link href="../css/css.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div class="corpo">
            <form name="cadastro"  method="post" enctype="multipart/form-data">

                    <div class="form">  
                        <label>Nome:</label></br>
                        <input type="text" maxlength='64' name="nome" required=""/>
                    </div>


                    <div class="form">
                        <label>RM:</label></br>
                        <input type="number" max="99999" name="rm" required=""/>
                    </div>

                <div class="form">
                    <label>Turma:</label></br>
                    <select name="turma">
                        <option value="1">Turma 1</option>
                        <option value="2">Turma 2</option>
                        <option value="3">Turma 3</option>
                    </select>
                </div>

                <div class="form">
                    <input type="file" name="foto">
                </div>

                <div class="form">
                   <input type="submit" value="Registrar" id="registrar" name="registrar">
                </div>
            </form>
        </div>

        <?php
            if (filter_input(INPUT_POST, 'registrar')) {
                extract(filter_input_array(INPUT_POST, FILTER_DEFAULT), EXTR_OVERWRITE);
                
                include_once('../classes/alunos.class.php');
                $cadastro = new aluno();
    
                $cadastro->verificaVazio('nome', $nome, 'cadastro.php');
                $cadastro->verificaExistente('rm', $rm, 'RM já cadastrado!', 'cadastro.php');
                $cadastro->verificaVazio('turma', $turma, 'cadastro.php');
                
            }

            @$arrayImagem = $_FILES['foto'];
                if ($arrayImagem !== '') {
                    $foto = $arrayImagem['name'];
                    $foto = utf8_decode($foto);
                    @$nomedafoto = $rm . '_' . $foto;
                    move_uploaded_file($arrayImagem['tmp_name'], '../imagens/alunos/' . $nomedafoto);
            }

            if (filter_input(INPUT_POST, 'registrar')) {
                extract(filter_input_array(INPUT_POST, FILTER_DEFAULT), EXTR_OVERWRITE);
                $cadastro->verificaVazio('foto', $nomedafoto, 'cadastro.php');
                $cadastro->cadastra();
            }
        ?>

    </body>
</html>
