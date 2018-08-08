drop table if exists est_articulo_comentario;
drop table if exists est_autor_articulo;
drop table if exists est_articulo_poblacion;
drop table if exists est_articulo;

drop table if exists est_post_autor;
drop table if exists est_post_comentario;
drop table if exists est_post_poblacion;
drop table if exists est_post;

create table if not exists est_post (
	id_post serial primary key not null,
	id_usuario text not null,
	carrera text not null,
	titulo character varying(300) not null,
	tema character varying(250) not null,
	contenido text not null,
	descripcion text not null,
	etiquetas character varying(250),
	enlace character varying(300) not null,
	fecha timestamp not null,
	activo boolean not null,
	permite_comentario boolean not null,
	constraint UQ_ENLACE Unique(enlace),
	constraint FK_ID_USUARIO foreign key(id_usuario)
		references usuario (id_usuario) MATCH SIMPLE
		ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE IF NOT EXISTS est_post_autor (
	id_post int not null,
	cod_docente int not null,
	constraint FK_ID_POST foreign key(id_post) 
		references est_post (id_post) MATCH SIMPLE
		ON UPDATE CASCADE ON DELETE CASCADE,
	constraint FK_COD_DOCENTE foreign key(cod_docente)
		references docente (cod_docente) match simple
		on update cascade on delete cascade
);

create table if not exists est_post_comentario (
	id_comentario serial primary key not null,
	id_post int not null,
	cod_ceta int not null,
	contenido text not null,
	fecha timestamp not null,
	id_respuesta int,
	verificado boolean default FALSE,
	denuncia boolean default FALSE,
	constraint FK_ID_ENTRADA foreign key(id_post)
		references est_post (id_post) MATCH SIMPLE
		ON UPDATE NO ACTION ON DELETE CASCADE,
	constraint FK_ID_RESPUESTA foreign key(id_respuesta)
		references est_post_comentario(id_comentario) MATCH SIMPLE
		ON UPDATE NO ACTION ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS est_poblacion (
	id_poblacion serial primary key not null,
	nombre text not null
);

CREATE TABLE IF NOT EXISTS est_post_poblacion (
	id_post int not null,
	id_poblacion int not null,
	item text not null,
	constraint FK_ID_POST foreign key (id_post) 
		references est_post (id_post) match simple
		on update cascade on delete cascade,
	constraint FK_ID_POBLACION foreign key(id_poblacion)
		references est_poblacion(id_poblacion) match simple
		on update cascade on delete cascade
);

CREATE TABLE IF NOT EXISTS est_comentario_denuncia (
	id_denuncia serial primary key not null,
	id_comentario int not null,
	cod_ceta int not null,
	descripcion text not null
);

/*
alter table est_password
add column bloqueado boolean default false not null
*/

/*
insert into est_poblacion (nombre) values 
('Todos'),
('Semestre'),
('Grupo');
*/