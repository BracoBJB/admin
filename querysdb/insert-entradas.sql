
--delete from est_post;
--truncate table est_post_autor cascade;
--truncate table est_post_poblacion cascade;
--TRUNCATE TABLE est_post cascade;


--select * from est_post;
--select * from est_post_autor;
--select * from est_post_poblacion;
--select * from est_post_comentario;
--select * from est_poblacion
--select * from docente where activo = 'TRUE'

with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Significado de Mecánica' , 'Mecánica','', 'significado-de-mecanica', '2018-01-13 20:15:00', FALSE, TRUE,
		'<h2 style="margin-left:0cm; margin-right:0cm"><span style="font-size:13pt"><span style="font-family:&quot;Calibri Light&quot;,sans-serif"><span style="color:#2e74b5"><span style="color:#2e74b5">Qu&eacute; es la Mec&aacute;nica: Todos</span></span></span></span></h2>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La mec&aacute;nica es la ciencia que <strong>estudia el movimiento de los cuerpos</strong> bajo la acci&oacute;n de las fuerzas participantes.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">En f&iacute;sica, los estudios te&oacute;ricos sobre los comportamientos mec&aacute;nicos de los objetos como, por ejemplo, en la <strong>mec&aacute;nica cl&aacute;sica, la mec&aacute;nica relativista y la mec&aacute;nica cu&aacute;ntica</strong> es importante para entender la din&aacute;mica del mundo que nos rodea.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/mecanica-cuantica/" style="color:blue; text-decoration:underline">Mec&aacute;nica cu&aacute;ntica</a>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La aplicaci&oacute;n de los conocimientos sobre la mec&aacute;nica ha ayudado en la construcci&oacute;n de estructuras con movimientos mec&aacute;nicos facilitando la vida del hombre. Estos estudios son abarcados, por ejemplo, en la <strong>ingenier&iacute;a mec&aacute;nica</strong> y en la <strong>mec&aacute;nica automotriz</strong>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Tanto para el estudio como para la aplicaci&oacute;n de la mec&aacute;nica se debe conocer los principios de la <strong>energ&iacute;a mec&aacute;nica</strong> como la fuerza que impulsar&aacute; un mecanismo.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La solidaridad mec&aacute;nica, por otro lado, se asocia a sociedades cuya divisi&oacute;n del trabajo es igual para todos al contrario de la solidaridad org&aacute;nica.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/solidaridad-mecanica-y-organica/" style="color:blue; text-decoration:underline">Solidaridad mec&aacute;nica y org&aacute;nica</a>.</span></span></p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'1','Todos')	
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '59')
	,((select id_post from first_insert), '62');
	

	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Significado de Mecánica 2', 'Mecánica', '', 'significado-de-mecanica-2', '2018-02-13 20:15:00', FALSE, TRUE,
		'<h2 style="margin-left:0cm; margin-right:0cm"><span style="font-size:13pt"><span style="font-family:&quot;Calibri Light&quot;,sans-serif"><span style="color:#2e74b5"><span style="color:#2e74b5">Qu&eacute; es la Mec&aacute;nica: 1er 2do 3er Semestre</span></span></span></span></h2>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La mec&aacute;nica es la ciencia que <strong>estudia el movimiento de los cuerpos</strong> bajo la acci&oacute;n de las fuerzas participantes.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">En f&iacute;sica, los estudios te&oacute;ricos sobre los comportamientos mec&aacute;nicos de los objetos como, por ejemplo, en la <strong>mec&aacute;nica cl&aacute;sica, la mec&aacute;nica relativista y la mec&aacute;nica cu&aacute;ntica</strong> es importante para entender la din&aacute;mica del mundo que nos rodea.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/mecanica-cuantica/" style="color:blue; text-decoration:underline">Mec&aacute;nica cu&aacute;ntica</a>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La aplicaci&oacute;n de los conocimientos sobre la mec&aacute;nica ha ayudado en la construcci&oacute;n de estructuras con movimientos mec&aacute;nicos facilitando la vida del hombre. Estos estudios son abarcados, por ejemplo, en la <strong>ingenier&iacute;a mec&aacute;nica</strong> y en la <strong>mec&aacute;nica automotriz</strong>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Tanto para el estudio como para la aplicaci&oacute;n de la mec&aacute;nica se debe conocer los principios de la <strong>energ&iacute;a mec&aacute;nica</strong> como la fuerza que impulsar&aacute; un mecanismo.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La solidaridad mec&aacute;nica, por otro lado, se asocia a sociedades cuya divisi&oacute;n del trabajo es igual para todos al contrario de la solidaridad org&aacute;nica.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/solidaridad-mecanica-y-organica/" style="color:blue; text-decoration:underline">Solidaridad mec&aacute;nica y org&aacute;nica</a>.</span></span></p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','1er Semestre')
	,((select id_post from first_insert),'2','2do Semestre')
	,((select id_post from first_insert),'2','3er Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '59');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Significado de Mecánica 3', 'Mecánica', '', 'significado-de-mecanica-3', '2018-03-13 20:15:00', FALSE, TRUE,
		'<h2 style="margin-left:0cm; margin-right:0cm"><span style="font-size:13pt"><span style="font-family:&quot;Calibri Light&quot;,sans-serif"><span style="color:#2e74b5"><span style="color:#2e74b5">Qu&eacute; es la Mec&aacute;nica: 4to 5to 6to</span></span></span></span></h2>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La mec&aacute;nica es la ciencia que <strong>estudia el movimiento de los cuerpos</strong> bajo la acci&oacute;n de las fuerzas participantes.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">En f&iacute;sica, los estudios te&oacute;ricos sobre los comportamientos mec&aacute;nicos de los objetos como, por ejemplo, en la <strong>mec&aacute;nica cl&aacute;sica, la mec&aacute;nica relativista y la mec&aacute;nica cu&aacute;ntica</strong> es importante para entender la din&aacute;mica del mundo que nos rodea.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/mecanica-cuantica/" style="color:blue; text-decoration:underline">Mec&aacute;nica cu&aacute;ntica</a>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La aplicaci&oacute;n de los conocimientos sobre la mec&aacute;nica ha ayudado en la construcci&oacute;n de estructuras con movimientos mec&aacute;nicos facilitando la vida del hombre. Estos estudios son abarcados, por ejemplo, en la <strong>ingenier&iacute;a mec&aacute;nica</strong> y en la <strong>mec&aacute;nica automotriz</strong>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Tanto para el estudio como para la aplicaci&oacute;n de la mec&aacute;nica se debe conocer los principios de la <strong>energ&iacute;a mec&aacute;nica</strong> como la fuerza que impulsar&aacute; un mecanismo.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La solidaridad mec&aacute;nica, por otro lado, se asocia a sociedades cuya divisi&oacute;n del trabajo es igual para todos al contrario de la solidaridad org&aacute;nica.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/solidaridad-mecanica-y-organica/" style="color:blue; text-decoration:underline">Solidaridad mec&aacute;nica y org&aacute;nica</a>.</span></span></p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values 	((select id_post from first_insert),'2','4to Semestre')
	,((select id_post from first_insert),'2','5to Semestre')
	,((select id_post from first_insert),'2','6to Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '92')
	,((select id_post from first_insert), '57');
	

with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Que es la electricidad', 'Electricidad', '', 'que-es-la-electricidad', '2018-04-13 20:15:00', FALSE, TRUE,
		'<h1><a href="https://www.foronuclear.org/es/el-experto-te-cuenta/121636-que-es-la-electricidad">&iquest;Qu&eacute; es la electricidad? mañana</a></h1>
<p><strong>La</strong> <strong>electricidad</strong> es un conjunto de fen&oacute;menos producidos por el movimiento e interacci&oacute;n entre las cargas el&eacute;ctricas positivas y negativas de los cuerpos f&iacute;sicos.</p>
<p>La palabra &quot;electricidad&quot; procede del lat&iacute;n electrum, y a su vez del griego&nbsp;<em>&eacute;lektron</em>, o &aacute;mbar. La referencia al &aacute;mbar proviene de un descubrimiento registrado por el cient&iacute;fico franc&eacute;s Charles Fran&ccedil;ois de Cisternay du Fay, que identific&oacute; la existencia de dos tipos de cargas el&eacute;ctricas (positiva y negativa). Las cargas positivas se manifestaban al frotar el vidrio, y las negativas al frotar sustancias resinosas como el &aacute;mbar.</p>
<p>La energ&iacute;a producida por las cargas el&eacute;ctricas puede manifestarse dentro de cuatro &aacute;mbitos: <strong>f&iacute;sico, luminoso, mec&aacute;nico y t&eacute;rmico</strong>.</p>
<p>Si bien la electricidad es abstracta o &quot;invisible&quot; en la mayor&iacute;a de sus manifestaciones, como por ejemplo en el sistema nervioso del ser humano, es posible &quot;verla&quot; en ocasiones, como los rayos cuando se desarrolla una fuerte tormenta.</p>
<h2>La electricidad es una fuente de energ&iacute;a secundaria</h2>
<p>Se denominan <strong>energ&iacute;as primarias</strong> las que se obtienen directamente de la naturaleza: solar, hidr&aacute;ulica, e&oacute;lica, geot&eacute;rmica, biomasa, petr&oacute;leo, gas natural o carb&oacute;n.</p>
<p>Las<strong> energ&iacute;as secundarias</strong> provienen de la transformaci&oacute;n de energ&iacute;a primaria con destino al consumo directo, o a otros usos: gasolina, electricidad, gasoil, fuel oil...</p>
<h2><br />
&iquest;C&oacute;mo se produce la electricidad para el consumo?</h2>
<p>La electricidad se produce mediante <strong>sistemas el&eacute;ctrico</strong>s que garantizan su disponibilidad.</p>
<p>Un sistema el&eacute;ctrico es el conjunto de elementos que operan de forma coordinada en un determinado territorio para satisfacer la demanda de energ&iacute;a el&eacute;ctrica de los consumidores.</p>
<p>Los sistemas el&eacute;ctricos se pueden clasificar b&aacute;sicamente de la siguiente manera:</p>
<ul>
	<li>Centros o plantas de generaci&oacute;n donde se produce la electricidad (centrales nucleares, hidroel&eacute;ctricas, de ciclo combinado, parques e&oacute;licos, etc.).</li>
	<li>L&iacute;neas de transporte de la energ&iacute;a el&eacute;ctrica de alta tensi&oacute;n (AT).</li>
	<li>Estaciones transformadoras (subestaciones) que reducen la tensi&oacute;n o el voltaje de la l&iacute;nea (alta tensi&oacute;n / media tensi&oacute;n, media tensi&oacute;n / baja tensi&oacute;n).</li>
	<li>L&iacute;neas de distribuci&oacute;n de media y baja tensi&oacute;n que llevan la electricidad hasta los puntos de consumo.</li>
	<li>Centro de control el&eacute;ctrico desde el que se gestiona y opera el sistema de generaci&oacute;n y transporte de energ&iacute;a.</li>
</ul>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'3','EEA-101M')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '98');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Que es la electricidad 2', 'Electricidad', '', 'que-es-la-electricidad-2', '2018-05-13 20:15:00', FALSE, TRUE,
		'<h1><a href="https://www.foronuclear.org/es/el-experto-te-cuenta/121636-que-es-la-electricidad">&iquest;Qu&eacute; es la electricidad? tarde</a></h1>
