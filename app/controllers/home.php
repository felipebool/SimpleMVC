<?php

include('../app/models/User.php');

class Home extends Controller {
   public function index($name = '') {
      $user_info = User::getAllUsers();
      $this->view('home/index', $user_info, []);
   }

   public function create() {
      if (isset($_POST['name'], $_POST['telephone'], $_POST['email'])) {
         $user = $this->model('User');

         $user->setName($_POST['name']);
         $user->setTelephone($_POST['telephone']);
         $user->setEmail($_POST['email']);
         $user->setPhoto('caminho para a foto');

         if ($user->createUser())
            echo "ok";
      }
   }

   public function search() {
      if (isset($_POST['searchName'])) {
         $search_result = User::searchUsers($_POST['searchName']);
         echo json_encode($search_result);
      }
   }
}

