<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="./scripts/main.js"></script>
    <link rel="icon" type="image/x-icon" href="./images/logo.png">
    <style>
        .chart-container {
            width: 90rem;
            height: 50%;
        }
    </style>
</head>
<body onload="onLoad();">
    <?php
        if (!isset($_SESSION["username"])) {
            header("Location: login.php");
            exit();
        }
        function alert($msg) {//you can use this function to alert the updates instead of echoing them at the bottom of the page
            echo "<script type='text/javascript'>alert('$msg')</script>";
        }
    ?>
    <?php include "../navbar.php" ?>

    <div class="mt-5 ms-5 mb-5">
        <h2 id="welcoming-message">Welcome Back,<span class="badge bg-secondary">Account Holder</span></h2>
    </div>

    <div class="shadow-lg p-3 mb-5 mx-5 bg-body rounded">Your Sensors And Controls.</div>

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                <div class="card" id="emergencyAlert">
                    <img id="emergencyImage" src="./images/emergency.png" class="card-img-top" alt="emergency_image" height="235" style="object-fit: contain">
                    <div class="card-body">
                        <div class="container text-center">
                        <h5 class="card-title">Emergency Alert</h5>
                        <p id="emergencyParagraph" class="card-text">Emergency alert is <b>ON</b></p>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <button class="btn btn-primary" type="button" onclick="onClickEmergency();">Toggle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card">
                    <a href="#chart-4">
                        <img id="weatherImage" src="./images/sunny.png" class="card-img-top" alt="..." height="235" style="object-fit: contain;">
                    </a>
                    <div class="card-body">
                        <div class="container text-center">
                            <h5 class="card-title">Weather Forecast</h5>
                            <p class="card-text">Forecasted weather for tomorrow is <b id="weatherParagraph">sunny</b>.</p>
                            <!-- TO GIVE SOME SPACE -->
                            <div class="mb-4"></div>
                            <!-- TO GIVE SOME SPACE -->
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item">
                <div class="card" id="airConditioning">
                    <a href="#chart-3">
                        <img id="acGif" src="./images/workingFan.gif" class="card-img-top" alt="..." height="235" width="432" style="object-fit: contain;">
                    </a>
                    <div class="card-body">
                        <div class="container text-center">
                            <h5 class="card-title">Air Conditioning</h5>
                            <p id="acParagraph" class="card-text">You can turn on/off AC.</p>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <button class="btn btn-primary" onclick="onClickAc();">AC Toggle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card">
                    <a href="#chart-2">
                    <img id="lightsImage" src="./images/lightsOn.png" class="card-img-top" alt="..." height="235" width="432" style="object-fit: contain;">
                    </a>
                    <div class="card-body">
                        <div class="container text-center">
                            <h5 class="card-title">Switch Lights</h5>
                            <p class="card-text">You can switch lights on and off from here. It's <b id="lightsParagraph">on</b> now.</p>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <button class="btn btn-primary" onclick="onClickLightsOn();">Lights Toggle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card">
                    <img id="blindsImage" src="./images/blindsOpened.png" class="card-img-top" alt="..." height="235" width="432" style="object-fit: contain;">
                    <div class="card-body">
                        <div class="container text-center">
                            <h5 class="card-title">Control Window Blinds</h5>
                            <p class="card-text">You can control them anytime you want.</p>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <button class="btn btn-primary" onclick="onClickWindow();">Window Blind Toggle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card" id="temperature">
                    <a href="#chart">
                    <img src="./images/temperature.png" class="card-img-top" alt="Temperature image" height="235" width="432" style="object-fit: contain;">
                    </a>
                    <div class="card-body">
                        <div class="container text-center">
                            <h5 class="card-title">Temperature</h5>
                            <p class="card-text">House temperature is <b id="temperatureParagraph"></b><b>C.</b></p>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <button class="btn btn-primary" type="button" onclick="onClickTemperatureUp();">+</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary" type="button" onclick="onClickTemperatureDown();">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <button class="carousel-control-prev carousel-dark" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next carousel-dark" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container text-center my-5"><div class="row"><div class="col-12"><img src="./images/seperator.png" height="20rem" style="opacity:0.8"></div></div></div>

    <div class="shadow-lg p-3 mb-5 mx-5 bg-body rounded">Your House Statistics</div>

    <div class="card chart-container m-5 py-5">
        <div class="row justify-content-center">
            <div class="col">
                <canvas id="chart"></canvas>
            </div>
            <div class="col">
                <canvas id="chart-2"></canvas>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="text-center mt-3" style="font-size: 0.8rem; color: gray"><p>Energy Consumption</p></div>
                <canvas id="chart-3"></canvas>
            </div>
            <div class="col">
                <div class="text-center mt-3" style="font-size: 0.8rem; color: gray"><p>Weather of Last Year</p></div>
                <canvas id="chart-4"></canvas>
            </div>
        </div>
    </div>

    <div class="container text-center my-5"><div class="row"><div class="col-12"><img src="./images/seperator.png" height="20rem" style="opacity:0.8"></div></div></div>
    
    <div class="shadow-lg p-3 mb-5 mx-5 bg-body rounded">About Your House</div>

    <div class="shadow-lg p-3 mb-5 mx-5 bg-body rounded">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices imperdiet tempor. Etiam eu scelerisque odio. Nullam auctor eget mi eget tincidunt. In lacinia pulvinar neque nec bibendum. Nulla nulla enim, aliquet consequat felis eu, consequat tempus elit. Aliquam erat volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc feugiat nulla nec justo fermentum sodales. In vulputate justo lacus, id fermentum ligula tristique non. Ut ultricies diam vitae pulvinar tempor. Suspendisse potenti. Suspendisse potenti. Mauris vel lacus mi. Cras convallis augue at dapibus accumsan.

Ut lacinia enim velit, in semper ligula ornare ac. Nulla a feugiat tortor. Fusce vulputate posuere ex, nec interdum ante viverra sed. Phasellus orci mi, mattis vel euismod vel, malesuada at elit. Integer pretium ex eu pretium lacinia. Donec auctor mollis venenatis. Duis in congue sapien. Sed faucibus at ex vitae vestibulum. Fusce ac odio quam.

Donec non venenatis libero, eget aliquet felis. Morbi quis ex efficitur, luctus dui in, sollicitudin ligula. Vestibulum maximus velit risus, ut maximus purus blandit vel. Aenean consequat sit amet mi euismod ultricies. Nunc ac augue quis velit molestie scelerisque quis a elit. Proin aliquet magna efficitur lobortis aliquam. Pellentesque at arcu non enim sodales porta sed nec orci. Curabitur massa orci, ornare non semper in, imperdiet at lorem. Morbi nisi libero, mattis in urna a, tincidunt lacinia felis. Proin efficitur cursus sem, a hendrerit velit ornare ut. Ut in nunc non est iaculis posuere non vitae ex. Morbi lobortis diam id rhoncus pellentesque. Nunc nec magna ipsum. Suspendisse consequat non nisi ac scelerisque. In blandit nisi interdum pellentesque congue. Quisque sed posuere neque.
    </div>











    <?php include '../toast.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

    <?php include "../footer.php" ?>
</body>
</html>