<?php $this->_t="SignUp"?>



<div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout">
    <main class="bd-main order-1">
        <div class="py-5 text-center">
            <h2 class="fw-bold display-5">Join Us!</h2>
            <p class="lead">Join our community! Create your account by entering your email and password.</p>
        </div>

        <div class="bd-example">
            <div class="border p-3 mb-3 rounded bg-light">
                <h2 class="display-7 fw-bold">Sign Up</h2>
                <form method="POST" action="/login/signUp">
                    <div class="form-floating mb-3 mt-3">
                        <input required id="pseudo-sign-up" name="pseudo" class="pseudo form-control" type="text" placeholder="a">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <div id='pseudoToolTip' class="text-danger error form-text">This username is already taken.</div>
                    </div>

                    <div class="form-floating mb-3 mt-3">
                        <input required name="email" class="emailInput form-control" type="email" placeholder="a">
                        <label for="email" class="form-label">Email</label>
                        <div id='emailToolTip' class="text-danger error form-text">Please enter a valid email address.</div>
                    </div>
                    <div class="mb-3 form-floating">
                        <input required name="password" class="passwordInput form-control" type="password" placeholder="password">
                        <label for="password" class="form-label">Password</label>

                        <div id="helpPassword">                            
                            <div id='pwd_eightCar'  class="text-danger error form-text">Password must be at least 8 characters long.</div>
                            <div id='pwd_special'   class="text-danger error form-text">Password must contain at least one special character.</div>
                            <div id='pwd_maj'       class="text-danger error form-text">Password must contain at least one uppercase letter.</div>
                            <div id='pwd_min'       class="text-danger error form-text">Password must contain at least one lowercase letter.</div>
                            <div id='pwd_number'    class="text-danger error form-text">Password must contain at least one number.</div>
                        </div>
                    </div>
                    <div class="mb-3 form-floating">
                        <input required name="password2" class="confirmPassword form-control" type="password" placeholder="password">
                        <label for="password2" class="form-label">Confirm password</label>
                        <div id='pwdMatchTooltip' class="text-danger error form-text">Oops, it looks like you've entered the wrong password twice. Please try again.</div>
                    </div>
                    <button id="submitBtn" type="submit" class="btn-dark btn btn-primary mt-4">Sign Up</button>                    
                </form>
            </div>
        </div>
        <div>
            Already have an acccount ?       
            <a class="btn btn-outline-dark" href="/login/signInView">Sign In</a>
        </div>
    </main>
</div>


</main>

