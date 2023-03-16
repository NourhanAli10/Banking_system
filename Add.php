<?php
include_once __DIR__ . "\Database\Customer.php";
include_once __DIR__ . "\Requests\Validation.php";

$validation = new Validation;
$newCustomer = new Customer;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        // validation rules
        $validation->setInputName('name')->setInputValue($_POST['name'] ?? "")->required()
            ->string();
        $validation->setInputName('email')->setInputValue($_POST['email'] ?? "")->required()
            ->regex()->unique();
        $validation->setInputName('balance')->setInputValue($_POST['balance'] ?? "")->required()
            ->numeric();
        if (empty($validation->getErrors())) {
            $newCustomer->setName($_POST['name'])->setEmail($_POST['email'])
                ->setCurrent_balance($_POST['balance']);
            //add Customer
            if ($newCustomer->addNewCustomer()) {
            $successMessage = "<p style='color: white; font-size: 18px; text-align:center; font-weight:bold; background-color: #3C32A3;'>Your process has been done successfully.</p>";
                header('refresh:3; url=show-customers.php');
            } else {
                $error = "<div style='color: red; font-size: 18px; text-align:center; font-weight:bold;>  please try again later</div>";
            }
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
    <link rel="stylesheet" href="css/table.css" type="text/css">
    <title>Add customer</title>
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
        <div id="add-form">
            <?= $error ?? "" ?>
            <?=  $successMessage ?? "" ?>
            <form method="post">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder=" Enter your name">
                <?= "<p style='color: red; font-size: 18px;'>" . $validation->getError('name') . "</p>" ?>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder=" Enter your email">
                <?= "<p style='color: red; font-size: 18px;'>" . $validation->getError('email') . "</p>" ?>
                <label for="balance">Balance</label>
                <input type="number" name="balance" id="balance" placeholder=" Enter your balance">
                <?= "<p style='color: red; font-size: 18px;'>" . $validation->getError('balance') . "</p>" ?>
                <button type="submit" name="add"> Add</button>
            </form>
        </div>
    </section>
    <script src="js/input.js"></script>
</body>

</html>