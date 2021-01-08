-- Generated and Designed by Kristof Friess
-- Copyright Kristof Friess 

-- -----------------------------------------------------
-- Data for table `notenspiegel`.`student`
-- -----------------------------------------------------
START TRANSACTION;

INSERT INTO `notenspiegel`.`student` (`id`, `createdAt`, `updatedAt`, `email`, `firstname`, `lastname`, `secondname`, `gender`, `street`, `streetNumber`, `city`, `zipCode`, `phone`, `matriculationNumber`) VALUES (1, '2018-10-10 22:00:00', NULL, 'student@fh-erfurt.de', 'Max', 'Mustermann', NULL, 'm', 'Altonaer Straße', '25', 'Erfurt', '99085', NULL, '13370815');

COMMIT;


-- -----------------------------------------------------
-- Data for table `notenspiegel`.`login`
-- -----------------------------------------------------
START TRANSACTION;

INSERT INTO `notenspiegel`.`login` (`id`, `createdAt`, `updatedAt`, `validated`, `enabled`, `username`, `lastActive`, `lastLogin`, `failedLoginCount`, `passwordHash`, `passwordResetHash`, `passwordResetCreatedAt`, `student`) VALUES (1, '2018-10-10 22:00:00', '2018-10-10 22:00:00', 1, 1, 'student', NULL, NULL, 0, '$2y$10$TvcY.94AgmVRQ0JCqXZ43.gBQH.HB6HOCOnBzWvIKTAbcR2btmqJW', NULL, NULL, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `notenspiegel`.`module`
-- -----------------------------------------------------
START TRANSACTION;

INSERT INTO `notenspiegel`.`module` (`id`, `createdAt`, `updatedAt`, `number`, `name`, `active`, `createdBy`) VALUES (1, '2018-10-01 00:00:00', NULL, 'BAAI-1110', 'Mathematik 1', 1, 1);
INSERT INTO `notenspiegel`.`module` (`id`, `createdAt`, `updatedAt`, `number`, `name`, `active`, `createdBy`) VALUES (2, '2018-10-01 00:00:00', NULL, 'BAAI-1210', 'Mathematik 2', 1, 1);
INSERT INTO `notenspiegel`.`module` (`id`, `createdAt`, `updatedAt`, `number`, `name`, `active`, `createdBy`) VALUES (3, '2018-10-01 00:00:00', NULL, 'BAAI-1520', 'Algorithmen', 1, 1);

COMMIT;