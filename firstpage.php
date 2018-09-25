<?php
include("db.php");
session_start();
$error="";
if(array_key_exists("logout",$_GET)){
    unset($_SESSION);
    setcookie("id","",time()-60*60);
    $_COOKIE["id"]="";
}
else if((array_key_exists("id",$_SESSION) AND $_SESSION['id']) OR (array_key_exists("id",$_COOKIE) AND $_COOKIE['id']))
{
    header("Location:secondpage.php");
}
if(array_key_exists("submit", $_POST))
 {
   
    if(!$_POST['username'])
    {
        $error.="USERNAME IS REREQUIRED<br>";
    }
    if(!$_POST['password'])
    {
        $error.="PASSWORD IS REQUIRED<br>";
    }
    if($error!="")
    {
        $error="<p>THERE ARE ERRORS IN FORM</p>".$error;
    }
    else
    {
        if($_POST['signup']=='1')
        {
         $query="SELECT id FROM teacher_info WHERE username= '".mysqli_real_escape_string($link, $_POST['username'])."' LIMIT 1";
         $result=mysqli_query($link,$query);
         if(mysqli_num_rows($result)>0)
         {
            $error="that username is already taken";
         }
         else
         {
            $query="INSERT INTO teacher_info (username,password) VALUES ('".mysqli_real_escape_string($link, $_POST['username'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";
            if(!mysqli_query($link,$query))
            {
                $error="<p> try again later";
            }
            else
            {   
                $query="UPDATE teacher_info SET password='".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id=".mysqli_insert_id($link)." LIMIT 1";
                mysqli_query($link,$query);
                $_SESSION['id']=mysqli_insert_id($link);
                if($_POST['stayloggedin']=='1')
                {
                    setcookie("id",mysqli_insert_id($link),time()+60*60*24*365);
                }
                header("Location:secondpage.php");
            }
         }
       }
       else
       {
          
            
          $query ="SELECT * FROM teacher_info WHERE username ='".mysqli_real_escape_string($link, $_POST['username'])."'";
          $result=mysqli_query($link,$query);
          $row=mysqli_fetch_array($result);
          if(isset($row))
          {
            $hashedpassword=md5(md5($row['id']).$_POST['password']);
            if($hashedpassword==$row['password'])
            {
                $_SESSION['id']=$row['id'];
                if($_POST['stayloggedin']=='1')
                {
                    setcookie("id",$row['id'],time()+60*60*24*365);
                }

                header("Location:secondpage.php");
            }
            else
            {
                echo "password is incorrect";
            }
          }
       }
    }
}
?>
<?php
 if(!empty($error))
 { 
?>
<div class="alert alert-success">
 <?php echo "<strong> $error </strong>"; ?>
</div>
<?php
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
     <style type="text/css">
       .container {
          text-align: center;
          width: 400px;
          margin-top: 160px;
        }
        html { 
           background: url(upside.jpeg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
           background-size: cover;
        }
        body {
           background: none;
           color: #FFF;
        }
        #loginform{
            display: none;
        }
       
     </style>
   </head>
<body>
   <div class="container">
    <h1>ATTENDENCE PANEL</h1>
    <p><strong>STORE THE ATTENDENCE OF STUDENT'S</strong></p>
    <form method="post" id="signupform">
       <p>Interested? Sign Up now.</p>
       <fieldset class="form-group"> 
          <input class="form-control" type="username" name="username" placeholder="Your Username">
       </fieldset>
       <fieldset class="form-group"> 
          <input class="form-control" type="password" name="password" placeholder="Password">
       </fieldset>
       <div class="checkbox">
         <label>
            <input type="checkbox" name="stayloggedin" value=1>  Stay Logged In
         </label>
       </div>
       <fieldset class="form-group"> 
          <input type="hidden" name="signup" value="1">
          <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
       </fieldset>
       <p><a class="toggleform" href='#'>Log In</a></p>
    </form>
    <form method="post" id="loginform">
        <p>Log in using your Username and password</p>
      <fieldset class="form-group"> 
         <input class="form-control" type="username" name="username" placeholder="Your Username">
      </fieldset>
      <fieldset class="form-group"> 
         <input class="form-control" type="password" name="password" placeholder="Password">
      </fieldset>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="stayloggedin" value=1>  Stay Logged In
        </label>
       </div>
       <fieldset class="form-group"> 
          <input type="hidden" name="signup" value="0">
          <input class="btn btn-success" type="submit" name="submit" value="Log In!">
       </fieldset>
       <p><a class="toggleform">Sign Up</a></p>
    </form>
  </div>  
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(".toggleform").click(function(){
            
            $("#signupform").toggle();
            $("#loginform").toggle();
        });
    </script>
    
  </body>
</html>