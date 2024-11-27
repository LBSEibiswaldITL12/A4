<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalorienrechner</title>
    <style>
        .upper {
            margin: auto;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            width: 80%;
        }

        .informationContainer {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .informationPerson {
            flex: 2;
            padding: 10px;
            box-sizing: border-box;
        }

        .informationActivity {
            flex: 3;
            padding: 10px;
            box-sizing: border-box;
        }

        input[type=text], input[type=number], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .result {
            margin: auto;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            width: 80%;
        }
    </style>
</head>
<body>
    <form method="post">
        <div class="upper">
            <h1>Kalorienrechner</h1>
            <div class="informationContainer">
                <div class="informationPerson">
                    <label for="gender">Geschlecht: </label>
                    <select id="gender" name="gender">
                        <option value="true">Männlich</option>
                        <option value="false">Weiblich</option>
                    </select><br>
                    <label for="age">Alter: </label>
                    <input type="number" id="age" name="age" required><br>
                    <label for="weight">Gewicht: </label>
                    <input type="number" id="weight" name="weight" required><br>
                    <label for="height">Größe: </label>
                    <input type="number" id="height" name="height" required><br>
                </div>
                <div class="informationActivity">
                    <label for="1">Ausschließlich sitzend/liegend</label>
                    <input type="number" id="1" name="1"><br>
                    <label for="2">Vorwiegend sitzende Tätigkeit, kaum körperliche Aktivität</label>
                    <input type="number" id="2" name="2"><br>
                    <label for="3">Überwiegend sitzende Tätigkeit, dazwischen auch stehend/gehend</label>
                    <input type="number" id="3" name="3"><br>
                    <label for="4">Hauptsächlich stehende und gehende Aktivitäten</label>
                    <input type="number" id="4" name="4"><br>
                    <label for="5">Körperlich anstrengende Arbeiten</label>
                    <input type="number" id="5" name="5"><br>
                </div>
            </div>
            <input type="submit" name="submit">
        </div>
    </form>

    <?php
        if (isset($_POST['age'])) {
            $isMan = $_POST['gender'];
            $age = $_POST['age'];
            $weight = $_POST['weight'];
            $height = $_POST['height'];
            $first = ($_POST['1'] != "") ? $_POST['1'] : 0;
            $second = ($_POST['2'] != "") ? $_POST['2'] : 0;
            $third = ($_POST['3'] != "") ? $_POST['3'] : 0;
            $fourth = ($_POST['4'] != "") ? $_POST['4'] : 0;
            $fifth = ($_POST['5'] != "") ? $_POST['5'] : 0;

            $consume = ($isMan ? 66.47 : 655.1) 
                + (($isMan ? 13.7 : 9.6) * $weight) 
                + (($isMan ? 5 : 1.8) * $height) 
                - (($isMan ? 6.8 : 4.7) * $age);

            $avgPMI = (($fifth * 2.4) 
                + ($fourth * 1.9) 
                + ($third * 1.7) 
                + ($second * 1.5) 
                + ($first * 1.2) 
                + ((24 - ($fifth + $fourth + $third + $second + $first)) * 0.95)) / 24;

            $consumeActivities = $consume * $avgPMI;

            echo "<div class='result'><p>Grundverbrauch: " . round($consume) . "</p><p>Gesamtverbrauch: " . round($consumeActivities) . "</p></div>";
        }
    ?>

</body>
</html>