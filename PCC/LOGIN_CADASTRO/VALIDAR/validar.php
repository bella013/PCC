<pre>
<?php
session_start();
$usuario = new usuario();
$usuario->setNome($_POST['nome']);
$usuario->setSobrenome($_POST['sobrenome']);
$usuario->setNome_social($_POST['nome_social']);
$usuario->setUsuario($_POST['usuario']);
$usuario->setEmail($_POST['email']);
$usuario->setSenha($_POST['senha']);
$usuario->setSenha2($_POST['senha2']);
$usuario->setNascimento($_POST['nascimento']);
$usuario->setGenero($_POST['genero']);
$usuario->setCpf($_POST['cpf']);

echo $usuario->getValidar();
echo var_dump($this->usuario);
class usuario
{
    private $nome;
    private $sobrenome;
    private $nome_social;
    private $usuario;
    private $email;
    private $senha;
    private $senhaConfirmar;
    private $nascimento;
    private $genero;
    private $cpf;

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function setNome_social($nome_social)
    {
        $this->nome_social = $nome_social;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setSenha2($senhaConfirmar)
    {
        $this->senhaConfirmar = $senhaConfirmar;
    }

    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getNivel()
    {
        $nivel = '1';
        return $nivel;
    }

    public function getValidar()
    {
        include_once "../../CONEXAO/conexao.php";
        $this->$erro = false;

        //Passando o valor do input para a variável.
        $data = $this->nascimento;
        //Separando yyyy, mm, ddd.
        list($ano, $mes, $dia) = explode('-', $data);
        //Data atual.
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        //Descobrindo a unix timestamp da data de nascimento do fulano.
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
        //Cálculo para descobrir a idade.
        $idade = floor((((($hoje - $this->nascimento) / 60) / 60) / 24) / 365.25);

        //Verifica se a senha é fraca.
        if (!empty($this->nome) and !empty($this->sobrenome) and !empty($this->nome_social) and !empty($this->usuario) and !empty($this->email) and !empty($this->senha) and !empty($this->senhaConfirmar) and !empty($this->nascimento) and !empty($this->genero) and !empty($this->cpf)) {
            if (!preg_match('/[a-z]/', $this->senha) or !preg_match('/[A-Z]/', $this->senha) or !preg_match('/[0-9]/', $this->senha)) {
                $this->$error = true;
                $_SESSION['msg'] = "<p style='color: red; padding: 6px 20px;'>Senha fraca!</p>";
                header('Location: ../index.php');
            }
            //Verifica se as senhas são iguais.
            elseif ($this->senha !== $this->senhaConfirmar) {
                $erro = true;
                $_SESSION['msg'] = "<p style='color: red; padding: 6px 20px;'>As senhas não são iguais!</p>";
                header('Location: ../index.php');
            }
            //Verifica a idade do usuário.
            elseif ($idade < 16) {
                $erro = true;
                $_SESSION['msg'] = "<p style='color: red; padding: 6px 20px;'>Não possível concluir cadastro devido a sua idade!</p>";
                header('Location: ../index.php');
            } else {
                //Buscando usuário no Banco de Dados.
                $buscar_usuario = "SELECT ID FROM usuario WHERE Usuario='$this->usuario'";
                $resultado_busca = mysqli_query($conex, $buscar_usuario);

                //Verifica se o usuário já existe.
                if (($resultado_busca) and ($resultado_busca->num_rows != 0)) {
                    $erro = true;
                    $_SESSION['msg'] = "<p style='color: red; padding: 6px 20px;'>Usuário já existe!</p>";
                    header('Location: ../index.php');
                }
                //Buscando Email no Banco de Dados.
                $buscar_email = "SELECT ID FROM usuario WHERE Email='$this->email'";
                $resultado_buscaEmail = mysqli_query($conex, $buscar_email);

                if (($resultado_buscaEmail) and ($resultado_buscaEmail->num_rows != 0)) {
                    $erro = true;
                    $_SESSION['msg'] = "<p style='color: red; padding: 6px 20px;'>Email já cadastrado!</p>";
                    header('Location: ../index.php');
                }
            }

            if (!$erro) {
                //Criptografando a senha
                $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);

                //Inserindo usuário no Banco de dados
                $cadastrar_usuario = "INSERT INTO usuario(Nome, Sobrenome, Nome_social, Usuario, Email, Senha, Nascimento, Genero, Imagem_perfil, nivel, CPF) 
                VALUES ('$this->nome', '$this->sobrenome', '$this->nome_social', '$this->usuario', '$this->email', '$this->senha','$this->nascimento', '$this->genero', 'unnamed.png', '{$this->getNivel()}', '$this->cpf')";
                mysqli_query($conex, $cadastrar_usuario);

                if (mysqli_insert_id($conex)) {
                    $_SESSION['msg'] = "<p style='color: green; padding: 6px 20px;'>Cadastrado com sucesso!</p>";
                    header('Location: ../index.php');
                } else {
                    $_SESSION['msg'] = "Erro ao cadastrar o Usuário!";
                    header('Location: ../index.php');
                }
            }
        }
    }
}
?>
</pre>