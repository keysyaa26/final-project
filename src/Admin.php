<?php
abstract class Admin{
    abstract public function addAcara($pdo = null);

    abstract public function showAcara($pdo, $limit = null, $all = true);

    abstract public function deleteAcara($pdo, $delete_id);

    public function editAcara() {}
}

?>