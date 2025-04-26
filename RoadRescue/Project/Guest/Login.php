<?php
session_start();
include("../Assets/Connection/Connection.php");

// Handle Regular Login
if (isset($_POST["btnlogin"])) {
    $selUser = "SELECT * FROM tbl_user WHERE user_email = '".$_POST["txt_username"]."' AND user_password = '".$_POST["txt_password"]."'";
    $result_1 = $conn->query($selUser);
    $selAdmin = "SELECT * FROM tbl_admin WHERE admin_email = '".$_POST["txt_username"]."' AND admin_password = '".$_POST["txt_password"]."'";
    $result_2 = $conn->query($selAdmin);
    $selWorkshop = "SELECT * FROM tbl_workshop WHERE workshop_email = '".$_POST["txt_username"]."' AND workshop_password = '".$_POST["txt_password"]."' AND workshop_status = '1'";
    $result_3 = $conn->query($selWorkshop);
    $selMechanic = "SELECT * FROM tbl_mechanic WHERE mechanic_email = '".$_POST["txt_username"]."' AND mechanic_password = '".$_POST["txt_password"]."'";
    $result_4 = $conn->query($selMechanic);
    $selShop = "SELECT * FROM tbl_shop WHERE shop_email = '".$_POST["txt_username"]."' AND shop_password = '".$_POST["txt_password"]."' AND shop_status = '1'";
    $result_5 = $conn->query($selShop);

    if ($dataUser = $result_1->fetch_assoc()) {
        $_SESSION["uid"] = $dataUser["user_id"];
        $_SESSION["uname"] = $dataUser["user_name"];
        header("Location: ../User/HomePage.php");
        exit();
    } elseif ($dataAdmin = $result_2->fetch_assoc()) {
        $_SESSION["aid"] = $dataAdmin["admin_id"];
        $_SESSION["aname"] = $dataAdmin["admin_name"];
        header("Location: ../Admin/HomePage.php");
        exit();
    } elseif ($dataWorkshop = $result_3->fetch_assoc()) {
        $_SESSION["wid"] = $dataWorkshop["workshop_id"];
        $_SESSION["wname"] = $dataWorkshop["workshop_name"];
        header("Location: ../Workshop/HomePage.php");
        exit();
    } elseif ($dataMechanic = $result_4->fetch_assoc()) {
        $_SESSION["mid"] = $dataMechanic["mechanic_id"];
        $_SESSION["mname"] = $dataMechanic["mechanic_name"];
        header("Location: ../Mechanic/HomePage.php");
        exit();
    } elseif ($dataShop = $result_5->fetch_assoc()) {
        $_SESSION["sid"] = $dataShop["shop_id"];
        $_SESSION["sname"] = $dataShop["shop_name"];
        header("Location: ../Shop/HomePage.php");
        exit();
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}

// Handle Google Sign-In
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'])) {
    $token = $_POST['token'];
    $google_url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token;
    $response = file_get_contents($google_url);
    $token_info = json_decode($response, true);

    if (isset($token_info['email'])) {
        $email = $token_info['email'];
        $google_sub = $token_info['sub'];
        $name = $token_info['name'] ?? 'GoogleUser';
        $avatar = $token_info['picture'] ?? '';

        // Check if user exists
        $selUser = "SELECT * FROM tbl_user WHERE user_email = '$email'";
        $result = $conn->query($selUser);

        if ($result->num_rows > 0) {
            $dataUser = $result->fetch_assoc();
            $_SESSION["uid"] = $dataUser["user_id"];
            $_SESSION["uname"] = $dataUser["user_name"];
            echo json_encode(['success' => true, 'redirect' => '../User/HomePage.php']);
            exit();
        } else {
            // Create new user
            $insertUser = "INSERT INTO tbl_user (user_name, user_email, google_sub, user_avatar) VALUES ('$name', '$email', '$google_sub', '$avatar')";
            if ($conn->query($insertUser)) {
                $user_id = $conn->insert_id;
                $_SESSION["uid"] = $user_id;
                $_SESSION["uname"] = $name;
                echo json_encode(['success' => true, 'redirect' => '../User/HomePage.php']);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'User creation failed']);
                exit();
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid Google token']);
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        /* Your existing styles */
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-left: 2em;
            padding-right: 2em;
            padding-bottom: 0.4em;
            background-color: #171717;
            border-radius: 25px;
            transition: .4s ease-in-out;
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }

        .form:hover {
            transform: scale(1.05);
            border: 1px solid black;
        }

        #heading {
            text-align: center;
            margin: 2em;
            color: rgb(255, 255, 255);
            font-size: 1.2em;
        }

        .field {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5em;
            border-radius: 25px;
            padding: 0.6em;
            border: none;
            outline: none;
            color: white;
            background-color: #171717;
            box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
        }

        .input-icon {
            height: 1.3em;
            width: 1.3em;
            fill: white;
        }

        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: #d3d3d3;
        }

        .form .btn {
            display: flex;
            justify-content: center;
            flex-direction: row;
            margin-top: 2.5em;
        }

        .button1 {
            padding: 0.5em;
            padding-left: 1.1em;
            padding-right: 1.1em;
            border-radius: 5px;
            margin-right: 0.5em;
            border: none;
            outline: none;
            transition: .4s ease-in-out;
            background-color: #252525;
            color: white;
        }

        .button1:hover {
            background-color: black;
            color: white;
        }

        .button2 {
            padding: 0.5em;
            padding-left: 2.3em;
            padding-right: 2.3em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: .4s ease-in-out;
            background-color: #252525;
            color: white;
        }

        .button2:hover {
            background-color: black;
            color: white;
        }

        .g_id_signin {
            margin-bottom: 3em;
            width: 100%;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body class="img js-fullheight" style="background-image: url(../Assets/Templates/Login/images/Snapseed-Background-92.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <form class="form" action="#" method="post">
                        <p id="heading">Login</p>
                        <div class="field">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                            </svg>
                            <input autocomplete="off" placeholder="Username" class="input-field" type="text" name="txt_username" required>
                        </div>
                        <div class="field">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                            </svg>
                            <input placeholder="Password" class="input-field" type="password" name="txt_password" required>
                        </div>
                        <div class="btn">
                        <button type="submit" name="btnlogin" class="button1">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                        <a href="UserRegistration.php">
                            <button type="button" class="button2">Sign Up</button>
                        </a>
                    </div>

                        <!-- Google Sign-In Button -->
                        <div id="google-signin-button"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../Assets/Templates/Login/js/jquery.min.js"></script>
    <script src="../Assets/Templates/Login/js/popper.js"></script>
    <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Login/js/main.js"></script>

    <script>
        function handleCredentialResponse(response) {
            const token = response.credential;
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `token=${token}`,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert('Google login failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        window.onload = function () {
            google.accounts.id.initialize({
                client_id: "624566371990-do2htsvqi1q441oennqd2ebbdeq74ncq.apps.googleusercontent.com", // Replace with your Google Client ID
                callback: handleCredentialResponse,
                redirect_uri: "http://localhost/RoadRescue/RoadRescue/Project/Guest/Login.php" // Match your URL
            });
            google.accounts.id.renderButton(
                document.getElementById("google-signin-button"),
                { theme: "outline", size: "large" }
            );
        };
    </script>
</body>
</html>