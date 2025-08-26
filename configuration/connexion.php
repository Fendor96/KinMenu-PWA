<?php 
$host = "localhost";
$dbname = "kinmenuappdb";
$user = "root";
$password = "";

function ErrorLogs($message, $file = null, $line = null) {
    // Spécifiez un chemin absolu pour le fichier de log
    $logFile = __DIR__ . '/../logs/logs_system.txt';

    // Formatage de la date
    $date = date("Y-m-d H:i:s");
    
    // Construction du message de log avec plus de détails
    $logMessage = "[$date] $message";

    if ($file !== null && $line !== null) {
        $logMessage .= " | Fichier: " . $file . " | Ligne: " . $line;
    }

    $logMessage .= PHP_EOL;

    // Utilisation de LOCK_EX pour éviter les problèmes de concurrence
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    ErrorLogs('Erreur lors de la connexion à la base de données: ', $e->getFile(), $e->getLine());
    echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
    exit();
}








?>