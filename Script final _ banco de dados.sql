create database datablaster;
use datablaster;


create table arquivo (

	nome_img int not null auto_increment  primary key ,
	arquivos varchar(90),
    datacriação datetime
    

);
create table cadastro_empresa(
cnpj int not null  primary key,
nome_e varchar(90),
endereco varchar(90),
data_fundação datetime,
email varchar(90),
telefona varchar(90),

nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img)


);
create table cadastro_do_usuario(
login int not null  primary key,
nome_c varchar(90),
senha varchar(90),
data_nascimento datetime,
email varchar(90),
setor varchar(90),
cargo varchar(90),

/*
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),
*/
cnpj int not null, 
foreign key (cnpj) references cadastro_empresa(cnpj)

);
create table avaria(
placa varchar(90),
carga_v int not null  primary key,
data_avaria datetime,
produto varchar(90),
motivo varchar(90),

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),
login int not null ,
foreign key (login) references cadastro_do_usuario(login)


);
create table c_control_rec(
placa_r varchar(90),
carga_r int not null primary key,
data_recebimento datetime,
produto_recebido varchar(90),
fabrica varchar(90),

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),
login int not null ,
foreign key (login) references cadastro_do_usuario(login)


);
create table c_control_exp(
placa varchar(90),
 OE int not null  primary key,
data_expedição datetime,
produtos_exp varchar(90),
cliente varchar(90),

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),
login int not null ,
foreign key (login) references cadastro_do_usuario(login)


);
create table RAC(
N_RAC int not null  primary key,
placa varchar(90),
carga_rac varchar(90), 
data_chegada datetime,
produto varchar(90),
motivo varchar(90),

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),
login int not null ,
foreign key (login) references cadastro_do_usuario(login)

);
create table sku_avaria(

N_registro_avaria int not null auto_increment primary key,

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),
login int not null ,
foreign key (login) references cadastro_do_usuario(login),

carga_v int not null,
foreign key (carga_v) references avaria(carga_v)

);
create table sku_rec(

N_registro_rec int not null auto_increment primary key,

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),

login int not null ,
foreign key (login) references cadastro_do_usuario(login),

carga_r int not null,
foreign key (carga_r) references c_control_rec(carga_r)

);
create table sku_exp(

N_registro_ex int not null auto_increment primary key,

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),

login int not null ,
foreign key (login) references cadastro_do_usuario(login),

OE int not null,
foreign key (OE) references c_control_exp(OE)

);
create table sku_RAC(


N_registro_RAC int not null primary key,

-- Chaves Secundarias
nome_img int not null,
FOREIGN KEY (nome_img) references arquivo (nome_img),

login int not null ,
foreign key (login) references cadastro_do_usuario(login),


N_RAC int not null,	
foreign key (N_RAC) references RAC(N_RAC)

);



select * from arquivo;
select * from cadastro_empresa; 
select * from cadastro_do_usuario;
select * from avaria;
select * from  c_control_rec;
select * from c_control_exp;
select * FROM RAC;
select * from sku_avaria;
select * from sku_rec;  
select * from sku_exp;
select * from sku_rac;


-- Script das telas de inserções
insert into arquivo values(1,"algo.img","2020/11/20 16:50");
insert into cadastro_empresa values(2222122231456,"sendas","avenida dos autonomistas",'1964/02/02 12:10',"alguem.oliveira@gmail.com","3919-4614",1);
insert into cadastro_empresa values(2222122231457,"cbd","avenida dos autonomistas",'1967/02/02 15:30',"cbd.oliveira@gmail.com","3919-4614",1);
insert into cadastro_do_usuario values(191005821,"mateus","123456",'1999/02/16 18:45',"mateus_oliveira@gmail.com","devolução","Conferente",2222122231457);
insert into avaria values("CHU-0661",1602166120,'2020/02/20 19:50',"6300","Caixa rasgada",1,191005821);
insert into  c_control_rec values("HUJ-4512","62212312220,", "2020/02/15 12:50","9741","MASSA LEVE",1,191005821);
insert into c_control_exp values("HJY-5152","2001385","2020/02/16 13:10","620103","SENDAS",1,191005821);
insert into RAC values(111323230021,"HJI-3248","62223015","2021/04/01 15:51","4512","fALTA DE VACUO",1,191005821);

-- Telas de Consulta
insert into sku_avaria values ("12",1,191005821,"1602166120");
insert into sku_rec values ("1222000622",1,191005821,"62212312220");
insert into sku_exp values(1222301,1,191005821,"2001385");
insert into  sku_rac values(1566620,1,191005821,111323230021);








