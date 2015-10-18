<?php
    $bodyMail = file_get_contents('mail/mail_index.htm',true);
    if(!empty($_POST))
    {
        $name1=$_POST['participant1'];

        if(!empty($_POST["participant2"])){
        $name2=$_POST["participant2"];
        }

        else { $name2='Not Applicable'; }

        $email=$_POST["email"];
        $phone=$_POST["phone-number"];
        $school=$_POST["school"];
        $level=$_POST["level"];

        $string=$name1."|".$name2."|".$email."|".$phone."|".$school."|".$level."\n";

        $file = fopen("","a+");
        $status=fwrite($file,$string);
        fclose($file);

        if($status === false){ header("Location: unsuccessful.html "); }
        else { /*header("Location: successful.html ");*/
                echo '<script>alert("Registration Successful!");</script>';
                echo "<p align='center'><br><br><br><br><h4> Registration for $name1's team is complete</h4><p>";

                        require 'mail/PHPMailerAutoload.php';

                        $mail = new PHPMailer;

                        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'glug@pace.edu.in';                 // SMTP username
                        $mail->Password = '';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom('glug@pace.edu.in','GLUG PACE');
                        $mail->addAddress($email, $name1);
                        $mail->addReplyTo('sahilsatishkumar@gmail.com', 'Bytestruck');
                        $mail->addBCC('sahilsatishkumar@gmail.com');

                        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = 'Your REGISTRATION for #Bytestruck2015 is complete';
                        
                        $bodyMail = str_replace("tbrname1", $name1, $bodyMail);
                        $bodyMail = str_replace("tbrname2", $name2, $bodyMail);
                        $bodyMail = str_replace("tbrphone", $phone, $bodyMail);
                        $bodyMail = str_replace("tbrschool", $school, $bodyMail);
                        $bodyMail = str_replace("tbrlevel", $level, $bodyMail);

                        $mail->Body    = $bodyMail;
                        $mail->AltBody = "Greetings, 
                            Hello Participant the registration details have been recorded.
                            Participant 1: $name1
                            Participant 2: $name2
                            Phone Number : $phone
                            School/College and level: $school($level)

                            Let us know if any changes are required.

                            Best Regards,
                            GLUG PACE";

                        if(!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo "A confirmation mail has been sent to $email";
                        }


                }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Registration for Bytestruck'15</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body id="page-top" class="index">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#page-top">Bytestruck 2015</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                                        <a href="#page-top"></a>
                </li>
                <li>
                    <button onClick="window.location='index.html';" class="btn btn-info btn-lg">HOME</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <br/><br/>
                <h2>REGISTRATION FORM</h2>
                <hr class="star-primary">
            </div>
        </div>


        <div class="col-lg-8 col-lg-offset-2">
            <form action="?" method="post">
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Team Leader's Name</label>
                        <input type="text" name="participant1" class="form-control" placeholder="Participant One" required="" data-validation-required-message="Please enter participant one's name.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Team Member Name</label>
                        <input type="text" name="participant2" class="form-control" placeholder="Participant Two (For 2 member teams only)"  ><!--required="" data-validation-required-message="Please enter participant two's name.">-->
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Email Address of any one team member</label>
                        <input type="email" name="email" class="form-control" placeholder="Email Address" id="email" required="" data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>10 digit valid Phone Number of any one team member</label>
                        <input type="tel" pattern="^\d{10}$" name="phone-number" class="form-control" placeholder="Phone Number" id="phone" required="" data-validation-required-message="Please enter your phone number.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Name of School/College</label>
                        <input type="text" name="school" class="form-control" placeholder="School/College Name" id="school" required="" data-validation-required-message="Please enter your School/College name.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <br/>
                        <select type="combo-box" name="level" value="Select Education level" class="form-control" id="" required="" data-validation-required-message="Please enter your name.">
                            <option style="display:none;" value="" disabled selected>Please select Education level</option>
                            <option value="High School">High School</option>
                            <option value="PUC">PUC or (+1/+2)</option>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <br>
                <div id="success"></div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <input type="submit" class="btn btn-success btn-lg" value="Submit">
                    </div>
                </div>
            </form>
        </div>



        </div>
</section>

<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                        <h3>About <a href="http://glugpace.in/index.php/about-bytestruck/">BYTESTRUCK</a></h3>
                        <p>Read more about<br>Bytestruck here.</p>
                    </div>
                <div class="footer-col col-md-4">
                    <h3>Around the Web</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="http://www.facebook.com/glugpace" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="http://twitter.com/glugpace" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="http://github.com/glugpace" class="btn-social btn-outline"><i class="fa fa-fw fa-github"></i></a>
                        </li>
                        <li>
                            <a href="http://mailto:admin@glugpace.in/" class="btn-social btn-outline"><i class="fa fa-fw fa-envelope"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3>About <a href="http://glugpace.in">GLUG PACE</a></h3>
                    <p>GNU/Linux User Group, PACE is a group of engineering students that promote and educate use of free and open source softwares.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Supported by: Department of Computer Science, PACE | FSMK
                </div>
            </div>
        </div>
    </div>
</footer>


        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="js/classie.js"></script>
        <script src="js/cbpAnimatedHeader.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/freelancer.js"></script>

</body>
</html>