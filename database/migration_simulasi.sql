CREATE TABLE simulasi_matriks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_elemen VARCHAR(20) NOT NULL,
    jenjang VARCHAR(10) NOT NULL,
    bobot DECIMAL(5,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Seeder untuk D3 (Berdasarkan Lampiran Tabel Bobot Butir D3 Halaman 170-182)
INSERT INTO simulasi_matriks (kode_elemen, jenjang, bobot) VALUES
('C.1.4', 'D3', 0.52),
('C.2.4.a', 'D3', 0.35),
('C.2.4.b', 'D3', 0.35),
('C.2.4.c', 'D3', 0.69),
('C.3.4.a', 'D3', 4.68),
('C.3.4.b', 'D3', 3.12),
('C.3.4.c', 'D3', 1.56),
('C.4.4.a', 'D3', 0.62), 
('C.4.4.b', 'D3', 0.91), 
('C.4.4.c', 'D3', 2.27), 
('C.4.4.d', 'D3', 1.13), 
('C.5.4.a', 'D3', 0.78), 
('C.5.4.b', 'D3', 3.12), 
('C.6.4.a', 'D3', 2.55), 
('C.6.4.b', 'D3', 0.85), 
('C.6.4.c', 'D3', 1.70), 
('C.6.4.d', 'D3', 1.13), 
('C.6.4.e', 'D3', 2.55), 
('C.6.4.f', 'D3', 1.70), 
('C.6.4.g', 'D3', 1.70), 
('C.6.4.h', 'D3', 2.55), 
('C.6.4.i', 'D3', 3.40), 
('C.7.4.a', 'D3', 1.56), 
('C.7.4.b', 'D3', 3.07), 
('C.8.4.a', 'D3', 1.04), 
('C.8.4.b', 'D3', 2.08), 
('C.9.4.a', 'D3', 2.03), 
('C.9.4.b', 'D3', 2.88); 

CREATE TABLE simulasi_skor_sistem (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriks_id INT NOT NULL,
    skor DECIMAL(5,2) NOT NULL DEFAULT 0,
    nilai DECIMAL(5,2) NOT NULL DEFAULT 0,
    last_calculated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (matriks_id) REFERENCES simulasi_matriks(id) ON DELETE CASCADE
);

CREATE TABLE simulasi_skor_asesor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matriks_id INT NOT NULL,
    skor DECIMAL(5,2) NOT NULL DEFAULT 0,
    nilai DECIMAL(5,2) NOT NULL DEFAULT 0,
    catatan TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (matriks_id) REFERENCES simulasi_matriks(id) ON DELETE CASCADE
);