<p><strong>La</strong> <strong>electricidad</strong> es un conjunto de fen&oacute;menos producidos por el movimiento e interacci&oacute;n entre las cargas el&eacute;ctricas positivas y negativas de los cuerpos f&iacute;sicos.</p>
<p>La palabra &quot;electricidad&quot; procede del lat&iacute;n electrum, y a su vez del griego&nbsp;<em>&eacute;lektron</em>, o &aacute;mbar. La referencia al &aacute;mbar proviene de un descubrimiento registrado por el cient&iacute;fico franc&eacute;s Charles Fran&ccedil;ois de Cisternay du Fay, que identific&oacute; la existencia de dos tipos de cargas el&eacute;ctricas (positiva y negativa). Las cargas positivas se manifestaban al frotar el vidrio, y las negativas al frotar sustancias resinosas como el &aacute;mbar.</p>
<p>La energ&iacute;a producida por las cargas el&eacute;ctricas puede manifestarse dentro de cuatro &aacute;mbitos: <strong>f&iacute;sico, luminoso, mec&aacute;nico y t&eacute;rmico</strong>.</p>
<p>Si bien la electricidad es abstracta o &quot;invisible&quot; en la mayor&iacute;a de sus manifestaciones, como por ejemplo en el sistema nervioso del ser humano, es posible &quot;verla&quot; en ocasiones, como los rayos cuando se desarrolla una fuerte tormenta.</p>
<h2>La electricidad es una fuente de energ&iacute;a secundaria</h2>
<p>Se denominan <strong>energ&iacute;as primarias</strong> las que se obtienen directamente de la naturaleza: solar, hidr&aacute;ulica, e&oacute;lica, geot&eacute;rmica, biomasa, petr&oacute;leo, gas natural o carb&oacute;n.</p>
<p>Las<strong> energ&iacute;as secundarias</strong> provienen de la transformaci&oacute;n de energ&iacute;a primaria con destino al consumo directo, o a otros usos: gasolina, electricidad, gasoil, fuel oil...</p>
<h2><br />
&iquest;C&oacute;mo se produce la electricidad para el consumo?</h2>
<p>La electricidad se produce mediante <strong>sistemas el&eacute;ctrico</strong>s que garantizan su disponibilidad.</p>
<p>Un sistema el&eacute;ctrico es el conjunto de elementos que operan de forma coordinada en un determinado territorio para satisfacer la demanda de energ&iacute;a el&eacute;ctrica de los consumidores.</p>
<p>Los sistemas el&eacute;ctricos se pueden clasificar b&aacute;sicamente de la siguiente manera:</p>
<ul>
	<li>Centros o plantas de generaci&oacute;n donde se produce la electricidad (centrales nucleares, hidroel&eacute;ctricas, de ciclo combinado, parques e&oacute;licos, etc.).</li>
	<li>L&iacute;neas de transporte de la energ&iacute;a el&eacute;ctrica de alta tensi&oacute;n (AT).</li>
	<li>Estaciones transformadoras (subestaciones) que reducen la tensi&oacute;n o el voltaje de la l&iacute;nea (alta tensi&oacute;n / media tensi&oacute;n, media tensi&oacute;n / baja tensi&oacute;n).</li>
	<li>L&iacute;neas de distribuci&oacute;n de media y baja tensi&oacute;n que llevan la electricidad hasta los puntos de consumo.</li>
	<li>Centro de control el&eacute;ctrico desde el que se gestiona y opera el sistema de generaci&oacute;n y transporte de energ&iacute;a.</li>
