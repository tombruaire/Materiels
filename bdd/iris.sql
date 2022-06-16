drop database if exists iris;
create database iris;
use iris;

create table users (
    iduser int(3) not null auto_increment,
    nomuser varchar(50),
    prenomuser varchar(50),
    pseudouser varchar(20),
    emailuser varchar(255),
    mdpuser varchar(255),
    lvl int not null default 1,
    primary key (iduser)
) ENGINE=InnoDB, charset=utf8;

insert into users values
(1, "Bruaire", "Tom", "tombruaire", "admin@gmail.com", "123", 2),
(2, "Kini", "Nahel", "nahelkiki", "user1@gmail.com", "456", 1),
(3, "Ben", "Yassine", "yassineben", "user2@gmail.com", "789", 1);

create table professeurs (
    idprofesseur int(3) not null auto_increment,
    nomprofesseur varchar(50),
    prenomprofesseur varchar(50),
    adresseprofesseur varchar(255),
    diplomeprofesseur varchar(50),
    primary key (idprofesseur)
) ENGINE=InnoDB, charset=utf8;

insert into professeurs values
(1, "BENAHMED", "Okacha", "5 rue de Paris", "Master"),
(2, "CHOUAKI", "Abder", "18 avenue Pompidou", "Master");

create table materiels (
    idmateriel int(3) not null auto_increment,
    designationmateriel varchar(50),
    dateachatmateriel date,
    etatmateriel enum('Bon état', 'Mauvais état'),
    primary key (idmateriel)
) ENGINE=InnoDB, charset=utf8;

insert into materiels values
(1, "PC Portable", "2021-09-05", "Bon état"),
(2, "Téléphone Portable", "2021-09-25", "Mauvais état");

create table categories (
    idcategorie int(3) not null auto_increment,
    libellecategorie varchar(50),
    fournisseurcategorie varchar(50),
    primary key (idcategorie)
) ENGINE=InnoDB, charset=utf8;

insert into categories values
(1, "Informatique", "Asus"),
(2, "Jeux-video", "Nintendo");

create table locations (
    idlocation int(3) not null auto_increment,
    datelocation date,
    heurelocation time,
    dureelocation int(3),
    idprofesseur int(3),
    idmateriel int(3),
    primary key (idlocation),
    foreign key (idprofesseur) references professeurs (idprofesseur)
    on delete cascade
    on update cascade,
    foreign key (idmateriel) references materiels (idmateriel)
    on delete cascade
    on update cascade
) ENGINE=InnoDB;

insert into locations values
(1, "2021-10-01", "09:00:00", 120, 1, 1),
(2, "2021-10-05", "10:00:00", 60, 2, 2);

create or replace view locationsProfsMats as (
    select l.idlocation, l.datelocation, l.heurelocation, l.dureelocation, p.nomprofesseur, p.prenomprofesseur, m.designationmateriel
    from locations l, professeurs p, materiels m
    where l.idprofesseur = p.idprofesseur and l.idmateriel = m.idmateriel
);
