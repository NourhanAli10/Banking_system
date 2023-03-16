<?php
include_once __DIR__ . "\Database\Customer.php";
include_once __DIR__ . "\Database\Transfer.php";

$customerModel = new Customer;
$transferModel = new Transfer;

$customerModel->setCustomer_id($_GET['customerid']);
$customerModel->getCustomerById();
$customer =  $customerModel->getCustomerById();
if ($customer->num_rows == 1) {
    $customerInfo = $customer->fetch_object();
    $transferModel->setSender_name($customerInfo->name)->setReceiver_name($customerInfo->name);
    $transfers = $transferModel->getAllTransactionsById();
    if ($transfers->num_rows >= 1) {
        $transfers->fetch_all(MYSQLI_ASSOC);
    } else {
        $transfererror = "<div style='color: red; padding-top :25px ;font-size: 16px;'>No Transaction yet</div>";
    }
} else {
    $error = "<p> something went wrong</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show.css" type="text/css">
    <link rel="stylesheet" href="css/table.css" type="text/css">
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
            <h2>Transaction history</h2>
            <hr>
            <table>
                <thead>
                    <th>ID</th>
                    <th>statement</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>transfer_date</th>
                </thead>
                <tbody>
                    <?php $id = 1; ?>
                    <?php foreach ($transfers as $transfer) { ?>
                        <tr>
                            <!-- ID -->
                            <td><?= $id ?></td>
                            <?php
                            if ($customerInfo->name == $transfer['sender_name']) {
                                $statment = "<p>'to'</p>";
                            } elseif (($customerInfo->name !== $transfer['sender_name'])) {
                                $statment = "<p>'from'</p>";
                            }
                            ?>
                            <!-- statment -->
                            <td><?= $statment ?? "" ?></td>
                            <?php
                            if ($customerInfo->name == $transfer['sender_name']) {
                                $name = "<p>{$transfer['receiver_name']}</p>";
                            } elseif (($customerInfo->name !== $transfer['sender_name'])) {
                                $name = "<p>{$transfer['sender_name']}</p>";
                            }
                            ?>
                            <!-- name -->
                            <td><?= $name ?></td>
                            <!-- transfer_amount -->
                            <td><?= $transfer['transfer_amount'] ?> $</td>
                            <!-- transfer_date -->
                            <td><?= $transfer['transfer_date'] ?></td>
                        </tr>
                    <?php
                        $id++;
                    }
                    ?>
                </tbody>
            </table>
            <?= $transfererror ?? "" ?>
            <?= $error ?? "" ?>
        </section>

</body>

</html>