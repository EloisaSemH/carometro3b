<?php
require_once  ("../classes/conexao.class.php");      
class tabelaFlex{

    public function __construct($turma, $qtdcol){
    $banco = new bancoDados();    
    $sqlconsulta = mysqli_query($banco->con, "call p_consultaralunosturma('$turma')");    
    if (!$sqlconsulta) {
        echo '<form name="voltar" class="estiloForm" style="text-align: center;">';
        die('Houve um erro. Erro:' . @mysqli_error($conexao));
        echo '<br/><br/><input type="button" onclick="window.location=' . "'consultaturma.html'" . ';" value="Voltar">';
        echo '</form>';
    }    
    $cel = mysqli_num_rows($sqlconsulta);    
    $col = 1;
    $celconstruida = 0;
    $colConstruida = 0;
    echo '<link href="../css/css.css" rel="stylesheet">';
    echo '<table>';        
    for ($a = 0; $a < $qtdcol; $a++) {
        if ($col == 1) {
            echo '<tr>';
            $celconstruida++;
        }
        if ($celconstruida <= $cel) {
            while ($dados = mysqli_fetch_array($sqlconsulta)) {
                $id = $dados['id_aluno'];
                $foto = utf8_encode($dados['foto']);
                $nome = utf8_encode($dados['nome']);
                $rm = $dados['rm'];
                echo '<td>';
                echo $id.'<br/><br/>';
                if (file_exists('../imagens/alunos/' . $foto) && $foto != '') {
                    echo '<img src="../imagens/alunos/'. $foto . '" alt="Imagem do aluno"><br/>';
                } else {
                    echo '<img src="../imagens/alunos/semfoto.jpg"><br/>';
                }
                echo $nome. '</br>';
                echo $rm;
                echo '</td>';
                $colConstruida++;
                if($colConstruida == $qtdcol){
                    echo '</tr>';
                    $colConstruida = 0;
                }
            }
        }
    } 
    echo '</table>';
    }
}
