ALTER TABLE `playerhistory` CHANGE `tryNumber` `tryNumber` INT NOT NULL DEFAULT '0';
ALTER TABLE `dailymovie` CHANGE `date` `date` DATE NOT NULL, CHANGE `idMovie` `idMovie` INT NOT NULL;