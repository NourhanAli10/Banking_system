<?php
include_once __DIR__ . "\Database\Transfer.php";

$transferModel = new Transfer;
$getTtransfers = $transferModel->getAllTransactions();

if ($getTtransfers->num_rows >= 1) {
    $transfers = $getTtransfers->fetch_all(MYSQLI_ASSOC);
} else {
    $error = "<div style='color: red; padding-top :25px ;font-size: 16px;'>No Transactions yet</div>";
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
    <title>Show transacations</title>
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
            <h2>Transacations</h2>
            <hr>
            <table>
                <thead>
                    <th>ID</th>
                    <th>sender_name</th>
                    <th>receiver_name</th>
                    <th>transfer_amount</th>
                    <th>transfer_date</th>
                </thead>
                <tbody>
                    <?php if (!empty($transfers)) {
                        foreach ($transfers as $transfer) { ?>
                            <tr>
                                <td><?= $transfer['id'] ?></td>
                                <td><?= $transfer['sender_name'] ?></td>
                                <td><?= $transfer['receiver_name'] ?></td>
                                <td><?= $transfer['transfer_amount'] ?> $</td>
                                <td><?= $transfer['transfer_date'] ?> </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <?= $error ?? "" ?>
        </section>
</body>

</html>