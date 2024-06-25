CREATE DATABASE ticket_store;
USE ticket_store;

CREATE TABLE użytkownicy (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  hasło VARCHAR(255) NOT NULL,
  imię VARCHAR(255),
  nazwisko VARCHAR(255),
  data_rejestracji DATE
);

CREATE TABLE wydarzenia (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nazwa VARCHAR(255) NOT NULL,
  opis TEXT,
  data DATE,
  czas TIME,
  miejsce VARCHAR(255),
  cena_biletu DECIMAL(10, 2)
);

CREATE TABLE bilety (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_wydarzenia INT,
  id_użytkownika INT,
  ilość INT,
  data_zakupu DATE,
  FOREIGN KEY (id_wydarzenia) REFERENCES wydarzenia(id),
  FOREIGN KEY (id_użytkownika) REFERENCES użytkownicy(id)
);

CREATE TABLE transakcje (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_użytkownika INT,
  id_biletu INT,
  kwota DECIMAL(10, 2),
  status VARCHAR(255),
  data_transakcji DATE,
  FOREIGN KEY (id_użytkownika) REFERENCES użytkownicy(id),
  FOREIGN KEY (id_biletu) REFERENCES bilety(id)
);



INSERT INTO wydarzenia (nazwa, opis, data, czas, miejsce, cena_biletu) VALUES 
('Koncert Rockowy', 'Niesamowity koncert rockowy z udziałem popularnych zespołów.', '2023-07-10', '19:00:00', 'Stadion Narodowy, Warszawa', 150.00),
('Festiwal Filmowy', 'Międzynarodowy festiwal filmowy prezentujący filmy z całego świata.', '2023-08-15', '10:00:00', 'Kino Kultura, Warszawa', 50.00),
('Wystawa Sztuki Nowoczesnej', 'Wystawa prezentująca prace współczesnych artystów.', '2023-09-01', '09:00:00', 'Muzeum Sztuki Nowoczesnej, Warszawa', 30.00),
('Maraton Warszawski', '42,195 km biegu ulicami Warszawy.', '2023-09-30', '08:00:00', 'Centrum Warszawy', 100.00),
('Konferencja Naukowa', 'Międzynarodowa konferencja na temat najnowszych odkryć w dziedzinie fizyki kwantowej.', '2023-10-20', '09:00:00', 'Uniwersytet Warszawski', 200.00);
