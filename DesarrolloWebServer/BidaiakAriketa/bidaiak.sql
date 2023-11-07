-- Crear la base de datos "Bidaiak"
CREATE DATABASE IF NOT EXISTS Bidaiak;
USE Bidaiak;

-- Crear la tabla "Usuarios"
CREATE TABLE Usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50),
  apellido_1 VARCHAR(50),
  apellido_2 VARCHAR(50),
  DNI VARCHAR(20),
  telefono VARCHAR(15),
  nombre_Usuario VARCHAR(20),
  contraseña VARCHAR(100)
);

-- Crear la tabla "Opcion_viaje" (Opción de viaje)
CREATE TABLE Opcion_viaje (
  id_viaje INT AUTO_INCREMENT PRIMARY KEY,
  lugar VARCHAR(100),
  estado VARCHAR(50),
  num_dias INT,
  descripción TEXT,
  precio DECIMAL(10, 2)
);

-- Crear la tabla "Usuario_viajes" (Relación entre usuarios y viajes)
CREATE TABLE Usuario_viajes (
  id_viaje_usuario INT AUTO_INCREMENT PRIMARY KEY,
  id_viaje INT,
  num_viajeros INT,
  fecha DATE,
  DNI VARCHAR(20),
  FOREIGN KEY (id_viaje) REFERENCES Opcion_viaje(id_viaje)
);

-- Crear la tabla "Opciones_visita" (Opción de visita)
CREATE TABLE Opciones_visita (
  id_visita INT AUTO_INCREMENT PRIMARY KEY,
  nom_visita VARCHAR(100),
  descripción_visita TEXT,
  duración INT,
  precio DECIMAL(10, 2)
);

-- Crear la tabla "Usuario_viaje_visita" (Relación entre usuarios, viajes y visitas)
CREATE TABLE Usuario_viaje_visita (
  id_erab_bidai_bisita INT AUTO_INCREMENT PRIMARY KEY,
  id_viaje_usuario INT,
  id_visita INT,
  FOREIGN KEY (id_viaje_usuario) REFERENCES Usuario_viajes(id_viaje_usuario),
  FOREIGN KEY (id_visita) REFERENCES Opciones_visita(id_visita)
);
