<?php
class AppointmentController extends Controller
{
    public function __construct(){
        $this->model = $this->model("Appointment");
    }

    public function reserve(){
        $data = [];
        $code = 200;
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $request_body = file_get_contents("php://input");
            extract(json_decode($request_body, true));
            $values = [$uuid, $appdate, $timeslot];
            $this->model->reserve_appointment($values);
            $data["message"] = "success";
        }
        else{
            $code = 405;
            $data["message"] = "Method not allowed";
        }
        response($data, "POST", $code);
    }

    public function reserved($uuid = null){
        $data = [];
        $code = 200;
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            if($uuid === null){
                $code = 405;
                $data["message"] = "uuid should be provided as a parameter";
            }else{
                $appointments = $this->model->get_reserved_appointments($uuid);
                $data["message"] = "success";
                $data["data"] = $appointments;
            }
        }
        else{
            $code = 405;
            $data["message"] = "Method not allowed";
            $data["data"] = [];
        }
        response($data, "GET", $code);
    }

    public function delete(){
        $data = ["message" => "", "data" => []];
        $code = 200;
        if($_SERVER["REQUEST_METHOD"] === "DELETE"){
            $request_body = file_get_contents("php://input");
            extract(json_decode($request_body, true));
            if(!isset($appid)){
                $code = 405;
                $data["message"] = "not appointment id provided";
            }else{
                $this->model->delete_appointment($appid);
                $data["message"] = "success";
            }
        }
        else{
            $code = 405;
            $data["message"] = "Method not allowed";
        }
        response($data, "DELETE", $code);
    }

}