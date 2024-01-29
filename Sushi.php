<?php
include "includes\connectSQLitePC.php";
// Connect to SQLite database
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = "SELECT ID, Nome, descrizione, pezzi, categoriaNome FROM prodotti WHERE cena = 'NO' ORDER BY categoriaID, ID";
$result = $db->query($query);
?>
<!DOCTYPE html> 
<html lang="it">
<head>
    <style>
        body {
            padding: 2%;
            font-family:  "Calibri", sans-serif;
            background-image: url(https://i.redd.it/ikj7qrf4pdba1.png);
            background-size: 100%;
            color: white;
            background-repeat: no-repeat;
            background-attachment: fixed;
            user-select: none;
            -webkit-user-select: none; 
            -ms-user-select: none;        }     
        
        ::-webkit-scrollbar {
        width:5px;
        background:grey;
        }
        ::-webkit-scrollbar-thumb 
        {
            background:rgba(61, 58, 58,1);
            border-radius: 10px;
        }
        #sel
        {
            width:100%;
            /* border: 2px solid red; */
            display: flex;
            justify-content: center;

        } 

        #persona
        {
            background: rgba(255, 255, 255, 0.23);
            border-radius: 5px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            -webkit-backdrop-filter: blur(5.9px);
            border: 1px solid rgba(255, 255, 255, 1);
            padding:0.5%;
            text-align:center;
            font-weight:bolder;
            width: 50%;
            font-size:20px;
            text-transform: uppercase;
        }

        

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .Categoria {
            margin: auto;
            width: fit-content;
            margin-bottom: 5%;
            text-align: center;
            margin-top: 3%;
            min-width: 20%;
            font-weight: bold;
            text-transform: uppercase;
            background: rgba(255, 255, 255, 0.23);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.9px);
            -webkit-backdrop-filter: blur(5.9px);
            border: 1px solid rgba(255, 255, 255, 1);
            
        }

        .casella {
            width: 18%; 
            margin: 1%; 
            background: rgba(255, 255, 255, 0.23);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.9px);
            -webkit-backdrop-filter: blur(5.9px);
            border: 1px solid rgba(255, 255, 255, 1);
            padding: 2%;
        }

        .id {
            width: fit-content;
            border: 1px white solid;
            padding: 2%;
            border-radius: 5px;
            float: left;
        }
        .nome
        {
            margin: auto;
            width: fit-content;
            border: 1px white solid;
            padding: 2%;
            border-radius: 5px;
        }
        .QT 
        {
            margin-top: 5%;
            width: fit-content;
            border: 1px white solid;
            padding: 2%;
            border-radius: 5px;
        }
        .desc 
        {
            width: fit-content;
            border: 1px white solid;
            padding: 2%;
            border-radius: 5px;
            min-height: 100px;
            width: 95%;
        }
        .bottone 
        {
            width: 90%;
            margin-left: 5%;
            border: 1px white solid;
            padding: 2%;
            border-radius: 5px;
            margin-top: 5%;
            background-color: transparent;
            color: white;
        }
        .sidenav 
        {
            height: 100%; 
            width: 0; 
            position: fixed; 
            z-index: 2;
            top: 0; 
            left: 0;
            background: rgba(255, 255, 255, 0.23);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.9px);
            -webkit-backdrop-filter: blur(5.9px);
            overflow-x: hidden; 
            padding-top: 60px; 
            transition: 0.5s; 
        }
        .sidenavR 
        {
            height: 100%;
            width: 0; 
            position: fixed; 
            z-index: 2; 
            top: 0; 
            right: 0;
            background: rgba(255, 255, 255, 0.23);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.9px);
            -webkit-backdrop-filter: blur(5.9px);
            overflow-x: hidden; 
            padding-top: 60px; 
            transition: 0.5s; 
        }
        .sidenav a 
        {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
        }.sidenavR a 
        {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
        }
        .sidenavR p 
        {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 30px;
            
            color: white;
            display: block;
        }
        .sidenav a:hover 
        {
            color: #f1f1f1;
        }
        .sidenavR a:hover 
        {
            color: #f1f1f1;
        }
        .sidenav .closebtn 
        {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        .sidenavR .closebtn 
        {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
            color:white;
        }
        @media screen and (max-height: 450px) 
        {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
            .sidenavR {padding-top: 15px;}
            .sidenavR a {font-size: 18px;}
        }
        #menu
        {
            font-size:150%;
            position:fixed;
            top:30;
            left:30;
            z-index: 1; /* Stay on top */
            background: rgba(255, 255, 255, 0.23);
            border-radius: 5px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.9px);
            -webkit-backdrop-filter: blur(5.9px);
            border: 1px solid rgba(255, 255, 255, 1);
            padding:0.5%;
            width:47.8px;
            color:white;
        }
        #menu2
        {
            font-size:150%;
            position:fixed;
            right:30;
            top:30;
            z-index: 1; /* Stay on top */
            background: rgba(255, 255, 255, 0.23);
            border-radius: 5px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.9px);
            -webkit-backdrop-filter: blur(5.9px);
            border: 1px solid rgba(255, 255, 255, 1);
            padding:0.5%;
            color:white;

        }
    </style>
