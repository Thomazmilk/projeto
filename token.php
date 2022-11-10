<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Token</title>


</head>
<body>
    

    <form method="post" action="#"> 
        Token: <input type= "text" name="token" id="token"/>
    
        <input type ="submit" value ="Cadastrar" name="botao"  onclick="funcao1()"/>

    </form>

    <?php

    $token="";

    $token = isset($_POST["token"]) ? $_POST ["token"] : null;
    
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
function funcao1()
{
alert("Dados salvos!");
}
</script>
     
</body>
</html>