CREATE TABLE `organizacao_atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organizacao_id` int(11) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_organizacao_atividade_organizacao1_idx` (`organizacao_id`),
  KEY `fk_organizacao_atividade_atividadees1_idx` (`atividade_id`),
  CONSTRAINT `fk_organizacao_atividade_organizacao1_idx` FOREIGN KEY (`organizacao_id`) REFERENCES `organizacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_organizacao_atividade_atividadees1_idx` FOREIGN KEY (`atividade_id`) REFERENCES `atividade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `saberdb`.`atividade`
DROP FOREIGN KEY `fk_atividade_organizacao1`;
ALTER TABLE `saberdb`.`atividade`
DROP COLUMN `organizacao_id`,
DROP INDEX `fk_atividade_organizacao1_idx` ;