</head>
<body>
    
    
        
    <div id="mySidenav" class="sidenav">
    
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#Antipasti">Antipasti</a>
            <a href="#nigiri">Nigiri</a>
            <a href="#gunkan e bignè">Gunkan e Bignè</a>
            <a href="#hosomaki e futomaki">Hosomaki e Futomaki</a>
            <a href="#Uramaki">Uramaki</a>
            <a href="#uramaki super">Uramaki super</a>
            <a href="#uramaki riso verenere">Uramaki riso verenere</a>
            <a href="#temaki">Temaki</a>
            <a href="#insalate e zuppe">Insalate e Zuppe</a>
            <a href="#barche di sushi">Barche di sushi</a>
            <a href="#riso e spaghetti">Riso e Spaghetti</a>
            <a href="#tempura">Tempura</a>
            <a href="#griglia">Griglia</a>
            <a href="#piastra">Piastra</a>
            <a href="#tacos">Tacos</a>
    </div>
    <button id="Menu"  onclick="openNav()">☰</button>
    <button id="Menu2"  onclick="openNavR()">Order</button>
    <div id="mySidenavR" class="sidenavR">
    <div id="sel">
        <select name="Persona" id="Persona">
            <option value="C">Charlie</option>
            <option value="F">Filippo</option>
            <option value="G">gabriele</option>
            <option value="R">Roberto</option>
        </select>
    </div>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavR()">&times;</a>
        <div id="buttonInfoContainer"></div>
    </div>
      
    <?php
    // Fetch the results
    $categoryShown = false;
    $currentCategory = null;
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        
        $ID = $row['ID'];
        $Nome = $row['Nome'];
        $descrizione = $row['descrizione'];
        $Pezzi =$row['pezzi'];
        $Categoria = $row['categoriaNome'];
        
        if ($Categoria != $currentCategory) {
            if ($currentCategory !== null) {
                echo '</div>'; 
            }

            ?>
            <div class="Categoria">
                <h1 id="<?php echo $Categoria; ?>">
                    <?php echo $Categoria; ?>
                </h1>
            </div>
            <div class="container">
            <?php
            $categoryShown = true;
            $currentCategory = $Categoria;
        }
        ?>
        <div class="casella">
            <div class="IDNOM">
                <div class="id">
                    <?php echo $ID; ?>
                </div>
                <div class="nome">
                    <?php echo $Nome; ?>
                </div>
                <div class="QT">
                    <?php echo $Pezzi . "pz";?>
                </div>
            </div>
            <br>
            
            <br>
            <div class="desc">
                <?php echo $descrizione; ?>
            </div>
            <button class="bottone"> Aggiungi</button>
        </div>
        <?php
    }
    if ($currentCategory !== null) 
    {
        echo '</div>'; 
    }
    ?> 
    
    <script>
        
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }

        function openNavR() {
        document.getElementById("mySidenavR").style.width = "300px";
        }
        function closeNavR() {
        document.getElementById("mySidenavR").style.width = "0";
        }
        
        function handleButtonClick(button) {
    var parentDiv = button.closest('.casella');
    var idText = parentDiv.querySelector('.id').textContent;
    var nomeText = parentDiv.querySelector('.nome').textContent;
    var personaValue = document.getElementById('Persona').value; // Get the selected value from the Persona select
    var combinedText = personaValue + ' ' + idText + ' ' + nomeText; // Add the Persona value to the combined text

    var existingParagraph = Array.from(document.querySelectorAll('#buttonInfoContainer p'))
                                .find(p => p.textContent.startsWith(combinedText));

    if (existingParagraph) {
        var existingCount = parseInt(existingParagraph.dataset.addedCount || 1, 10);
        existingCount++;
        existingParagraph.dataset.addedCount = existingCount;
        existingParagraph.textContent = combinedText + " (X " + existingCount + ")";
    } else {
        var infoParagraph = document.createElement("p");
        infoParagraph.textContent = combinedText + " (X 1)";
        infoParagraph.dataset.addedCount = 1;
        infoParagraph.classList.add("ordine");
        infoParagraph.addEventListener('click', function() {
            var currentCount = parseInt(this.dataset.addedCount || 1, 10);
            currentCount--;

            if (currentCount > 0) {
                this.dataset.addedCount = currentCount;
                this.textContent = combinedText + " (X " + currentCount + ")";
            } else {
                this.remove();
            }
        });
        document.getElementById("buttonInfoContainer").appendChild(infoParagraph);
    }
}

document.querySelectorAll('.bottone').forEach(button => {
    button.addEventListener('click', function() {
        handleButtonClick(this);
    });
});

    </script>
</body>
</html>