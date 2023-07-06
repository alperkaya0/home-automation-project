function onLoad() {
    //LOAD CHARTS
    loadCharts();
    //LOAD WELCOMING MESSAGE
    fetch('./buttons-backend/getFullName.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(response => {
            console.log(JSON.stringify(response));
            document.getElementById("welcoming-message").innerHTML = "Welcome Back, " + response + "<span class=\"badge bg-secondary\">Account Holder</span>";
        });
    //LOAD EMERGENCY PART
    fetch('./buttons-backend/buttons_emergency.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("emergencyImage");
        let p   = document.getElementById("emergencyParagraph");
        if (response == "true") {
            img.setAttribute("src", "./images/emergency.png");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        } else {
            img.setAttribute("src", "./images/nonEmergency.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        }
    });
    //LOAD AC PART
    fetch('./buttons-backend/buttons_ac.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("acGif");
        let p   = document.getElementById("acParagraph");
        if (response == "true") {
            img.setAttribute("src", "./images/workingFan.gif");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        } else {
            img.setAttribute("src", "./images/stoppedFan.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        }
    });
    //LOAD WEATHER PART
    fetch('./buttons-backend/buttons_weather.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("weatherImage");
        let p   = document.getElementById("weatherParagraph");
        
        img.setAttribute("src", "./images/"+ response +".png");
        p.innerHTML = response;
    });
    //LOAD LIGHTS PART
    fetch('./buttons-backend/buttons_lights.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("lightsImage");
        let p   = document.getElementById("lightsParagraph");
        
        if (response == "true") {
            img.setAttribute("src", "./images/lightsOn.png");
            p.innerHTML = "ON";
        } else {
            img.setAttribute("src", "./images/lightsOff.png");
            p.innerHTML = "OFF";
        }
    });
    //LOAD WINDOW BLIND PART
    fetch('./buttons-backend/buttons_window.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("blindsImage");
        
        if (response == "true") {
            img.setAttribute("src", "./images/blindsOpened.png");
        } else {
            img.setAttribute("src", "./images/blindsClosed.png");
        }
    });
    //LOAD TEMPERATURE PART
    fetch('./buttons-backend/buttons_temperature.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p = document.getElementById("temperatureParagraph");
        p.innerHTML = response;
    });

}

