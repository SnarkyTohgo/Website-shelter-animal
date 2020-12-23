PRAGMA foreign_keys = ON;

BEGIN TRANSACTION;

-- @CLASSES

-- USER
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
    password VARCHAR(255), 
    email VARCHAR(255), 
	firstName VARCHAR(255),
    lastName VARCHAR(255),
    morada VARCHAR(255) UNIQUE,
    zipCod CHAR(10),
    coverImg VARCHAR(255)
);

-- PET
DROP TABLE IF EXISTS Pet;
CREATE TABLE Pet (
    idPet INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255),
    age INTEGER,
    gender TINYINT,
    weight FLOAT(2,1),
    location VARCHAR(255),
    description VARCHAR(200000),
    image VARCHAR(255),
    adopted TINIINT(2) DEFAULT 0,
	idUser INTEGER,
    idMessage INTEGER,
    idType INTEGER,
    idBreed INTEGER,
    FOREIGN KEY (idType) REFERENCES Type(idType),
    FOREIGN KEY (idBreed) REFERENCES Breed(idBreed),
    FOREIGN KEY (idUser) REFERENCES User(idUser),
    FOREIGN KEY (idMessage) REFERENCES Message(idMessage)
);

-- TYPE
DROP TABLE IF EXISTS Type;
CREATE TABLE Type (
    idType INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255)
);

-- Breed
DROP TABLE IF EXISTS Breed;
CREATE TABLE Breed (
    idBreed INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255),
  	idType INTEGER,
    FOREIGN KEY (idType) REFERENCES Type(idType)
);

-- LOST AND FOUND
DROP TABLE IF EXISTS LostAndFound;
CREATE TABLE LostAndFound (
    idLostAndFound INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255),
    contact VARCHAR(200000),
    location VARCHAR(255),
    email VARCHAR(255),
    image VARCHAR(255),
    idType INTEGER,
    FOREIGN KEY (idType) REFERENCES Type(idType)
);

-- MESSAGE
DROP TABLE IF EXISTS Message;
CREATE TABLE Message (
    idMessage INTEGER PRIMARY KEY AUTOINCREMENT,
    messageDate DATE,
    body VARCHAR(200000),
    idSender INTEGER,
    idReceiver INTEGER,
    hasResponse TINYINT(2) DEFAULT 0,
    FOREIGN KEY (idSender) REFERENCES User(idUser),
    FOREIGN KEY (idReceiver) REFERENCES User(idUser)
);


-- @ASSOCIATIONS

-- ASK FOR ADOPTION
DROP TABLE IF EXISTS Adopt;
CREATE TABLE Adopt (
	idUser INTEGER,
	idPet INTEGER,
    adoptionDate DATE,
    adoptionProposal VARCHAR(200000),
    proposalResponse TINYINT DEFAULT NULL,
    responded TINYINT(2) DEFAULT 0,
    FOREIGN KEY (idUser) REFERENCES User(idUser),
    FOREIGN KEY (idPet) REFERENCES Pet(idPet),
    PRIMARY KEY (idUser, idPet)
);

-- FAVOURITE
DROP TABLE IF EXISTS Favourite;
CREATE TABLE Favourite (
	idUser INTEGER,
	idPet INTEGER,
    FOREIGN KEY (idUser) REFERENCES User(idUser),
    FOREIGN KEY (idPet) REFERENCES Pet(idPet),
    PRIMARY KEY (idUser, idPet)
);


-- @POPULATE

-- INSERT TYPES

INSERT INTO `type` 
	(name) 
VALUES 
    ('cao'), 
    ('gato'), 
    ('pequeno');


-- INSERT BREEDS

