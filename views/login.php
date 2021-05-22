<?php
/** @var model \app\models\User */
?>

<?php $form = \app\core\form\Form::begin('', "post") ?>
  <div class="mb-3">
    <?php echo $form->field($model, 'email') ?>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <?php echo $form->field($model, 'password') ?>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php \app\core\form\Form::end() ?>
