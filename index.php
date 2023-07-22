<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Task Manager</title>
    <meta property="og:title" content="Delicious Faithful Gnu" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: gray;

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./style.css" />
    <script src = "index.js"></script>
  </head>
  <body>
  <form action="index.php" method="post">

    <div>
      <link href="./index.css" rel="stylesheet" />
      <div class="home-container">
        <div class="home-container1">
          <div class="home-container2">
            <h1 class="home-text">Task Manager</h1>
            <button id="colorButton" type="button" class="home-button button">
              Change Background
            </button>
            <input
              type="color"
              id="color"
              class="home-textinput input"
            />
          </div>
        </div>
        <div class="home-container3">
          <h2 id="date" class="home-text1">Task name:</h2>
          <input
            type="text"
            id="taskName"
            name = "taskName"
            class="home-textinput1 input"
          />
          <h2 id="date" class="home-text2">Task Description:</h2>
          <textarea
            id="taskDesc"
            name = "taskDesc"
            class="home-textarea textarea"
          ></textarea>
          <h2 id="date" class="home-text3">Date:</h2>
          <input
            type="date"
            name = "date"
            id="dataChosen"
            class="home-textinput2 input"
          />
        </div>
        <div class="home-container4">
          <h2 class="home-text4">Tasks</h2>
          <button id="add" type="submit" class="home-button1 button" name = "add" onclick = "checkInput()">
            Add
          </button>
          <button id="edit" type="submit" class="home-button2 button" name = "edit" onclick = "checkInput()">
            Edit
          </button>
          <button id="delete" type="submit" class="home-button3 button" name = "delete">
            Delete
          </button>
          <!-- <button id="fav" type="submit" class="home-button4 button" name = "favorite">
            <span>
              <span>Favorite</span>
              <br />
            </span>
          </button> -->
          <input
            type="text"
            placeholder="Enter ID Number"
            id="IDNo"
            name="IDNo"
            class="home-textinput3 input"
          />
          <select id="sort" class="home-select" name = "sort" type = "submit" onchange="this.form.submit()">
            <option value="default" selected="">Sort By</option>
            <option value="IDLow">ID Number (Low to High)</option>
            <option value="IDHigh">ID Number (High to Low)</option>
            <option value="date">Date</option>
            <option value="abc1">A-Z</option>
            <option value="abc2">Z-A</option>
          </select>
        </div>

        <ul id="urgentTaskList" class="home-ul list">
        <h2>Tasks in two days</h2>
        <?php

          // Read JSON data from the file
          $jsonData = file_get_contents('tasks.json');

          // Decode JSON data into an array
          $tasks = json_decode($jsonData, true);

          // Get the current date and calculate three days before
          $currentDate = date("Y-m-d");

          // Array to store urgent tasks
          $urgentTasks = array();

          // Loop through tasks and find urgent ones
          foreach ($tasks as $task) {
            $taskDate = $task['Date'];

            $diff = abs(strtotime($taskDate) - strtotime($currentDate));
            if ($diff<=172800) {
              $urgentTasks[] = $task;
            }
          }

          // Display urgent tasks
          if (!empty($urgentTasks)) {
            echo "Urgent Tasks (due within two days):\n";
            foreach ($urgentTasks as $task) {
              echo '<li class="list-item"><span>';
              echo "ID: " . $task['ID'] . "\n";
              echo "Task Name: " . $task['TaskName'] . "\n";
              echo "Task Description: " . $task['TaskDesc'] . "\n";
              echo "Date: " . $task['Date'] . "\n\n";
              echo '</span></li>';
            }
          } else {
            echo "No urgent tasks found within the two-day range.\n";
          }      

        ?>

        </ul>

        <ul id="taskList" class="home-ul list">
          <h2>All the tasks</h2>
          <?php
            $json_data = file_get_contents('tasks.json');

            // Decode the JSON data into a PHP array
            $tasks = json_decode($json_data, true);
          
            if(count($tasks) != 0){ 
              // Read the content of the JSON file
            
              foreach ($tasks as $task) {
                echo '<li class="list-item"><span>' .$task['ID']. '. ' . 'Task: '. $task['TaskName'] . '.          ' . ' Description: ' . $task['TaskDesc']. '.          ' . ' Due Date: ' . $task['Date'] . '.' . '</span></li>';
            }
          }
         
          ?>
        </ul>
       <!-- 
        <div class="home-container5">
          <h2 class="home-text8">Favorite Tasks</h2>
          <button id="remove_fav" type="button" class="home-button5 button">
            Remove from Favorites
          </button>
          <input
            type="text"
            placeholder="Enter ID Number"
            id="favID"
            name="favNo"
            class="home-textinput4 input"
          />
          <select id="fav_sort" class="home-select1">
            <option value="default" selected="">Sort By</option>
            <option value="FIDLow">ID Number (Low to High)</option>
            <option value="FIDHigh">ID Number (High to Low)</option>
            <option value="date">Date</option>
            <option value="abc1">A-Z</option>
            <option value="abc2">Z-A</option>
          </select>
        </div>
        <ul id="favList" class="home-ul1 list">
        </ul>
      </div> -->
    </div>
    </form>
<?PHP

