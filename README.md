# ALICE

Baseado no termo da área de informática CRUD (acrónimo do inglês Create, Read, Update e
Delete) surgiu a ideia de nomear a atividade de ALICE (acrônimo de Alteração, Login, Inclusão,
Consulta e Exclusão).

## Proposta 

- Modelar 2 tabelas que possuem um relacionamento UM-PARA-MUITOS. A tabela que recebe a chave do relacionamento deve ter pelo menos 4 campos, e deve ser escolhida para manipulação pelo PHP.

- Para o sistema registrar a venda de produtos, os dados dos produtos precisam estar armazenados previamente. Sendo assim, haverá um programa que Altera, Loga, Inclui, Consulta e Exclui os dados dos produtos, daí o acrônimo A.L.I.C.E.

## Tecnologias 

Para a construção desta aplicação utilizamos PHP e JavaScript. A parte visual do site foi construída utilizando HTML e CSS puro, em conjunto com o JavaScript para a manipulação da DOM. Trabalhamos em conjunto, a fim de nos desenvolvermos nas respectivas técnologias. 

## Visualização 

![image](https://user-images.githubusercontent.com/69210720/123141339-a9f63080-d42e-11eb-9eea-4e1524f3e29c.png)

O projeto apresenta uma tela inicial, além de páginas de login e cadastro com feedback visual de erro. Assim que o login é realizado a home é apresentada, está possui interação com o usuário nas principais operações da aplicação por meio de modais. A tela de usuário apresenta algumas informações a respeito do usuário e possibilita alterações no perfil. 

Caso deseje visualizar nosso projeto de forma rápida **[clique aqui](http://200.145.153.175/felipeestevanatto/Projetos/ALICE/).**

### Instalação 
#### Conexão 

O projeto pode ser aberto em sua máquina por meio da instalação em um servidor local, para tal é necessário a alteração do arquivo ```connect.php```. Para que a instalação funcione corretamente é necessário alterar as informações de conexão segundo seu servidor, adicionando seu usuário, senha e o tipo do banco de dados desejado. 

**Exemplo:**

```php
<?php

    $DB_dsn = 'mysql:host=localhost;dbname=alice_db';
    $DB_user = "root";
    $DB_password = "";

    try {
        $conn = new PDO($DB_dsn, $DB_user, $DB_password);
    }
    catch(PDOException $e) {
        echo 'Error: '.$e->getCode().' Message: '.$e->getMessage(); 
    }

?>
```

Nesse caso utilizamos o banco de dados ```MySQL``` em ```localhost```, com o usuário ```root``` e a senha vazia. Assim, a conexão foi feita com o banco de dados ```alice_db``` onde as informações puderam ser armazenadas. 

#### SQL

Para recebermos os dados devemos preparar nosso banco de dados, o código pronto pode ser encontrado no arquivo ```SQL.sql``` ou logo em seguida: 

**Criação do Banco de Dados**
```sql
CREATE DATABASE alice_db;
```

**Criação da Tabela de Usuários**
```sql
CREATE TABLE users (
id_user SERIAL PRIMARY KEY NOT NULL,
name_user VARCHAR(40) NOT NULL,
email_user VARCHAR(128) NOT NULL UNIQUE,
password_user VARCHAR(72) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Criação da Tabela de Registros**
```sql 
CREATE TABLE user_records (
id_record SERIAL PRIMARY KEY NOT NULL,
name_record VARCHAR(100),
quantity_record INT NOT NULL,
type_record VARCHAR(20),
price_record DECIMAL(10,2),
deleted BOOLEAN NOT NULL,
timeDeleted TIMESTAMP,
fk_user BIGINT NOT NULL,
FOREIGN KEY (fk_user) REFERENCES users (id_user)
);
```