<style media="screen">
  table, th, td, tr {
    border: 1px solid black;
    }

    .space-right {
      margin-right: 25px;
    }

    .jarak {
      margin-right: 5px;
    }

    .lebar {
      width: 100%;
      height: 200px;
    }

</style>

<?php
//This file contains functions that fetch data from the database and display it.

require_once 'connection.php';

//Function for printing all topics found in the database.
function printTopics(){
	//Opening connection to the database using the function connectToDB().
	$conn = connectToDB();
	//Creating the SQL-statement for fetching data from the database.
	$sql = "SELECT t_id, t_name, username, t_desc FROM topic";
	$result = $conn->query($sql);

	//Here we echo some html content to be displayed on the webpage.
  echo "<div class='container'>";
  echo "<br>";

	echo "<h1 class='align-middle'>Topics</h1>";
	echo "<table class='tabel'>";

	//Checking if the query returned any results.
	if ($result->num_rows > 0) {

		//We go through the results of the sql with a while loop and echo the contents to a html table.
		while($row = $result->fetch_assoc()) {
			//Here we check if the user is logged in
			if(isset($_SESSION["userN"])){

				echoTopics($row, $_SESSION["userN"]);

			}else if(isset($_COOKIE["username"])){

				echoTopics($row, $_COOKIE["username"]);


			}else{

        echo "
        <br>
        <div class='card'>
          <div class='card-header'>
            ".$row["username"]."
          </div>
          <div class='card-body'>
            <h5 class='card-title'>".$row["t_name"]."</h5>
            <p class='card-text'>".$row["t_desc"]."</p>
            <a class='btn btn-primary' href='?t=".$row["t_id"]."' class='btn btn-primary'>Go discuss</a>
          </div>
        </div>
        <br>
        ";

			}

		}
		//If the user has logged in we create a form for creating new topics. It the user hasn't logged in we kindly ask them to do so.
		echo "<form action='functions.php' method='post'>";


	//If no results are found in the database the else-statement is executed.
	} else {
		echo "<br>
						<h3>
							No topics found
						</h3>
            <br>
            ";
		echo "<form action='functions.php' method='post'>";

		if(isset($_SESSION['userN']) && isset($_SESSION['userP'])){



		}else if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){



		}else{
			echo "<p class='text-left'>Please login to create topics.</p>";
		}
	}
	echo "</table>
			</form>
      </div>";
}


function viewTopics(){

  $conn = connectToDB();
  $username = $_COOKIE["username"];

	//Creating the SQL-statement for fetching data from the database.
	$sql = "SELECT t_id, t_name, username, t_desc FROM topic where username = '$username'";
	$result = $conn->query($sql);

	//Here we echo some html content to be displayed on the webpage.
  echo "<div class='container'>";
  echo "<br>";

	echo "<h1 class='align-middle'>Your Topics</h1>";
	echo "<table class='tabel'>";

	//Checking if the query returned any results.
	if ($result->num_rows > 0) {

		//We go through the results of the sql with a while loop and echo the contents to a html table.
		while($row = $result->fetch_assoc()) {
			//Here we check if the user is logged in
			if(isset($_SESSION["userN"])){

				echoTopics2($row, $_SESSION["userN"]);

			}else if(isset($_COOKIE["username"])){

				echoTopics2($row, $_COOKIE["username"]);


			}else{

        echo "
        <br>
        <div class='card'>
          <div class='card-header'>
            ".$row["username"]."
          </div>
          <div class='card-body'>
            <h5 class='card-title'>".$row["t_name"]."</h5>
            <p class='card-text'>".$row["t_desc"]."</p>
            <a class='btn btn-primary space-right' href='?t=".$row["t_id"]."' class='btn btn-primary'>Go discus</a>
          </div>
        </div>
        <br>
        ";

			}

		}
		//If the user has logged in we create a form for creating new topics. It the user hasn't logged in we kindly ask them to do so.
		echo "<form action='functions.php' method='post'>";


	//If no results are found in the database the else-statement is executed.
	} else {
		echo "<br>
						<h3>
							No topics found
						</h3>
            <br>
            ";
		echo "<form action='functions.php' method='post'>";

	}
	echo "</table>
			</form>
      </div>";

}


