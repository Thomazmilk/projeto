<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stilo.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Token</title>


</head>
<body>
    
<div id="container">
    <div class= "janela">
        <label>
            <a href="index.php">Menu</a>
            <a href="relatorio.php">Relatório</a>
        </label>
    </div>

</br>
</br>

    <div class="mb-3">
        <form method="post" action="#"> 
            <label>Cadastre seu Token</label> <input class="form-control" type= "text" name="token" id="token"/>
</br>                
            <input type ="submit" value ="Cadastrar" name="botao"  onclick="funcao1()"/>
        </form>
    </div>       
    
    
</div>

    <?php
   
   if(isset($_POST["token"]) && !empty($_POST["token"])){
   
    $token="";

    $token = isset($_POST["token"]) ? $_POST ["token"] : false;
    
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

}

    ?>

<script>
    function funcao1(){
        alert("Dados salvos!");
    }
</script>

      
</body>
</html>



