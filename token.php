<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Token</title>

    <?php
    if(!isset($_POST["token"]))

    $token = $_POST["token"];
    
    //Conecta no banco
    $cadastrar = new MYSQLI("localhost", "root", "", "projeto");

    //Não grava automático
    $cadastrar ->autocommit(false);

    //Retorna erro
    if(!MYSQLI_connect_errno()){

        //codigo sql para gravar
        //aspas simples para indicar que e uma string, aspas por conta do banco

        $cadastrar-> query("INSERT INTO token(id_token, token) values (null,'".$token."')");

        //confirmar a gravacao

        $cadastrar -> commit();
    }

    //Fecha banco
    $cadastrar ->close();

    ?>

<script>
window.alert("Dados Salvos!");
botao.addEventListener("click", 'anonymous function');
</script>

</head>
<body>

    <form method="post" action="#"> 
        token: <input type= "text" name="token" id="token"/>
    
        <input type ="submit" value ="Cadastrar" id="botao"/>

    </form>

    </body>
</html>



