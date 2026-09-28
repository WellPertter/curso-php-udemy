<?php

    session_start();
    include_once("url.php");
    include_once("connection.php");

    $data = $_POST;

    if (!empty($data)){


        if ($data["type"] === "create"){
            $name = $data["name"]; 
            $phone = $data["phone"]; 
            $description = $data["observation"]; 
            $query = "INSERT INTO contacts (name, phone, observation) VALUES (:name, :phone, :observation)";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":observation", $description);


            try {
                $stmt->execute();
                $_SESSION["msg"] = "Cadastrado com sucesso!";

            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }


        } else if ($data["type"] === "edit"){
            $id = $data["id"]; 
            $name = $data["name"]; 
            $phone = $data["phone"]; 
            $description = $data["observation"]; 
            $query = "UPDATE contacts SET name = :name, phone = :phone, observation =:observation WHERE id = :id";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":observation", $description);
            $stmt->bindParam(":id", $id);


            try {
                $stmt->execute();
                $_SESSION["msg"] = "Atualizado com sucesso!";

            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }

        } else if ($data["type"] === "delete"){
            $id = $data["id"]; 
            $query = "DELETE FROM contacts WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":id", $id);

            try {
                $stmt->execute();
                $_SESSION["msg"] = "Deletado com sucesso!";

            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        }

        header("Location:" . $BASE_URL . "../index.php");




    } else {

        $id = null;

        if (!empty($_GET)){
            $id = $_GET["id"];
        }

        if (!empty($id)){
            // retornar todos os contatos
            $query = "SELECT * FROM contacts WHERE id = :id";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();

            $contact = $stmt->fetch();

        } else {
            // retornar todos os contatos
            $query = "SELECT * FROM contacts";

            $stmt = $conn->prepare($query);

            $contacts = [];
            
            $stmt->execute();

            $contacts = $stmt->fetchAll();

        }


    }


    $conn = null;

?>