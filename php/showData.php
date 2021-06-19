<?php

session_start();

    function showBoxes($restricao){

        require_once("conexao.php");
        define("Host","host=localhost port=5432 dbname=a06felipeestevanatto user=a06felipeestevanatto password=cti");
        
        $conecta = pg_connect(Host);
        
        //print_r($restricao);
        $sql = "SELECT idregistro,nomeprod,qntprod,tipoprod,valorprod FROM registros WHERE $_SESSION[idUser] = fk_user AND excluido = 'FALSE' ";
        
        $_SESSION['ids'] = 0;

        if( !empty($restricao['typeSearch']) ){
            $sql = $sql."AND tipoprod = '".$restricao['typeSearch']."'";
        }

        if( !empty(cleanString($restricao['textSearch'])) && $restricao['textSearch'] != ' '){
            $sql = $sql."AND nomeprod = '".$restricao['textSearch']."'";
        }

        //echo$sql;
            $return = pg_query($conecta, $sql);
            $_SESSION['ids'] = pg_fetch_all($return);
        
            //Irá instanciar a matriz com os registros e seus arrays internos de dados, printando a informação na tela
        if( !empty($_SESSION['ids']) )
            foreach($_SESSION['ids'] as $obj){
                echo"<div class='box'>";
                    echo"<div class='title'>";
                            echo"<span id='name".$obj['idregistro']."'>"; 
                            echo $obj['nomeprod']; if( $obj['nomeprod'] == '' || $obj['nomeprod'] == ' ' || $obj['nomeprod'] == null) echo"Registro #".$obj['idregistro']; 
                            echo "</span>";

                            echo"<i class='fas fa-trash-alt trash' onclick='openExclude(".$obj['idregistro'].")'></i>";
                    echo"</div>";

                    echo"<div class='data'>";
                        echo"<div class='quantity'>";
                            echo"Quantidade";
                        echo"</div>";
                        echo"<span id='qnt".$obj['idregistro']."'>".$obj['qntprod']."</span>";

                        echo"<div class='type'>";
                            echo"Valor";
                        echo"</div>";
                        echo"<span id='val".$obj['idregistro']."'>R$ ".$obj['valorprod']."</span>";

                        echo"<div class='type'>";
                            echo"Tipo";
                        echo"</div>";
                        echo"<span id='typ".$obj['idregistro']."'>".$obj['tipoprod']; if(empty($obj['tipoprod']))echo"Tipo Vazio"; echo"</span>";

                        echo"</div>";

                        echo"<div class='edit' onclick='openEdit(".$obj['idregistro'].")'>";
                            echo"Editar";
                    echo"</div>";
                echo"</div>";
            }
        else{
            echo"<div id='void'>Nenhum Registro encontrado!</div>";
        }
    }
?>