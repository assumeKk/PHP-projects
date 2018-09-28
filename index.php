<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>lottory machine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <!-- <script src="main.js"></script> -->
</head>
<script>
    function luckyDip(){
        var balls =[];
        var selectedBalls = [];
        for(i = 0; i < 59; i++){
            balls[i] = i+1;      
        }
        var i = 0;
        // alert(balls.length);
        while(i < 6){
            ball = Math.floor((Math.random()*59)+1);
            // alert(ball);
            if(balls.indexOf(ball) != -1){
                balls.splice(balls.indexOf(ball),1);
                selectedBalls[i] = ball;
                i++;
            }           
        }
        document.getElementById("one").value = selectedBalls[0];
        document.getElementById("two").value = selectedBalls[1];
        document.getElementById("three").value = selectedBalls[2];
        document.getElementById("four").value = selectedBalls[3];
        document.getElementById("five").value = selectedBalls[4];
        document.getElementById("six").value = selectedBalls[5];
        // alert(balls.toString());
        // alert(selectedBalls.toString() + " length: " + selectedBalls.length + " length: " + balls.length);
        
    }
</script>
<body>
    <?php
        error_reporting(0);
        $playerSelectedBalls = isset($_POST['balls'])? $_POST['balls'] :''; //player selected balls
        $balls = drawnRandomBalls();
        echo 'Player select numbers: ';
        print_r($playerSelectedBalls);
        echo 'Drawn numbers: ';
        print_r($balls);
        // $test = true;
        // $test = checkRepeat($playerSelectedBalls);
        $count = 0; // count how many matched numbers
        if(checkRepeat($playerSelectedBalls)){
            //play games here, check how many balls they matched
            foreach($balls as $ball){
                foreach($playerSelectedBalls as $player){                    
                    if($ball == $player){
                        $count++;
                    }
                }
            }
            if($count == 3){
                echo 'You have matched 3 numbers.';
            }
            elseif($count == 4){
                echo 'You have matched 4 numbers.';
            }
            elseif($count == 5){
                echo 'You have matched 5 numbers.';
            }
            elseif($count == 6){
                echo 'You have matched all the numbers.';
            }
            elseif($count == 2 || $count == 1){
                echo 'You have matched 1 or 2 numbers';
            }
            else{
                echo 'No numbers matched';
            }
        }
        else{
            echo 'Please check your numbers';
        }
        // generate random ball
        function checkRepeat($numbers){
        //check repetive numbers
            for($i = 0; $i < count($numbers); $i++){
                for($j = $i+1; $j < count($numbers); $j++){
                    // echo 'i='.$i . 'and j='.$j.'<b>';
                    //echo 'current number: '.$playerSelectedBalls[$i] . ' next number: '.$playerSelectedBalls[$j].'<br>';
                    if($numbers[$i] == $numbers[$j] ||
                        $numbers[$i] < 1 || $numbers[$i] > 59){
                        // echo 'current number: '.$playerSelectedBalls[$i] . ' next number: '.$playerSelectedBalls[$j].'<br>';
                        //echo 'Please check your numbers<br>';
                        return false;
                    }
                }
            }
            return true;
        }
        function drawnRandomBalls(){
            $balls = array();
            $nonRepeatNumbers = array();
            for($i = 0; $i < 6; $i++){
                $rand = rand(1,59);

                // ensure value isn't already in the array
                // if it is, recalculate the rand until we
                // find one that's not in the array
                while(in_array($rand,$nonRepeatNumbers)){
                    $rand = rand(1,59);
                }
                // add random number to non repeat number array
                $nonRepeatNumbers[$i] = $rand;
            }
            return $nonRepeatNumbers;
        }
    ?>
    <form action="" method="post">
        please insert 6 numbers, numbers must be between 1-59.<br>
        1:<input type="text" id="one" name="balls[]"><br>
        2:<input type="text" id="two" name="balls[]"><br>
        3:<input type="text" id="three" name="balls[]"><br>
        4:<input type="text" id="four" name="balls[]"><br>
        5:<input type="text" id="five" name="balls[]"><br>
        6:<input type="text" id="six" name="balls[]"><br>
        <a onclick="luckyDip()"> LuckyDip</a>
        <input type="submit" value="submit">
    </form>
    <!-- <button onclick="luckyDip()">Lucky Dip</button> -->
</body>
</html>
