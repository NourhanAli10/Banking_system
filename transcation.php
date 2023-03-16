<?php
session_start();
include_once __DIR__ . "\Database\Customer.php";
include_once __DIR__ . "\Database\Transfer.php";

$customerModel = new Customer;

$customerModel->setCustomer_id($_GET['customerid']);
$customer = $customerModel->getCustomerById()->fetch_object();
$customers = $customerModel->getAllCustomers()->fetch_all(MYSQLI_ASSOC);
$customersExcept = $customerModel->getCustomers()->fetch_all(MYSQLI_ASSOC);

$transferModel = new Transfer;
$_SESSION['customer'] = $customer;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    $receiver = $_POST['receiver'];
    list($customer_id, $customer_name) = explode('|', $receiver);
    $transferModel->setSender_name($customer->name)->setReceiver_name($customer_name)
        ->setTransfer_amount($_POST['amount']);
    if ($customer->current_balance <= 500) {
        $message = "<p style='color: white; font-size: 18px; text-align:center; font-weight:bold; background-color:red; margin-bottom:5px;'>
        your transfer has been failed , your balance should be more than 500$</p>";
    } else {
        if ($transferModel->insertTransaction()) {
            $customerModel->updateSenderBalance($_POST['amount']);
            $customerModel->setCustomer_id($customer_id);
            $customerModel->updateReceiverBalance($_POST['amount']);
            $_SESSION['customer']->current_balance = $_SESSION['customer']->current_balance - $_POST['amount'];
            $successMessage = "<p style='color: white; font-size: 18px; text-align:center; font-weight:bold; background-color:#3C32A3; margin-bottom:5px;'>
            Your process has been done successfully.</p>";
            header('refresh:3; url=Transaction-history.php?customerid=' . $_GET['customerid']);
        } else {
            $error = "<p> something went wrong</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show.css" type="text/css">
    <link rel="stylesheet" href="css/table.css">
    <title>Transacations</title>
    <link rel="icon" href="images/bank.jpg">

</head>

<body>
    <section id="sec1">
        <section class="container">
            <nav class="navbar">
                <div>
                    <a href="#" class="link">Spark International Bank</a>
                </div>
                <ul>
                    <li class="nav-item"><a href="index.php" class="nav-link"> Home</a></li>
                    <li class="nav-item"><a href="show-customers.php" class="nav-link">Customers</a></li>
                    <li class="nav-item"><a href="Add.php" class="nav-link">Add customers</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact us</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Open Account</a></li>
                </ul>
            </nav>
        </section>
        <section class="sec-table">
            <h2>Customer Details</h2>
            <hr>
            <table>
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Balance</th>
                    <th>Details</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $customer->customer_id ?></td>
                        <td><?= $customer->name ?></td>
                        <td><?= $customer->email ?></td>
                        <td><?= $customer->current_balance ?></td>
                        <td><a href="Transaction-history.php?customerid=<?= $_GET['customerid'] ?>">Transaction history</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section>
            <form id="form" method="post">
                <?= $message ?? "" ?>
                <?=  $successMessage ?? "" ?>
                <?= $error ?? "" ?>
                <h4>Transfer Money</h4>
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount">
                <label for="receiver">Send to</label>
                <select id="receiver" name="receiver">
                    <option>Select a customer</option>
                    <?php foreach ($customersExcept as $customer) { ?>
                        <option value="<?= $customer['customer_id'] ?>|<?= $customer['name'] ?>"><?= $customer['customer_id'] . ' ' . $customer['name'] ?></option>
                    <?php } ?>
                </select>
                <button type="submit" name="send">Transfer</button>
            </form>
        </section>
</body>

</html>