function newTopics(){
	//Opening connection to the database using the function connectToDB().
	$conn = connectToDB();
	//Creating the SQL-statement for fetching data from the database.
	$sql = "SELECT t_id, t_name, username FROM topic";
	$result = $conn->query($sql);

	//Here we echo some html content to be displayed on the webpage.
  echo "<div class='container'>";
	echo "<table class='tabel'>";

	//Checking if the query returned any results.
	if ($result->num_rows > 0) {

		//We go through the results of the sql with a while loop and echo the contents to a html table.

		echo "<form action='functions.php' method='post'>";

		if(isset($_SESSION['userN']) && isset($_SESSION['userP'])){

			echoTopicsForm();

		}else if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){

			echoTopicsForm();

		}else{
			echo "<td><p>Please login to create topics.</p></td>";
		}

	//If no results are found in the database the else-statement is executed.
	} else {
		echo "  <br>
						<h3>
							No topics found
						</h3>
            <br>
					";
		echo "<form action='functions.php' method='post'>";

		if(isset($_SESSION['userN']) && isset($_SESSION['userP'])){

			echoTopicsForm();

		}else if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){

			echoTopicsForm();

		}else{
			echo "<p class='text-center'>Please login to create topics.</p>";
		}
	}
	echo "</table>
			</form>
      </div>";
}









//This function prints a spesific topic including its name, description and creator.
function printTopic($id){
	//Opening connection to the database using the function connectToDB().
	$conn = connectToDB();
	//Creating the SQL-statement for fetching data from the database.
	$sql = $conn->prepare("SELECT t_name, username, t_desc FROM topic WHERE t_id = ?");
	$sql->bind_param("i", $id);
	$row_id = 0;

	//Executing the query
	$sql->execute();
	$result = $sql->get_result();

	if ($result->num_rows > 0) {
		// output data of each row
		echo "<table class='table'>";
		while($row = $result->fetch_assoc()) {
			//Checking if the user is logged in, if so we add elements that allow them to edit the description of their topic.
			if(isset($_SESSION["userN"])){

				echoTopic($row, $_SESSION["userN"], $_GET["t"], $row_id);

			}else if(isset($_COOKIE["username"])){

				echoTopic($row, $_COOKIE["username"], $_GET["t"], $row_id);

			}else{

        echo "
        <br>
        <div class='px-5 text-white'>
        <div class='border border-white jumbotron bg-white' style='background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);'>
          <h1 class='display-4'>".$row["t_name"]."</h1>
          <p id='row".$row_id."' class='lead'>".$row["t_desc"].".</p>

          <hr class='my-4'>
          <p>By ".$row["username"].".</p>
          <p class='lead'>

          </p>
        </div>
        </div>

        <h5 class='text-center'>Replies: </h5>

        ";
				// echo "<tr>
				// 		<td class='vertical-align text-right'>
				// 			<b>".$row["username"]."</b>
        //       23r23r23r23r23r23r
				// 		</td>
				// 		<td class='text-center'>
				// 			<h1>".$row["t_name"] ."</h1><br>
				// 			<h3 class='textLines'>".$row["t_desc"]."</h3>
        //       32hrh239hr92h3r9h
				// 		</td>
				// 	</tr>";
			}
		}
		echo "</table>";
	} else {
		echo "0 results";
	}
	//After echoing the topic, we query for the comments made to the topic.
	printPosts($id);
}

//This function prints all comments with a spesific topicID
function printPosts($id){
	//Opening connection to the database using the function connectToDB().
	$conn = connectToDB();
	//Creating the SQL-statement for fetching data from the database.
	$sql = $conn->prepare("SELECT p_id ,username, p_comment FROM post WHERE t_id = ?");
	$sql->bind_param("i", $id);

	//Executing the SQL-query
	$sql->execute();
	$result = $sql->get_result();
	$row_id = 1;
	if ($result->num_rows > 0) {
		// output data of each row
		echo "<form class='w-100 p-3' action='functions.php' method='post'>
				<table class='table'>";
		while($row = $result->fetch_assoc()) {
			//We use the $row_id for creating unique ids for all rows we create.
			$row_id++;
			if(isset($_SESSION["userN"])){

				//If the user has logged in we add an edit option for comments made by them.
				echoPosts($row, $_SESSION["userN"], $_GET["t"], $row_id);

			}else if(isset($_COOKIE["username"])){

				//If the user has logged in we add an edit option for comments made by them.
				echoPosts($row, $_COOKIE["username"], $_GET["t"], $row_id);

			}else{

        echo " <div class='px-5'>
        <div class='card' style='width: auto;'>
          <div class='card-header'>
            ".$row["username"] ." say,
          </div>
          <ul class='list-group list-group-flush'>
            <li class='list-group-item'>".$row["p_comment"]."</li>
          </ul>
        </div>
        </div>

        <br>
        ";
			}
		}
	}
	//After displaying all comments we add an form that allows logged in users to add new comments to the topics.
	echo "<form action='functions.php' method='post'>
			<table class='table'>";
	if(isset($_SESSION['userN']) && isset($_SESSION['userP'])){

		echoPostsForm($_GET['t']);

	}else if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){

		echoPostsForm($_GET['t']);

	}else{
		echo "<tr>
				<td class='text-center'>
					<p>Please login to comment.</p>
				</td>
			</tr>";
	}
	echo "	</table>
		</form>";
}

