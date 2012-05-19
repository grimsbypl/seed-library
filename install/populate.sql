USE `seeddb`;
INSERT INTO `users` (DateReg, NameFirst, NameLast, Email, Password, Admin) values(now(), 'Admin', 'User', 'admin@library.com', md5('iloveseeds'), 1);
