<?php

use App\Models\User;
use Carbon\Carbon;

$user = User::where("chat_id", $chat_id)->first();
$userMeals = $user->meals;
$timezone = $user->timezone;
$localDayStartInUTC = Carbon::today($timezone)->subHour(Carbon::today()->offsetHours);

$todayMeals = $userMeals->where('created_at', '>=', $localDayStartInUTC);
// if (empty($todayMeals)) {
//     $todayMeals[] = ""
// }

// dump($todayMeals);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <style>
        body {
            background: var(--tg-theme-bg-color);
            color: var(--tg-theme-text-color);
        }

        path {
            fill: var(--tg-theme-text-color);
        }

        .list-group-item {
            background-color: var(--tg-theme-secondary-bg-color);
            color: var(--tg-theme-text-color);
        }
    </style>

    <div class="container" id="body">

        <div id="amogus"></div>

        <div class=" mt-5">
            <h2 class="text-center mb-4">Ваш рацион за сегодня</h2>
            <ul class="list-group">
                @foreach($todayMeals as $todayMeal)
                <li class="list-group-item  rounded mb-3 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-2">{{$todayMeal["name"]}}</h5>
                        <span class="text-muted small">{{$todayMeal["created_at"]}}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <div class="d-flex flex-column">
                            <strong>Белки:</strong>
                            <span>{{$todayMeal["total_proteins"]}} г</span>
                        </div>
                        <div class="d-flex flex-column">
                            <strong>Жиры:</strong>
                            <span>{{$todayMeal["totals_fat"]}} г</span>
                        </div>
                        <div class="d-flex flex-column">
                            <strong>Углеводы:</strong>
                            <span>{{$todayMeal["total_carbohydrates"]}} г</span>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <strong>Калории:</strong>
                            <span class="font-weight-bold">{{$todayMeal["total_calories"]}}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle">
                            <svg width="15px" height="15px" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="angle-down" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path d="M33.1650874,133.072181 C43.9430028,122.416902 61.3504909,122.310349 72.2609978,132.752523 L72.589617,133.072181 L250,308.463909 L427.410383,133.072181 C438.188298,122.416902 455.595787,122.310349 466.506293,132.752523 L466.834913,133.072181 C477.612828,143.727461 477.720607,160.936879 467.15825,171.723241 L466.834913,172.048121 L269.712265,366.927819 C258.934349,377.583098 241.526861,377.689651 230.616354,367.247477 L230.287735,366.927819 L33.1650874,172.048121 C22.2783042,161.285212 22.2783042,143.83509 33.1650874,133.072181 Z" id="Shape" fill="black" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </li>
                @endforeach


                <li class="list-group-item  rounded mb-3 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-2">Куриная грудка</h5>
                        <span class="text-muted small">2024-05-27 13:00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <div class="d-flex flex-column">
                            <strong>Белки:</strong>
                            <span>31 г</span>
                        </div>
                        <div class="d-flex flex-column">
                            <strong>Жиры:</strong>
                            <span>3.6 г</span>
                        </div>
                        <div class="d-flex flex-column">
                            <strong>Углеводы:</strong>
                            <span>0 г</span>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <strong>Калории:</strong>
                            <span class="font-weight-bold">165</span>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle">
                            <svg width="15px" height="15px" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="angle-down" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path d="M33.1650874,133.072181 C43.9430028,122.416902 61.3504909,122.310349 72.2609978,132.752523 L72.589617,133.072181 L250,308.463909 L427.410383,133.072181 C438.188298,122.416902 455.595787,122.310349 466.506293,132.752523 L466.834913,133.072181 C477.612828,143.727461 477.720607,160.936879 467.15825,171.723241 L466.834913,172.048121 L269.712265,366.927819 C258.934349,377.583098 241.526861,377.689651 230.616354,367.247477 L230.287735,366.927819 L33.1650874,172.048121 C22.2783042,161.285212 22.2783042,143.83509 33.1650874,133.072181 Z" id="Shape" fill="black" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </li>

            </ul>
        </div>


    </div>



    <script>
        const tg = window.Telegram.WebApp;
        tg.ready();
        const user_id = tg.initDataUnsafe?.user?.id;
        const username = tg.initDataUnsafe?.user?.username;

        const body = document.getElementById("body");
        const h1 = document.createElement('h1');
        h1.textContent = `Продукты за день ${username}`;
        h1.classList.add("text-center", "fs-2")
        body.appendChild(h1);

        tg.MainButton.show();
        tg.MainButton.text = "wow le button"


        const requestOptions = {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "lol": "kek",
            })
        }

        let data = fetch("", requestOptions)
            .then(response => response)
            .then(data => console.log(data));
    </script>
</body>

</html>