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
}
?>

<html>
<head>
<title>Predictor</title>
</head>

<body>
  <p>
  <form method="post">
  <br/>Pregnancies: <input type="number" name="Pregnancies">
  <br/>Glucose: <input type="number" name="Glucose">
  <br/>BloodPressure: <input type="number" name="BloodPressure">
  <br/>SkinThickness: <input type="number" name="SkinThickness">
  <br/>Insulin: <input type="number" name="Insulin">
  <br/>BMI: <input type="number" name="BMI">
  <br/>DiabetesPedigreeFunction: <input type="number" name="DiabetesPedigreeFunction">
  <br/>Age: <input type="number" name="Age">
  <br/><input type="submit" value="submit" name="submit">
  </form>
  </p>


<!--
 "Pregnancies"              "Glucose"                 
 "BloodPressure"            "SkinThickness"           
"Insulin"                  "BMI"                     
"DiabetesPedigreeFunction" "Age"                     
 "Outcome"   
-->
<?php
if (isset($_POST['submit']))
{
  // display the output
  echo "<p>";
  echo "Pregnancies: $Pregnancies<br />";
  echo "Glucose: $Glucose<br />";
  echo "BloodPressure: $BloodPressure<br />";
  echo "SkinThickness: $SkinThickness<br />";
  echo "Insulin: $Insulin<br />";
  echo "BMI: $BMI<br />";
  echo "DiabetesPedigreeFunction: $DiabetesPedigreeFunction<br />";
  echo "Age: $Age<br />";
  
  
  $ans = exec("Rscript runme.R $Pregnancies $Glucose $BloodPressure $SkinThickness $Insulin $BMI $DiabetesPedigreeFunction $Age");
  echo "<br />Naive Baye's <br />";
  echo "Diabetes <br /> $ans <br />";
  echo "</p>";
}
?>

</body>
</html>
