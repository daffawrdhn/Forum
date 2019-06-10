<!DOCTYPE html>
<html lang="en">
<?php

include_once('header.php');
include_once('content.php');
?>
<head>
<title>
	CRUDFURM.
</title>

<meta charset="utf-8">
<meta name="viewport"content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>

	function showLogin(){
		if($('#login').is(":visible")){
			$('#login').slideUp();
		}else{$('#login').slideDown();}

	}

	$(document).ready(function(){
		if(window.location.href.indexOf("UNF") > -1){
			alert("Login failed: User not found");
		}else if(window.location.href.indexOf("UAT") > -1){
			alert("Username is already taken");
		}else if(window.location.href.indexOf("TFF=false") > -1){
			alert("Please fill all text boxes when creating a new topic");
		}else if(window.location.href.indexOf("PFF") > -1){
			alert("Please fill all inputfields.");
		}else if(window.location.href.indexOf("RFF=false") > -1){
			alert("All registration fields have to be filled");
		}else if(window.location.href.indexOf("ITL") > -1){
			alert("Input exceeds maximum length.");
		}else if(window.location.href.indexOf("ICD") > -1){
			alert("Username and password can't contain special characters..");
		}
	});

	function showEdit(pID, rID, tID){
		if($("#form"+rID).length){
			if($("#form"+rID).is(":visible")){
				$("#form"+rID).slideUp();
			}else{$("#form"+rID).slideDown();}

		}else{
			if(pID != -1){
				$("#row"+rID).append("<br><form id='form"+rID+"' class='forms' action='functions.php' method='post'>"
						+"<textarea name='updCont' placeholder='Updated comment'></textarea><br>"
						+"<input type='hidden' name='postID' value='"+pID+"'>"
						+"<input type='hidden' name='topicID' value='"+tID+"'>"
						+"<button type='submit' name='submit' value='updContent'>Update comment</button> "
						+"<button type='submit' name='submit' value='delContent' onClick=\"return confirm('Are you sure?')\">"
						+"Delete comment</button>"
						+"</form>");
				$("#form"+rID).slideDown();
			}else{
				$("#row"+rID).append("<br><form class='forms' id='form"+rID+"' action='functions.php' method='post'>"
						+"<textarea name='updCont' class='lebar' placeholder='Updated description'></textarea><br>"

						+"<input type='hidden' name='postID' value='"+pID+"'>"
						+"<input type='hidden' name='topicID' value='"+tID+"'>"
						+"<button type='submit' name='submit' value='updContent'>Update</button> "
						+"</form>");
				$("#form"+rID).slideDown();
			}

		}


	}
</script>

<style media="screen">
  body {
    background: url('img/header.jpeg') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;

    /* background: #007bff;
    background: linear-gradient(to right, #0062E6, #33AEFF); */
  }

  /* table {
    /* border-collapse: collapse; */
    margin-top: 75px;
    margin-bottom: 25px;
  } */

  nav a {
    color: black;
  }

  a {
    color: black ;
  }

  .masthead {
  height: 100vh;
  min-height: 500px;
  background-image: url('img/header.jpeg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
  .section-full {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  }
  }

	.lebar{
		width: 100%;
		height: 20px;
	}

</style>

</head>

  <?php
  //If a session or a cookie is detected the website welcomes the user.
    if(isset($_SESSION['userN'])){
      print "";
    }else if(isset($_COOKIE['username'])){
      print "";
    }else if(isset($_GET["t"])){
      print "";
    }else{
      print "
      <header class='masthead shadow'>
        <div class='container h-100'>
          <div class='row h-100 align-items-center'>
            <div class='col-12 text-center'>
              <h1 class='font-weight-light'>CRUDFURM.</h1>
              <p class='lead'>Made forum too asdfghjkl</p>
            </div>
          </div>
        </div>
      </header>
      ";
    }

  ?>





<body>


  <!-- <div id="content">
  	<div class="d-flex justify-content-center">
  		<div class="shadow"> -->

  			<?php
  			//If the page is given a value 't' we display a single topic and its comments.
  				if(isset($_GET["t"])){
  					printTopic($_GET["t"]);

  				//If 't' isn't found the page instead displays all topics.
  				}else{printTopics();}


  			?>
  		<!-- </div>
  	</div>
  </div> -->






</body>
<?php include_once('footer.php'); ?>

</html>
