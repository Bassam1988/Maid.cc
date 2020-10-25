<?php

require_once 'services/staff.php';
require_once 'services/services.php';
require_once 'views/emp_view.php';

class products_controller
{
    private $service ;//= new staff_services();
    public function __construct(){

		
		$this->service = new products();
	}

    public function fetch_product_controller($conn)
    {
        header('Content-Type: application/json');
        $result=$this->service->fetch_product($conn);
        if ($result) {
          
                echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
       
    }

    public function add_new_product_controller($conn)
    {
        header('Content-Type: application/json');
        $jsonBody = file_get_contents('php://input');
        $json = json_decode($jsonBody, true);
        $name = $json['name'];
        $description = $json['description'];
        $cat_id = $json['cat_id'];
        $price = $json['price'];
        $result=$this->service->add_new_product($conn, $name, $description, $cat_id, $price);
        if ($result) {
          
            echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
    }
    
    public function update_product_controller($conn)
    { 
        header('Content-Type: application/json');
        $jsonBody = file_get_contents('php://input');
        $json = json_decode($jsonBody, true);
        $id = $json['id'];
        $name = $json['name'];
        $description = $json['description'];
        $cat_id = $json['cat_id'];
        $price = $json['price'];
        $result=$this->service->update_product($conn,$id, $name, $description, $cat_id, $price);
        if ($result) {
          
            echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
    }
}




class clients_controller
{
    private $service ;//= new staff_services();
    public function __construct(){

		
		$this->service = new clients();
	}

    public function fetch_client_controller($conn)
    {
        header('Content-Type: application/json');
        $result=$this->service->fetch_client($conn);
        if ($result) {
          
                echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
       
    }

    public function add_new_client_controller($conn)
    {
        header('Content-Type: application/json');
        $jsonBody = file_get_contents('php://input');
        $json = json_decode($jsonBody, true);
        $name = $json['name'];
        $last_name = $json['last_name'];
        $mobile = $json['mobile'];
        $result=$this->service->add_new_client($conn,$name, $last_name, $mobile);
        if ($result) {
          
            echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
    }
    
    public function update_client_controller($conn)
    {
        header('Content-Type: application/json');
        $jsonBody = file_get_contents('php://input');
        $json = json_decode($jsonBody, true);
        $id = $json['id'];
        $name = $json['name'];
        $last_name = $json['last_name'];
        $mobile = $json['mobile'];
        
        $result=$this->service->update_client($conn, $id, $name, $last_name, $mobile);
        if ($result) {
          
            echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
    }
}


class sales_controller
{
    private $service ;//= new staff_services();
    public function __construct(){

		
		$this->service = new sales();
	}

    public function fetch_sales_controller($conn)
    {
        header('Content-Type: application/json');
        $result=$this->service->fetch_sales($conn);
        if ($result) {
          
                echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
       
    }

    public function add_new_sales_controller($conn)
    {
        header('Content-Type: application/json');
        $jsonBody = file_get_contents('php://input');
        $json = json_decode($jsonBody, true);
        $client_id = $json['client_id'];
        $emp_id = $json['emp_id'];
        $transactions = $json['transactions'];
        $result=$this->service->add_new_sales($conn,$client_id, $emp_id, $transactions);
        if ($result) {
          
            echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
    }
    
    public function update_sales_controller($conn)
    {
        header('Content-Type: application/json');
        $jsonBody = file_get_contents('php://input');
        $json = json_decode($jsonBody, true);
        $pro_id = $json['pro_id'];
        $trans_id = $json['trans_id'];
        $quantity = $json['quantity'];
        $price = $json['price'];
        
        $result=$this->service->update_sales($conn, $pro_id, $trans_id, $quantity, $price);
        if ($result) {
          
            echo json_encode($result);
        }
        else {
            echo json_encode(['error'=> 1]);

        }
    }
}