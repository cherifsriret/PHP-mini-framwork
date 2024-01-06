<?php
    $title = "My notes";
    require('partials/header.php')
?>
<h1>My notes</h1>

<div class="courses-section">
        <?php 
            foreach ($notes as $key => $course) : ?>
            <div class="course-container">
              <div class="course"><?= $course->getName() ?></div>
              <div class="notes">Notes: 
                <div class="notes-container">
                  <?php foreach ($course->getNotes() as $key => $note) : ?>
                    <div class="note">
                        <div class="note-value flex1">Note :<?= $note->getNote() ?></div>
                        <div class="note-coeficient flex1">Coeficient :<?= $note->getCoeficient() ?></div>
                        <div class="note-action flex1"><button>Update</button><button>Delete</button></div>
                    </div>
                  <?php endforeach; ?>
                </div> 
              </div>
              <div class="your-average">Your Average:  </div>
          </div>
       

        <?php endforeach; ?>
  </div>
<?php require('partials/footer.php') ?>
