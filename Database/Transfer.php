<?php
include_once 'config/Connection.php';
class Transfer extends Connection
{
    private $id, $sender_name, $receiver_name, $transfer_amount, $transfer_date;

    /**
     * Set the value of sender_name
     *
     * @return  self
     */
    public function setSender_name($sender_name)
    {
        $this->sender_name = $sender_name;

        return $this;
    }

    /**
     * Set the value of receiver_name
     *
     * @return  self
     */
    public function setReceiver_name($receiver_name)
    {
        $this->receiver_name = $receiver_name;

        return $this;
    }

    /**
     * Set the value of transfer_amount
     *
     * @return  self
     */
    public function setTransfer_amount($transfer_amount)
    {
        $this->transfer_amount = $transfer_amount;

        return $this;
    }

    //quries
    public function getAllTransactions(): mysqli_result|false
    {
        $query = "SELECT * FROM `transfers`";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function insertTransaction(): bool
    {
        $query = "INSERT INTO `transfers`(sender_name,receiver_name,transfer_amount) VALUES(?,?,?)";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->bind_param('ssi', $this->sender_name, $this->receiver_name, $this->transfer_amount);
        return $stmt->execute();
    }

    public function getAllTransactionsById(): mysqli_result|false
    {
        $query = " SELECT * FROM `transfers` WHERE `sender_name`= ? OR `receiver_name`= ? ";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return $stmt;
        }
        $stmt->bind_param('ss', $this->sender_name, $this->receiver_name);
        $stmt->execute();
        return $stmt->get_result();
    }
}
