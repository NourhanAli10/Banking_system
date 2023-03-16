<?php
include_once __DIR__ . "\Database\Customer.php";

$customerModel = new Customer;
$getCustomers = $customerModel->getAllCustomers();
if ($getCustomers->num_rows >= 1) {
    $customers = $getCustomers->fetch_all(MYSQLI_ASSOC);
} else {
    $error = "<div style='color: red; padding-top :25px ;font-size: 16px;'>No Customers yet</div>";
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
    <title>Show Customers</title>
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
            <h2>Customers</h2>
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
                    <?php
                    if (!empty($customers)) {
                        foreach ($customers as $customer) { ?>
                            <tr>
                                <td><?= $customer['customer_id'] ?></td>
                                <td><?= $customer['name'] ?></td>
                                <td><?= $customer['email'] ?></td>
                                <td><?= $customer['current_balance'] ?> $</td>
                                <td><a href="transcation.php?customerid=<?= $customer['customer_id'] ?>">Transfer</a></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <?= $error ?? "" ?>
        </section>
    </section>
</body>

</html>