INSERT INTO `breed` (
        name, 
        idType
)
VALUES
    ('Sem raça', 1),
    ('Sem raça', 2),
    ('Sem raça', 3),
    ('Abissínio', 2),
    ('Angorá', 2),
    ('Ashera', 2),
    ('Balinês', 2),
    ('Bengal', 2),
    ('Bobtail americano', 2),
    ('Bobtail japonês', 2),
    ('Bombay', 2),
    ('Burmês', 2),
    ('Chartreux', 2),
    ('Colorpoint de Pêlo Curto', 2),
    ('Cornish Rex', 2),
    ('Curl Americano', 2),
    ('Devon Rex', 2),
    ('Himalaio', 2),
    ('Jaguatirica', 2),
    ('Javanês', 2),
    ('Korat', 2),
    ('LaPerm', 2),
    ('Maine Coon', 2),
    ('Manx', 2),
    ('Mau Egípcio', 2),
    ('Mist Australiano', 2),
    ('Munchkin', 2),
    ('Norueguês da Floresta', 2),
    ('Pelo curto americano', 2),
    ('Pelo curto brasileiro', 2),
    ('Pelo curto europeu', 2),
    ('Pelo curto inglês', 2),
    ('Persa', 2),
    ('Pixie-bob', 2),
    ('Ragdoll', 2),
    ('Ocicat', 2),
    ('Russo Azul', 2),
    ('Sagrado da Birmânia', 2),
    ('Savannah', 2),
    ('Scottish Fold', 2),
    ('Selkirk Rex', 2),
    ('Siamês', 2),
    ('Siberiano', 2),
    ('Singapura', 2),
    ('Somali', 2),
    ('Sphynx', 2),
    ('Thai', 2),
    ('Tonquinês', 2),
    ('Toyger', 2),
    ('Usuri', 2),
    ('Kelpie australiano', 1),
    ('Pastor-australiano', 1),
    ('Pastor-belga', 1),
    ('Schipperke', 1),
    ('Cão lobo checoslovaco', 1),
    ('Pastor croata', 1),
    ('Pastor-alemão', 1),
    ('Pastor-maiorquino', 1),
    ('Pastor-catalão', 1),
    ('Pastor-de-beauce', 1),
    ('Pastor-de-brie', 1),
    ('Pastor-da-picardia', 1),
    ('Pastor-dos-pirinéus-de-pelo-comprido', 1),
    ('Pastor-dos-pirinéus-de-pelo-curto', 1),
    ('Bearded collie', 1),
    ('Border collie', 1),
    ('Rough collie', 1),
    ('Smooth collie', 1),
    ('Old english sheepdog', 1),
    ('Pastor-de-shetland', 1),
    ('Welsh corgi cardigan', 1),
    ('Welsh corgi pembroke', 1),
    ('Pastor-bergamasco', 1),
    ('Pastor-maremano-abruzês', 1),
    ('Komondor', 1),
    ('Kuvasz', 1),
    ('Mudi', 1),
    ('Puli', 1),
    ('Pumi', 1),
    ('Pastor-holandês', 1),
    ('Cão lobo de Saarloos', 1),
    ('Schapendoes', 1),
    ('Pastor-polonês-da-planície', 1),
    ('Pastor-de-tatra', 1),
    ('Cão da Serra de Aires', 1),
    ('Pastor-romeno-miorítico', 1),
    ('Pastor-romeno-dos-cárpatos', 1),
    ('Pastor-da-rússia-meridional', 1),
    ('Cuvac eslovaco', 1),
    ('Pastor-branco-suíço', 1),
    ('Lancashire heeler', 1),
    ('Chodský Pes', 1),
    ('Pastor americano miniatura', 1),
    ('Boiadeiro australiano', 1),
    ('Boiadeiro das Ardenas', 1),
    ('Boiadeiro da Flandres', 1),
    ('Boiadeiro australiano de cauda chata', 1),
    ('Affenpinscher', 1),
    ('Dobermann', 1),
    ('Pinscher alemão', 1),
    ('Pinscher austríaco', 1),
    ('Pinscher miniatura', 1),
    ('Cão fazendeiro da Dinamarca e Suécia', 1),
    ('Schnauzer gigante', 1),
    ('Schnauzer', 1),
    ('Schnauzer miniatura', 1),
    ('Cão dagua português', 1),
    ('Cão dagua espanhol', 1),
    ('Maltês', 1),
    ('Bichon frisé', 1),
    ('Caniche', 1),
    ('Shih-tzu', 1),
    ('Terrier tibetano', 1),
    ('King charles spaniel', 1),
    ('Cavalier king charles spaniel', 1),
    ('Spaniel anão continental', 1),
    ('Pequeno cão russo', 1),
    ('Bulldog francês', 1),
    ('Boston terrier', 1),
    ('Wolfhound irlandês', 1),
    ('Deerhound', 1),
    ('Galgo', 1),
    ('American bully', 1),
    ('Toy Fox Terrier', 1),
    ('Cão de gado transmontano', 1),
    ('Serra da estrela', 1),
    ('Husky siberiano', 1),
    ('Samoieda', 1),
    ('Malamute', 1),
    ('Akita Inu', 1),
    ('Papagaio Chauá', 3),
    ('Papagaio verdadeiro', 3),
    ('Papagaio de hispaniola', 3),
    ('Papagaio de Porto-rico', 3),
    ('Hamster Chinês', 3),
    ('Hamster Sírio', 3),
    ('Hamster anão russo', 3),
    ('Leopard Gecko', 3),
    ('Dragão Barbudo', 3),
    ('Lagarto de língua azul', 3),
    ('Iguana Verde', 3),
    ('Rex', 3),
    ('Anão holandês', 3),
    ('Angorá inglês', 3),
    ('Cabeça de leão', 3);



-- INSERT USERS

