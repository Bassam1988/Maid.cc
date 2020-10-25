<?php
require_once 'DB_Connection.php';
require_once 'controllers/services_controler.php';

require_once 'services/services.php';

$DBconn = new mysql_connection();

$controller = 'default';
$action = "";
if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
}
switch ($controller) {
    case "product":
        $staff_ob = new products_controller();
        switch ($action) {
            case "all":
                $staff_ob->fetch_product_controller($DBconn->conn);
                break;
            case "add":

                $staff_ob->add_new_product_controller($DBconn->conn, $name);
                break;
            case "update":
                $staff_ob->update_product_controller($DBconn->conn);
                break;

        }
    case "client":
        $staff_ob = new clients_controller();
        switch ($action) {
            case "all":
                $staff_ob->fetch_client_controller($DBconn->conn);
                break;
            case "add":

                $staff_ob->add_new_client_controller($DBconn->conn, $name);
                break;
            case "update":
                $staff_ob->update_client_controller($DBconn->conn);
                break;

		}
	    case "sales":
			$staff_ob = new sales_controller();
			switch ($action) {
				case "all":
					$staff_ob->fetch_sales_controller($DBconn->conn);
					break;
				case "add":
	
					$staff_ob->add_new_sales_controller($DBconn->conn, $name);
					break;
				case "update":
					$staff_ob->update_sales_controller($DBconn->conn);
					break;
	
			}

}
