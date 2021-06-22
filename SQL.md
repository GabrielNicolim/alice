<h2>Criar tabelas</h2>

<pre>
CREATE TABLE usuarios (
id_user SERIAL PRIMARY KEY NOT NULL,
nome VARCHAR(40) NOT NULL,
email VARCHAR(128) NOT NULL,
senha CHAR(32) NOT NULL
);
</pre>

<pre>
CREATE TABLE registros (
idRegistro BIGSERIAL PRIMARY KEY NOT NULL,
nomeProd VARCHAR(100),
qntProd INT NOT NULL,
tipoProd VARCHAR(20),
valorProd DECIMAL(10,2),
excluido BOOLEAN NOT NULL,
data_exclusao DATE,
fk_user INT NOT NULL,
FOREIGN KEY (fk_user) REFERENCES usuarios (id_user)
);
</pre>

<h2>Dropar tabelas</h2>

<pre>
DROP TABLE registros; DROP TABLE usuarios;
</pre>