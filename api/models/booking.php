<?php


class Booking extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM book_table";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {

        $query = "SELECT * FROM book_table WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {

        $query = "INSERT INTO  book_table ( id ,  name ,phone,email,capacity,the_date,user_id)
         VALUES(NULL,:name,:phone,:email,:capacity,:the_date, :user_id)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":phone", $input["phone"]);
        $stmt->bindParam(":the_date", $input["the_date"]);
        $stmt->bindParam(":capacity", $input["capacity"]);
        $stmt->bindParam(":user_id", $input["user_id"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function update($input = [], $id)
    {
        $query = "UPDATE book_table  
        SET name=:name , phone=:phone,
         email=:email, capacity=:capacity,
          the_date=:the_date
        WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":phone", $input["phone"]);
        $stmt->bindParam(":the_date", $input["the_date"]);
        $stmt->bindParam(":capacity", $input["capacity"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $query = "delete FROM book_table where id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