</ul>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'3','EEA-101T')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '44');
	
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Que es la electricidad 3', 'Electricidad', '', 'que-es-la-electricidad-3', '2018-06-13 20:15:00', FALSE, TRUE,
		'<h1><a href="https://www.foronuclear.org/es/el-experto-te-cuenta/121636-que-es-la-electricidad">&iquest;Qu&eacute; es la electricidad? noche</a></h1>
<p><strong>La</strong> <strong>electricidad</strong> es un conjunto de fen&oacute;menos producidos por el movimiento e interacci&oacute;n entre las cargas el&eacute;ctricas positivas y negativas de los cuerpos f&iacute;sicos.</p>
<p>La palabra &quot;electricidad&quot; procede del lat&iacute;n electrum, y a su vez del griego&nbsp;<em>&eacute;lektron</em>, o &aacute;mbar. La referencia al &aacute;mbar proviene de un descubrimiento registrado por el cient&iacute;fico franc&eacute;s Charles Fran&ccedil;ois de Cisternay du Fay, que identific&oacute; la existencia de dos tipos de cargas el&eacute;ctricas (positiva y negativa). Las cargas positivas se manifestaban al frotar el vidrio, y las negativas al frotar sustancias resinosas como el &aacute;mbar.</p>
<p>La energ&iacute;a producida por las cargas el&eacute;ctricas puede manifestarse dentro de cuatro &aacute;mbitos: <strong>f&iacute;sico, luminoso, mec&aacute;nico y t&eacute;rmico</strong>.</p>
<p>Si bien la electricidad es abstracta o &quot;invisible&quot; en la mayor&iacute;a de sus manifestaciones, como por ejemplo en el sistema nervioso del ser humano, es posible &quot;verla&quot; en ocasiones, como los rayos cuando se desarrolla una fuerte tormenta.</p>
<h2>La electricidad es una fuente de energ&iacute;a secundaria</h2>
<p>Se denominan <strong>energ&iacute;as primarias</strong> las que se obtienen directamente de la naturaleza: solar, hidr&aacute;ulica, e&oacute;lica, geot&eacute;rmica, biomasa, petr&oacute;leo, gas natural o carb&oacute;n.</p>
<p>Las<strong> energ&iacute;as secundarias</strong> provienen de la transformaci&oacute;n de energ&iacute;a primaria con destino al consumo directo, o a otros usos: gasolina, electricidad, gasoil, fuel oil...</p>
<h2><br />
&iquest;C&oacute;mo se produce la electricidad para el consumo?</h2>
<p>La electricidad se produce mediante <strong>sistemas el&eacute;ctrico</strong>s que garantizan su disponibilidad.</p>
<p>Un sistema el&eacute;ctrico es el conjunto de elementos que operan de forma coordinada en un determinado territorio para satisfacer la demanda de energ&iacute;a el&eacute;ctrica de los consumidores.</p>
<p>Los sistemas el&eacute;ctricos se pueden clasificar b&aacute;sicamente de la siguiente manera:</p>
<ul>
	<li>Centros o plantas de generaci&oacute;n donde se produce la electricidad (centrales nucleares, hidroel&eacute;ctricas, de ciclo combinado, parques e&oacute;licos, etc.).</li>
	<li>L&iacute;neas de transporte de la energ&iacute;a el&eacute;ctrica de alta tensi&oacute;n (AT).</li>
	<li>Estaciones transformadoras (subestaciones) que reducen la tensi&oacute;n o el voltaje de la l&iacute;nea (alta tensi&oacute;n / media tensi&oacute;n, media tensi&oacute;n / baja tensi&oacute;n).</li>
	<li>L&iacute;neas de distribuci&oacute;n de media y baja tensi&oacute;n que llevan la electricidad hasta los puntos de consumo.</li>
	<li>Centro de control el&eacute;ctrico desde el que se gestiona y opera el sistema de generaci&oacute;n y transporte de energ&iacute;a.</li>