//This function echoes all topics to the webpage.
function echoTopics($row, $name){
	if($row["username"] == $name){

    echo "
    <br>

    <div class='card'>
      <div class='card-header'>
        ".$row["username"]."

      </div>
      <div class='card-body'>
        <h5 class='card-title'>".$row["t_name"]."</h5>


        <p class='card-text'>".$row["t_desc"]."</p>



        <div class='d-flex mx-auto'>
        <a href='index.php?t=".$row["t_id"]."' class='btn btn-primary jarak'>Go discuss</a>
        <form action='functions.php' method='post'>
          <input name='postID' type='hidden' value=-1>
          <input name='topicID' type='hidden' value=".$row["t_id"].">
          <button class='btn btn-outline-secondary' type='submit' class='rButton' name='submit' value='delContent'
            onClick=\"return confirm('Are you sure?')\">Remove
          </button>
        </form>
        </div>
      </div>
    </div>
    <br>
    ";


	}else{
    echo "
    <br>
    <div class='card'>
      <div class='card-header'>
        ".$row["username"]."
      </div>
      <div class='card-body'>
        <h5 class='card-title'>".$row["t_name"]."</h5>
        <p class='card-text'>".$row["t_desc"]."</p>
        <a href='?t=".$row["t_id"]."' class='btn btn-primary'>Go discuss</a>
      </div>
    </div>
    <br>
    ";

	}

}

function echoTopics2($row, $name){
	if($row["username"] == $name){

    echo "
    <br>

    <div class='card'>
      <div class='card-header'>
        ".$row["username"]."

      </div>
      <div class='card-body'>
        <h5 class='card-title'>".$row["t_name"]."</h5>


        <p class='card-text'>".$row["t_desc"]."</p>



        <div class='d-flex mx-auto'>
        <a href='index.php?t=".$row["t_id"]."' class='btn btn-primary jarak'>Go discuss</a>
        <form action='functions.php' method='post'>
          <input name='postID' type='hidden' value=-1>
          <input name='topicID' type='hidden' value=".$row["t_id"].">
          <button class='btn btn-outline-secondary' type='submit' class='rButton' name='submit' value='delContent2'
            onClick=\"return confirm('Are you sure?')\">Remove
          </button>
        </form>
        </div>
      </div>
    </div>
    <br>
    ";


	}else{
    echo "
    <br>
    <div class='card'>
      <div class='card-header'>
        ".$row["username"]."
      </div>
      <div class='card-body'>
        <h5 class='card-title'>".$row["t_name"]."</h5>
        <p class='card-text'>".$row["t_desc"]."</p>
        <a href='?t=".$row["t_id"]."' class='btn btn-primary'>Go discuss</a>
      </div>
    </div>
    <br>
    ";

	}

}

//This function adds a form used to create new topics.
function echoTopicsForm(){

  echo "<br>";

  echo "
  <div class='card text-center mx-auto' style='width: 25rem;'>
	  <div class='card-header'>
	    New Topic
	  </div>
	  <div class='card-body'>
	    <h5 class='card-title'>Topic Title</h5>

      <input class='input-group titleField' type='text' name='newTop' placeholder='Topic title' required>

      <br>

      <h5 class='card-title'>Topic Description</h5>

      <textarea class='form-group lebar' name='newDesc' placeholder='Topic description' required></textarea><br>

      <button class='btn btn-primary' type='submit' name='submit' value='newTopic'>
        Submit
      </button>

	  </div>
	  <div class='card-footer text-muted'>
	    Create new topic
	  </div>
	</div>
  ";

  echo "<br>";

}

