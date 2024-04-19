
<?php

class OrderModel extends Model
{

    private $tableName = "orders_";

    function addOrder($data)
    {
        $result = $this->insert($this->tableName, $data);
        if ($result) {
            $cart_items = $_SESSION['cart'];
            $dataOfItem['order_id'] = $this->getLastInsertedId();;
            foreach ($cart_items as $item) {
                $dataOfItem['user_id'] = $data['user_id'];
                $dataOfItem['product_id'] = $item['id'];
                $dataOfItem['quantity'] = $item['quantity'];
                $dataOfItem['type'] = $item['type'];
                $this->addItemOfOrder($dataOfItem);
                
            }
        }
        return  $dataOfItem['order_id'];
    }

    function getOrdersOfTheUser($id)
    {

        $this->select($this->tableName, ['user_id' => $id]);
        return $this->resultset();
    }
    function getLastInsertedId()
    {
        $sql = "SELECT LAST_INSERT_ID() AS last_id FROM $this->tableName";
        $this->query($sql);
        return $this->single()->last_id;
    }
    function addItemOfOrder($data)
    {
        $tableName = "order_item";
        $this->insert($tableName, $data);
    }
    function updateStatus($order_id)
    {
        return $this->update($this->tableName, ['status' => true], ['id' => $order_id]);
    }
}
