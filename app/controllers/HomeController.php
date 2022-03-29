<?php
class HomeController extends Controller{

    // public function __construct(){
    //     $this->model = $this->model("Home");
    // }

    public function index(){
        http_response_code(403);
        echo json_encode([
            'message' => 'You should not messing around with this API'
        ]);
    }
}