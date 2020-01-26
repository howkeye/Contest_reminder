<?php
$user = $_SESSION['user'];
$servername = "localhost";
$username = "*********";
$password = "********";
$dbname = "********";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die(" can't connect to server");
?>





<?
function check($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
function died($error)
{
    // your error code can go here
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";
    echo $error . "<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
}

$name = $user = $email = $mbno = $pword = $cpword = "";

$name = check($_POST["name"]);
$email = check($_POST["email"]);

$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
if (!preg_match($email_exp, $email))
{
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
}
$string_exp = "/^[A-Za-z .'-]+$/";
if (!preg_match($string_exp, $name))
{
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
}

if (strlen($error_message) > 0)
{
    died($error_message);
}

?>
<html>
<body>

Welcome <?php echo $name; ?><br>
Your email address : <?php echo $email; ?>
<?
$sql1 = "INSERT INTO conuser(name,email) VALUES ('$name','$email')";
if (mysqli_query($conn, $sql1) == true)
{
    echo "  is  registered Successfully ";
}
else " error in registration";

?>

</body>
</html>

