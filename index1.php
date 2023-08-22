<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="icon" href="images/search-employee-8969.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Urban Workers</title>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var loginButton = document.getElementById("login-button");
            var loginOptions = document.getElementById("login-options");

            loginButton.addEventListener("click", function () {
                loginOptions.classList.toggle("hidden");
            });
        });
    </script>
</head>

<body>
    <div class="nav">
        <div class="navbar">
            <div class="navbar-start">
                <a href="index1.php" class="btn btn-ghost normal-case text-xl ">Urban Workers</a>
            </div>
            <div class="navbar-center text-gray-900 font-semibold">
                <ul class="menu menu-horizontal px-1">
                    <li><a>About</a></li>
                    <li><a>Services</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                <div class=" inline-block text-left">
                    <?php
                    session_start();
                    if(isset($_SESSION['email'])) {
                        echo '<p>Welcome, ' . $_SESSION['email'] . '</p>';
                        // header("Location: ../index.htnl"); // Redirect to main page

                     echo '<a href="index.html">Logout</a>';
                    } else {
                        echo '<button type="button" class="btn-login open-modal" data-modal="login-modal">Login</button>';
                        echo '<button type="button" class="btn-signup">Sign up</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
        <header class="max">
            <div class="container">
                <div class="theme">
                    <h1>
                        Find the right service <br>
                        right away
                    </h1>
                    <p>
                        Forget the old rules. You can have the best people.<br>
                        Right now. Right here.
                    </p>
                    <!-- <form action="">
                  <input type="" placeholder="Enter your email here" required>
                  <button class="btn3" type="submit">Subscribe</button>
              </form> -->
                    <div class="Search">
                        <form action="" class="mt-10 text-2xl text-gray-600">
                            <input type="text" placeholder="Search here"
                                class=" Search my-1 px-20 py-3 border-2 border-gray-200 rounded-xl bg-gray-300">
                            <button type="submit"
                                class="btn3 bg-green-600 rounded-2xl px-6 py-3 ml-1 text-white mr-">Search</button>
                        </form>
                    </div>



                </div>
                <div class="pic">
                    <img src="images/working-man.jpg" alt="">
                </div>

            </div>

        </header>


        <section class="our-Services" id="our-service">
            <div class="Services">
                <h1>

                    Our Services

                </h1>
                <hr>
            </div>
            <div class="allServices max">

                <div class="box">
                    <a href="php/fetch.php?service=AC%20Servicing">
                        <img src="images/ac.jpg" alt="AC Servicing">
                        <h1>AC Servicing</h1>
                    </a>
                </div>
                <div class="box">
                    <!-- <img src="images/paint.webp" alt="">
                <h1>
                    <a href="php/fetch.php"> 
                        Painting Servicing
                    </a>


                </h1> -->

                    <a href="php/fetch.php?service=Painting%20Servicing">
                        <img src="images/paint.webp" alt="Painting Servicing">
                        <h1>Painting Servicing</h1>
                    </a>
                </div>
                <div class="box">
                    <a href="php/fetch.php?service=Home%20cleaning">
                        <img src="images/clean.jpg" alt="Home cleaning">
                        <h1>Home Cleaning</h1>
                    </a>
                </div>
                <div class="box">
                    <a href="php/fetch.php?service=Plumbing%20Services">
                        <img src="images/plumb.webp" alt="Plumbing Services">
                        <h1>Plumbing Services</h1>
                    </a>
                </div>
            </div>
            <div class="allServices max">
                <div class="box">
                    <img src="images/shift.jpg" alt="">
                    <h1>Shifting Services</h1>
                </div>
                <div class="box">
                    <img src="images/beauty.jpg" alt="">
                    <h1>Beauty Care</h1>
                </div>
                <div class="box">
                    <img src="images/laptop.jpg" alt="">
                    <h1>Laptop Services</h1>
                </div>
                <div class="box">
                    <img src="images/cctv.jpg" alt="">
                    <h1>CCTV Camera Services</h1>
                </div>

            </div>
            <!--
        <div class="max-w-screen-xl mx-auto border-solid border-gray-300">
            <div class="carousel w-full">
                <div id="item1" class="carousel-item w-full h-1/2">
                    <img src="images/home6.avif" class="" />
                </div>
                <div id="item2" class="carousel-item w-full h-1/2">
                    <img src="images/homey.jpg" class="" />
                </div>
                <div id="item3" class="carousel-item w-full">
                    <img src="images/home4.avif" class="" />
                </div>
                <div id="item4" class="carousel-item w-full">
                    <img src="images/home5.avif" class="" />
                </div>
            </div>
            <div class="flex justify-center w-full py-2 gap-2">
                <a href="#item1" class="btn btn-xs">1</a>
                <a href="#item2" class="btn btn-xs">2</a>
                <a href="#item3" class="btn btn-xs">3</a>
                <a href="#item4" class="btn btn-xs">4</a>
            </div>
        </div>
         -->
        </section>

        <section class="About us">
            <h1 class="font-bold text-4xl m-10 text-center">
                About us
            </h1>
            <p class="text-center">Welcome to Urban Workers, your one-stop destination for finding the best professional
                services for your needs. With years of experience in connecting customers with skilled workers, we are
                dedicated to revolutionizing the way you find and hire professionals.

            </p>

            <h1 class="font-bold text-4xl m-10 text-center">
                why choose us

            </h1>
            <ul class="list-disc list-inside text-gray-600 text-center">
                <li>Wide range of services for every need</li>
                <li>Verified and highly skilled professisss</li>
                <li>Effortless booking and scheduling and</li>
                <li>Transparent pricing and reviews others</li>
                <li>Secure and user-friendly platformingss</li>
            </ul>

        </section>




        <footer>
            <div class="foot">

                <div class="pic6">
                    <img src="images/search-employee-8969.png" alt="">
                    <p class="x6 text-2xl ">Urban Workers</p>

                </div>
                <div class="list1">
                    <li>
                        <a href="">Our story</a>
                    </li>
                    <li>
                        <a href="">About us</a>
                    </li>
                    <li>
                        <a href="">Services</a>

                    </li>
                    <li>
                        <a href="">Careers</a>
                    </li>
                    <li>
                        <a href="">Supports</a>

                    </li>
                    <li>
                        <a href="">My Account</a>
                    </li>

                </div>
                <div class="icon5">
                    <img class="aa" src="images/twitter-logo-2429.png" alt="">
                    <img class="aa" src="images/facebook-5221.png" alt="">
                    <img class="aa" src="images/linkedin-logo-2430.png" alt="">
                    <img class="bb" src="images/youtube-logo-2431.png" alt="">
                    <img class="bb" src="images/instagram-logo-8869.png" alt="">
                </div>
                <div class="list2">
                    <li>
                        <a href="">
                            Terms and Conditions

                        </a>
                    </li>
                    <li>
                        <a href="">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="">Cookie Policy</a>

                    </li>
                    <li>
                        <a href="">Privacy Settings</a>
                    </li>


                </div>
                <div>
                    <p class="p0">
                        Copyright ©2023 urban workers. All Rights Reserved
                    </p>
                </div>
            </div>
    </div>
    </footer>

</body>

</html>