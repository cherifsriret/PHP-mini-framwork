<?php
    $title = "Add New Note";
    require('partials/header.php')
?>
<h1><?= $title?></h1>
<main>

    <p>
        The following form allows you to add a new note
    </p>


    <form class="note-add-form" action="note_add" method="post">
      <div class="form-group">
        <label for="course_id">Course:</label>
        <select  name="course_id" required autofocus>
        <?php 
            foreach ($courses as $key => $course) :
        ?>
        <option value="<?= $course->getId() ?>"><?= $course->getName() ?></option>
        <?php endforeach; ?>
      </select>
      </div>
      <div class="form-group">
        <label for="note">Note:</label>
        <input type="number" id="note" name="note" required>
      </div>
      <div class="form-group">
        <label for="coeficient">Coeficient:</label>
        <input type="number" id="coeficient" name="coeficient" required>
      </div>
      <div class="form-group">
        <button type="submit">Add Note</button>
      </div>
    </form>

    <?php 
        if (isset($_SESSION['error'])) : 
    ?>
    <div id="alertMessage" class="alert alert-danger" ><?= $_SESSION['error']?></div>
    <?php 
        unset($_SESSION['error']);
        endif; 
    ?>
</main>
<?php require('partials/footer.php') ?>
