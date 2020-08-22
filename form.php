<?php

require_once "config.php";

$teamname = $ideaname = $themename = $file = "";
$teamname_err = $ideaname_err = $themename_err = $file_err = "";

$leadername = $leaderclgname = $leaderemail = $leadercontact = "";
$leadername_err = $leaderclgname_err = $leaderemail_err = $leadercontact_err = "";

$member1name = $member1clgname = $member1email = $member1contact = "";
$member1name_err = $member1clgname_err = $member1email_err = $member1contact_err = "";

$member2name = $member2clgname = $member2email = $member2contact = "";
$member2name_err = $member2clgname_err = $member2email_err = $member2contact_err = "";

$member3name = $member3clgname = $member3email = $member3contact = "";
$member3name_err = $member3clgname_err = $member3email_err = $member3contact_err = "";

$member4name = $member4clgname = $member4email = $member4contact = "";
$member4name_err = $member4clgname_err = $member4email_err = $member4contact_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_FILES['file']))
    {
        if ($_FILES['file']['type'] == "application/pdf")
        {
            $source_file = $_FILES['file']['tmp_name'];
            $dest_file = "abstracts/".time().'_'.$_FILES['file']['name'];
            move_uploaded_file( $source_file, $dest_file )
            or die ("Error!!");
            $file=$dest_file;
        }
        else
        {
            if ( $_FILES['file']['size'] == 0 )
            {
                $file_err = "Error occured while uploading file. ".$_FILES['file']['name']."<br/>"."No File Chosen."."<br/>";
            }
            else if ( $_FILES['file']['type'] != "application/pdf")
            {
                $file_err = "Error occured while uploading file ".$_FILES['file']['name']."<br/>"."Invalid file extension. File should be pdf."."<br/>";
            }
        }
    }

    if(empty($_POST["teamname"]))
    {
        $teamname_err = "Please enter a teamname.";
    }
    else
    {
        $sql = "SELECT teamname FROM registrations WHERE teamname = ?";
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $p_teamname);
            $p_teamname = test_data($_POST["teamname"]);
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $teamname_err = "This teamname is already taken.";
                }
                else
                {
                    $teamname = test_data($_POST["teamname"]);
                    if (!preg_match("/^[a-zA-Z ]*$/",$teamname))
                    {
                        $teamname_err = "Only letters and white space are allowed.";
                    }
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if(empty($_POST["ideaname"]))
    {
        $ideaname_err = "Please enter a project idea name.";
    }
    else
    {
        $sql = "SELECT ideaname FROM registrations WHERE ideaname = ?";
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $p_ideaname);
            $p_ideaname = test_data($_POST["ideaname"]);
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $ideaname_err = "This project idea name is already taken.";
                }
                else
                {
                    $ideaname = test_data($_POST["ideaname"]);
                    if (!preg_match("/^[a-zA-Z ]*$/",$ideaname))
                    {
                        $ideaname_err = "Only letters and white space are allowed.";
                    }
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty($_POST["leadername"]))
    {
        $leadername_err = "Leader's Full Name is required.";
    }
    else
    {
        $leadername = test_data($_POST["leadername"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$leadername))
        {
            $leadername_err = "Only letters and white space are allowed.";
        }
    }

    if (empty($_POST["leaderclgname"]))
    {
        $leaderclgname_err = "Leader's College Name is required.";
    }
    else
    {
        $leaderclgname = test_data($_POST["leaderclgname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$leaderclgname))
        {
            $leaderclgname_err = "Only letters and white space are allowed.";
        }
    }
    
    if (empty($_POST["leaderemail"]))
    {
        $leaderemail_err = "Leader's Email Address is required.";
    }
    else
    {
        $leaderemail = test_data($_POST["leaderemail"]);
        if (!filter_var($leaderemail, FILTER_VALIDATE_EMAIL))
        {
            $leaderemail_err = "Invalid email format.";
        }
          
    }

    if (empty($_POST["leadercontact"]))
    {
        $leadercontact_err = "Leader's Contact No. is required.";
    }
    else
    {
        $leadercontact = test_data($_POST["leadercontact"]);
        if (!preg_match("/^[0-9]*$/",$leadercontact))
        {
            $leadercontact_err = "Only numbers are allowed.";
        }
    }

    if (empty($_POST["member1name"]))
    {
        $member1name = "";
    }
    else
    {
        $member1name = test_data($_POST["member1name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member1name))
        {
            $member1name_err = "Only letters and white space are allowed.";
        }
    }

    if (empty($_POST["member1clgname"]))
    {
        $member1clgname = "";
    }
    else
    {
        $member1clgname = test_data($_POST["member1clgname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member1clgname))
        {
            $member1clgname_err = "Only letters and white space are allowed.";
        }
    }
    
    if (empty($_POST["member1email"]))
    {
        $member1email = "";
    }
    else
    {
        $member1email = test_data($_POST["member1email"]);
        if (!filter_var($member1email, FILTER_VALIDATE_EMAIL))
        {
            $member1email_err = "Invalid email format.";
        }
          
    }

    if (empty($_POST["member1contact"]))
    {
        $member1contact = "";
    }
    else
    {
        $member1contact = test_data($_POST["member1contact"]);
        if (!preg_match("/^[0-9]*$/",$member1contact))
        {
            $member1contact_err = "Only numbers are allowed.";
        }
    }

    if (empty($_POST["member2name"]))
    {
        $member2name = "";
    }
    else
    {
        $member2name = test_data($_POST["member2name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member2name))
        {
            $member2name_err = "Only letters and white space are allowed.";
        }
    }

    if (empty($_POST["member2clgname"]))
    {
        $member2clgname = "";
    }
    else
    {
        $member2clgname = test_data($_POST["member2clgname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member2clgname))
        {
            $member2clgname_err = "Only letters and white space are allowed.";
        }
    }
    
    if (empty($_POST["member2email"]))
    {
        $member2email = "";
    }
    else
    {
        $member2email = test_data($_POST["member2email"]);
        if (!filter_var($member2email, FILTER_VALIDATE_EMAIL))
        {
            $member2email_err = "Invalid email format.";
        }
          
    }

    if (empty($_POST["member2contact"]))
    {
        $member2contact = "";
    }
    else
    {
        $member2contact = test_data($_POST["member2contact"]);
        if (!preg_match("/^[0-9]*$/",$member2contact))
        {
            $member2contact_err = "Only numbers are allowed.";
        }
    }

    if (empty($_POST["member3name"]))
    {
        $member3name = "";
    }
    else
    {
        $member3name = test_data($_POST["member3name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member3name))
        {
            $member3name_err = "Only letters and white space are allowed.";
        }
    }

    if (empty($_POST["member3clgname"]))
    {
        $member3clgname = "";
    }
    else
    {
        $member3clgname = test_data($_POST["member3clgname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member3clgname))
        {
            $member3clgname_err = "Only letters and white space are allowed.";
        }
    }
    
    if (empty($_POST["member3email"]))
    {
        $member3email = "";
    }
    else
    {
        $member3email = test_data($_POST["member3email"]);
        if (!filter_var($member3email, FILTER_VALIDATE_EMAIL))
        {
            $member3email_err = "Invalid email format.";
        }
          
    }

    if (empty($_POST["member3contact"]))
    {
        $member3contact = "";
    }
    else
    {
        $member3contact = test_data($_POST["member3contact"]);
        if (!preg_match("/^[0-9]*$/",$member3contact))
        {
            $member3contact_err = "Only numbers are allowed.";
        }
    }

    if (empty($_POST["member4name"]))
    {
        $member4name = "";
    }
    else
    {
        $member4name = test_data($_POST["member4name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member4name))
        {
            $member4name_err = "Only letters and white space are allowed.";
        }
    }

    if (empty($_POST["member4clgname"]))
    {
        $member4clgname = "";
    }
    else
    {
        $member4clgname = test_data($_POST["member4clgname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$member4clgname))
        {
            $member4clgname_err = "Only letters and white space are allowed.";
        }
    }
    
    if (empty($_POST["member4email"]))
    {
        $member4email = "";
    }
    else
    {
        $member4email = test_data($_POST["member4email"]);
        if (!filter_var($member4email, FILTER_VALIDATE_EMAIL))
        {
            $member4email_err = "Invalid email format.";
        }
          
    }

    if (empty($_POST["member4contact"]))
    {
        $member4contact = "";
    }
    else
    {
        $member4contact = test_data($_POST["member4contact"]);
        if (!preg_match("/^[0-9]*$/",$member4contact))
        {
            $member4contact_err = "Only numbers are allowed.";
        }
    }

    if(empty($_POST['themename'])) 
    {
        $themename_err = "Selecting a theme is required.";
    }
    else
    {
        $themename = test_data($_POST["themename"]);
    }

    if ( empty($teamname_err) && empty($ideaname_err) && empty($themename_err) && empty($file_err) && 
         empty($leadername_err) && empty($leaderclgname_err) && empty($leaderemail_err) && empty($leadercontact_err) &&
         empty($member1name_err) && empty($member1clgname_err) && empty($member1email_err) && empty($member1contact_err) &&
         empty($member2name_err) && empty($member2clgname_err) && empty($member2email_err) && empty($member2contact_err) &&
         empty($member3name_err) && empty($member3clgname_err) && empty($member3email_err) && empty($member3contact_err) &&
         empty($member4name_err) && empty($member4clgname_err) && empty($member4email_err) && empty($member4contact_err) )
    {
        // $sql = "INSERT INTO registrations (teamname,leadername,leaderclgname,leaderemail,leadercontact,
        // member1name,member1clgname,member1email,member1contact,member2name,member2clgname,member2email,member2contact,
        // member3name,member3clgname,member3email,member3contact,member4name,member4clgname,member4email,member4contact,
        // ideaname,themename,file) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        // if($stmt = mysqli_prepare($link, $sql))
        // {
        //     mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssss",$p_teamname,$p_leadername,$p_leaderclgname,$p_leaderemail,$p_leadercontact,
        //     $p_member1name,$p_member1clgname,$p_member1email,$p_member1contact,$p_member2name,$p_member2clgname,$p_member2email,$p_member2contact,
        //     $p_member3name,$p_member3clgname,$p_member3email,$p_member3contact,$p_member4name,$p_member4clgname,$p_member4email,$p_member4contact,
        //     $p_ideaname,$p_themename,$p_file);

        //     $p_teamname=$teamname;
        //     $p_leadername=$leadername;
        //     $p_leaderclgname=$leaderclgname;
        //     $p_leaderemail=$leaderemail;
        //     $p_leadercontact=$leadercontact;
        //     $p_member1name=$member1name;
        //     $p_member1clgname=$member1clgname;
        //     $p_member1email=$member1email;
        //     $p_member1contact=$member1contact;
        //     $p_member2name=$member2name;
        //     $p_member2clgname=$member2clgname;
        //     $p_member2email=$member2email;
        //     $p_member2contact=$member2contact;
        //     $p_member3name=$member3name;
        //     $p_member3clgname=$member3clgname;
        //     $p_member3email=$member3email;
        //     $p_member3contact=$member3contact;
        //     $p_member4name=$member4name;
        //     $p_member4clgname=$member4clgname;
        //     $p_member4email=$member4email;
        //     $p_member4contact=$member4contact;
        //     $p_ideaname=$ideaname;
        //     $p_themename=$themename;
        //     $p_file=$file;

        //     if(mysqli_stmt_execute($stmt))
        //     {
                header("location: thankyou.php");
        //     }
        //     else
        //     {
        //         echo "Something went wrong. Please try again later.";
        //     }
        //     mysqli_stmt_close($stmt);
        // }
    }

    mysqli_close($link);

}

function test_data($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hackathon | Registration Form</title>
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/styleform.css">
</head>
<body>
    <div class="main">
        <section class="submission">
            <div class="image">
                <img src="assets/hori1.jpg" alt="" >
            </div>
            <div class="container">
                <div class="submission-content">
                    <form method="POST" id="submission-form" class="submission-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  enctype="multipart/form-data" >
                        
                        <h2 class="form-title">Hackathon <br> Registrations</h2> 

                        <h3 class="labels">Team Details <span class="star">*</span></h3>
                        <div class="form-group">
                            <input type="text" class="form-input" name="teamname" id="teamname" placeholder="Team Name" value="<?php echo $teamname; ?>"/>
                            <span class="error_msg"><?php echo $teamname_err; ?></span>
                        </div>
                        <h3 class="labels">Team Leader Details <span class="star">*</span></h3>
                        <div class="form-group">
                            <input type="text" class="form-input" name="leadername" id="leadername" placeholder="Full Name" value="<?php echo $leadername; ?>"/>
                            <span class="error_msg"><?php echo $leadername_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="leaderclgname" id="leaderclgname" placeholder="College Name" value="<?php echo $leaderclgname; ?>"/>
                            <span class="error_msg"><?php echo $leaderclgname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="leaderemail" id="leaderemail" placeholder="Email Address" value="<?php echo $leaderemail; ?>"/>
                            <span class="error_msg"><?php echo $leaderemail_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="leadercontact" id="leadercontact" placeholder="Contact No." value="<?php echo $leadercontact; ?>"/>
                            <span class="error_msg"><?php echo $leadercontact_err; ?></span>
                        </div>
                        
                        <h3 class="labels">Member 1 Details</h3>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member1name" id="member1name" placeholder="Full Name" value="<?php echo $member1name; ?>"/>
                            <span class="error_msg"><?php echo $member1name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member1clgname" id="member1clgname" placeholder="College Name" value="<?php echo $member1clgname; ?>"/>
                            <span class="error_msg"><?php echo $member1clgname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member1email" id="member1email" placeholder="Email Address" value="<?php echo $member1email; ?>"/>
                            <span class="error_msg"><?php echo $member1email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member1contact" id="member1contact" placeholder="Contact No." value="<?php echo $member1contact; ?>"/>
                            <span class="error_msg"><?php echo $member1contact_err; ?></span>
                        </div>

                        <h3 class="labels">Member 2 Details</h3>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member2name" id="member2name" placeholder="Full Name" value="<?php echo $member2name; ?>"/>
                            <span class="error_msg"><?php echo $member2name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member2clgname" id="member2clgname" placeholder="College Name" value="<?php echo $member2clgname; ?>"/>
                            <span class="error_msg"><?php echo $member2clgname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member2email" id="member2email" placeholder="Email Address" value="<?php echo $member2email; ?>"/>
                            <span class="error_msg"><?php echo $member2email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member2contact" id="member2contact" placeholder="Contact No." value="<?php echo $member2contact; ?>"/>
                            <span class="error_msg"><?php echo $member2contact_err; ?></span>
                        </div>

                        <h3 class="labels">Member 3 Details</h3>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member3name" id="member3name" placeholder="Full Name" value="<?php echo $member3name; ?>"/>
                            <span class="error_msg"><?php echo $member3name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member3clgname" id="member3clgname" placeholder="College Name" value="<?php echo $member3clgname; ?>"/>
                            <span class="error_msg"><?php echo $member3clgname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member3email" id="member3email" placeholder="Email Address" value="<?php echo $member3email; ?>"/>
                            <span class="error_msg"><?php echo $member3email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member3contact" id="member3contact" placeholder="Contact No." value="<?php echo $member3contact; ?>"/>
                            <span class="error_msg"><?php echo $member3contact_err; ?></span>
                        </div>

                        <h3 class="labels">Member 4 Details</h3>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member4name" id="member4name" placeholder="Full Name" value="<?php echo $member4name; ?>"/>
                            <span class="error_msg"><?php echo $member4name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member4clgname" id="member4clgname" placeholder="College Name" value="<?php echo $member4clgname; ?>"/>
                            <span class="error_msg"><?php echo $member4clgname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member4email" id="member4email" placeholder="Email Address" value="<?php echo $member4email; ?>"/>
                            <span class="error_msg"><?php echo $member4email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="member4contact" id="member4contact" placeholder="Contact No." value="<?php echo $member4contact; ?>"/>
                            <span class="error_msg"><?php echo $member4contact_err; ?></span>
                        </div>

                        <h3 class="labels">Project Idea Details <span class="star">*</span></h3>
                        <div class="form-group">
                            <input type="text" class="form-input" name="ideaname" id="ideaname" placeholder="Project Idea Name" value="<?php echo $ideaname; ?>"/>
                           <span class="error_msg"><?php echo $ideaname_err; ?></span>
                        </div>

                        <h3 class="labels">Project Idea's Theme <span class="star">*</span></h3>
                        <div class="form-group">
                            <select class="dropdown" name="themename" id="themename">
                                <option value="">Select...</option>
                                <option value="Human Augmentation">Human Augmentation</option>
                                <option value="COVID-19">COVID-19</option>
                                <option value="Education">Education</option>
                                <option value="Health">Health</option>
                                <option value="Defence">Defence</option>
                            </select><br>
                            <span class="error_msg"><?php echo $themename_err; ?></span>
                        </div>

                        <h3 class="labels">Project Idea Abstract Upload <span class="star">*</span></h3>
                        <div class="form-group">
                            <input type="file" class="form-input upload" name="file" id="file">   
                        </div>
                        <span class="error_msg"><?php echo $file_err; ?></span>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>