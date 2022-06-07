<pre>
<?php
SESSION_start();
include("../CONEXAO/conexao.php");
require_once("VALIDAR/functions.php");
$Buscar_Alerta = "SELECT * FROM alerta";
$Resultado_alerta = mysqli_query($conex, $Buscar_Alerta);
$row_alerta = mysqli_fetch_assoc($Resultado_alerta);

$id = $_COOKIE['ID'];
$Buscar_usuario = "SELECT * FROM usuario WHERE ID = '$id'";
$resultado_busca = mysqli_query($conex, $Buscar_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_busca);

if ($_COOKIE['continuar_logado']) {
?>
</pre>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Meus_alertas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='CSS/Estilo.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- LINKS GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="Div_logo">
            <img src="../LOGO_IMG/logo.png" class="logo_site">
        </div>
        <div class="Div_titlesNav">
            <a href="" class="title_nav">Home</a>
            <a href="" class="title_nav">Alertas</a>
            <a href="#" class="title_nav">Meus alertas</a>
            <a href="Sair.php" class="title_nav title_sair">SAIR</a>
        </div>
    </nav>
    <div class="alerta_container">
        <div class="alerta_texto">
            <h2 class="Title_MeusAlertas">Meus Alertas</h2>
            <button class="Btn_AdicionarAlertas" onclick="CriarAlerta()">Adicionar</button>
            <div class="content_meusAlertas">
                <?php foreach (getMyAlert($conex) as $value) { ?>
                    <div class="alertas" id="<?php echo $value['ID'] ?>">
                        <img src="../IMAGENS_PERFIL/<?php echo $row_usuario['Imagem_perfil'] ?>" class="img_alerta">
                        <div class="meusAlertas_texto">
                            <h2 class="title_alerta"><?php echo mb_strimwidth($value['Titulo'], 0, 35, '...') ?></h2>
                            <p class="description_alertas"><?php echo mb_strimwidth($value['Descricao'], 0, 465, '... <a href="" class="continuar_lendo" onclick="Abrir_alerta()">continuar</a>') ?></p>
                        </div>
                        <form method="get" action="VALIDAR/Excluir.php" class="DivExcluirAlerta">
                            <input type="hidden" name="id_alerta" value="<?php echo $value['ID'] ?>">
                            <button type="submit" class="Excluir_alerta" name="btn" id="btn">Excluir</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="Div_CriarAlertas">
        <div class="Primeira_coluna">
            <h2 class="Title_CriarAlerta">CRIANDO MEU ALERTA</h2>
            <form action="VALIDAR/Validar.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="Titulo" placeholder="Título" required>
                <select name="Tipo" id="Tipo" class="select-tipo" required>
                    <option value="" disabled selected>Tipo</option>
                    <option value="1" data-id="1">DOAÇÕES</option>
                    <option value="2" data-id="2">GENÉRICOS</option>
                </select>
                <div class="content-form-doacoes">
                    <input type="text" name="valor1-doacoes" class="input_1 money" placeholder="R$0,00" aria-label="Valor" aria-describedby="basic-addon1">
                    <input type="text" name="valor2-doacoes" class="input_1" placeholder="Pix">
                </div>
                <div class="content-form-genericos">
                    <select name="valor1-genericos" class="input_1" id="estado" onchange="buscaCidades(this.value)">
                        <option value="" disabled selected>Estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                    <select name="valor2-genericos" class="input_1" id="cidade">
                        <option value="" disabled selected>Cidade</option>
                    </select>
                </div>
                <textarea name="Descricao" rows="10" cols="60" placeholder="Descrição" required></textarea>
                <button type="submit" class="Button" id="btn" name="btn">CONFIRMAR</button>
            </form>
        </div>
        <div class="Segunda_coluna">
            <button class="Btn_fechar" onclick="Fechar()">X</button>
            <h2 class="Title_SegundaColuna">COMO FAÇO MEU ALERTA?</h2>
            <p class="description_alerta">
                Preencha todas as informações corretamente de acordo com
                as instruções dos campos, em tipo selecione Doação, caso
                seu alerta almeja arrecadar dinheiro, ou genérico, caso
                tenha outra finalidade. Necessita de uma imagem de capa,
                porém imagens extras são opcionais. Aproveite!!!
            </p>
        </div>
    </div>
    <script src="JS/JavaScript.js"></script>
</body>

</html>

<?php
} else {
    header('location: ../ALERTAS/Sair.php');
}
?>