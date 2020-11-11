# CREAMOS BASE DE DATOS 

CREATE DATABASE IF NOT EXISTS cloninstagram;
USE cloninstagram;


# TABLA USUARIOS 
CREATE TABLE IF NOT EXISTS users (
    id                  int(255) auto_increment not null,
    role                varchar(20),
    name                varchar(100),            
    surname             varchar(200),
    nick                varchar(100),
    email               varchar(255),
    password            varchar(255),
    image               varchar(255),
    created_at          datetime,
    updated_at          datetime,
    remember_token      varchar(255),
CONSTRAINT              pk_users PRIMARY KEY(id)     
)ENGINE =InnoDb; 


# Insercion de datos en la tabla usuarios 
INSERT INTO users VALUES (null,'user','Javier','Aparicio Garrido','webjavier','javier@webjavier.com','1234',null,CURTIME(),CURTIME(),null); 
INSERT INTO users VALUES (null,'user','Juan','Lopez','juanlopez','juan@juan.com','1234',null,CURTIME(),CURTIME(),null); 
INSERT INTO users VALUES (null,'user','Manolo','Garcia','manologarcia','manolo@manolo.com','1234',null,CURTIME(),CURTIME(),null); 



# TABLA IMAGES 
CREATE TABLE IF NOT EXISTS images(
    id              int(255) auto_increment not null,
    user_id         int(255) not null,
    image_path      varchar(255),
    description     text,
    created_at      datetime,
    updated_at      datetime,
CONSTRAINT          pk_images  PRIMARY KEY(id),    
CONSTRAINT          fk_images_users   FOREIGN KEY(user_id)  REFERENCES users(id)
)ENGINE=InnoDb;


# INSERCIÓN DE IMAGENES 
INSERT INTO images VALUES(null,1,'test.jpg','Descripción de prueba 1',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'playa.jpg','Descripción de prueba 2',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'arena.jpg','Descripción de prueba 3',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,3,'familia.jpg','Descripción de prueba 4',CURTIME(),CURTIME());



# TABLA COMMENTS
CREATE TABLE IF NOT EXISTS comments(
    id                  int(255) auto_increment not null,
    user_id             int(255) not null,
    image_id            int(255) not null,
    content             text,
    created_at          datetime,  
    updated_at          datetime,
CONSTRAINT              pk_comments PRIMARY KEY(id),
CONSTRAINT              fk_comments_users   FOREIGN KEY(user_id)  REFERENCES users(id),
CONSTRAINT              fk_comments_images  FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;    


# INSERCIÓN DE COMENTARIOS
INSERT INTO comments VALUES (null,1,4,'Buena foto de familia',CURTIME(),CURTIME());
INSERT INTO comments VALUES (null,2,1,'Buena foto de PLAYA',CURTIME(),CURTIME());
INSERT INTO comments VALUES (null,2,4,'¡¡QUE BUENO !!',CURTIME(),CURTIME());


# TABLA LIKES
CREATE TABLE IF NOT EXISTS likes(
    id                  int(255) auto_increment not null,
    user_id             int(255) not null,
    image_id            int(255) not null,
    created_at          datetime,
    updated_at          datetime,
CONSTRAINT              pk_likes  PRIMARY KEY(id),
CONSTRAINT              fk_likes_users   FOREIGN KEY(user_id)     REFERENCES users(id),
CONSTRAINT              fk_likes_images  FOREIGN KEY(image_id)    REFERENCES images(id)
)ENGINE=InnoDb;

# INSERCIÓN DE LIKES 
INSERT INTO likes VALUES(null,1,4,CURTIME(),CURTIME());
INSERT INTO likes VALUES(null,2,4,CURTIME(),CURTIME());
INSERT INTO likes VALUES(null,3,1,CURTIME(),CURTIME());
INSERT INTO likes VALUES(null,3,2,CURTIME(),CURTIME());
INSERT INTO likes VALUES(null,2,1,CURTIME(),CURTIME());