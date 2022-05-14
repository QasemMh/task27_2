<?php


class User extends Database
{

    public function getUsers($limit = 10)
    {

        $query = "
            SELECT
                u.id,
                u.name,
                u.username,
                u.email,
                u.createAt
            FROM
                users u LIMIT ?
        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getUserBy($id)
    {
        $query = "
        SELECT
        u.id,
        u.name,
        u.username,
        u.email,
        u.createAt
        FROM
        users u WHERE u.id=? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
    public function getLoginData($username)
    {
        $username = strtolower($username);
        $query = "SELECT id,username,password FROM users where username = ? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function createUser($input = [])
    {
        //hash the password
        $hash_pass = password_hash($input["password"], PASSWORD_DEFAULT);

        $username = strtolower($input["username"]);


        $query = "INSERT INTO users(id, name, username, email,password,createAt) 
         VALUES(null,:name,:username,:email,:password, current_timestamp())";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hash_pass);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function updateUser($input = [], $id)
    {
        $username = strtolower($input["username"]);

        $query = "UPDATE users SET name=:name, username=:username,
         email=:email WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function deleteUser($id)
    {
        $query = "delete FROM users where id=?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
