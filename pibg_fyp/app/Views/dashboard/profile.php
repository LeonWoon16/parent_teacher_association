<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>



<form action="<?= base_url('usercontroller/updateProfile') ?>" method="post">

<?=csrf_field(); ?>

                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger">
                    <?= session()->getFlashdata('fail'); ?>
                    </div>
                 <?php endif ?>

                 <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= $userInfo['fld_name']; ?>">
  </div>

  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $userInfo['fld_email']; ?>">
  </div>


  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="<?= $userInfo['fld_password']; ?>">
  </div>


  <div class="form-group">
    <label for="cpassword">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword" value="<?= $userInfo['fld_password']; ?>">
  </div>

  <div class="form-group">
  <label for="phone">Phone Number</label>
  <input type="tel" class="form-control" id="phone" name="phone" value="<?= $userInfo['fld_phone']; ?>" pattern="[0-9]+" required>
  </div>

  <div class="form-group">
   <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" value="<?= $userInfo['fld_address']; ?>">
  </div>

  <div class="form-group">
   <label for="dob">Date of Birth</label>
    <input type="date" class="form-control" id="dob" name="dob" value="<?= $userInfo['fld_dob']; ?>">
  </div>

  <div class="form-group">
   <label for="income">Income(RM)</label>
    <input type="text" class="form-control" name="income" pattern="[0-9]+" name="income" value="<?= $userInfo['fld_income']; ?>">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
  <button type="reset" class="btn btn-danger">Reset</button>
</form>



<?= $this->endSection();?>