<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'acceuil</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/066b8a6038.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Island+Moments&family=Kaushan+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            background-color: #6b61d6;
        }
        h2 {
            color: white;
        }
        h3 {
            margin-top: -20px;
            color: white;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
            margin-bottom: 0;
        }
        header .liste {
            display: flex;
            justify-content: space-between;
            list-style: none;
            padding: 0;
            color: white;
        }
        header .liste li {
            margin: 0 15px;
        }



    </style>
</head>
<body>
    <header>
         <h2>IMOG</h2>
        <ul class="liste">
            <li>Aujourd'hui</li>
            <li>Demain</li>
            <li>Hier</li>
            <li>Semaine</li>
        </ul>
    </header>
    <h3>Gestion Immobiliere</h3>
    <div class="classe">
        
    </div>
</body>
</html>