<?php

class products
{

    public function fetch_product($conn)
    {
        $query = "SELECT id, name, description, category_name, creation_date, price FROM products p join category c on p.cat_id=c.id";
        $result = $conn->query($query);
        if (!$result) {
            die("Fatal Error");
        }

        $result_array = [];
        while ($row_result = $result->fetch_assoc()) {

            array_push($result_array, $row_result);
        }
        return $result_array;
    }

    public function add_new_product($conn, $name, $description, $cat_id, $price)
    {
        $query = "INSERT INTO products (name,description,cat_id,creation_date, price)
		VALUES ('$name', '$description', '$cat_id', 'sysdate', '$price')";
        $result = $conn->query($query);
        if (!$result) {
            echo "INSERT failed";
        }

        $row_result = $conn->insert_id;
        return $row_result;

    }

    public function update_product($conn, $id, $name, $description, $cat_id, $price)
    {
        $query = "update products set ";
        $edit = 0;
        if ($name) {
            $query += "name='$name'";
            $edit = 1;
        }
        if ($description) {
            if ($edit != 0) {
                $query += ", description='$description'";
            } else {
                $query += " description='$description'";
                $edit = 1;
            }
        }
        if ($cat_id) {
            if ($edit != 0) {
                $query += ", cat_id='$cat_id'";
            } else {
                $query += " cat_id='$cat_id'";
                $edit = 1;
            }
        }
        if ($price) {
            if ($edit != 0) {
                $query += ", price='$price'";
            } else {
                $query += " price='$price'";
                $edit = 1;
            }
        }
        $query += " where id= '$id'";
        $result = $conn->query($query);
        if (!$result) {
            echo "update failed";
        }

        $row_result = $result->fetch_assoc();
        return $row_result;

    }
}

class clients
{

    public function fetch_client($conn)
    {
        $query = "SELECT  id, name, last_name, mobile FROM clients";
        $result = $conn->query($query);
        if (!$result) {
            die("Fatal Error");
        }

        $result_array = [];
        while ($row_result = $result->fetch_assoc()) {

            array_push($result_array, $row_result);
        }
        return $result_array;
    }

    public function add_new_client($conn, $name, $last_name, $mobile)
    {
        $query = "INSERT INTO clients (name, last_name, mobile)
		VALUES ('$name',  '$last_name', '$mobile')";
        $result = $conn->query($query);
        if (!$result) {
            echo "INSERT failed";
        }

        $row_result = $$conn->insert_id;
        return $row_result;

    }

    public function update_client($conn, $id, $name, $last_name, $mobile)
    {
        $query = "update products set ";
        $edit = 0;
        if ($name) {
            $query += "name='$name'";
            $edit = 1;
        }
        if ($last_name) {
            if ($edit != 0) {
                $query += ", last_name='$last_name'";
            } else {
                $query += " last_name='$last_name'";
                $edit = 1;
            }
        }
        if ($mobile) {
            if ($edit != 0) {
                $query += ", mobile='$mobile'";
            } else {
                $query += " mobile='$mobile'";
                $edit = 1;
            }
        }

        $query += " where id= '$id'";
        $result = $conn->query($query);
        if (!$result) {
            echo "update failed";
        }

        $row_result = $result->fetch_assoc();
        return $row_result;

    }
}

class sales
{

    public function fetch_sales($conn)
    {
        $query = "SELECT  s.id, creation_date, c.name client, emp.name seller, sum(t.total) total FROM sales s join clients c on s.client_id=c.id join employee emp on s.emp_id=emp.id join Transactions t on s.id=t.sales_id group by s.id";
        $result = $conn->query($query);
        if (!$result) {
            die("Fatal Error");
        }

        $result_array = [];
        while ($row_result = $result->fetch_assoc()) {

            array_push($result_array, $row_result);
        }
        return $result_array;
    }

    public function add_transaction($conn, $sales_id, $tansaction)
    {

        $total = $tansaction->total;
        $products = $tansaction->products;
        $query = "INSERT INTO transctions (sales_id,total)
		VALUES ('$sales_id', '$total')";
        $result = $conn->query($query);
        if (!$result) {
            echo "INSERT failed";
        }

        $T_id = $conn->insert_id;
        for ($j = 0; $j < count($products); $j++) {
            $p_id = $products[$j]['p_id'];
            $price_id = $products[$j]['price_id'];
            $quantity = $products[$j]['quantity'];
            $query = "INSERT INTO transctions_products (tans_id, pro_id, price_id, quantity)
		    VALUES ('$T_id', '$p_id', '$price_id', '$quantity')";
            $result = $conn->query($query);
            if (!$result) {
                echo "INSERT failed";
            }

        }

    }

    public function add_new_sales($conn, $client_id, $emp_id, $transactions)
    {
        $query = "INSERT INTO sales (client_id,emp_id,creation_date)
		VALUES ('$client_id', '$emp_id', 'sysdate')";
        $result = $conn->query($query);
        $sales_id = $conn->insert_id;

        for ($j = 0; $j < count($transactions); $j++) {
            $this->add_transaction($conn, $sales_id, $transactions[$j]);
        }

    }

    public function update_sales($conn, $pro_id, $trans_id, $quantity, $price)
    {
        $query = "update transctions_products set ";
        $edit = 0;
        if ($quantity) {
            $query += "quantity='$quantity'";
            $edit = 1;
        }
        if ($price) {
            if ($edit != 0) {
                $query += ", price='$price'";
            } else {
                $query += " price='$price'";
                $edit = 1;
            }
        }
      
        $query += " where pro_id= '$pro_id' and tran_id='$trans_id'";
        $result = $conn->query($query);

        $query2="update transctions set total=(select sum(price) from transctions_products where tran_id='$trans_id') where id='$trans_id' ";
        $result = $conn->query($query2);
        if (!$result) {
            echo "update failed";
        }

      /*  for this request:   We need to log all update operations on sale transactions.
        we can add trigger (before update) to insert a row in log table contains the date and old and new data
        or create this function here and insert this new row but we need to read the old values so this require additional connection on the database*/
       

    }
}
