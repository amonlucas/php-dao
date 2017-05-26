<?php 
require_once ("config.php");


// Carrega um usuario
//$usuario = new Usuario();
//$usuario->loadById(4);
//echo $usuario;


//Lista de Usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Busca Usuarios pelo Login
//$busca = Usuario::search("jo");
//echo json_encode($busca);

//Autenticacao
//$usuario = new Usuario();
//$usuario->login("Maria","senha3");
//echo $usuario;


//Criando Usuario / INSERT
//$aluno = new Usuario();
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("passAluno");
//$aluno->insert("Graca","SenhaGraca");


//Alterar Usuario - Update
//$usuario = new Usuario();
//$usuario->loadById(7);
//$usuario->update("Professor","Senha do Professor");

//Delete
$usuario = new Usuario();
$usuario->loadById(7);
$usuario->delete(7);
echo $usuario;



?>