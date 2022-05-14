<?php


class Menu extends Database
{

    public function getAll($limit = 10)
    {

        $query = "
        SELECT
            m.id,
            m.title,
            m.sub_title,
            m.price,
            m.path,
            m.category_id,
            c.name category
        FROM
            menu m
        INNER JOIN category c ON
            c.id = m.category_id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getAllByCategory($category_id)
    {

        $query = "
        SELECT
            m.id,
            m.title,
            m.sub_title,
            m.price,
            m.path,
            m.category_id,
            c.name category
        FROM
            menu m
        INNER JOIN category c ON
            c.id = m.category_id  WHERE  m.category_id=:category_id LIMIT 10";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {
        $query = "
        SELECT
        m.id,
        m.title,
        m.sub_title,
        m.price,
        m.path,
        m.category_id,
        c.name category
    FROM
        menu m
    INNER JOIN category c ON
        c.id = m.category_id  WHERE m.id=? 
        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {
        $query = "INSERT INTO menu values(NULL,:title,:sub_title,:price,:path, :category_id)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":sub_title", $input["sub_title"]);
        $stmt->bindParam(":price", $input["price"]);
        $stmt->bindParam(":category_id", $input["category_id"], PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function update($input = [], $id)
    {
        $query = "UPDATE menu SET title=:title, sub_title=:sub_title, 
        price=:price, path=:path, category_id=:category_id WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":sub_title", $input["sub_title"]);
        $stmt->bindParam(":price", $input["price"]);
        $stmt->bindParam(":category_id", $input["category_id"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function delete($id)
    {
        $query = "delete FROM menu where id=?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }






    public function GetWhere($ids = [])
    {

        $inQuery = implode(',', array_fill(0, count($ids), '?'));;


        $query = "
        SELECT
            m.id,
            m.title,
            m.sub_title,
            m.price,
            m.path,
            m.category_id,
            c.name category
        FROM
            menu m
        INNER JOIN category c ON
            c.id = m.category_id Where m.id in(" .  $inQuery . ")";
        // prepare query statement
        $stmt = $this->conn->prepare($query);


        foreach ($ids as $k => $id)
            $stmt->bindValue(($k + 1), $id);


        // execute query
        $stmt->execute();
        return $stmt;
    }
}
