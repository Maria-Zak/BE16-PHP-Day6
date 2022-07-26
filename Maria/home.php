<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

$sql = "SELECT * FROM products";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table
if (mysqli_num_rows($result)  > 0) {
    while ($row1 = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr class= 'align-middle'>
            <td class='text-center'><img class='img-thumbnail product-img' src='pictures/". $row1['picture'] ."'</td>
            <td>" . $row1['name'] . "</td>
            <td>" . $row1['price'] . "</td>
            <td><a class='btn btn-primary btn-sm' href='details.php?id=" . $row1['id'] . " '>Details</a></td>
            </tr>";
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <style>
        .userImage {
            width: 200px;
            height: 200px;
        }
        .product-img{
            width: 100px;
            height: 100px;
        }

        .hero {
            background: rgb(2, 0, 36);
            background: linear-gradient(24deg, rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="hero">
            <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
            <p class="text-white">Hi <?php echo $row['first_name']; ?></p>
        </div>
        <a class="btn btn-danger" href="logout.php?logout">Sign Out</a>
        <a class="btn btn-warning" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
        <div class="products">
        <table class='table'>
            <thead class='table-success '>
                <tr >
                    <th class="text-center">Picture</th>
                    <th>Name</th>
                    <th>price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>
        </div>
        <a class="btn btn-danger" href="form.php?form">Contact</a>
    </div>
</body>
</html>