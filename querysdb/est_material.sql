/*
Navicat PGSQL Data Transfer

Source Server         : SERVIDOR_EEA
Source Server Version : 90102
Source Host           : 192.168.0.101:5432
Source Database       : CetaWeb
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90102
File Encoding         : 65001

Date: 2018-08-10 21:31:42
*/


-- ----------------------------
-- Table structure for est_material
-- ----------------------------
DROP TABLE IF EXISTS "public"."est_material";
CREATE TABLE "public"."est_material" (
"id_material" int8 DEFAULT nextval('est_material_id_material_seq'::regclass) NOT NULL,
"gestion" text COLLATE "default" NOT NULL,
"titulo" text COLLATE "default",
"contenido" text COLLATE "default",
"cod_docente" int4,
"nom_archivo" text COLLATE "default",
"url" text COLLATE "default",
"carrera" text COLLATE "default",
"fecha" date DEFAULT now(),
"cod_materia" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of est_material
-- ----------------------------
INSERT INTO "public"."est_material" VALUES ('7', '2/2018', 'Documento de Confidencialidad', '<p>ryteyrtyerty</p>
', '92', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('8', '2/2018', 'Documento de Confidencialidad', '<p>hrtutyurtyu</p>
', '92', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('9', '2/2018', 'Documento de Confidencialidad', '<p>hjkghjkghjkghjk</p>
', '92', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('10', '2/2018', 'Documento de Confidencialidad', '<p>fghjfghjfghj</p>
', '92', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('11', '2/2018', 'Documento de Confidencialidad', '<p>ghkjkghjkgh</p>
', '92', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('12', '2/2018', 'Documento de Confidencialidad', '<p>fghjfgjfghj</p>
', '92', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('16', '2/2018', 'Alternadores', '<p>fhdfghdfgh</p>
', '92', '', '', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('17', '2/2018', 'computadora', '<p>qrqwerqwerqwerqwer</p>
', '84', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'assembly of a bed and fitted drawers pre july 2015 - youtube.webm', 'EEA', '2018-08-10', 'E-ELE110');
INSERT INTO "public"."est_material" VALUES ('18', '2/2018', 'demo', '<p>ertwertwert</p>
', '84', '', '', 'EEA', '2018-08-10', 'E-ELE110');

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table est_material
-- ----------------------------
ALTER TABLE "public"."est_material" ADD PRIMARY KEY ("id_material");
