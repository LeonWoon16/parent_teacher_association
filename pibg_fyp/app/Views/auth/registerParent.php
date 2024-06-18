<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parent Register Page</title>
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>

    <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-9">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <h4 class="mt-1 mb-5 pb-1">Parent Registration</h4>
                </div>

                <form action="<?= base_url('auth/saveParent') ?>" method="post">

                <?=csrf_field(); ?>


                 <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                 <?php endif ?>

                 <?php if(!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                 <?php endif ?>

                    <p>Please register your account</p>

                  <!-- <div class="form-outline mb-4">
                  <label for="">Role </label>
                  <select class="form-select" name="role">
                   <option value="" disabled selected>Select your role</option>
                   <option value="option2">Teacher</option>
                   <option value="option3">Parents</option>
                  </select>
                </div> -->

                  <!-- <div class="form-outline mb-4"> 
                    <label for="">User ID </label>
                  <input type="text" class="form-control" name="id" placeholder="User ID">
                  </div> -->

                  <div class="form-outline mb-4">
                    <label for="">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Name" value="<?= set_value('name'); ?>">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'name'):''?></span>
                  </div>

                  <div class="form-outline mb-4">
                    <label for="">Role</label> 
                  <input type="text" class="form-control" name="role" placeholder="Parent" value="Parent" readonly>
                  </div>

                  <div class="form-outline mb-4"> 
                    <label for="">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'password'):''?></span>
                  </div>

                  <div class="form-outline mb-4"> 
                    <label for="">Confirm Password</label>
                  <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" value="<?= set_value('cpassword'); ?>">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'cpassword'):''?></span>
                  </div>

                  <div class="form-outline mb-4"> 
                    <label for="">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'email'):''?></span>
                  </div>

                  <div class="form-outline mb-4"> 
                    <label for="">Phone Number</label>
                  <input type="text" class="form-control" name="phone" placeholder="Phone Number" value="<?= set_value('phone'); ?>">
                   <span class="text-danger"><?= isset($validation) ? display_error($validation,'phone'):''?></span>
                  </div>

                  <div class="form-outline mb-4"> 
                    <label for="">Date of Birth</label>
                  <input type="date" class="form-control" name="dob" placeholder="Date of Birth" value="<?= set_value('dob'); ?>">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'dob'):''?></span>
                  </div>

                  <div class="form-outline mb-4"> 
                    <label for="">Address</label>
                  <input type="text" class="form-control" name="address" placeholder="Address" value="<?= set_value('address'); ?>">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'address'):''?></span>
                  </div>

                  <div class="form-outline mb-4"> 
                    <label for="">Income</label>
                  <input type="text" class="form-control" name="income" placeholder="Income (RM)" pattern="[0-9]+" value="<?= set_value('income'); ?>">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'income'):''?></span>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <a href="/auth">Click here!</a>
                    <!-- <button type="button" class="btn btn-outline-danger" onclick="location.href='<?= site_url('auth') ?>'">Login</button>  -->
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>


    <script src="assets/js/jquery-3.6.4.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


  </body>
</html>