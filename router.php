<?php
    require_once './app/controllers/autorController.php';
    require_once './app/controllers/libroController.php';
    require_once './app/controllers/loginController.php';
    require_once './app/controllers/errorController.php';
    require_once './app/controllers/adminController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//Para mantener la session iniciada, antes de manejar los datos
AuthHelper::init();

$action = 'libros';
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'administration':
        if(isset($_SESSION['Usuario'])){
            $controller = new AdminController();
            $controller->showAdmin();
            break;
        }else{
            $controller = new LoginController();
            $controller->showLogin(); 
            break; 
        }
    case 'login':
        $controller = new LoginController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new LoginController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new LoginController();
        $controller->logout();
        break;
    case 'libros':
        $controller = new LibroController();
        if (isset($params[1])){
            $controller->showLibro($params[1]);
            break;
        }
        else
            $controller->showLibros();
            break;
    case 'autores':
        if (isset($params[1])){
            $controller = new LibroController();
            $controller->showLibrosAutor($params[1]);
            break;
        }
        else
            $controller = new AutorController();
            $controller->showAutores();
            break;
    default: 
        $controller = new ErrorController();
        $controller->show404();
        break;
}
