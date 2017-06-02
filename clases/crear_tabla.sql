CREATE TABLE PERSONAS(
    ID_PERSONA INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    NOMBRE VARCHAR(64) NULL,
    APELLIDO VARCHAR(64) NULL, 
    EDAD INT NULL, 
    NACIMIENTO DATE NULL 
)

CREATE TABLE cds(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    interpret VARCHAR(64) NULL,
    titel VARCHAR(64) NULL, 
    jahr INT NULL, 
    NACIMIENTO DATE NULL 
)

insert into cds(interpret,titel,jahr)
values('Paul Desmonds','Take five',1962)
     ,('Bart Howard','Fly Me to the Moon',1954)
     ,('Billy Streyhorn','The The A-Train',1951)     