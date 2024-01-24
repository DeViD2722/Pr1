<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/student.css">
    <title>Result</title>
</head>
<body>
    <?php
        include("init.php");

        if(!isset($_GET['class']))
            $class=null;
        else
            $class=$_GET['class'];
        $rn=$_GET['rn'];

        // validation
        if (empty($class) or empty($rn) or preg_match("/[a-z]/i",$rn)) {
            if(empty($class))
                echo '<p class="error">Please select your class</p>';
            if(empty($rn))
                echo '<p class="error">Please enter your roll number</p>';
            if(preg_match("/[a-z]/i",$rn))
                echo '<p class="error">Please enter valid roll number</p>';
            exit();
        }

        $name_sql=mysqli_query($conn,"SELECT `name` FROM `students` WHERE `rno`='$rn' and `class_name`='$class'");
        while($row = mysqli_fetch_assoc($name_sql))
        {
        $name = $row['name'];
        }

        $result_sql=mysqli_query($conn,"SELECT `English`, `Computer`, `Maths`, `Science`, `Gujarati`, `marks`, `percentage` FROM `result` WHERE `rno`='$rn' and `class`='$class'");
        while($row = mysqli_fetch_assoc($result_sql))
        {
            $p1 = $row['English'];
            $p2 = $row['Computer'];
            $p3 = $row['Maths'];
            $p4 = $row['Science'];
            $p5 = $row['Gujarati'];
            $mark = $row['marks'];
            $percentage = $row['percentage'];
        }
        if(mysqli_num_rows($result_sql)==0){
            echo "no result";
            exit();
        }
    ?>

    <div class="container">
        <h1>Result</h1>
        <div class="details">
            <span>Name :</span> <?php echo $name ?> <br>
            <span>Class :</span> <?php echo $class; ?> <br>
            <span>Roll No :</span> <?php echo $rn; ?> <br>
        </div>
        <hr>
        <div class="main" >
            <div class="s1"><b>
                <p style="font-size:22px;">Subjects</p>
                <p>English</p>
                <p>Computer</p>
                <p>Maths</p>
                <p>Science</p>
                <p>Gujarati</p></b>
            </div>
            <div class="s2"><b>
                <p style="font-size:22px;">Marks</p>
                <?php echo '<p>'.$p1.'</p>';?>
                <?php echo '<p>'.$p2.'</p>';?>
                <?php echo '<p>'.$p3.'</p>';?>
                <?php echo '<p>'.$p4.'</p>';?>
                <?php echo '<p>'.$p5.'</p>';?></b>
            </div>
        </div>
        <hr>
        <div class="result" style="color:green;">
            <?php echo '<p>Total Marks : '.$mark.'</p>';?>
            <?php echo '<p>Percentage : '.$percentage.'%</p>';?>
        </div>

        <div class="result">
            <?php 
            if($percentage>=40){
                echo '<p style="color:green;">Congratulations You have Pass the Exam.';
            }
            else{
                echo '<p style="color:red;">Sorry, You dont clear the Exam. Better Luck Next Time.' ;
            }
            ?>
        </div>

        <div class="button1"><center>
            <button onclick="window.print()">Print Result</button></center>
        </div>
    </div>
</body>
</html>