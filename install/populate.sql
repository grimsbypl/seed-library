USE `seeddb`;
INSERT INTO `users` (DateReg, NameFirst, NameLast, Email, Password, Admin) VALUES(now(), 'Admin', 'User', 'admin@library.com', md5('iloveseeds'), 1);
INSERT INTO `seeds` (Common_Name, Latin_Name, Variety, Year_Harvested, Location, Experience, Notes) VALUES('Sunflower', 'Helianthus Annuus', 'Titan', 2012, 'Somehere', 1, '');
INSERT INTO `transactions` (Date, UserID, SeedId, Count) VALUES(now(), 1, 1, 1);
