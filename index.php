<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="mycss.css"></link>
<!------ Include the above in your HEAD tag ---------->

<?php
if(isset($_POST['submit'])){
$Pregnancies = $_POST["Pregnancies"];
$Glucose = $_POST["Glucose"];
$BloodPressure = $_POST["BloodPressure"];
$SkinThickness = $_POST["SkinThickness"];
$Insulin = $_POST["Insulin"];
$BMI = $_POST["BMI"];
$DiabetesPedigreeFunction = $_POST["DiabetesPedigreeFunction"];
$Age = $_POST["Age"];



$servername="localhost";
$username="stark";
$password="iron";
$dbname="diabetes";

}
?>

<div class="container">
 <div class="row">
    <div class="col-md-4">
		<div class="form_main">
                <h4 class="heading"><strong> Diabetes </strong> Predictor<span></span></h4>
                <div class="form">
                <form method="post">
                <br/>Pregnancies: <input type="number" name="Pregnancies" class="txt" required>
                <br/>Glucose: <input type="number" name="Glucose" class="txt" required>
                <br/>BloodPressure: <input type="number" name="BloodPressure" class="txt" required>
                <br/>SkinThickness: <input type="number" name="SkinThickness" class="txt" required>
                <br/>Insulin: <input type="number" name="Insulin" class="txt"required>
                <br/>BMI: <input type="decimil" name="BMI" class="txt" required>
                <br/>DiabetesPedigreeFunction: <input type="decimil" name="DiabetesPedigreeFunction" class="txt"required>
                <br/>Age: <input type="number" name="Age" class="txt" required>
                <br/><input type="submit" value="submit" name="submit" class="txt2" required>
                </form>
                </div>
       </div>
    </div>
    <div class="col-md-6">
                
<?php
if (isset($_POST['submit']))
{
  // display the output
  echo "<div class='txt_3'>";
 // echo "<p class='txt_3'>";
  echo "Pregnancies: $Pregnancies<br />";
  echo "Glucose: $Glucose<br />";
  echo "BloodPressure: $BloodPressure<br />";
  echo "SkinThickness: $SkinThickness<br />";
  echo "Insulin: $Insulin<br />";
  echo "BMI: $BMI<br />";
  echo "DiabetesPedigreeFunction: $DiabetesPedigreeFunction<br />";
  echo "Age: $Age<br />";
  
  
  $ans = exec("Rscript runme.R $Pregnancies $Glucose $BloodPressure $SkinThickness $Insulin $BMI $DiabetesPedigreeFunction $Age");
  echo "</br><STRONG>Naive Baye's</STRONG>";
  echo "<br />You have P(E)=$ans of testing Postive for Diabetes <br />";
  if($ans>0.5){
  echo '<p id="outcome" value="1"></p>';
  echo "You should consult a doctor<br />";
  }
  else if($ans<=0.5){
  echo '<p id="outcome" value="0"></p>';
  echo "It dosen't look like it is necessary to consult a doctor<br />";
  }
  
  
  $ans = exec("Rscript dtree.R $Pregnancies $Glucose $BloodPressure $SkinThickness $Insulin $BMI $DiabetesPedigreeFunction $Age");
  echo "</br><STRONG>Decision Tree's</STRONG>";
  echo "<br />You have P(E)=$ans of testing Postive for Diabetes <br />";
  if($ans>0.5){echo "You should consult a doctor<br />";}
  else if($ans<=0.5){echo "It dosen't look like it is necessary to consult a doctor<br />";}
  echo "</p>";
  
  
  //echo "</p>";
  echo "</div>";
  
  
  
  
  
  
  $conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}  

      $sql="insert into records(Pregnancies,Glucose,BloodPressure,SkinThickness,Insulin,BMI,DiabetesPedigreeFunction,Age, Outcome)values($Pregnancies,$Glucose,$BloodPressure,$SkinThickness,$Insulin,$BMI,$DiabetesPedigreeFunction,$Age,$ans)";


     if ($conn->query($sql) === TRUE) {
           // echo '<script language="javascript">';
           // echo 'alert("Record Stored")';
           // echo '</script>';
      } else {
           // echo '<script language="javascript">';
           // echo 'alert("Unable to Store Record")';
           // echo '</script>';
        
        }

$conn->close();

}


?>

    </div>
    
  </div>
</div>

