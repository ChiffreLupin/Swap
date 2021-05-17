<div class="cotainer">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card">
                <div class="card-header">Register</div>
                    <div class="card-body">
                        <?php $form = \app\core\form\Form::begin('', 'post') ?>
                            <?php echo $form->field($model, 'firstname')?>
                            <?php echo $form->field($model, 'lastname')?>
                            <?php echo $form->field($model, 'email')?>
                            <?php echo $form->field($model, 'password')->passwordField()?>
                            <?php echo $form->field($model, 'confirmPassword')->passwordField()?>
                            
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                Register
                                </button>
                            </div>
                        <?php \app\core\form\Form::end() ?>

                </div>
            </div>
        </div>
    </div>
</div>