function addDeviceDefault() {
    var select = document.getElementById('deviceName');
    var option = select.options[select.selectedIndex];
    console.log(option.innerHTML);
    fetch('../consumer/buttons-backend/buttons_submit_add_device_default.php', {
        method: 'POST',
        body: JSON.stringify({
            device: option.innerHTML.toLowerCase()
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        debugger;
    });
}

function onClickEmergency() {
    console.log("worksEmergency");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("emergencyImage");
    let p   = document.getElementById("emergencyParagraph");
    fetch('./buttons-backend/buttons_emergency.php', {
        method: 'POST',
        body: JSON.stringify({
            isEmergency: (img.getAttribute("src") == "./images/emergency.png" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/emergency.png") {
            img.setAttribute("src", "./images/nonEmergency.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        } else {
            img.setAttribute("src", "./images/emergency.png");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        }
    });
}

function onClickAc() {
    console.log("worksAc");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("acGif");
    let p   = document.getElementById("acParagraph");
    fetch('./buttons-backend/buttons_ac.php', {
        method: 'POST',
        body: JSON.stringify({
            isAcOn: (img.getAttribute("src") == "./images/workingFan.gif" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/workingFan.gif") {
            img.setAttribute("src", "./images/stoppedFan.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        } else {
            img.setAttribute("src", "./images/workingFan.gif");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        }
    });
}

function onClickLightsOn() {
    console.log("worksLightsOn");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("lightsImage");
    let p   = document.getElementById("lightsParagraph");
    fetch('./buttons-backend/buttons_lights.php', {
        method: 'POST',
        body: JSON.stringify({
            isLightsOn: (img.getAttribute("src") == "./images/lightsOn.png" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/lightsOn.png") {
            img.setAttribute("src", "./images/lightsOff.png");
            p.innerHTML = "OFF";
        } else {
            img.setAttribute("src", "./images/lightsOn.png");
            p.innerHTML = "ON";
        }
    });
}

function onClickWindow() {
    console.log("worksWindow");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("blindsImage");
    fetch('./buttons-backend/buttons_window.php', {
        method: 'POST',
        body: JSON.stringify({
            isWindowBlindOn: (img.getAttribute("src") == "./images/blindsOpened.png" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/blindsOpened.png") {
            img.setAttribute("src", "./images/blindsClosed.png");
        } else {
            img.setAttribute("src", "./images/blindsOpened.png");
        }
    });
}

function onClickTemperatureUp() {
    console.log("worksTemperature");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let p = document.getElementById("temperatureParagraph");
    fetch('./buttons-backend/buttons_temperature.php', {
        method: 'POST',
        body: JSON.stringify({
            temperature: parseInt(p.innerHTML) + 1
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        p.innerHTML = parseInt(p.innerHTML) + 1;
    });
}

function onClickTemperatureDown() {
    console.log("worksTemperature");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let p = document.getElementById("temperatureParagraph");
    fetch('./buttons-backend/buttons_temperature.php', {
        method: 'POST',
        body: JSON.stringify({
            temperature: parseInt(p.innerHTML) - 1
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        p.innerHTML = parseInt(p.innerHTML) - 1;
    });
}

function loadCharts() {
    fetch('./charts-backend/charts_temperature.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (!response["Monday"]) {
            response["Monday"] = 0;
        }
        if (!response["Tuesday"]) {
            response["Tuesday"] = 0;
        }
        if (!response["Wednesday"]) {
            response["Wednesday"] = 0;
        }
        if (!response["Thursday"]) {
            response["Thursday"] = 0;
        }
        if (!response["Friday"]) {
            response["Friday"] = 0;
        }
        if (!response["Saturday"]) {
            response["Saturday"] = 0;
        }
        if (!response["Sunday"]) {
            response["Sunday"] = 0;
        }
        const ctx = document.getElementById("chart").getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: ["Sunday", "Monday", "Tuesday",
            "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [{
                label: 'Temperature',
                backgroundColor: 'rgb(178, 164, 255)',
                borderColor: 'rgb(147, 132, 209)',
                data: [
                response["Monday"],
                response["Tuesday"],
                response["Wednesday"],
                response["Thursday"],
                response["Friday"],
                response["Saturday"],
                response["Sunday"]]
            }]
            },
            options: {
            scales: {
                yAxes: [{
                ticks: {
                    beginAtZero: true,
                }
                }]
            }
            },
        });
    })
    
    fetch('./charts-backend/charts_light_usage.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        const ctx2 = document.getElementById("chart-2").getContext('2d');
        const myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ["Last Decade", "This Year", "This Week", "Today"],
            datasets: [{
            label: 'Light Usage',
            backgroundColor: 'rgb(255, 180, 180)',
            borderColor: 'rgb(147, 132, 209)',
            data: [response["decade"], response["year"], response["week"], response["day"]],
            }]
        },
        options: {
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true,
                }
            }]
            }
        },
        });
    });

    
    fetch('./charts-backend/charts_energy_consumption.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        const ctx3 = document.getElementById("chart-3").getContext('2d');
        const myChart3 = new Chart(ctx3, {
            type: 'pie',
            data: {
            labels: ["Last Decade", "This Year", "This Week", "Today"],
            datasets: [{
                label: 'Air Conditioning Energy Consumption',
                backgroundColor: 'rgb(255, 222, 180)',
                borderColor: 'rgb(255, 180, 180)',
                data: [response["decade"], response["year"], response["week"], response["day"]],
            }]
            },
        });
    });

    fetch('./charts-backend/charts_weather.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        const ctx4 = document.getElementById("chart-4").getContext('2d');
        const myChart4 = new Chart(ctx4, {
        type: 'doughnut',
        data: {
            labels: ["sunny", "rainy", "cloudy", "stormy", "windy"],
            datasets: [{
            label: 'Weather',
            data: [response["sunny"], response["rainy"], response["cloudy"], response["stormy"], response["windy"]],
            backgroundColor: ["#FEFF86", "#B0DAFF", "#DAF5FF", "#576CBC", "#B9E9FC"]
            }]
        },
        });
    });
}