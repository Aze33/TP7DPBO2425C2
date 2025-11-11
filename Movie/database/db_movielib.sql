CREATE DATABASE db_movielib;
USE db_movielib;

CREATE TABLE tbl_genre (
    id_genre INT AUTO_INCREMENT PRIMARY KEY,
    nama_genre VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE tbl_sutradara (
    id_sutradara INT AUTO_INCREMENT PRIMARY KEY,
    nama_sutradara VARCHAR(100) NOT NULL,
    negara_asal VARCHAR(50)
);

CREATE TABLE tbl_film (
    id_film INT AUTO_INCREMENT PRIMARY KEY,
    judul_film VARCHAR(150) NOT NULL,
    tahun_rilis INT(4),
    durasi_menit INT,
    rating_usia VARCHAR(5),
    id_genre INT,
    id_sutradara INT,
    
    FOREIGN KEY (id_genre) 
        REFERENCES tbl_genre(id_genre)
        ON DELETE SET NULL ON UPDATE CASCADE,
        
    FOREIGN KEY (id_sutradara) 
        REFERENCES tbl_sutradara(id_sutradara)
        ON DELETE SET NULL ON UPDATE CASCADE
);

-- Data Contoh
INSERT INTO tbl_genre (nama_genre) VALUES 
('Sci-Fi'), ('Action'), ('Drama'), ('Comedy'), ('Horror');

INSERT INTO tbl_sutradara (nama_sutradara, negara_asal) VALUES 
('Christopher Nolan', 'UK'), 
('James Cameron', 'Canada'),
('Joko Anwar', 'Indonesia');

INSERT INTO tbl_film (judul_film, tahun_rilis, durasi_menit, rating_usia, id_genre, id_sutradara) VALUES 
('Inception', 2010, 148, 'PG-13', 1, 1),
('Avatar', 2009, 162, 'PG-13', 2, 2),
('Pengabdi Setan 2', 2022, 119, 'R', 5, 3);