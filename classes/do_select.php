<?php

namespace classes;
class do_select extends database
{
    public function do($sql, $value = [])
    {
        $result = $this->pdo->prepare($sql);
        foreach ($value as $key => $item) {
            $result->bindValue($key + 1, $item);
        }
            $result->execute();
    }
    public function select($sql, $value = [], $fetch = 'fetchAll')
    {
        $result = $this->pdo->prepare($sql);
        foreach ($value as $key => $item) {
            $result->bindValue($key + 1, $item);
        }
        $result->execute();
        if ($fetch == 'fetchAll') {
            if ($result->rowCount() >= 1) {
                $row = $result->fetchAll(\PDO::FETCH_OBJ);
                return $row;
            } else {
                return false;
            }
        } else {
            if ($result->rowCount() >= 1) {
                $row = $result->fetch(\PDO::FETCH_OBJ);
                return $row;
            } else {
                return false;
            }
        }
    }
}
?>