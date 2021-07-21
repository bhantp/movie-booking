<?php
include 'connection.php';
echo "seat-bookings";
$thet = $_GET['theat'];
$mdate = $_GET['mdate'];
$mtime = $_GET['mtime'];
$movieid = $_GET['mid'];

$mtime .= ":00";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="movie.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body>



<ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>N/A</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat occupied"></div>
        <small>Occupied</small>
      </li>
    </ul>
    <div class="movie-container" id="showing-seats">
      <div class="screen" style="width: 100%; height: 60px;"></div>
      <table id="s_table">
<?php
$sql= "SELECT * FROM shows NATURAL JOIN seats WHERE shows.mid=$movieid AND shows.cid=$thet AND shows.sdate='$mdate' AND shows.stimings='$mtime';";

$cnt=0;
$occ_seats= array();
$seat_name="";
if($result = mysqli_query($link,$sql));
    {

     if(mysqli_num_rows($result) > 0){
        
while($row = mysqli_fetch_array($result))
  {
      array_push($occ_seats, $row['sno']);
    $cnt+=1;
  }
}
}
//    echo "<table id='s_table'>";
  for($i=1;$i<=3;$i++)
  {  
    $seat_price=150 + 50*$i;
      echo "<tr class='" .$seat_price ."'>";
    for($j=1;$j<=5;$j++)
    {           $calc=($i-1)*5+$j ;
        if(in_array($calc , $occ_seats)){
            $seat_name="seat occupied";
        }
        else{
            $seat_name="seat";
        }

        echo "<td class='" .$seat_name ."'style='text-align: center'><a href='#'>" . $calc ."</a></td> ";
    }
    echo "</tr>";
  }
//    echo "</table>";

?></table>
</div>
    <p class="text">
      You have selected <span id="count">0</span> seats for a price of $<span
        id="total"
        >0</span>
    </p>
    <input type="button" id='submit-book' value='Pay now' disabled> 

    <script type="text/javascript" src= movie-page.js></script>
</body>
</html>