<?php
// Configurações de conexão com o banco de dados (ajuste conforme sua configuração)
$host = "127.0.0.1";
$port = 3306;
$dbname = "db_byteware";
$username = "byteware";
$password = "123";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para inserir um novo registro
    function create($pdo, $table, array $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $pdo->lastInsertId();
    }

    // Função para ler registros
    function readAll($pdo, $table, $where = null, $like = null) {
        $sql = "SELECT * FROM $table";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


       $sql = "SELECT * FROM $table";
        if ($where) {
            $sql .= " LIKE %$like%";
        }
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

