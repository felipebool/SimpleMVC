<?php

class User {
   private $name;
   private $telephone;
   private $email;
   private $photo;

   public function getName() {
      return $this->name;
   }

   public function getTelephone() {
      return $this->telephone;
   }

   public function getEmail() {
      return $this->email;
   }

   public function getPhoto() {
      return $this->photo;
   }

   public function setName($name) {
      $this->name = $name;
   }

   public function setTelephone($telephone) {
      $this->telephone = $telephone;
   }

   public function setEmail($email) {
      $this->email = $email;
   }

   public function setPhoto($photo) {
      $this->photo = $photo;
   }

   public function createUser() {
      try {
         require_once('database.php');
         $handler = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbuser, $dbpass);
         $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e) {
         die('Ocorreu algum problema na conexão com o banco de dados.');
      }

      $sql = "INSERT INTO Pessoa (name, telephone, photo, email)
              VALUES (:name, :telephone, :photo, :email)";

      $query = $handler->prepare($sql);

      return $query->execute(array(
         ':name'        => $this->name,
         ':telephone'   => $this->telephone,
         ':photo'       => $this->photo,
         ':email'       => $this->email
      ));
   }

   public static function getAllUsers() {
      $query_results = array();

      try {
         require_once('database.php');
         $handler = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbuser, $dbpass);
         $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e) {
         die('Ocorreu algum problema na conexão com o banco de dados.');
      }

      $query = $handler->query('SELECT * FROM Pessoa');
      while ($r = $query->fetch()) {
         array_push($query_results, $r);
      }

      return $query_results;
   }

   public static function searchUsers($name) {
      $query_results = array();

      try {
         require_once('database.php');
         $handler = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbuser, $dbpass);
         $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e) {
         die('Ocorreu algum problema na conexão com o banco de dados.');
      }

      $query = $handler->query('SELECT * FROM Pessoa WHERE name = "'.$name.'"');
      while ($r = $query->fetch()) {
         array_push($query_results, $r);
      }

      return $query_results;
   }
}

