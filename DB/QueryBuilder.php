<?php


namespace DB\query;

use PDO;


class QueryBuilder
{
    private $db;

    function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    function add_user($table, $data)
    {

        $keys = array_keys($data);
        $stringOfKeys = implode(',', $keys);
        $placeholders = ":" . implode(', :', $keys);

        $sql = "INSERT INTO $table($stringOfKeys) VALUES($placeholders)";

        $query = $this->db->prepare($sql);
        $query->execute($data);

    }

    function get_user_by_email ($email) {

        $statement = $this->db->prepare("SELECT * FROM registration WHERE userEmail=:userEmail");
        $statement->bindParam(":userEmail", $email);
        $statement->execute();

        $mail = $statement->fetch(PDO::FETCH_ASSOC);

        return $mail;
    }


}