//Function that is used to print a single topic.
function echoTopic($row, $name, $tID, $row_id){
	if($row["username"] == $name){



    echo "
    <br>
    <div class='px-5 text-white'>
    <div class='border border-white jumbotron bg-white' style='background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);'>
      <h1 class='display-4'>".$row["t_name"]."</h1>
      <p id='row".$row_id."' class='lead'>".$row["t_desc"].".</p>

      <hr class='my-4'>
      <p>By ".$row["username"].".</p>
      <p class='lead'>
        <a id='edit-1' class='btn btn-primary' href='#' role='button' onClick='showEdit(-1,".$row_id.",".$tID.")'>Edit</a>
      </p>
    </div>
    </div>

    <h5 class='text-center'>Replies: </h5>
    ";


	}else{

    echo "
    <br>
    <div class='px-5 text-white'>
    <div class='border border-white jumbotron bg-white' style='background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);'>
      <h1 class='display-4'>".$row["t_name"]."</h1>
      <p id='row".$row_id."' class='lead'>".$row["t_desc"].".</p>

      <hr class='my-4'>
      <p>By ".$row["username"].".</p>
      <p class='lead'>
        <a id='edit-1' class='btn btn-primary' href='#' role='button' onClick='showEdit(-1,".$row_id.",".$tID.")'>Edit</a>
      </p>
    </div>
    </div>

    <h5 class='text-center'>Replies: </h5>
    ";

		// echo "<tr>
		// 					<td class='vertical-align text-right'>
		// 						<b>".$row["username"]."</b>
    //             awdkabwdkjhakjwdhakwdjhahwkdjhak
		// 					</td>
		// 					<td class='text-center'>
		// 						<h1>".$row["t_name"] ."</h1><br>
		// 						<h3 class='textLines'>".$row["t_desc"]."</h3>
    //             1112jhsjhfjshefkhskjfhkjsehfhksjehfhkjsehfkh
		// 					</td>
		// 				</tr>";
	}
}
//Function that echoes all comments for a topic.
function echoPosts($row, $name, $tID, $row_id){
	if($row["username"] == $name){

    echo " <div class='px-5'>
    <div class='card' style='width: auto;'>
      <div class='card-header'>
        ".$row["username"] ." say,

          <a id='edit".$row["p_id"]."' class='btn btn-outline-secondary btn-sm' onClick='showEdit(".$row["p_id"].",".$row_id.",".$tID.")'>Edit</a>

      </div>
      <ul class='list-group list-group-flush'>
        <li class='list-group-item'>
          <a id='row".$row_id."' class='textLines'>
            ".$row["p_comment"]."
          </a>
        </li>
      </ul>
    </div>
    </div>

    <br>
    ";

  }else{

    echo " <div class='px-5'>
    <div class='card' style='width: auto;'>
      <div class='card-header'>
        ".$row["username"] ." say,
      </div>
      <ul class='list-group list-group-flush'>
        <li class='list-group-item'>".$row["p_comment"]."</li>
      </ul>
    </div>
    </div>

    <br>
    ";

	}
}

//This function adds a form that allows user to add comments to a topic.
function echoPostsForm($tID){

  echo "
    <div class='card text-center mx-auto' style='width: 25rem;'>
    <div class='card-header'>
      New Comment
    </div>
    <div class='card-body'>
      <h5 class='card-title'>Special title treatment</h5>
      <p class='card-text'>
      <textarea class='lebar' name='newComm' placeholder='New Comment'></textarea>
      <input type='hidden' name='topicID' value='".$tID."'><br>
      <button class='btn btn-primary' type='submit' name='submit' value='newComment'>
        Comment
      </button>
      </p>
    </div>
  </div>


  ";

	// echo "<tr>
	// 			<td>
	// 				<textarea name='newComm' placeholder='New Comment'></textarea>
	// 				<input type='hidden' name='topicID' value='".$tID."'><br>
	// 				<button type='submit' name='submit' value='newComment'>
	// 					Comment
	// 				</button>
	// 			</td>
	// 		</tr>";
}

?>
