<?php

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;



class AppController extends Action{

	public function timeline(){
		$this->validaAutenticacao();
		$tweet = Container::getModel('Tweet');
		$tweet->__set('id_usuario',$_SESSION['id']);
		$tweets = $tweet->getAll();
		$this->view->tweets = $tweets;
		$Container

		$this->render('timeline');	

	}

	public function tweet(){
		$this->validaAutenticacao();
		$tweet = Container::getModel('Tweet');
		$tweet->__set('tweet',$_POST['tweet']);
		$tweet->__set('id_usuario',$_SESSION['id']);
		$tweet->salvar();
		header('Location:/timeline');
	}

	public function validaAutenticacao(){
		session_start();
		if(!isset($_SESSION['id']) || $_SESSION['id']  == '' && isset($_SESSION['nome']) || $_SESSION['nome'] == '' ){
			header('Location:/?login=erro');
		}
	}


	public function quemSeguir(){
		$this->validaAutenticacao();
		$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
		$usuarios = array();
		if($pesquisarPor != ''){
			$usuario = Container::getModel('Usuario');
			$usuario->__set('nome',$pesquisarPor);
			$usuario->__set('id',$_SESSION['id']);
			$usuarios = $usuario->getAll();
		}
		$this->view->usuarios = $usuarios;
		$this->render('quemSeguir');
	}

	public function accao(){
		$this->validaAutenticacao();
		$accao = isset($_GET['accao']) ? $_GET['accao'] : '';
		$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id',$_SESSION['id']);

		if($accao == 'seguir'){
			$usuario->seguirUsuario($id_usuario_seguindo);
		}else{
			if($accao == 'deixar_de_seguir'){
				$usuario->deixarSeguirUsuario($id_usuario_seguindo);
			}
		}

		header('Location: /quem_seguir');
	}
}
?>