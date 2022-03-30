<?php
class UserController extends Controller{

    
    public function __construct(){
        $this->model = $this->model("User");
    }
    
    private function generate_uuid(){
        $uuid = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 10; $i++) {
            $uuid .= $characters[mt_rand(0, $max)];
        }
        return $uuid;
    }


    public function index(){
        $data = [];
        $code = 200;
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            $request_body = file_get_contents("php://input");
            extract(json_decode($request_body, true));
            $users = $this->model->get_user($uuid);
            if(count($users) > 0){
                $code = 200;
                $data["data"] = $users[0];
                $data["message"] = "success";
            }
            else{
                $code = 404;
                $data["message"] = "User not found";
                $data["data"] = [];
            }
        }
        else{
            $code = 405;
            $data["message"] = "Method not allowed";
            $data["data"] = [];
        }
        response($data, "GET", $code);
    }
    public function getall(){
        $data = [];
        $code = 200;
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            $data["message"] = "success";
            $data["data"] = $this->model->get_users();
        }
        else{
            $code = 405;
            $data["message"] = "Method not allowed";
            $data["data"] = [];
        }
        response($data, "GET", $code);
    }

    public function create(){
        $data = [];
        $code = 200;
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $request_body = file_get_contents("php://input");
            extract(json_decode($request_body, true));
            $uuid = $this->generate_uuid();
            $values = [$uuid, $firstname, $lastname, $birthdate];
            $this->model->create_user($values);
            $data["message"] = "success";
            $data["data"] = ["uuid" => $uuid];
        }
        else{
            $code = 405;
            $data["message"] = "Method not allowed";
            $data["data"] = [];
        }
        response($data, "POST", $code);
    }
}