<?php
require_once "./app/config/config.php";
class DbHelper
{

  public static function connect_db()
  {
    try {
      $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
      return $conn;
    } catch (PDOException $e) {
      $conn = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
      // set the PDO error mode to exception
      $sql = "CREATE DATABASE " . DB_NAME;
      $conn->exec($sql);

      $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "", DB_USER, DB_PASS);

      $sql = "CREATE TABLE `generos` (
        `id` int(11) NOT NULL,
        `nombre` varchar(50) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
      
      ALTER TABLE `generos`
      ADD PRIMARY KEY (`id`);
      
      ALTER TABLE `generos`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;"
      ;
      $conn->exec($sql);

      $sql = "INSERT INTO `generos` (`id`, `nombre`) VALUES
      (6, 'Terror'),
      (8, 'Aventura'),
      (9, 'Accion'),
      (10, 'Locura'),
      (11, 'FPS');
      ";
      $conn->exec($sql);

      $sql = "CREATE TABLE `juegos` (
        `id` int(11) NOT NULL,
        `nombre` varchar(100) NOT NULL,
        `precio` float NOT NULL,
        `genero` int(11) NOT NULL,
        `desarrolladora` varchar(100) NOT NULL,
        `micro_transacciones` tinyint(1) NOT NULL,
        `lanzamiento` varchar(25) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

      ALTER TABLE `juegos`
      ADD PRIMARY KEY (`id`);
      

      ALTER TABLE `juegos`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

      ALTER TABLE `juegos`
      ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`genero`) REFERENCES `generos` (`id`); ";
      $conn->exec($sql);

      $sql = "INSERT INTO `juegos` (`id`, `nombre`, `precio`, `genero`, `desarrolladora`, `micro_transacciones`, `lanzamiento`) VALUES
      (1, 'God of War', 15000, 9, 'yo que se', 0, 'no se tampoco'),
      (2, 'Counter Strike : GO', 7000, 11, 'Steam', 1, 'Eeeehhhh'),
      (4, 'Layers of Fear', 7500, 6, 'Aun no se ', 0, 'Sigo sin saber'),
      (5, 'Far Cry 3', 5000, 8, 'Aun no se ', 0, 'Sigo sin saber');
      ";
      $conn->exec($sql);


      $sql = "CREATE TABLE `usuarios` (
        `id` int(11) NOT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
      
      ALTER TABLE `usuarios`
      ADD PRIMARY KEY (`id`);
      
      ALTER TABLE `usuarios`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
      $conn->exec($sql);


      $sql = "INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
      (2, 'webadmin', '$2y$10$0eO.03LGBqLFKdzAoTMaRO7Kf9NQueTKpx2Vm.MltexAL75qs6qKO');";
      $conn->exec($sql);
      
      return $conn;
    }
  }
}
?>