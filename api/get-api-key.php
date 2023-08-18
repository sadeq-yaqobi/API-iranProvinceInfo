<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Assets/CSS/main.css">
    <title>Generate Token</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h1>Generate Token</h1>
                <input type="email" name="email" class="email" placeholder="Email..." />
                <input type="submit" name="submit" id="btn" class="btn" value="generate token" onclick="jwt_generator()">
                <textarea name="txtArea" id="txtArea" cols="30" rows="10" readonly></textarea>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your email address to generate a token that you can use in our APIs</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="#">us</a>
            - Read how to work this API
            <a target="_blank" href="#">here</a>.
        </p>
    </footer>


    <script>
        function jwt_generator() {
            <?php
            include "../loader.php";
            $request_method = $_SERVER['REQUEST_METHOD'];
            if (!isset($_POST['submit']) && !$_POST['submit'] == "generate token")
                die("Bad request");
            if ($request_method != "POST")
                die("Request not supported");
            if (empty($_POST['email']))
                die("Email field is required");
            $email = trim(htmlentities(strip_tags($_POST['email'])));
            $user = getUserByEmail($email);
            if (is_null($user))
                die("User not found");
            $jwt = createApiToken($user);
            ?>
        }

        // JavaScript code to set the value of the textarea using PHP variable
        var jwt = "<?php echo $jwt ?>";
        if (jwt == '') {
            document.getElementById("txtArea").style.display = "none";
        } else {
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("txtArea").style.display = "block";
                document.getElementById("txtArea").value = jwt;
            });
        }
    </script>
</body>

</html>