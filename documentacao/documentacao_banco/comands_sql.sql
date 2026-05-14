CREATE TABLE IF NOT EXISTS teste(
id INT PRIMARY KEY AUTO_INCREMENT
);

SHOW TABLES;

DROP TABLE teste;

CREATE TABLE IF NOT EXISTS administradores(
id_administrador INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(200) UNIQUE NOT NULL,
cpf VARCHAR(14) UNIQUE NOT NULL,
email VARCHAR(500) UNIQUE NOT NULL,
senha VARCHAR(1000) NOT NULL,
rad VARCHAR(500) NOT NULL
);

CREATE TABLE IF NOT EXISTS clientes(
id_cliente INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(200) UNIQUE NOT NULL,
cnpj VARCHAR(18) UNIQUE NOT NULL,
email VARCHAR(500) UNIQUE NOT NULL,
senha VARCHAR(1000) NOT NULL 
);

CREATE TABLE IF NOT EXISTS profissionais(
id_profissional INT PRIMARY KEY AUTO_INCREMENT,
re VARCHAR(100) NOT NULL UNIQUE,
nome VARCHAR(200) NOT NULL,
cpf VARCHAR(14) NOT NULL,
cnpj VARCHAR(18),
salario NUMERIC(14,2)
);

CREATE TABLE IF NOT EXISTS produtos(
id_produto INT PRIMARY KEY AUTO_INCREMENT,
id_administrador INT,
CONSTRAINT fk_administrador
FOREIGN KEY (id_administrador)
REFERENCES administradores(id_administrador),
pn VARCHAR(255) NOT NULL UNIQUE,
ean_gtin VARCHAR(255) NOT NULL UNIQUE,
estoque INT NOT NULL,
categoria VARCHAR(500) NOT NULL,
ficha_tec VARCHAR(6000) NOT NULL,
custo NUMERIC(14,2)
);

CREATE TABLE IF NOT EXISTS compra (
id_cliente INT,
CONSTRAINT fk_cliente
FOREIGN KEY (id_cliente)
REFERENCES clientes(id_cliente),
id_produto INT,
CONSTRAINT fk_produto
FOREIGN KEY (id_produto)
REFERENCES produtos(id_produto)
);

CREATE TABLE IF NOT EXISTS alocacao(
id_cliente INT,
CONSTRAINT fk_cliente2
FOREIGN KEY (id_cliente)
REFERENCES clientes(id_cliente),
id_produto INT,
CONSTRAINT fk_produto2
FOREIGN KEY (id_produto)
REFERENCES produtos(id_produto)
);



ALTER TABLE administradores ADD COLUMN rad VARCHAR(500) NOT NULL; 

DESCRIBE alocacao;

DESCRIBE administradores;


