<?php 
    // Pau Muñoz Serra

    function connexio() {
        $host = DB_HOST; // Servidor donde se aloja la base de datos
        $dbname = DB_NAME; // Nombre de la base de datos
        $username = DB_USER; // Usuario de la base de datos
        $password = DB_PASS; // Contraseña de la base de datos

        try {
            // Crear una nueva instancia de PDO
            $connexio = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            return $connexio;
        
        } catch (PDOException $e) {
            // Mostrar error en cas de que falli la conexión
            die("Error en la conexión: " . $e->getMessage());
            
        }
    }
?>