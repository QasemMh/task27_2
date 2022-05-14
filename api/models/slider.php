<?php


class Slider extends Database
{

    public function getAll($limit = 10)
    {

        $query = "SELECT * FROM slider";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {
        $query = "SELECT * FROM slider WHERE id=? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {
        $query = "INSERT INTO slider values(NULL,:title,:sub_title)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":sub_title", $input["sub_title"]);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function update($input = [], $id)
    {
        $query = "UPDATE slider SET title=:title, sub_title=:sub_title WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":sub_title", $input["sub_title"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function delete($id)
    {
        $query = "delete FROM slider where id=?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
