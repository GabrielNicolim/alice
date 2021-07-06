<?php
    function showBoxes($restriction){

        require_once("connect.php");
        require_once("functions.php");

        $query = "SELECT * FROM user_records WHERE :id_user = fk_user AND deleted = 'FALSE' ";
        
        $_SESSION['ids'] = 0;

        if( !empty($restriction['typeSearch']) ){
            $query = $query."AND type_record = '".$restriction['typeSearch']."'";
        }

        if( !empty( cleanString($restriction['textSearch']) ) && $restriction['textSearch'] != ' '){
            $query = $query."AND name_record = '".$restriction['textSearch']."'";
        }

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':id_user', $_SESSION['idUser']);

        $stmt = $conn -> query($query);

        $_SESSION['ids'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        //Irá instanciar a matriz com os registros e seus arrays internos de dados, printando a informação na tela
        if( !empty($_SESSION['ids']) )

            foreach($_SESSION['ids'] as $obj){
                echo"<div class='box'>";
                    echo"<div class='title'>";
                            echo"<span id='name".$obj['id_record']."'>"; 
                            echo $obj['name_record']; if( $obj['name_record'] == '' || $obj['name_record'] == ' ' || $obj['name_record'] == null) echo"Registro #".$obj['id_record']; 
                            echo "</span>";

                            echo"<i class='fas fa-trash-alt trash' onclick='openExclude(".$obj['id_record'].")'></i>";
                    echo"</div>";

                    echo"<div class='data'>";
                        echo"<div class='quantity'>";
                            echo"Quantidade";
                        echo"</div>";
                        echo"<span id='qnt".$obj['id_record']."'>".$obj['quantity_record']."</span>";

                        echo"<div class='type'>";
                            echo"Valor";
                        echo"</div>";
                        echo"<span id='val".$obj['id_record']."'>R$ ".$obj['price_record']."</span>";

                        echo"<div class='type'>";
                            echo"Tipo";
                        echo"</div>";
                        echo"<span id='typ".$obj['id_record']."'>".$obj['type_record']; if(empty($obj['type_record']))echo"Tipo Vazio"; echo"</span>";

                        echo"</div>";

                        echo"<div class='edit' onclick='openEdit(".$obj['id_record'].")'>";
                            echo"Editar";
                    echo"</div>";
                echo"</div>";
            }
        else{
            echo"<div id='void'>Nenhum Registro encontrado!</div>";
        }
    }
?>