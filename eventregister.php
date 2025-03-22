<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['register'])) {
    // Sanitize inputs

    // $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $event_type = filter_var($_POST['event_type'], FILTER_SANITIZE_STRING);
    $event_date = filter_var($_POST['event_date'], FILTER_SANITIZE_STRING);

    // Check for empty or invalid fields
    if (empty($name) || empty($email) || empty($event_type) || empty($event_date)) {
        $message[] = 'Please fill in all fields!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format!';
    } else {
        // Prepare and execute SQL statement
        try {
            $select_registration = $conn->prepare("SELECT * FROM event_registrations WHERE user_id = ? AND event_type = ? AND event_date = ?");
            $select_registration->execute([$user_id, $event_type, $event_date]);

            if ($select_registration->rowCount() > 0) {
                $message[] = 'You are already registered for this event!';
            } else {
                $insert_registration = $conn->prepare("INSERT INTO event_registrations(user_id, name, email, event_type, event_date) VALUES(?,?,?,?,?)");
                $insert_registration->execute([$user_id, $name, $email, $event_type, $event_date]);
                $message[] = 'Registration made successfully!';
            }
        } catch (PDOException $e) {
            $message[] = 'Error: ' . $e->getMessage();
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
    <title>Event Registration</title>
    <style>
/* Reset default margin and padding */


/* Container for the form */
.registration {
    width: 80%;
    max-width: 600px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Heading styles */
.heading {
    text-align: center;
    margin-bottom: 20px;
}

 .name {
    text-align: center;
    font-size: 30px;
    color: #333;
}

.heading p {
    font-size: 14px;
    color: #666;
}

.heading a {
    color: #3498db;
    text-decoration: none;
}

/* Form styles */
.box {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;

}

.btn:hover {
    background-color: #2980b9;
}

/* Message styles */
.message {
    margin-top: 10px;
    padding: 10px;
    background-color: #f2dede;
    color: #a94442;
    border: 1px solid #ebccd1;
    border-radius: 4px;
}




    </style>
  

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
   
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
    <h3>Event Registration</h3>
    <p><a href="home.php">Home</a> <span> / Event Registration</span></p>
</div>

<!-- registration section starts  -->
<section class="registration">
    <div class="row">
        <div class="image">
            <img src="images/book.jpg" alt="Event Image">
        </div>

        <form action="" method="post"><br><br>
            <h3 class="name">Register for the event!</h3> <br>

     <select name="category" class="box" required>
         <option value="Sri lanka Foods">Sri lankan foods</option>
         <option value="Italian Foods">Italian foods</option>
         <option value="Chines Foods">Chines foods</option>
         <option value="desserts">Japanese foods</option>
      </select>
            <input type="text" name="name" maxlength="50" class="box" placeholder="Enter your name" required>
            <input type="email" name="email" maxlength="50" class="box" placeholder="Enter your email" required>
            <input type="text" name="event_type" maxlength="50" class="box" placeholder="Enter event type" required>
            <input type="date" name="event_date" class="box" required>
            <input type="submit" value="Register Now" name="register" class="btn">
        </form>
    </div>

    <!-- <?php
    // if (isset($message)) {
    //     foreach ($message as $msg) {
    //         echo '<div class="message">' . htmlspecialchars($msg) . '</div>';
    //     }
    // }
    ?> -->
</section>
<!-- registration section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
