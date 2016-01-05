<html>
<head>
   <title>Sistema de cadastro de usuários</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

   <script>
      // Handle listing
      $(function(){
         $(".error").hide();
         $("#newUserForm").submit(function(e) {
            e.preventDefault();

            var name = $('input#name').val();
            var telephone = $('input#telephone').val();
            var email = $('input#email').val();
            var userData = 'name=' + name +
                           '&telephone=' + telephone +
                           '&email=' + email;

            if (name == "") {
               $("label#name_error").show();
               $("input#name").focus();
               return false;
            }
            else if (telephone == "") {
               $("label#telephone_error").show();
               $("input#telephone").focus();
               return false;
            }
            else if (email == "") {
               $("label#email_error").show();
               $("input#email").focus();
               return false;
            }

            $.ajax({
               url: 'http://localhost/sinax/public/home/create',
               data: userData,
               type: 'post',
               success: function(output) {
                  var newRow = '<tr>' +
                               '<td>' + name + '</td>' +
                               '<td>' + telephone + '</td>' +
                               '<td>' + email + '</td>' +
                               '<td> photo </td>' +
                               '</tr>';
                  $('#usersTable > tbody:last-child').append(newRow);
                  $('input#name, input#telephone, input#email').val('');
                  alert("Usuário cadastrado com Sucesso");
               }
            });
         });
         return false;
      });

      // Handle searching
      $(function(){
         $(".error").hide();
         $("#searchUserForm").submit(function(e) {
            e.preventDefault();

            var name = $('input#searchName').val();
            var userData = 'searchName=' + name;

            if (name == "") {
               $("label#search_name_error").show();
               $("input#searchName").focus();
               return false;
            }

            $.ajax({
               url: 'http://localhost/sinax/public/home/search',
               data: userData,
               type: 'post',
               success: function(output) {
                  $('table#foundUserTable').remove();

                  var obj = JSON.parse(output);
                  $('form#searchUserForm').after('<table class="table table-striped" id="foundUserTable"></table>');
                  $('table#foundUserTable').append('<thead><tr><th>Nome</th><th>Telefone</th><th>Email</th><th>Foto</th></tr></thead>');
                  $('table#foundUserTable').append('<tbody id="foundUserTableBody"></tbody>');
                  for (i = 0; i < obj.length; i++) {
                     var appendUser = '<tr>' +
                                      '<td>' + obj[i].name + '</td>' +
                                      '<td>' + obj[i].telephone + '</td>' +
                                      '<td>' + obj[i].email + '</td>' +
                                      '<td>foto</td>' +
                                      '</tr>';
                     $('tbody#foundUserTableBody').append(appendUser);
                  }
               }
            });
         });
         return false;
      });
   </script>

</head>
<body>
   <div class="container">
      <h1>Usuários Cadastrados</h1>
      <table class="table table-striped" id="usersTable">
         <thead>
            <tr>
               <th>Nome</th>
               <th>Telefone</th>
               <th>Email</th>
               <th>Foto</th>
            </tr>
         </thead>
         <tbody>
            <?php
               foreach ($data as $user) {
                  echo '<tr>';
                  echo '<td>'.$user['name'].'</td>';
                  echo '<td>'.$user['telephone'].'</td>';
                  echo '<td>'.$user['email'].'</td>';
                  echo '<td>foto</td>';
                  echo '</tr>';
               }
            ?>
         </tbody>
      </table>

      <h1>Formulário de cadastro de novo usuário</h1>
      <form role="form" id="newUserForm" enctype="multipart/form-data">
         <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name">
            <label class="error" for="name" id="name_error">Este campo é obrigatório</label>
         </div>
         <div class="form-group">
            <label for="telephone">Telefone:</label>
            <input type="text" class="form-control" id="telephone">
            <label class="error" for="telephone" id="telephone_error">Este campo é obrigatório</label>
         </div>
         <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email">
            <label class="error" for="email" id="email_error">Este campo é obrigatório</label>
         </div>
         <button type="submit" class="btn btn-default" id="newUser">Novo</button>
      </form>

      <h1>Buscar usuário</h1>
      <form role="form" id="searchUserForm" class="form-inline">
         <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="searchName">
            <label class="error" for="name" id="search_name_error">Este campo é obrigatório</label>
         </div>
         <button type="submit" class="btn btn-default" id="searchUser">Buscar</button>
      </form>

   </div>
</body>
</html>

