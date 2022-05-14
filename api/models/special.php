<?php


class SpecialSection extends Database
{

    public function getAll($limit = 10)
    {

        $query = "SELECT * FROM special";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {
        $query = "SELECT * FROM special WHERE id=? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {
        $query = "INSERT INTO special(id, title, discount, path) values(NULL,:title,:discount,:path)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":discount", $input["discount"]);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function update($input = [], $id)
    {
        $query = "UPDATE special SET title=:title,discount=:discount, path=:path WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":discount", $input["discount"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function delete($id)
    {
        $query = "delete FROM special where id=?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
