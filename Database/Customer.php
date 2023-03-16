<?php
include_once 'config/Connection.php';

class Customer extends Connection
{
    private $customer_id, $name, $email, $current_balance, $created_at;

    /**
     * Set the value of customer_id
     *
     * @return  self
     */
    public function setCustomer_id($customer_id)
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of current_balance
     *
     * @return  self
     */
    public function setCurrent_balance($current_balance)
    {
        $this->current_balance = $current_balance;

        return $this;
    }


    //quries

    public function getAllCustomers(): mysqli_result|false
    {

        $query = "SELECT * FROM `customers`";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getCustomers(): mysqli_result|false
    {
        $query = "SELECT * FROM `customers` WHERE `customer_id` != ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->bind_param('i', $this->customer_id);
        $stmt->execute();
        return $stmt->get_result();
    }


    public function getCustomerById(): mysqli_result|false
    {
        $query = "SELECT * FROM `customers` WHERE `customer_id` = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->bind_param('i', $this->customer_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateReceiverBalance($amount): bool
    {
        $query = " UPDATE `customers` 
SET `current_balance` = `current_balance` + ?
 WHERE `customer_id` = ? ";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->bind_param('ii', $amount, $this->customer_id);
        return $stmt->execute();
    }

    public function updateSenderBalance($amount): bool
    {
        $query = " UPDATE `customers` SET `current_balance` = `current_balance` - ? 
WHERE `customer_id` = ? ";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
            echo "hello";
        }
        $stmt->bind_param('ii', $amount, $this->customer_id);
        return $stmt->execute();
    }


    public function addNewCustomer()
    {
        $query = "INSERT INTO `customers` (`name`,`email`,`current_balance`) values (?,?,?)";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->bind_param('ssi', $this->name, $this->email, $this->current_balance);
        return $stmt->execute();
    }
}
