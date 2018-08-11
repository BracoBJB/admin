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

Date: 2018-08-10 21:32:19
*/


-- ----------------------------
-- Table structure for est_material_grupo
-- ----------------------------
DROP TABLE IF EXISTS "public"."est_material_grupo";
CREATE TABLE "public"."est_material_grupo" (
"id_material" int8 NOT NULL,
"cod_grupo" text COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of est_material_grupo
-- ----------------------------
INSERT INTO "public"."est_material_grupo" VALUES ('7', 'EEA-101N');
INSERT INTO "public"."est_material_grupo" VALUES ('8', 'EEA-101T');
INSERT INTO "public"."est_material_grupo" VALUES ('9', 'EEA-101N');
INSERT INTO "public"."est_material_grupo" VALUES ('10', 'EEA-101N');
INSERT INTO "public"."est_material_grupo" VALUES ('10', 'EEA-102M');
INSERT INTO "public"."est_material_grupo" VALUES ('11', 'EEA-101N');
INSERT INTO "public"."est_material_grupo" VALUES ('12', 'EEA-101M');
INSERT INTO "public"."est_material_grupo" VALUES ('16', 'EEA-101N');
INSERT INTO "public"."est_material_grupo" VALUES ('17', 'EEA-201T');
INSERT INTO "public"."est_material_grupo" VALUES ('18', 'EEA-202T');

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table est_material_grupo
-- ----------------------------
ALTER TABLE "public"."est_material_grupo" ADD PRIMARY KEY ("id_material", "cod_grupo");