#Function to add input to list and JSON file
if (isset ($_POST["add"])){
	$TaskName = trim($_POST ["taskName"]);
	$TaskDesc = trim($_POST ["taskDesc"]);
	$Date = trim($_POST ["date"]);
	
  if (strlen($TaskName) != 0  && strlen($TaskDesc) != 0 && strlen($Date) != 0){
    if(filesize("tasks.json") == 0){ 
      $xyz = array("ID" => 1, "TaskName" => $TaskName, "TaskDesc" => 	$TaskDesc, "Date" => 	$Date); 
        
    }
    else{
      $json_data = file_get_contents('tasks.json');
      // Decode the JSON data into a PHP array
      $tasks = json_decode($json_data, true);
      $xyz = array("ID" => count($tasks)+1, "TaskName" => $TaskName, "TaskDesc" => 	$TaskDesc, "Date" => 	$Date); 
    }
  
      if(filesize("tasks.json") == 0){ 
            $first_record = array($xyz);
            $data_to_save = $first_record; 
        }
        else{ #If the file size is not zero
            $old_records = json_decode(file_get_contents("tasks.json")); 
            array_push($old_records, $xyz); 
            $data_to_save = $old_records; 
        }
          $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT); #Encodes the array $data_to_save into a json string with pretty-printing using json_encode. This is stored in $encoded_data
          file_put_contents("tasks.json", $encoded_data); #Puts the data into the json file
          echo "<meta http-equiv='refresh' content='0'>";
  }
}

if (isset ($_POST["delete"])){
  $ID = $_POST ["IDNo"];

  if ($ID > 0){
      
      $json_data = file_get_contents('tasks.json');

      // Decode the JSON data into a PHP array
      $tasks = json_decode($json_data, true);
    
      if(filesize("tasks.json") != 0){ 
        // Read the content of the JSON file
        $data_to_save = array();
        $count = 1;
        foreach ($tasks as $task) {    
          if ($task['ID'] != $ID){
              $xyz = array("ID" => $count, "TaskName" => $task['TaskName'], "TaskDesc" => $task['TaskDesc'], "Date" => $task['Date']);
              
              array_push($data_to_save, $xyz);
              $count = $count + 1;
          }
      }
      $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT); #Encodes the array $data_to_save into a json string with pretty-printing using json_encode. This is stored in $encoded_data
      file_put_contents("tasks.json", $encoded_data); #Puts the data into the json file
      echo "<meta http-equiv='refresh' content='0'>";
    }
  }
}
  
if (isset ($_POST["edit"])){
  $ID = $_POST ["IDNo"];
  $TaskName = trim($_POST ["taskName"]);
	$TaskDesc = trim($_POST ["taskDesc"]);
	$Date = trim($_POST ["date"]);

  if(empty($TaskName)||empty($TaskDesc)||empty($Date)){
    return;
  }
 
  if ($ID > 0){
      
      $json_data = file_get_contents('tasks.json');

      // Decode the JSON data into a PHP array
      $tasks = json_decode($json_data, true);
    
      if(filesize("tasks.json") != 0){ 
        // Read the content of the JSON file
        $data_to_save = array();
        $count = 1;
        foreach ($tasks as $task) {    
          if ($task['ID'] != $ID){
              $xyz = array("ID" => $count, "TaskName" => $task['TaskName'], "TaskDesc" => $task['TaskDesc'], "Date" => $task['Date']);
              array_push($data_to_save, $xyz);
              $count = $count + 1;
          }
          if ($task['ID'] == $ID ){
              $xyz = array("ID" => $ID, "TaskName" => $TaskName, "TaskDesc" => 	$TaskDesc, "Date" => 	$Date); 
              array_push($data_to_save, $xyz);
              $count = $count + 1;
          }
      }
      $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT); #Encodes the array $data_to_save into a json string with pretty-printing using json_encode. This is stored in $encoded_data
      file_put_contents("tasks.json", $encoded_data); #Puts the data into the json file
      echo "<meta http-equiv='refresh' content='0'>";
    }
  }
}

if (isset ($_POST["sort"])){
  $sortOption = $_POST["sort"];
  $json_data = file_get_contents('tasks.json');

  // Decode the JSON data into a PHP array
  $tasks = json_decode($json_data, true);

  if(count($tasks) != 0){ 
    // Read the content of the JSON file
    $ID = array_column($tasks, 'ID');
    $TaskName = array_column($tasks, 'TaskName');
    $Date = array_column($tasks, 'Date');
  
    $data_to_save = array();
      switch ($sortOption) {
          case 'IDLow':
              array_multisort($ID, SORT_ASC, $tasks);
              break;
          case 'IDHigh':
            array_multisort($ID, SORT_DESC, $tasks);
              break;
          case 'date':
            array_multisort($Date, SORT_ASC, $tasks);
              break;
          case 'abc1':
            array_multisort($TaskName, SORT_ASC, $tasks);
              break;
          case 'abc2':
            array_multisort($TaskName, SORT_DESC, $tasks);
              break;
          default:
            # code...
            break;
      }
      $data_to_save = $tasks;
      $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT); #Encodes the array $data_to_save into a json string with pretty-printing using json_encode. This is stored in $encoded_data
      file_put_contents("tasks.json", $encoded_data); #Puts the data into the json file
      echo "<meta http-equiv='refresh' content='0'>";
  }
}
?>

  
  
  
  
  </body>
</html>