</ul>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'3','EEA-101N')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '21')
	,((select id_post from first_insert), '19');
	


with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Información de formato', 'Diccionario de Datos','', 'informacion-de-formato', '2018-02-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 1er</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','1er Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '48');
	

	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Información de formato 2', 'Diccionario de Datos','', 'informacion-de-formato-2', '2018-03-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 2</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','2do Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '49');
	

	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA' , 'Información de formato 3', 'Diccionario de Datos', '', 'informacion-de-formato-3', '2018-04-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 3</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','3er Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '81');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Información de formato 4', 'Diccionario de Datos', '', 'informacion-de-formato-4', '2018-05-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 4</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','4to Semestre')	
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '19');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Información de formato 5', 'Diccionario de Datos','','informacion-de-formato-5', '2018-06-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 5</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','5to Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '49');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Información de formato 6', 'Diccionario de Datos','', 'informacion-de-formato-6', '2018-07-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 6</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','6to Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '48');
	
----------------------------agreando informcion ducplicada para hacer pruebas----------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------



with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Post Prueba Mecánica' , 'Mecánica','', 'post-prueba-mecanica', '2018-01-13 20:15:00', FALSE, TRUE,
		'<h2 style="margin-left:0cm; margin-right:0cm"><span style="font-size:13pt"><span style="font-family:&quot;Calibri Light&quot;,sans-serif"><span style="color:#2e74b5"><span style="color:#2e74b5">Qu&eacute; es la Mec&aacute;nica: Todos</span></span></span></span></h2>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La mec&aacute;nica es la ciencia que <strong>estudia el movimiento de los cuerpos</strong> bajo la acci&oacute;n de las fuerzas participantes.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">En f&iacute;sica, los estudios te&oacute;ricos sobre los comportamientos mec&aacute;nicos de los objetos como, por ejemplo, en la <strong>mec&aacute;nica cl&aacute;sica, la mec&aacute;nica relativista y la mec&aacute;nica cu&aacute;ntica</strong> es importante para entender la din&aacute;mica del mundo que nos rodea.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/mecanica-cuantica/" style="color:blue; text-decoration:underline">Mec&aacute;nica cu&aacute;ntica</a>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La aplicaci&oacute;n de los conocimientos sobre la mec&aacute;nica ha ayudado en la construcci&oacute;n de estructuras con movimientos mec&aacute;nicos facilitando la vida del hombre. Estos estudios son abarcados, por ejemplo, en la <strong>ingenier&iacute;a mec&aacute;nica</strong> y en la <strong>mec&aacute;nica automotriz</strong>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Tanto para el estudio como para la aplicaci&oacute;n de la mec&aacute;nica se debe conocer los principios de la <strong>energ&iacute;a mec&aacute;nica</strong> como la fuerza que impulsar&aacute; un mecanismo.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La solidaridad mec&aacute;nica, por otro lado, se asocia a sociedades cuya divisi&oacute;n del trabajo es igual para todos al contrario de la solidaridad org&aacute;nica.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/solidaridad-mecanica-y-organica/" style="color:blue; text-decoration:underline">Solidaridad mec&aacute;nica y org&aacute;nica</a>.</span></span></p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'1','Todos')	
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '87')
	,((select id_post from first_insert), '81');
	

	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Post Prueba Mecánica 2', 'Mecánica', '', 'post-prueba-mecanica-2', '2018-02-13 20:15:00', FALSE, TRUE,
		'<h2 style="margin-left:0cm; margin-right:0cm"><span style="font-size:13pt"><span style="font-family:&quot;Calibri Light&quot;,sans-serif"><span style="color:#2e74b5"><span style="color:#2e74b5">Qu&eacute; es la Mec&aacute;nica: 1er 2do 3er Semestre</span></span></span></span></h2>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La mec&aacute;nica es la ciencia que <strong>estudia el movimiento de los cuerpos</strong> bajo la acci&oacute;n de las fuerzas participantes.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">En f&iacute;sica, los estudios te&oacute;ricos sobre los comportamientos mec&aacute;nicos de los objetos como, por ejemplo, en la <strong>mec&aacute;nica cl&aacute;sica, la mec&aacute;nica relativista y la mec&aacute;nica cu&aacute;ntica</strong> es importante para entender la din&aacute;mica del mundo que nos rodea.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/mecanica-cuantica/" style="color:blue; text-decoration:underline">Mec&aacute;nica cu&aacute;ntica</a>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La aplicaci&oacute;n de los conocimientos sobre la mec&aacute;nica ha ayudado en la construcci&oacute;n de estructuras con movimientos mec&aacute;nicos facilitando la vida del hombre. Estos estudios son abarcados, por ejemplo, en la <strong>ingenier&iacute;a mec&aacute;nica</strong> y en la <strong>mec&aacute;nica automotriz</strong>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Tanto para el estudio como para la aplicaci&oacute;n de la mec&aacute;nica se debe conocer los principios de la <strong>energ&iacute;a mec&aacute;nica</strong> como la fuerza que impulsar&aacute; un mecanismo.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La solidaridad mec&aacute;nica, por otro lado, se asocia a sociedades cuya divisi&oacute;n del trabajo es igual para todos al contrario de la solidaridad org&aacute;nica.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/solidaridad-mecanica-y-organica/" style="color:blue; text-decoration:underline">Solidaridad mec&aacute;nica y org&aacute;nica</a>.</span></span></p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','1er Semestre')
	,((select id_post from first_insert),'2','2do Semestre')
	,((select id_post from first_insert),'2','3er Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '59');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Post Prueba Mecánica 3', 'Mecánica', '', 'post-prueba-mecanica-3', '2018-03-13 20:15:00', FALSE, TRUE,
		'<h2 style="margin-left:0cm; margin-right:0cm"><span style="font-size:13pt"><span style="font-family:&quot;Calibri Light&quot;,sans-serif"><span style="color:#2e74b5"><span style="color:#2e74b5">Qu&eacute; es la Mec&aacute;nica: 4to 5to 6to</span></span></span></span></h2>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La mec&aacute;nica es la ciencia que <strong>estudia el movimiento de los cuerpos</strong> bajo la acci&oacute;n de las fuerzas participantes.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">En f&iacute;sica, los estudios te&oacute;ricos sobre los comportamientos mec&aacute;nicos de los objetos como, por ejemplo, en la <strong>mec&aacute;nica cl&aacute;sica, la mec&aacute;nica relativista y la mec&aacute;nica cu&aacute;ntica</strong> es importante para entender la din&aacute;mica del mundo que nos rodea.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/mecanica-cuantica/" style="color:blue; text-decoration:underline">Mec&aacute;nica cu&aacute;ntica</a>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La aplicaci&oacute;n de los conocimientos sobre la mec&aacute;nica ha ayudado en la construcci&oacute;n de estructuras con movimientos mec&aacute;nicos facilitando la vida del hombre. Estos estudios son abarcados, por ejemplo, en la <strong>ingenier&iacute;a mec&aacute;nica</strong> y en la <strong>mec&aacute;nica automotriz</strong>.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Tanto para el estudio como para la aplicaci&oacute;n de la mec&aacute;nica se debe conocer los principios de la <strong>energ&iacute;a mec&aacute;nica</strong> como la fuerza que impulsar&aacute; un mecanismo.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">La solidaridad mec&aacute;nica, por otro lado, se asocia a sociedades cuya divisi&oacute;n del trabajo es igual para todos al contrario de la solidaridad org&aacute;nica.</span></span></p>
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,serif">Vea tambi&eacute;n <a href="https://www.significados.com/solidaridad-mecanica-y-organica/" style="color:blue; text-decoration:underline">Solidaridad mec&aacute;nica y org&aacute;nica</a>.</span></span></p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values 	((select id_post from first_insert),'2','4to Semestre')
	,((select id_post from first_insert),'2','5to Semestre')
	,((select id_post from first_insert),'2','6to Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '72')
	,((select id_post from first_insert), '57');
	

with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Prueba electricidad', 'Electricidad', '', 'prueba-electricidad', '2018-04-13 20:15:00', FALSE, TRUE,
		'<h1><a href="https://www.foronuclear.org/es/el-experto-te-cuenta/121636-que-es-la-electricidad">&iquest;Qu&eacute; es la electricidad? mañana</a></h1>
<p><strong>La</strong> <strong>electricidad</strong> es un conjunto de fen&oacute;menos producidos por el movimiento e interacci&oacute;n entre las cargas el&eacute;ctricas positivas y negativas de los cuerpos f&iacute;sicos.</p>
<p>La palabra &quot;electricidad&quot; procede del lat&iacute;n electrum, y a su vez del griego&nbsp;<em>&eacute;lektron</em>, o &aacute;mbar. La referencia al &aacute;mbar proviene de un descubrimiento registrado por el cient&iacute;fico franc&eacute;s Charles Fran&ccedil;ois de Cisternay du Fay, que identific&oacute; la existencia de dos tipos de cargas el&eacute;ctricas (positiva y negativa). Las cargas positivas se manifestaban al frotar el vidrio, y las negativas al frotar sustancias resinosas como el &aacute;mbar.</p>
<p>La energ&iacute;a producida por las cargas el&eacute;ctricas puede manifestarse dentro de cuatro &aacute;mbitos: <strong>f&iacute;sico, luminoso, mec&aacute;nico y t&eacute;rmico</strong>.</p>
<p>Si bien la electricidad es abstracta o &quot;invisible&quot; en la mayor&iacute;a de sus manifestaciones, como por ejemplo en el sistema nervioso del ser humano, es posible &quot;verla&quot; en ocasiones, como los rayos cuando se desarrolla una fuerte tormenta.</p>
<h2>La electricidad es una fuente de energ&iacute;a secundaria</h2>
<p>Se denominan <strong>energ&iacute;as primarias</strong> las que se obtienen directamente de la naturaleza: solar, hidr&aacute;ulica, e&oacute;lica, geot&eacute;rmica, biomasa, petr&oacute;leo, gas natural o carb&oacute;n.</p>
<p>Las<strong> energ&iacute;as secundarias</strong> provienen de la transformaci&oacute;n de energ&iacute;a primaria con destino al consumo directo, o a otros usos: gasolina, electricidad, gasoil, fuel oil...</p>
<h2><br />
&iquest;C&oacute;mo se produce la electricidad para el consumo?</h2>
<p>La electricidad se produce mediante <strong>sistemas el&eacute;ctrico</strong>s que garantizan su disponibilidad.</p>
<p>Un sistema el&eacute;ctrico es el conjunto de elementos que operan de forma coordinada en un determinado territorio para satisfacer la demanda de energ&iacute;a el&eacute;ctrica de los consumidores.</p>
<p>Los sistemas el&eacute;ctricos se pueden clasificar b&aacute;sicamente de la siguiente manera:</p>
<ul>
	<li>Centros o plantas de generaci&oacute;n donde se produce la electricidad (centrales nucleares, hidroel&eacute;ctricas, de ciclo combinado, parques e&oacute;licos, etc.).</li>
	<li>L&iacute;neas de transporte de la energ&iacute;a el&eacute;ctrica de alta tensi&oacute;n (AT).</li>
	<li>Estaciones transformadoras (subestaciones) que reducen la tensi&oacute;n o el voltaje de la l&iacute;nea (alta tensi&oacute;n / media tensi&oacute;n, media tensi&oacute;n / baja tensi&oacute;n).</li>
	<li>L&iacute;neas de distribuci&oacute;n de media y baja tensi&oacute;n que llevan la electricidad hasta los puntos de consumo.</li>
	<li>Centro de control el&eacute;ctrico desde el que se gestiona y opera el sistema de generaci&oacute;n y transporte de energ&iacute;a.</li>
</ul>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'3','EEA-101M')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '98');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Prueba electricidad 2', 'Electricidad', '', 'prueba-electricidad-2', '2018-05-13 20:15:00', FALSE, TRUE,
		'<h1><a href="https://www.foronuclear.org/es/el-experto-te-cuenta/121636-que-es-la-electricidad">&iquest;Qu&eacute; es la electricidad? tarde</a></h1>
