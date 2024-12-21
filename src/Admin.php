<?php
abstract class Admin{
    abstract public function tambahAcara($pdo = null);

    abstract public function tampilkanAcara($pdo, $limit = null, $all = true);

    abstract public function hapusAcara($pdo, $delete_id);

    public function editAcara() {}
}

?>
