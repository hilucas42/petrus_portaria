DROP TABLE IF EXISTS visits;
DROP TABLE IF EXISTS visitors;

CREATE TABLE visitors (
  id serial NOT NULL,
  fullname varchar(100) NOT NULL,
  cpf varchar(14),
  rg varchar(14),
  email varchar(100),
  phone varchar(20),
  wpp varchar(20),
  CONSTRAINT visitors_pkey PRIMARY KEY (id)
);

insert into visitors (fullname,cpf,rg,email,phone,wpp)
  values('Garrett Winters','02994078023','216392858','g.winters@yahoo.com','996734776','996734776');
insert into visitors (fullname,cpf,rg,email,phone,wpp)
  values('Ashton Cox','96253105094','316382723','','996300191','996300191');
insert into visitors (fullname,cpf,rg,email,phone,wpp)
  values('Cedric Kelly','56039455080','369076862','kelly.cedric@gmail.com','34361706','988264619');
insert into visitors (fullname,cpf,rg,email,phone,wpp)
  values('Airi Satou','15165140091','','aspsyco@gmail.com','35210100','');
insert into visitors (fullname,cpf,rg,email,phone,wpp)
  values('Brielle Williamson','74259032020','','','54999953123','54999953123');
insert into visitors (fullname,cpf,rg,email,phone,wpp)
  values('Herrod Chandler','84968453035','433285679','','988131946','988131946');

CREATE TABLE visits
(
  id serial NOT NULL,
  arrival timestamp,
  departure timestamp,
  department varchar(20),
  tag char(10),
  visitor_id integer,
  CONSTRAINT visits_pkey PRIMARY KEY (id),
  CONSTRAINT visits_visitor_id_fkey FOREIGN KEY (visitor_id)
      REFERENCES visitors (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 13:45','2021/02/25 13:54','Secretaria','VIS2021001',id from visitors where fullname='Garrett Winters';
insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 13:58','2021/02/25 14:35','Secretaria','VIS2021002',id from visitors where fullname='Ashton Cox';
insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 14:21','2021/02/25 14:52','Financeiro','VIS2021003',id from visitors where fullname='Cedric Kelly';
insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 14:35','2021/02/25 14:50','Secretaria','VIS2021004',id from visitors where fullname='Airi Satou';
insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 14:45','2021/02/25 14:54','Diretoria','VIS2021001',id from visitors where fullname='Garrett Winters';
insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 14:49',null,'Diretoria','VIS2021005',id from visitors where fullname='Brielle Williamson';
insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 15:04',null,'Secretaria','VIS2021002',id from visitors where fullname='Herrod Chandler';
insert into visits (arrival, departure, department, tag, visitor_id)
  select '2021/02/25 15:05','2021/02/25 15:10','Financeiro','VIS2021004',id from visitors where fullname='Airi Satou';
