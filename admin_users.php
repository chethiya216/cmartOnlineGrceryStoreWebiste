<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>users</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!--   admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">



</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="users">

        <h1 class="title"> user accounts </h1>

        <div class="box-container">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            while ($fetch_users = mysqli_fetch_assoc($select_users)) {
            ?>
                <div class="box">
                    <p> user id : <span><?php echo $fetch_users['id']; ?></span> </p>
                    <p> username : <span><?php echo $fetch_users['name']; ?></span> </p>
                    <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
                    <p> user type : <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                                                            echo 'var(--orange)';
                                                        } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
                    <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
                </div>

                
                <!-- <table>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    
                    $fetch_users = mysqli_query($conn, "SELECT * FROM users") or die('query failed');
                    while ($user = mysqli_fetch_assoc($fetch_users)) {
                    ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td style="color:<?php if ($user['user_type'] == 'admin') {
                                                    echo 'var(--orange)';
                                                } ?>">
                                <?php echo $user['user_type']; ?>
                            </td>
                            <td><a href="admin_users.php?delete=<?php echo $user['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">Delete User</a></td>
                        </tr>
                    <?php } ?>
                </table> -->

            <?php
            };
            ?>
        </div>

    </section>

    <!--   admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>