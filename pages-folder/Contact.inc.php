<h1 id="request">Movie Premier Booking Form</h1>
<p class="req">Interested in Movie Premier at NY Cinema? Please complete and submit the following form to the Booking Office. One of our representatives will send you an information package tailored to the field(s) of Premier that interest you. Please indicate whether you would like additional information or not</p>


<style type="text/css">
input[type="text"],input[type="email"],textarea{
	border:  1px solid dashed;
	background-color: rgb(221,216,212);
	width: 480px;
	padding: .5em;
	font-size: 1.0em;
}
.Error{
	color: red;
    font-size: 1.2em;  
font-family: Bitter,Georgia,Times,"Times New Roman",serif;}
input[type="submit"]{
 color: white;
    float: right;
    font-size: 1.3em;
    font-family: Bitter,Georgia,Times,"Times New Roman",serif;
    width: 170px;
    height: 40px;
    background-color:  #5D0580;
    border: 5px solid ;
    border-bottom-left-radius: 35px;
   border-bottom-right-radius: 35px;
   border-top-left-radius: 35px;
   border-top-right-radius: 35px;
    border-color: rgb(221,216,212);
      font-weight: bold;
}
.FieldInfo{
     color: rgb(251, 174, 44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.3em;
   

}
.MF{
	color: black;
    font-size: 1.2em;  
font-family: Bitter,Georgia,Times,"Times New Roman",serif;}

</style>




<?php 
    // define variables and set to empty values
    $NameError = $EmailError = $GenderError =$WebsiteError = "";
    $name = $email = $gender = $message = $website = "";
                    
    function test_input($data)
    {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    //form is submitted with POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["Name"])) {
            $NameError = "Name is Required";
        } else {
            $name = test_input($_POST["Name"]);
            //check  if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z. ]*$/", $name)) {
                $NameError = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["Email"])) {
            $EmailError = "Email is Required";
        } else {
            $email = test_input($_POST["Email"]);
            //check  if email address is well formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $EmailError = "Invalid email format";
            }
        }

        if (empty($_POST["Gender"])) {
            $GenderError = "Gender is Required";
        } else {
            $gender = test_input($_POST["Gender"]);
            //check  if phone number only contains number
            // if (!preg_match("(^\+\D[0-9]{3}\D+[0-9]{3}\D+[0-9]{3}\D+[0-9]{4})", $phone)) {
            //     $phone_error = "Invalid phone number";
            // }
        }

        if (empty($_POST["Website"])) {
            $WebsiteError = "Url is required";
        } else {
            $website = test_input($_POST["Website"]);
            //check  if URL address syntax is valid(this regular expression also allows dashes in the URL)
            if (!preg_match("([(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*))", $website)) {
                $WebsiteError = "Invalid URL";
            }
        }

        if (empty($_POST["message"])) {
            $message = "";
        } else {
            $message = test_input($_POST["message"]);
        }

        // Send message
        if(!empty($name) && !empty($email) && !empty($gender) && !empty($website)) {
            if((preg_match("/^[a-zA-Z. ]*$/", $name) == true) && (filter_var($email, FILTER_VALIDATE_EMAIL) == true) && (preg_match("([(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*))", $website) == true)){

                $to = "ridwanoseni101@gmail.com";
                $body = "";

                $body .= "From: ". $name."\r\n";
                $body .= "Phone: ". $gender."\r\n";
                $body .= "URL: ". $website."\r\n";
                $body .= "Message: ". $message."\r\n";

                mail($to, $email, $body);
            } else {
                echo "Please fill in the form approprately";
            }

        }
    }

?>







<form  action="" method="post"> 
<legend>* Please Fill Out the following Fields.</legend>			
<fieldset>
 <span class="FieldInfo">
Name:</span><br>
<input class="input" type="text" Name="Name" value="">
<span class="Error">*<?php echo $NameError;  ?></span><br>
<span class="FieldInfo">
E-mail:</span><br>
<input class="input" type="text" Name="Email" value="">
<span class="Error">*<?php echo $EmailError; ?></span><br>
<span class="FieldInfo">
Gender:</span><br>
<input class="radio" type="radio" Name="Gender" value="Female"><span class="MF">Female</span>
<input class="radio" type="radio" Name="Gender" value="Male"><span class="MF">Male</span>
<span class="Error">*<?php echo $GenderError; ?></span><br>
<span class="FieldInfo">
Website:</span><br>
<input class="input" type="text" Name="Website" value="">
<span class="Error">*<?php echo $WebsiteError; ?></span><br>
<span class="FieldInfo">
Comment:</span><br>
<textarea Name="Comment" rows="5" cols="25"></textarea>
<br>
<br>
<input type="Submit" Name="Submit" value="Submit">
   </fieldset>
</form>

 	
	  