<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stilo.css"/>

    <title>Document</title>
</head>
<body>

    <div class="container">
        <h1 class="fs-3">898 - Relatório de Emissões via Cliente API</h1>
    
</br>    
        <form method="post" action="#">
            Data Emissão:
            <input id="data_ini" type="date" name="data_ini">
            <input id="data_fim" type="date" name="data_fim">
            <input type="submit" id="pesquisar" id="pesquisar" value="Pesquisar">
        </form>
</br>
        <form method="post">
            <input type="submit" name="importar" value="Importar API"/>
        </form>
</br>
    <div>
        <table class="table table-bordered table-hover table-responsive">
            <thead class="table-light">

                <tr>
                <th>Minuta</th>
                <th>Coleta</th>
                <th>Ct-e</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Frete</th>
                <th>Peso</th>
                <th>Volume</th>
                <th>Data Emissão</th>
                <th>Status</th>
                <th>Tipo</th>

            </thead>


    <?php

        $conexao = new MYSQLI("localhost", "root", "", "projeto");

        $data_ini = isset($_POST["data_ini"])?$_POST["data_ini"]:"";
        $data_fim = isset($_POST["data_fim"])?$_POST["data_fim"]:"";


        //Consulta tabela de minuta


        if(!MYSQLI_connect_errno()){

            if(empty($data_ini) && empty($data_fim)){

                $sql = "SELECT * FROM minuta";
            
            }else{
                
                $sql = "SELECT *, cast(data_emissao as date) from minuta 
                where cast(data_emissao as date) BETWEEN '".$data_ini."' AND '".$data_fim."';";
            }               


        $resultado = mysqli_query($conexao, $sql);

        $array = mysqli_fetch_assoc($resultado);

        $total = mysqli_num_rows($resultado);

        if($total > 0){

            do{
                $id_minuta = $array['id_minuta'];
                $coleta = $array['coleta'];
                $cte = $array['cte'];
                $origem = $array['origem'];
                $destino = $array['destino'];
                $frete = $array['frete'];
                $peso = $array['peso'];
                $volume = $array['volume'];
                $data_emissao = $array['data_emissao'];
                $status = $array['status'];
                $tipo = $array['tipo'];
                
                $date = explode(" ", $data_emissao);
                $data1 = $date[0];
                $hora = $date[1]; 
                $dateBR = implode( '/', array_reverse( explode( '-', $data1 ) ) );


                echo "<tr>
                <td>$id_minuta</td>
                <td>$coleta</coleta>
                <td>$cte</td>
                <td>$origem</td>
                <td>$destino</td>
                <td>$frete</td>
                <td>$peso</td>
                <td>$volume</td>
                <td>$dateBR $hora</td>
                <td>$status</td>
                <td>$tipo</td>
                </tr>";
           
            }while($array = mysqli_fetch_assoc($resultado));
        
            }

    //Consulta tabela de coleta

        
            if(empty($data_ini) && empty($data_fim)){

                $sql = "SELECT * FROM coleta";
            
            }else{
                
                $sql = "SELECT *, cast(data_emissao as date) from coleta 
                where cast(data_emissao as date) BETWEEN '".$data_ini."' AND '".$data_fim."';";
            }               
        
        $resultado = mysqli_query($conexao, $sql);

        $array = mysqli_fetch_assoc($resultado);

        $total = mysqli_num_rows($resultado);

        if($total > 0){

            do{
                $id_coleta = $array['id_coleta'];
                $origem = $array['origem'];
                $destino = $array['destino'];
                $frete = $array['frete'];
                $peso = $array['peso'];
                $volume = $array['volume'];
                $data_emissao = $array['data_emissao'];
                $status = $array['status'];
                $tipo = $array['tipo'];
                
                
                $date = explode(" ", $data_emissao);
                $data1 = $date[0];
                $hora = $date[1]; 
                $dateBR = implode( '/', array_reverse( explode( '-', $data1 ) ) );

                echo "<tr>
                <td></td>
                <td>$id_coleta</td>
                <td></td>
                <td>$origem</td>
                <td>$destino</td>
                <td>$frete</td>
                <td>$peso</td>
                <td>$volume</td>
                <td>$dateBR $hora</td>
                <td>$status</td>
                <td>$tipo</td>
                </tr>";
           
            }while($array = mysqli_fetch_assoc($resultado));

        }
    }  
    ?>
    </table>
    

<?php

    //Consulta token 

        $query = "SELECT token FROM token ORDER BY id_token DESC LIMIT 1";

        $result = mysqli_query($conexao, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $t = $row["token"];
        }

    if(isset($_POST['importar'])) {

        
        $filename = "https://app-brudam.herokuapp.com/kabum/api/show/remessas/" . $t;
        $data = file_get_contents($filename);

        if($data > 0){
        $array = json_decode ($data, true);

    //Importa array minuta
    
    if(count ($array)){
        $i = 0;
    foreach ($array["data"] as $data){
        $i++;

        if(count($data)){
            $i = 0;
            foreach ($data["coletas"] as $coleta){
                $i++;
                
        $sql = "INSERT IGNORE INTO coleta (id_coleta, origem, destino, volume ,peso, tipo, status, frete, data_emissao) VALUES ('".$coleta["id_coleta"]."', 
        '".$coleta["origem"]."','".$coleta["destino"]."','".$coleta["volume"]."','".$coleta["peso"]."','".$coleta["tipo"]."',
        '".$coleta["status"]."','".$coleta["frete"]."','".$coleta["data_emissao"]."')";

        mysqli_query($conexao, $sql);


        //Importa array coleta

        if(count($data)){
            $i = 0;
            foreach ($data["minutas"] as $minuta){
            $i++;
                
    
        $sql = "INSERT IGNORE INTO minuta (id_minuta, coleta, origem, destino, volume, cte, peso, tipo, status, frete, data_emissao) VALUES ('".$minuta["id_minuta"]."', 
        '".$minuta["id_coleta"]."','".$minuta["origem"]."','".$minuta["destino"]."','".$minuta["volume"]."','".$minuta["cte"]."','".$minuta["peso"]."','".$minuta["tipo"]."',
        '".$minuta["status"]."','".$minuta["frete"]."','".$minuta["data_emissao"]."')";

        mysqli_query($conexao, $sql);


        }}
      }
    }
  }
 }
 
}else {
    echo "ERRO: Token inválido!";
}

}

    ?>  
</div>
    <a href="index.php">Voltar</a>
</body>
</html>