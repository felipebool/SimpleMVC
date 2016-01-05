Teste Prático
====================

Sistema de cadastro de usuário
---------------------

Sistema simples para cadastro de usuários utilizando Javascript, JQuery,
Ajax, CSS, HTML, PHP e orientação a objetos, seguindo o padrão MVC e
implementando persistência em banco de dados.

Na tela inicial do sistema são listados os usuários cadastrados e são
apresentados dois formulários, o primeiro para cadastro de novo usuário
(que é anexado a lista de cadastrados sem refresh) e o segundo um formulário
de busca. O resultado da busca é apresentado em forma de lista logo abaixo
do próprio formulário de busca.


### Instalação
É necessária a criação de uma tabela pessoa contendo cinco campos:

```sql
CREATE TABLE `Pessoa` (
 `name` text NOT NULL,
 `telephone` text NOT NULL,
 `photo` text NOT NULL,
 `email` text NOT NULL,
 `id` int(11) NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1
```

Além disso, deve-se editar o arquivo *models/database.php* com os parâmetros
de conexão com o banco do ambiente de instalação.


