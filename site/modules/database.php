<?php
class Database {
    private $db;

    public function __construct($path) {
        $this->db = new SQLite3($path);
    }

    public function Create($table, $data) {
        $columns = implode(",", array_keys($data));
        $values = implode("','", array_values($data));
        $this->db->exec("INSERT INTO $table ($columns) VALUES ('$values')");
        return $this->db->lastInsertRowID();
    }

    public function Read($table, $id) {
        $res = $this->db->querySingle("SELECT * FROM $table WHERE id = $id", true);
        return $res ?: null;
    }

    public function Update($table, $id, $data) {
        $pairs = [];
        foreach ($data as $key => $value) {
            $pairs[] = "$key = '$value'";
        }
        $str = implode(",", $pairs);
        return $this->db->exec("UPDATE $table SET $str WHERE id = $id");
    }

    public function Delete($table, $id) {
        return $this->db->exec("DELETE FROM $table WHERE id = $id");
    }
}