INSERT INTO User (
    password,
    email,
	firstName,
    lastName,
    morada,
    zipCod,
    coverImg
)
VALUES 
(
    '$2y$12$Clwk95vXtV4wbYR8JEObxOAz9bjBFucnYaEwzoRPgTLULEGFIKS2C',
    "manel@feup.pt",
    "Manel",
    "Doe",
    "morada abc",
    12345678,
    NULL
),
(
    '$2y$12$Clwk95vXtV4wbYR8JEObxOAz9bjBFucnYaEwzoRPgTLULEGFIKS2C',
    "maria@feup.pt",
    "Maria",
    "Doe",
    "morada defg",
    98745612,
    NULL
);


-- INSERT PETS

INSERT INTO `Pet`(
    name,
    age,
    gender,
    weight,
    location,
    description,
    image,
    idType,
    idBreed,
    idUser
)
VALUES 
    ('Rebeca', 2.1, 1, 3, 'Porto', 
    'Esta linda gatinha tinha problemas de saúde e a sua família não tinha condições para a tratar, por isso ela veio até nós e nós rapidamente encontramos um lugar para ela no nosso abrigo. Ela é uma adorável gatinha doméstica de pelo curto com 4 anos e pesa cerca de 2kg. A Rebeca adora afetos e está à procura da pessoa especial com quem passar o resto da sua vida. Ela é fantástica dentro de casa e gosta de comida seca para gatos.',
    'adopt-cats-2-370x240.jpg', 2, 11, 2),
    ('Poly', 2.5, 1, 2.3, 'Aveiro',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-cats-3-370x240.jpg', 2, 11, 2),
    ('Tino', 10, 0, 1.8, 'Coimbra',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-cats-4-370x240.jpg', 2, 13, 1),
    ('Princesa', 2.1, 1, 2.8, 'Porto',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-cats-5-370x240.jpg', 2, 12, 1),
    ('Biscoito', 2.5, 0, 19, 'Lisboa', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-dogs-1-370x254.jpg', 1, 77, 1),
    ('Tosta', 12, 1, 21, 'Porto',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-dogs-2-370x254.jpg', 1, 78, 2),
    ('Oscar', 10, 0, 41, 'Castelo Branco', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-dogs-3-370x254.jpg', 1, 81, 2),
    ('Nike', 4.4, 0, 29, 'Porto',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-dogs-4-370x254.jpg', 1, 84, 2),
    ('Brittany', 1, 1, 2, 'Porto', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-2-96x107.jpg', 3, 133, 2),
    ('Marta', 1, 1, 2, 'Porto', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-6-96x107.jpg', 3, 134, 2),
    ('Harlow', 1, 1, 2, 'Porto', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-3-96x107.jpg', 3, 142, 2),
    ('Mink', 1, 1, 2, 'Porto', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-7-96x107.jpg', 3, 143, 2),
    ('August', 1, 1, 2, 'Porto', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-4-96x107.jpg', 3, 140, 2),
    ('Penelope', 1, 1, 2, 'Porto', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-8-96x107.jpg', 3, 141, 2),
    ('Cristina', 1, 1, 2, 'Porto', 
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-5-96x107.jpg', 3, 141, 2),
    ('Macy', 1, 1, 2, 'Porto',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut aliquam ipsum, at pulvinar velit. Pellentesque eget dolor vulputate, congue neque sit amet, convallis nunc. Mauris dignissim, augue in finibus mattis, orci ligula maximus est, id ornare lacus metus ac ante. Suspendisse at aliquet ante. Praesent aliquam orci nisl, in maximus nunc vulputate sit amet. Integer eget imperdiet eros. Ut vel enim auctor, blandit orci sed, pretium augue. Suspendisse potenti. Nullam feugiat ante at velit lobortis, vel iaculis arcu dignissim. Praesent quis orci rhoncus neque accumsan placerat. Fusce commodo orci arcu, in condimentum diam fringilla vitae. Ut mauris nibh, tincidunt a nisi non, semper laoreet ipsum.',
    'adopt-small-pets-9-96x107.jpg', 3, 141, 2);


-- INSERT LOST AND FOUND

INSERT INTO LostAndFound (
    title,
    contact,
    location,
    email,
    image,
    idType
)
VALUES
    ('Gato Europeu Comum de Pelo Curto', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-1-370x320.jpg', 2),
    ('Huskies', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-2-370x320.jpg', 1),
    ('Gato Europeu Comum Raçado', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-3-370x320.jpg', 1),
    ('Hamster Macho', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-4-370x320.jpg', 3),
    ('Gato Europeu Comum', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-5-370x320.jpg', 2),
    ('Coelho Angora Francês', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-6-370x320.jpg', 3),
    ('Papagaio Macho', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-7-370x320.jpg', 3),
    ('Raçado Mastiff', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-8-370x320.jpg', 1),
    ('Hamster Fêmea', 912345678, 'Porto', 'test@test.pt', 'grid-gallery-9-370x320.jpg', 3);

COMMIT TRANSACTION;
