CREATE  TABLE `inventory`.`venderMaster` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(255) NULL ,
  `address1` VARCHAR(150) NULL ,
  `address2` VARCHAR(100) NULL ,
  `suburb` VARCHAR(45) NULL ,
  `state` VARCHAR(45) NULL ,
  `postcode` VARCHAR(45) NULL ,
  `country` VARCHAR(45) NULL ,
  `termscode` VARCHAR(45) NULL ,
  `extrafield1` VARCHAR(100) NULL ,
  `extrafield2` VARCHAR(100) NULL ,
  `extrafield3` VARCHAR(100) NULL ,
  PRIMARY KEY (`Id`) );

ALTER TABLE `inventory`.`venderMaster` ADD COLUMN `createby` DATETIME NULL  AFTER `extrafield3` , ADD COLUMN `updatedby` DATETIME NULL  AFTER `createby` ;
ALTER TABLE `inventory`.`venderMaster` CHANGE COLUMN `createby` `createdate` DATETIME NULL DEFAULT NULL  , CHANGE COLUMN `updatedby` `updateddate` DATETIME NULL DEFAULT NULL  ;


CREATE  TABLE `inventory`.`items` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `vendorID` VARCHAR(45) NULL ,
  `description` VARCHAR(255) NULL ,
  `extraDescription` VARCHAR(255) NULL ,
  `purchasingUOM` VARCHAR(45) NULL ,
  `sellingUOM` VARCHAR(45) NULL ,
  `stockingUOM` VARCHAR(45) NULL ,
  `drawingNumber` VARCHAR(45) NULL ,
  `cost` VARCHAR(45) NULL ,
  `listPrice` VARCHAR(45) NULL ,
  `leadTime` VARCHAR(45) NULL ,
  `abcCode` VARCHAR(45) NULL ,
  `exfield1` VARCHAR(200) NULL ,
  `exfield2` VARCHAR(200) NULL ,
  `exfield3` VARCHAR(200) NULL ,
  `createddate` DATETIME NULL ,
  `updatedate` DATETIME NULL ,
  PRIMARY KEY (`id`) );


  