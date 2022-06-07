<pre>
<?php
session_start();

$value1 = '';
$value2 = '';

if ($_POST['Tipo'] == 1) {
    $tipo = "Doação";
    $value1 = $_POST['valor1-doacoes'];
    $value2 = $_POST['valor2-doacoes'];
} else {
    $tipo = 'Genérico';
    $value1 = $_POST['valor1-genericos'];
    $value2 = $_POST['valor2-genericos'];
}

$alertas = new alertas();
$alertas->setTitulo($_POST['Titulo']);
$alertas->setTipo($tipo);
$alertas->setValue1($value1);
$alertas->setValue2($value2);
$alertas->setDescricao($_POST['Descricao']);

echo $alertas->getValidar();
echo var_dump($alertas);

class alertas
{
    private $titulo;
    private $tipo;
    private $value1;
    private $value2;
    private $descricao;

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setValue1($value1)
    {
        $this->value1 = $value1;
    }

    public function setValue2($value2)
    {
        $this->value2 = $value2;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    
    public function getTempo()
    {
        $data = new DateTime();
        return $data->format("d/m/Y");
    }

    public function getEstatus(){
        $ativo = 'ATIVO';
        return $ativo;
    }

    public function getValidar()
    {
        include_once "../../CONEXAO/conexao.php";
        $id = $_COOKIE['ID'];
        if (!empty($this->value1) and !empty($this->value2)) {
            $cadastrar_alerta = " INSERT INTO alerta(Titulo, value1, value2, Descricao, Tipo, ID_usuario, Tempo, Estatus) 
            VALUES ('$this->titulo', '$this->value1', '$this->value2', '$this->descricao', '$this->tipo', '$id', '{$this->getTempo()}', '{$this->getEstatus()}')";
            mysqli_query($conex, $cadastrar_alerta);
            header('Location: ../index.php');
            echo "Alerta criado com sucesso!";
        } else {
            header('Location: ../index.php');
            echo "Preencha todos os campos!";
        }
    }
}
?>
</pre>