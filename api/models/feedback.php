<?php


class Feedback extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM feedback";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {

        $query = "SELECT * FROM feedback WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {

        $query = "INSERT INTO  feedback ( id ,  name ,content, path) VALUES(NULL,:name,:content, :path)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":content", $input["content"]);
        $stmt->bindParam(":path", $input["path"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function update($input = [], $id)
    {
        $query = "UPDATE feedback  
        SET name= :name , content=:content, path=:path 
        WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":content", $input["content"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $query = "delete FROM feedback where id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
