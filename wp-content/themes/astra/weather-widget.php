<section class="vh-100" style="background-color: #C1CFEA;">
    <div class="container py-5">

        <div class="row d-flex justify-content-center align-items-center h-100" style="color: #282828;">
            <div class="col-md-9 col-lg-7 col-xl-7">
                <div class="card mb-4" style="border-radius: 25px;">
                    <div class="input-group">
                        <input type="text" class="form-control city-name" placeholder="City">

                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">OR</span>
                        </div>
                        <input type="text" class="form-control longitude" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="Longitude">
                        <input type="text" class="form-control latitude" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="Latitude">
                    </div>
                </div>

                <div class="card mb-4"style="margin-top: -20px;">
                <button type="button" class="btn btn-secondary btn-lg btn-block search-btn">Search</button>
                </div>
            </div>

            <div class="col-md-9 col-lg-7 col-xl-7">

                <div class="card mb-4 gradient-custom" style="border-radius: 25px;">
                    <div class="card-body p-4">
                        <div id="demo1">
                            <div class="d-flex justify-content-between mb-4 pb-2">
                                <div>
                                    <h2 class="display-2"><strong class="current-emperature"></strong><strong>°C</strong></h2>
                                    <p class="text-muted mb-0"><span class="full-city-name"></span>, <span class="country"></span></p>
                                    <div class ="divider"></div>
                                    <p class="text-muted1 mb-0">Min: 
                                        <span class="min-temp"></span><span>°C</span> Max: 
                                        <span class="max-temp"></span><span>°C</span>
                                    </p>
                                    <p class="text-muted1 mb-0">Feels like: <span class="feeling-temp"></span><span>°C</span></p>
                                    <p class="text-muted1 mb-0">Humidity: <span class="humidity"></span></p>
                                    <p class="text-muted1 mb-0">Pressure: <span class="pressure"></span></p>
                                </div>
                                <div>
                                    <img class="weather-img" src="https://openweathermap.org/img/w/04n.png" width="150px">
                                    <h2 class="img-description">Clouds</h2>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mb-4 seven-days-block" style="border-radius: 25px;">
                    <div class="card-body p-4">

                        <div id="demo2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="d-flex justify-content-around text-center mb-4 pb-3 pt-2 days-temperature">
                                        <!-- HTML added from Javascript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<script>
    //Api key and default location
    const key = "C815e7e6f6adf63781437395939c7e9d";
    var lat, long;
    var search = document.querySelector(".search-btn");
    var cityName = document.querySelector(".city-name");
    var currentWeatherBlock = document.querySelector(".gradient-custom");
    var mainNode = document.querySelector(".days-temperature");

    document.onload = getCoordonates("London");
    document.querySelector(".seven-days-block").style.display="none";


    search.addEventListener("click", function(){
        var city = cityName.value;
        var latitude = document.querySelector(".latitude");
        var longitude = document.querySelector(".longitude");
    
        if (city) {
            document.querySelector(".seven-days-block").style.display="none";
            currentWeatherBlock.style.display="flex";
            getCoordonates(city);
            insertCity(city);
            cityName.value = "";
        } else if (!city && !latitude.value && ! longitude.value) {
            return;
        } else {
            mainNode.innerHTML = "";
            lat = latitude.value;
            long = longitude.value;
            currentWeatherBlock.style.display="none";
            document.querySelector(".seven-days-block").style.display="flex";
            fetchResultsMoreDays();
            latitude.value = "";
            longitude.value = "";
        }
    }, false);
    
    function getCoordonates(city) {
        let url = `https://api.openweathermap.org/geo/1.0/direct?q=${city}&limit=1&appid=${key}`;
        fetch(url)
        .then((response) => response.json())
        .then((json) => returnCoordonates(json))
        .catch((error) => console.error(`Error fetching data: ${error.message}`));

    }

    function returnCoordonates(json){
        long = json[0].lon
        lat = json[0].lat
        fetchResults();
    }

    function fetchResults() {
    // Get the full URL
    let url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${long}&appid=${key}`;
    fetch(url)
        .then((response) => response.json())
        .then((json) => displayResults(json))
        .catch((error) => console.error(`Error fetching data: ${error.message}`));
    }

    //Disply result in HTML
    function displayResults(json) {
        // Variable definition
        var currentTemperature = document.querySelector(".current-emperature");
        var cityName = document.querySelector(".full-city-name");
        var cityCountryCode = document.querySelector(".country");
        var minTemperature = document.querySelector(".min-temp");
        var maxTemperature = document.querySelector(".max-temp");
        var feelingTemperature = document.querySelector(".feeling-temp");
        var humidity = document.querySelector(".humidity");   
        var pressure = document.querySelector(".pressure");
        var weatherImg = document.querySelector(".weather-img");
        var imageDescription = document.querySelector(".img-description");
        
        // Insert data in HTML
        currentTemperature.innerText = Math.round(json.main.temp-273.15);
        cityName.innerText = json.name;
        cityCountryCode.innerText = json.sys.country;
        minTemperature.innerText = Math.round(json.main.temp_min-273.15);
        maxTemperature.innerText = Math.round(json.main.temp_max-273.15);
        feelingTemperature.innerText = Math.round(json.main.feels_like-273.15);
        humidity.innerText = json.main.humidity;
        pressure.innerText = json.main.pressure;
        weatherImg.src = 'https://openweathermap.org/img/w/'+json.weather[0].icon+'.png';
        imageDescription.innerText = json.weather[0].main;
    };

    function fetchResultsMoreDays() {
        // Get the full URL
    let url = `https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${long}&appid=${key}`;
    fetch(url)
        .then((response) => response.json())
        .then((json) => displayResultsMoreDays(json))
        .catch((error) => console.error(`Error fetching data: ${error.message}`));
    }

    function displayResultsMoreDays(json) {
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        for (let i = 0; i < json.daily.length-1; i++) {
             // Variable definition and append HTML to main node
            var curentTimestamp = json.daily[i].dt.toString() + "000";
            var date = new Date(parseInt(curentTimestamp));
            var currentDate = date.getDate();
            var month = monthNames[date.getMonth()];
            var weatherImgSmall = json.daily[i].weather[0].icon;
            var temperatureMax = Math.round(json.daily[i].temp.max-273.15);
            var temperatureMin = Math.round(json.daily[i].temp.min-273.15);
            var description = json.daily[i].weather[0].main;
            var nodeChild = `<div class="flex-column" style="min-width: 70px !important;>\n
                    <p><strong class="date-month">${currentDate} ${month}</strong></p>\n
                    <img class="weather-img-small" src="https://openweathermap.org/img/w/${weatherImgSmall}.png" width="45px">\n
                    <p class="mb-0 small"><strong class="temperature-max">${temperatureMax}<span>°C</span></strong></p>\n
                    <p class="mb-0 small"><strong class="temperature-min">${temperatureMin}<span>°C</span></strong></p>\n
                    <p class="mb-0 text-muted weather-description-small" style="font-size: .65rem;">${description}</p>\n
                </div>`;
            mainNode.insertAdjacentHTML('beforeend', nodeChild);
        }
    }

    // Insert input city to DB
    function insertCity(city) {
    var City = city;
    var request = $.ajax({
        type: "POST",
        url: "/pragmatic/wp-content/themes/astra/insert-city.php",
        data: {City: City},
        dataType: "html"
    });

    request.done(function(msg) {
        console.log( "Response: " + msg );
        });

        request.fail(function(jqXHR, textStatus) {
        console.log( "Request failed: " + textStatus );
    });
    
}
        
</script>