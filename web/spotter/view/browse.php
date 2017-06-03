<?php
if(!isset($_SESSION)){
session_start();
}

if(!isset($_SESSION['username'])){
    header("Location: ../");
    session_destroy();
    die();
}else{
    $thisPage = "browse"; 
    include "modules/header.php";
}
?>
  <main>
    <h2>Browse</h2>
    <div class="columns">
      <div class="leftCol">
        <h3 class="header">Categories</h3>
        <ul class="filter">
          <?php
          foreach($categories as $category){
            echo "<li><a onclick=(filterByCategory('{$category['id']}'))>{$category['title']}</a></li>";
          }
        ?>
        </ul>
      </div>
      <div class="rightCol">
        <h3 class="header">Locations</h3>
        <ul class="filterContent">
          <?php
          foreach($locations as $location){
            echo "<li data-categoryId='{$location['categoryid']}'><h3><a href='./?action=viewLocation&id={$location['id']}&location=".urlencode($location['title'])."'>{$location['title']}</a></h3> <p>{$location['description']}</p></li>";
          }
        ?>
        </ul>
      </div>
    </div>
  </main>
  <?php include "modules/footer.php"; ?>
