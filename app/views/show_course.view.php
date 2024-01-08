<?php
    $title = "Audit Course";
    require('partials/header.php')
?>
<h1>Audit Course</h1>

<div class="courses-section">
        <div class="course-container">
          <div class="course flex1"><?= $course->getName() ?></div>
          <div class="average flex1">Moyenne Générale: <input type="number" class="form-control"  name="average" value="<?= $course->getAverage() ?>" disabled></div>
      </div>
  </div>
  <h3>Audit</h3>
  <table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Moyenne</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($course->getAudits() as $key => $audit) :?>
            <tr>
                <td><?= $audit->getUpdatedAt() ?></td>
                <td><?= $audit->getAverage() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>  
<?php require('partials/footer.php') ?>