<p><strong>La</strong> <strong>electricidad</strong> es un conjunto de fen&oacute;menos producidos por el movimiento e interacci&oacute;n entre las cargas el&eacute;ctricas positivas y negativas de los cuerpos f&iacute;sicos.</p>
<p>La palabra &quot;electricidad&quot; procede del lat&iacute;n electrum, y a su vez del griego&nbsp;<em>&eacute;lektron</em>, o &aacute;mbar. La referencia al &aacute;mbar proviene de un descubrimiento registrado por el cient&iacute;fico franc&eacute;s Charles Fran&ccedil;ois de Cisternay du Fay, que identific&oacute; la existencia de dos tipos de cargas el&eacute;ctricas (positiva y negativa). Las cargas positivas se manifestaban al frotar el vidrio, y las negativas al frotar sustancias resinosas como el &aacute;mbar.</p>
<p>La energ&iacute;a producida por las cargas el&eacute;ctricas puede manifestarse dentro de cuatro &aacute;mbitos: <strong>f&iacute;sico, luminoso, mec&aacute;nico y t&eacute;rmico</strong>.</p>
<p>Si bien la electricidad es abstracta o &quot;invisible&quot; en la mayor&iacute;a de sus manifestaciones, como por ejemplo en el sistema nervioso del ser humano, es posible &quot;verla&quot; en ocasiones, como los rayos cuando se desarrolla una fuerte tormenta.</p>
<h2>La electricidad es una fuente de energ&iacute;a secundaria</h2>
<p>Se denominan <strong>energ&iacute;as primarias</strong> las que se obtienen directamente de la naturaleza: solar, hidr&aacute;ulica, e&oacute;lica, geot&eacute;rmica, biomasa, petr&oacute;leo, gas natural o carb&oacute;n.</p>
<p>Las<strong> energ&iacute;as secundarias</strong> provienen de la transformaci&oacute;n de energ&iacute;a primaria con destino al consumo directo, o a otros usos: gasolina, electricidad, gasoil, fuel oil...</p>
<h2><br />
&iquest;C&oacute;mo se produce la electricidad para el consumo?</h2>
<p>La electricidad se produce mediante <strong>sistemas el&eacute;ctrico</strong>s que garantizan su disponibilidad.</p>
<p>Un sistema el&eacute;ctrico es el conjunto de elementos que operan de forma coordinada en un determinado territorio para satisfacer la demanda de energ&iacute;a el&eacute;ctrica de los consumidores.</p>
<p>Los sistemas el&eacute;ctricos se pueden clasificar b&aacute;sicamente de la siguiente manera:</p>
<ul>
	<li>Centros o plantas de generaci&oacute;n donde se produce la electricidad (centrales nucleares, hidroel&eacute;ctricas, de ciclo combinado, parques e&oacute;licos, etc.).</li>
	<li>L&iacute;neas de transporte de la energ&iacute;a el&eacute;ctrica de alta tensi&oacute;n (AT).</li>
	<li>Estaciones transformadoras (subestaciones) que reducen la tensi&oacute;n o el voltaje de la l&iacute;nea (alta tensi&oacute;n / media tensi&oacute;n, media tensi&oacute;n / baja tensi&oacute;n).</li>
	<li>L&iacute;neas de distribuci&oacute;n de media y baja tensi&oacute;n que llevan la electricidad hasta los puntos de consumo.</li>
	<li>Centro de control el&eacute;ctrico desde el que se gestiona y opera el sistema de generaci&oacute;n y transporte de energ&iacute;a.</li>
