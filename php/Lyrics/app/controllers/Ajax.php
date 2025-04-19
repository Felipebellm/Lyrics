<?php
class Ajax extends Controller
{
    private $core;
    
    public function __construct()
    {
        // Instancia o Core do seu sistema
        $this->core = new Core();
        
        // Verifica se é AJAX
        if (!$this->isAjaxRequest()) {
            $this->response(['error' => 'Acesso não permitido'], 403);
        }
    }
    
    public function call()
    {
        $controller = $_POST['controller'] ?? null;
        $action = $_POST['action'] ?? null;
        $data = $_POST['data'] ?? [];
        
        if (!$controller || !$action) {
            $this->response(['error' => 'Controller ou action não especificado'], 400);
        }
        
        // Usa o Core do seu sistema para carregar o controller
        $this->core->loadController($controller);
        
        $controllerClass = $controller . 'Controller';
        
        if (!class_exists($controllerClass)) {
            $this->response(['error' => 'Controller não encontrado'], 404);
        }
        
        $controllerInstance = new $controllerClass();
        
        if (!method_exists($controllerInstance, $action)) {
            $this->response(['error' => 'Método não encontrado'], 404);
        }
        
        try {
            $result = call_user_func_array([$controllerInstance, $action], [$data]);
            $this->response($result);
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }
    
    private function isAjaxRequest()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    private function response($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}