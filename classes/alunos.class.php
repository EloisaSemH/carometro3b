<?php
require_once  ("conexao.class.php");
class aluno {
    private $rm_aluno;
    private $nome;
    private $turma;
    private $foto = 'semfoto.png';

    public function verificaVazio($nomeCampo, $campo, $caminho) {
        if ($campo == '' || $campo == ' ' || $campo == null) {
            echo"<script language='javascript' type='text/javascript'>alert('Por favor, preencha o campo em branco');window.location.href='$caminho';</script>";
        } else {
            $campo = utf8_decode($campo);
            $this->$nomeCampo = $campo;
        }
    }

    public function verificaExistente($nomeCampo, $campo, $mensagem, $caminho) {
        $banco = new bancoDados();
        if ($campo == '' || $campo == ' ' || $campo == null) {
            echo"<script language='javascript' type='text/javascript'>alert('Por favor, preencha o campo em branco');window.location.href='$caminho';</script>";
        } else {
            $query_select = "SELECT $nomeCampo FROM alunos WHERE $nomeCampo = '$campo'";
            $select = mysqli_query($banco->con, $query_select);
            $array = mysqli_fetch_array($select); //e//
            $Earray = $array["$nomeCampo"];

            if ($Earray == $campo) {
                echo"<script language='javascript' type='text/javascript'>alert('$mensagem');window.location.href='$caminho';</script>";
                die();
            } else {
                $this->$nomeCampo = $campo;
            }
        }
    }

    public function cadastra() {
        $banco = new bancoDados();
        
        $queryCadastro = "call p_cadastrodealuno('$this->rm_aluno', '$this->nome', '$this->turma', '$this->foto')";

        $insert = mysqli_query($banco->con, $queryCadastro);
        if ($insert) {
            echo"<script language='javascript' type='text/javascript'>alert('Aluno cadastrado com sucesso!');window.location.href='../index.php'</script>";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Desculpe, não foi possível cadastrar esse aluno');window.location.href='cadastro.php'</script>";
            echo @mysqli_error($banco->con);
        }
    }

    public function consulta($rm){
        $banco = new bancoDados();
        
        $dados = $banco->sqlQuery("call p_consultaalunoRM($rm)", '../index.php');
        
        echo $dados['id_aluno'] . '<br/>';
        if (file_exists('../imagens/alunos/' . $dados['foto']) && $dados['foto'] != '') {
            echo '<img src="../imagens/alunos/'. $dados['foto'] . '" alt="Imagem do aluno"><br/>';
        } else {
            echo '<img src="../imagens/alunos/semfoto.jpg" class="rounded-circle mx-auto d-block"><br/>';
        }
        echo $dados['rm'] . '<br/>';
        echo $dados['nome'] . '<br/>';
        echo 'Turma ' . $dados['turma'];
    }

    public function edita($campo, $novoVlr, $oldRm){
        $banco = new bancoDados();

        $queryEdita = "UPDATE alunos SET $campo = '$novoVlr' WHERE rm = '$oldRm'";

        $resultado = mysqli_query($banco->con, $queryEdita);
        if ($resultado) {
            echo"<script language='javascript' type='text/javascript'>alert('Aluno alterado com sucesso!');window.location.href='../index.php'</script>";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Desculpe, não foi possível alterar esse aluno');window.location.href='edita.php'</script>";
            echo @mysqli_error($banco->con);
        }
        // }
    }
}