</ul>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'3','EEA-101T')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '44');
	
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Prueba electricidad 3', 'Electricidad', '', 'prueba-electricidad-3', '2018-06-13 20:15:00', FALSE, TRUE,
		'<h1><a href="https://www.foronuclear.org/es/el-experto-te-cuenta/121636-que-es-la-electricidad">&iquest;Qu&eacute; es la electricidad? noche</a></h1>
<p><strong>La</strong> <strong>electricidad</strong> es un conjunto de fen&oacute;menos producidos por el movimiento e interacci&oacute;n entre las cargas el&eacute;ctricas positivas y negativas de los cuerpos f&iacute;sicos.</p>
<p>La palabra &quot;electricidad&quot; procede del lat&iacute;n electrum, y a su vez del griego&nbsp;<em>&eacute;lektron</em>, o &aacute;mbar. La referencia al &aacute;mbar proviene de un descubrimiento registrado por el cient&iacute;fico franc&eacute;s Charles Fran&ccedil;ois de Cisternay du Fay, que identific&oacute; la existencia de dos tipos de cargas el&eacute;ctricas (positiva y negativa). Las cargas positivas se manifestaban al frotar el vidrio, y las negativas al frotar sustancias resinosas como el &aacute;mbar.</p>
<p>La energ&iacute;a producida por las cargas el&eacute;ctricas puede manifestarse dentro de cuatro &aacute;mbitos: <strong>f&iacute;sico, luminoso, mec&aacute;nico y t&eacute;rmico</strong>.</p>
<p>Si bien la electricidad es abstracta o &quot;invisible&quot; en la mayor&iacute;a de sus manifestaciones, como por ejemplo en el sistema nervioso del ser humano, es posible &quot;verla&quot; en ocasiones, como los rayos cuando se desarrolla una fuerte tormenta.</p>
<h2>La electricidad es una fuente de energ&iacute;a secundaria</h2>
<p>Se denominan <strong>energ&iacute;as primarias</strong> las que se obtienen directamente de la naturaleza: solar, hidr&aacute;ulica, e&oacute;lica, geot&eacute;rmica, biomasa, petr&oacute;leo, gas natural o carb&oacute;n.</p>
<p>Las<strong> energ&iacute;as secundarias</strong> provienen de la transformaci&oacute;n de energ&iacute;a primaria con destino al consumo directo, o a otros usos: gasolina, electricidad, gasoil, fuel oil...</p>
<h2><br />
&iquest;C&oacute;mo se produce la electricidad para el consumo?</h2>
<p>La electricidad se produce mediante <strong>sistemas el&eacute;ctrico</strong>s que garantizan su disponibilidad.</p>
<p>Un sistema el&eacute;ctrico es el conjunto de elementos que operan de forma coordinada en un determinado territorio para satisfacer la demanda de energ&iacute;a el&eacute;ctrica de los consumidores.</p>
<p>Los sistemas el&eacute;ctricos se pueden clasificar b&aacute;sicamente de la siguiente manera:</p>
<ul>
	<li>Centros o plantas de generaci&oacute;n donde se produce la electricidad (centrales nucleares, hidroel&eacute;ctricas, de ciclo combinado, parques e&oacute;licos, etc.).</li>
	<li>L&iacute;neas de transporte de la energ&iacute;a el&eacute;ctrica de alta tensi&oacute;n (AT).</li>
	<li>Estaciones transformadoras (subestaciones) que reducen la tensi&oacute;n o el voltaje de la l&iacute;nea (alta tensi&oacute;n / media tensi&oacute;n, media tensi&oacute;n / baja tensi&oacute;n).</li>
	<li>L&iacute;neas de distribuci&oacute;n de media y baja tensi&oacute;n que llevan la electricidad hasta los puntos de consumo.</li>
	<li>Centro de control el&eacute;ctrico desde el que se gestiona y opera el sistema de generaci&oacute;n y transporte de energ&iacute;a.</li>
