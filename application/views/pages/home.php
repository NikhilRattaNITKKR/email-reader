<?= '<h1>' . $title . '</h1>' ?>

<?php echo form_open(base_url('emails')) ?>

<div class="form-group mt-2">
    <label for="email">
        <h5>Email*</h5>
    </label>
    <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email">
    <div class="invalid-feedback" id="title_div">
    </div>
</div>
<div class="form-group mt-2">
    <label for="password">
        <h5>Password*</h5>
    </label>
    <input type="password" class="form-control" name="password" placeholder="Enter App Password">
</div>

<div class="form-group mt-2">
    <label for="number">
        <h5>Number of Emails to show (default = 5)</h5>
    </label>
    <input type="number" class="form-control" name="number" placeholder="Enter Number of Emails to Show">
</div>

<input type="submit" value="Submit" />


<?= form_close() ?>