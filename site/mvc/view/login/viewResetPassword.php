<?php $this->_t="ResetPassword"?>
<div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout">
    <main class="bd-main order-1">
        <div class="py-5 text-center">
            <h2 class="fw-bold display-5">Start Over with a New Password</h2>
            <p class="lead">Easily reset your password by entering your email address. We'll send you a link to create a new password. If you have any trouble, please contact our support team for assistance..</p>
        </div>

        <div class="bd-example">   
            <div class="border p-3 mb-3 rounded bg-light">
                <h2 class="display-7 fw-bold">Reset your password</h2>
                <form method="POST" action="/login/updatePassword">
                    <div class="form-floating mb-3 mt-3">
                        <input required class="form-control" name="email" type="hidden" value=<?= $_GET['email'] ?>>
                        <p>Your email :<?= $_GET['email'] ?></p>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required name="token" class="form-control"  type="hidden" value=<?= $_GET['token'] ?>>
                        <p>Your Token : <?= $_GET['token'] ?></p>
                    </div>

                    <div class="mb-3 form-floating">
                        <input required name="newPassword" class="form-control passwordInput" type="password" placeholder="password">
                        <label for="newPassword" class="form-label">New Password</label>
                        <div id="helpPassword">                            
                            <div id='pwd_eightCar'  class="text-danger error form-text">Password must be at least 8 characters long.</div>
                            <div id='pwd_special'   class="text-danger error form-text">Password must contain at least one special character.</div>
                            <div id='pwd_maj'       class="text-danger error form-text">Password must contain at least one uppercase letter.</div>
                            <div id='pwd_min'       class="text-danger error form-text">Password must contain at least one lowercase letter.</div>
                            <div id='pwd_number'    class="text-danger error form-text">Password must contain at least one number.</div>
                        </div>
                    </div>
                    <div class="mb-3 form-floating">
                        <input required name="confirmPassword" class="confirmPassword form-control" type="password" placeholder="password">
                        <label for="confirmPassword" class="form-label">Confirm password</label>
                        <div id='pwdMatchTooltip' class="text-danger error form-text">Oops, it looks like you've entered the wrong password twice. Please try again.</div>
                    </div>
                    <button id="submitBtn" type="submit" class="btn-dark btn btn-primary mt-4">Reset Password</button>                    
                </form>
            </div>
        </div>
    </main>
</div>