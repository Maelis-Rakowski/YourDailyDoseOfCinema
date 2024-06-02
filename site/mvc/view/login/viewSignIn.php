<?php $this->_t="SignIn"?>

<div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout">
    <div class="bd-main order-1">

        <div class="py-5 text-center">
            <h2 class="fw-bold display-5">Welcome Back!</h2>
            <p class="lead">Welcome to our login page! Please enter your email and password to access your account.</p>
        </div>

        <div class="bd-example">
            <div class="border p-3 mb-3 rounded bg-light">
                <h2 class="display-7 fw-bold">Sign In</h2>
                <form method="POST" action="/login/signIn">
                    <div class="form-floating mb-3 mt-3">
                        <input name="pseudo" class="form-control" type="text" placeholder="a">
                        <label for="pseudo" class="form-label">Pseudo</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input name="password" class="form-control" type="password" placeholder="password">
                        <label for="password" class="form-label">Password</label>
                        <?php 
                            if($error == "errorConnexion") {
                                echo('<div id="loginTooltip" class="text-danger error form-text">Error in the entry of your username or password</div>');
                            } 
                        ?>                        
                    </div>
                    <button type="submit" class="btn-dark btn btn-primary mt-2">Sign In</button>
                </form>
            </div>

            <div class="border p-3 rounded bg-light mt-5">
                <h2 class="display-7 fw-bold">Forgot Password ?</h2>
                <form id="emailForm" method="POST" action="sendEmail" target="_blank">
                    <div class="mb-3 form-floating mt-3">
                        <input name="email" id="emailInput" class="form-control" type="text" placeholder="exist">
                        <label for="email" class="form-label" >Email</label>
                    </div>
                    <p id="answerEmail"></p>

                    <button type="submit" class="btn-dark btn btn-primary mt-4" id="sendEmailButton">Send Mail</button>
                </form>
            </div>
        </div>
    </div>
    <script src="/scripts/login.js"></script>
</div>
