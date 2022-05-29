
CREATE TABLE utente (Email varchar(255) PRIMARY KEY,
                     Nome varchar(255), 
                     Cognome varchar(255),
                     Password varchar(255))
                     Engine = InnoDB;

CREATE TABLE cibo (Id int AUTO_INCREMENT PRIMARY KEY,
                   Nome varchar(255), 
                   Immagine varchar(255),
                   Nutrienti varchar(255))
                   Engine = InnoDB;



CREATE TABLE likes (Id int AUTO_INCREMENT PRIMARY KEY,
                   Email_utente varchar(255), 
                   Id_post int,
                   FOREIGN KEY (Email_utente) REFERENCES utente(Email),
                   FOREIGN KEY (Id_post) REFERENCES cibo(Id))
                   Engine = InnoDB;