</ul>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'3','EEA-101N')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '21')
	,((select id_post from first_insert), '19');
	


with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Formato Trabajo 1', 'Diccionario de Datos','', 'formato-trabajo-1', '2018-02-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 1er</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','1er Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '48');
	

	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Formato Trabajo 2', 'Diccionario de Datos','', 'formato-trabajo-2', '2018-03-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 2</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','2do Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '49');
	

	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA' , 'Formato Trabajo 3', 'Diccionario de Datos', '', 'formato-trabajo-3', '2018-04-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 3</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','3er Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '92');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Formato Trabajo 4', 'Diccionario de Datos', '', 'formato-trabajo-4', '2018-05-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 4</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','4to Semestre')	
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '19');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA','Formato Trabajo 5', 'Diccionario de Datos','','formato-trabajo-5', '2018-06-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 5</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','5to Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '49');
	
	
with first_insert as(
	INSERT INTO est_post (id_usuario, carrera, titulo, tema , etiquetas, enlace, fecha, activo, permite_comentario, contenido, descripcion) 
	VALUES ('Braco','EEA', 'Formato Trabajo 6', 'Diccionario de Datos','', 'formato-trabajo-6', '2018-07-13 20:15:00', FALSE, TRUE,
		'<h1>Informaci&oacute;n de formato 6</h1>
<p>El grupo de trabajo estudi&oacute; el formato con detalle y lleg&oacute; a la conclusi&oacute;n de que hab&iacute;a que llegar a un acuerdo en algunos temas fundamentales antes de poder definir unidades sem&aacute;nticas concretas. Estos temas inclu&iacute;an:</p>
<p>&iquest;Qu&eacute; es un formato?<br />
&iquest;Qu&eacute; tipo de objetos tienen formato?<br />
&iquest;C&oacute;mo se identifica un formato?<br />
&iquest;Existe alguna diferencia entre un formato y un perfil?</p>
<p>El concepto de formato parece casi intuitivo, pero debido a la importancia que tiene la informaci&oacute;n del formato para la preservaci&oacute;n digital, el grupo decidi&oacute; ser muy concreto respecto a su significado. Debatiendo acerca de las caracter&iacute;sticas que definen un formato surgi&oacute; se lleg&oacute; a la conclusi&oacute;n de que todo formato tiene que corresponderse con alguna especificaci&oacute;n formal o informal, no puede tratarse de un dise&ntilde;o de bits al azar o sin previa documentaci&oacute;n. La definici&oacute;n de Wikipedia, &laquo;una manera particular de codificar informaci&oacute;n para almacenarla en un archivo inform&aacute;tico&raquo;, no parece enfatizar lo suficiente esta caracter&iacute;stica1. El grupo esboz&oacute; su propia definici&oacute;n: <em>una estructura espec&iacute;fica y preestablecida para la organizaci&oacute;n de un fichero digital o cadena de bits.</em></p>
<p>El formato es, evidentemente, una propiedad de los ficheros, pero tambi&eacute;n puede aplicarse a las cadenas de bits. Por ejemplo, una cadena de bits de una imagen dentro de un fichero TIFF podr&iacute;a tener un formato acorde a la especificaci&oacute;n del formato del fichero TIFF. Por este motivo, PREMIS evita utilizar el t&eacute;rmino formato de fichero y emplea en su lugar formato, m&aacute;s gen&eacute;rico.</p>
<p>Un repositorio debe registrar la informaci&oacute;n sobre el formato de la manera m&aacute;s espec&iacute;fica posible. Lo ideal ser&iacute;a identificar los formatos con un enlace directo hacia la especificaci&oacute;n completa del formato. En la pr&aacute;ctica, es m&aacute;s c&oacute;modo un enlace indirecto como un c&oacute;digo o una cadena que pueda a su vez asociarse con las especificaciones completas del formato. El grupo consider&oacute; el nombre de formato como una designaci&oacute;n algo arbitraria que se podr&iacute;a utilizar a modo de enlace indirecto. Sin embargo, surgieron dos complicaciones cuando el grupo intent&oacute; definir las unidades sem&aacute;nticas que se utilizar&iacute;an como enlace.</p>
<p>En primer lugar, las designaciones utilizadas habitualmente para los formatos, como las del tipo MIME con sus extensiones, no ofrecen informaci&oacute;n suficientemente detallada como para utilizarla sin tener que a&ntilde;adir informaci&oacute;n adicional sobre la versi&oacute;n. Se debati&oacute; acerca de si la unidad sem&aacute;ntica definida para el nombre del formato deber&iacute;a incluir tanto el formato como la versi&oacute;n (por ejemplo, &laquo;TIFF 6.0&raquo;) o si deber&iacute;an definirse dos unidades sem&aacute;nticas diferentes, una para el nombre y otra para la versi&oacute;n. Se decantaron por dos unidades sem&aacute;nticas para poder utilizar listados de autoridades ya existentes como los de tipo MIME, as&iacute;, en el Diccionario de Datos, formatDesignation (designaci&oacute;n del formato) consta de dos componentes: formatName (nombre de formato) y formatVersion (versi&oacute;n de formato).</p>
','Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum assumenda, soluta, quidem voluptas, quod aut qui odit officiis a dolorem sed. Nisi eius error odio provident accusantium, iste cumque nemo.')
	RETURNING id_post
), second_insert as (
	insert into est_post_poblacion (id_post,id_poblacion,item)
	values ((select id_post from first_insert),'2','6to Semestre')
)
insert into est_post_autor ( id_post ,cod_docente) 
  	values ((select id_post from first_insert), '48');
