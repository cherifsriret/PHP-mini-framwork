<?php
    $title = "Home";
    require('partials/header.php')
?>
<h1>Home</h1>

<div class="courses-section">

        <?php 
            foreach ($courses as $key => $course) :
        ?>
        <div class="course-container">
          <div class="course flex1"><?= $course->getName() ?></div>
          <div class="average flex1">Moyenne Générale: <input type="number" class="form-control"  name="average" value="<?= $course->getAverage() ?>" disabled></div>
          <div class="your-average flex1"> <a href="/<?=  App::get('config')['base_uri']?>/details_course?id=<?= $course->getId() ?>">Details</a> </div>
      </div>

        <?php endforeach; ?>
  </div>
<?php require('partials/footer.php') ?>
