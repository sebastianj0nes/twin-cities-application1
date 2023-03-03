CREATE TABLE city (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    lat DECIMAL(8,6) NOT NULL, 
    lon DECIMAL(9,6) NOT NULL,
    population INT,
    country VARCHAR(45) NOT NULL,
    wiki VARCHAR(100) NOT NULL,
    events VARCHAR(500)
);

CREATE TABLE location_type (
    id INT PRIMARY KEY AUTO_INCREMENT,
    l_type VARCHAR(50)
);

CREATE TABLE place_of_interest (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    lat DECIMAL(8,6) NOT NULL, 
    lon DECIMAL(9,6) NOT NULL,
    established INT,
    description VARCHAR(1500),
    capacity INT,
    wiki VARCHAR(100),
    website VARCHAR(100),
    postcode VARCHAR(60),
    address_line1 VARCHAR(200),
    address_line2 VARCHAR(200),
    city_id INT NOT NULL,
    l_type_id INT,
    FOREIGN KEY (l_type_id) REFERENCES location_type(id),
    FOREIGN KEY (city_id) REFERENCES city(id) 
);

CREATE TABLE image (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100),
    img_desc VARCHAR(100),
    img_link VARCHAR(100),
    place_of_interest_id INT,
    city_id INT NOT NULL,
    FOREIGN KEY (place_of_interest_id) REFERENCES place_of_interest(id),
    FOREIGN KEY (city_id) REFERENCES city(id)
)

--Adding Location Types
--Not sure what location type is meant to be, so Im making it associated to what type activity the POI is, and so one location_type can have multiple POIs, but a POI can only have one location type.
INSERT INTO location_type(`l_type`) VALUES ('History');
INSERT INTO location_type(`l_type`) VALUES ('Culture');
INSERT INTO location_type(`l_type`) VALUES ('Nature');

-- --Inputing Edinburgh data
INSERT INTO city(`name`, `lat`, `lon`, `population`, `country`, `wiki`, `events`) VALUES ('Edinburgh', '55.954251',' -3.19267', '554000', 'Scotland', 'https://en.wikipedia.org/wiki/Edinburgh', 'Edinburgh Fringe Festival, Royal Edinburgh Military Tattoo, International Sciencee Festival');

-- --Inputing Munich data
INSERT INTO city(`name`, `lat`, `lon`, `population`, `country`, `wiki`, `events`) VALUES ('Munich', '48.158132', '11.560550', '1456000', 'Germany', 'https://en.wikipedia.org/wiki/Munich', 'Oktoberfest, Tollwood Festival, Kocherlball');

INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Edinburgh Castle', '55.948612', '-3.200833', '1103', 'Edinburgh Castle is a historic castle in Edinburgh, Scotland. It stands on Castle Rock, which has been occupied by humans since at least the Iron Age, although the nature of the early settlement is unclear. There has been a royal castle on the rock since at least the reign of David I in the 12th century, and the site continued to be a royal residence until 1633. From the 15th century, the castle''s residential role declined, and by the 17th century it was principally used as military barracks with a large garrison. Its importance as a part of Scotland''s national heritage was recognised increasingly from the early 19th century onwards, and various restoration programmes have been carried out over the past century and a half.', '1000', 'https://en.wikipedia.org/wiki/Edinburgh_Castle', 'https://www.edinburghcastle.scot/', 'EH1 2NG', 'Castlehill', 'Edinburgh', '1', '1');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('National Museum of Scotland', '55.947519', '-3.190422', '1866', 'The National Museum of Scotland in Edinburgh, Scotland, was formed in 2006 with the merger of the new Museum of Scotland, with collections relating to Scottish antiquities, culture and history, and the adjacent Royal Scottish Museum (opened in 1866 as the Edinburgh Museum of Science and Art, renamed in 1904, and for the period between 1985 and the merger named the Royal Museum of Scotland or simply the Royal Museum), with international collections covering science and technology, natural history, and world cultures. The two connected buildings stand beside each other on Chambers Street, by the intersection with the George IV Bridge, in central Edinburgh. The museum is part of National Museums Scotland. Admission is free.', '1500', 'https://en.wikipedia.org/wiki/National_Museum_of_Scotland', 'https://www.nms.ac.uk/national-museum-of-scotland/', 'EH1 1JF', 'Chambers Street', 'Edinburgh', '1', '2');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Royal Botanic Garden', '55.965286', '-3.209155', '1670', '"The Royal Botanic Garden Edinburgh (RBGE) is a scientific centre for the study of plants, their diversity and conservation, as well as a popular tourist attraction. Founded in 1670 as a physic garden to grow medicinal plants, today it occupies four sites across Scotland—Edinburgh, Dawyck, Logan and Benmore—each with its own specialist collection. The RBGE''s living collection consists of more than 13,302 plant species (34,422 accessions), whilst the herbarium contains in excess of 3 million preserved specimens. The Royal Botanic Garden Edinburgh is an executive non-departmental public body of the Scottish Government. The Edinburgh site is the main garden and the headquarters of the public body, which is led by Regius Keeper Simon Milne.', '1000', 'https://en.wikipedia.org/wiki/Royal_Botanic_Garden_Edinburgh', 'https://www.rbge.org.uk/', 'EH3 5NZ', 'Arboretum Place', 'Edinburgh', '1', '3');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Palace of Holyrood House', '55.953905', '-3.171916', '1671', 'The Palace of Holyroodhouse, commonly referred to as Holyrood Palace or Holyroodhouse, is the official residence of the British monarch in Scotland. Located at the bottom of the Royal Mile in Edinburgh, at the opposite end to Edinburgh Castle, Holyroodhouse has served as the principal royal residence in Scotland since the 16th century, and is a setting for state occasions and official entertaining.', '200', 'https://en.wikipedia.org/wiki/Holyrood_Palace', 'https://www.rct.uk/visit/palace-of-holyroodhouse', 'EH8 8DX', 'Canongate', 'Edinburgh', '1', '1');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Scottish National Gallery of Modern Art', '55.951983', '-3.228049', '1984', '"The Scottish National Gallery of Modern Art is part of the National Galleries of Scotland, which are based in Edinburgh, Scotland. The National Gallery of Modern Art houses the collection of modern and contemporary art dating from about 1900 to the present in two buildings, Modern One and Modern Two, that face each other on Belford Road to the west of the city centre. The National Gallery has a collection of more than 6000 paintings, sculptures, installations, video work, prints and drawings and also stages major exhibitions.', '1000', 'https://en.wikipedia.org/wiki/Scottish_National_Gallery_of_Modern_Art', 'https://www.nationalgalleries.org/visit/scottish-national-gallery-modern-art', 'EH4 3DS', '73 and 75 Belford Road', 'Edinburgh', '1', '2');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('The Scotch Whiskey Experience', '55.94875', '-3.195815', '1987', 'The Scotch Whisky Experience is a whisky visitor attraction located on Castlehill in the Old Town of Edinburgh, immediately adjacent to the esplanade of Edinburgh Castle. The centre offers tours and whisky tutoring sessions, alonside a shop, corporate spaces and Amber Restaurant & Whisky Bar.', '150', 'https://en.wikipedia.org/wiki/Scotch_Whisky_Experience', 'https://www.scotchwhiskyexperience.co.uk/', 'EH1 2NE', '354 Castlehill', 'Edinburgh', '1', '2');

INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Marienplatz', '48.13744', '11.57545', '1158', 'Marienplatz (English: Mary''s Square, i.e. St. Mary, Our Lady''s Square) is a central square in the city centre of Munich, Germany. It has been the city''s main square since 1158.', '5000', 'https://en.wikipedia.org/wiki/Marienplatz', 'https://www.munich.travel/en/pois/urban-districts/marienplatz#/', '80331', 'Marienplatz', 'München', '2', '1');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('English Garden Munich', '48.16428', '11.60552', '1789', '"The Englischer Garten (English Garden) is a large public park in the centre of Munich, Bavaria, stretching from the city centre to the northeastern city limits. It was created in 1789 by Sir Benjamin Thompson (1753-1814), later Count Rumford (Reichsgraf von Rumford), for Prince Charles Theodore, Elector of Bavaria. Thompson''s successors, Reinhard von Werneck (1757-1842) and Friedrich Ludwig von Sckell (1750-1823), advisers on the project from its beginning, both extended and improved the park. With an area of 3.7 km2 (1.4 sq mi) (370 ha or 910 acres), the Englischer Garten is one of the world''s largest urban public parks. The name refers to its English garden form of informal landscape, a style popular in England from the mid-18th century to the early 19th century and particularly associated with Capability Brown.', '7000', 'https://en.wikipedia.org/wiki/Englischer_Garten', 'https://www.muenchen.de/en/sights/attractions/english-garden', '80805', 'Englischer Garten', 'München', '2', '3');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Nymphenburg Palace', '48.15833', '11.50372', '1675', 'The Nymphenburg Palace is a Baroque palace situated in Munich''s western district Neuhausen-Nymphenburg, in Bavaria, southern Germany. Combined with the adjacent Nymphenburg Palace Park it constitutes one of the premier royal palaces of Europe. Its frontal width of 632 m (2,073 ft) (north-south axis) even surpasses Versailles Palace. The Nymphenburg served as the main summer residence for the former rulers of Bavaria of the House of Wittelsbach.', '400', 'https://en.wikipedia.org/wiki/Nymphenburg_Palace', 'https://www.schloss-nymphenburg.de/englisch/palace/', '80638', 'Schloß Nymphenburg 1', 'München', '2', '1');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Asankirche', '48.13526', '11.56968', '1746', 'St. Johann Nepomuk, better known as the Asam Church, is a Baroque church in Munich, southern Germany. It was built from 1733 to 1746 by a pair of brothers, sculptor Egid Quirin Asam and painter Cosmas Damian Asam, as their private church. It is considered to be one of the most important buildings of the southern German Late Baroque.', '7000', 'https://en.wikipedia.org/wiki/Asam_Church,_Munich', 'https://www.munich.travel/en/pois/urban-districts/asamkirche', '80331', 'Sendlinger Str. 32', 'München', '2', '1');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('Olympiapark', '48.17554', '11.55179', '1972', 'The Olympiapark in Munich, Germany, is an Olympic Park which was constructed for the 1972 Summer Olympics. Located in the Oberwiesenfeld neighborhood of Munich, the Park continues to serve as a venue for cultural, social, and religious events, such as events of worship. It includes a contemporary carillon.', '69250', 'https://en.wikipedia.org/wiki/Olympiapark_(Munich)', 'https://www.olympiapark.de/en/olympiapark-munich/', '80809', 'Spiridon-Louis-Ring 21', 'München', '2', '2');
INSERT INTO place_of_interest(`name`, `lat`, `lon`, `established`, `description`, `capacity`, `wiki`, `website`, `postcode`, `address_line1`, `address_line2`, `city_id`, `l_type_id`) VALUES ('BMW Museum', '48.176907', '11.559360', '1973', 'The BMW Museum is an automobile museum of BMW history located near the Olympiapark in Munich, Germany. The museum was established in 1973, shortly after the Summer Olympics opened. From 2004 to 2008, it was renovated in connection with the construction of the BMW Welt, directly opposite. The museum reopened on 21 June 2008. At the moment the exhibition space is 5,000 square metres for the presentation of about 120 exhibits.', '600', 'https://en.wikipedia.org/wiki/BMW_Museum', 'https://www.bmw-welt.com/en.html', '80809', 'Am Olympiapark 2', 'München', '2', '2');

