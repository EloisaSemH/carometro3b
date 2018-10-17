<?php
class bancoDados {
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $senha = '';
    private $banco = 'carometro';
    public $con;

    public function __construct() {
        $this->con = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
        if (!$this->con) {
            die('Problemas com conexão'); 
        }
    }

    public function fechar() {
        mysqli_close($this->con);
        return;
    }

    public function sqlString($sql, $mensagem) {
        $resultado = mysqli_query($this->con, $sql);
        if (!$resultado) {
            echo '<input type="button" onclick="window.location=' . "'index.php'" . ';"value="Voltar"><br />';
            die('Query Inválida: ' . @mysqli_error($mysql->con));
        } else {
            echo "$mensagem realizada com sucesso!";
        }
    }

    public function sqlQuery($string, $caminho) {
        $resultado = mysqli_query($this->con, $string);
        if (!$resultado) {
            echo '<input type="button" onclick="window.location=' . "'$caminho'" . ';"value="Voltar"><br/><br/>';
            die('Query Inválida: ' . @mysqli_error($this->con));
        } else {
            $num = mysqli_num_rows($resultado);
            if ($num == 0) {
                echo 'Código não localizado!<br/>';
                echo '<input type="button" onclick="window.location=' . "'$caminho'" . ';"value="Voltar"><br/><br/>';
                exit;
            } else {
                $dados = mysqli_fetch_array($resultado);
            }
        }
        $this->fechar();
        return $dados;
    }

    public function sqlQuerySemNumRows($string, $caminho, $mensagem) {
        $resultado = mysqli_query($this->con, $string);
        if (!$resultado) {
            echo '<input type="button" onclick="window.location=' . "'$caminho'" . ';"value="Voltar"><br/><br/>';
            die('Query Inválida: ' . @mysqli_error($this->con));
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('$mensagem');window.location.href='$caminho'</script>";            
        }
        $this->fechar();
        return $dados;
    }

    public function sqlQueryVerificaNum($string, $caminho) {
        $resultado = mysqli_query($this->con, $string);
        if (!$resultado) {
            echo '<input type="button" onclick="window.location=' . "'$caminho'" . ';"value="Voltar"><br/><br/>';
            die('Query Inválida: ' . mysqli_error($this->con));
        } else {
            $num = mysqli_num_rows($resultado);
            if ($num == 0) {
                echo '<link href="../css/css.css" rel="stylesheet"><div class="corpo">';
                echo '<div class="form">Código não localizado!<br/>';
                echo '<input type="button" onclick="window.location=' . "'$caminho'" . ';"value="Voltar"></div></div>';
                exit;
            }
        $this->fechar();
        return $num;
        }
    }

}