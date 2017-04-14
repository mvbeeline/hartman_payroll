<div class="header_1">
        <div id="header_4">
                <div class="login">
                    <form action="<?php echo BASE_URI_HTTPS . 'index.php'?>" method="post">
                    <h3 id="login">Login:</h3>
                        <?php if (!empty($login_errors)) {
                            if (isset($login_errors['login'])) {
                                echo $login_errors['login'];
                            }
                        } ?>
                    <p id="user_id_1" >UserID:
                    <input type="text" id="user_id" size="15" name="user_id" />
                        <?php if (!empty($login_errors)) {
                            if (isset($login_errors['id'])) {
                                echo $login_errors['id'];
                            }
                        } ?>
                    </p>
                    <p id="password" >Password:
                    <input type="password" id="pass" size="15" name="password" />
                        <?php if (!empty($login_errors)) {
                            if (isset($login_errors['password'])) {
                                echo $login_errors['password'];
                            }
                        } ?>
                    <input type="submit" id="login_submit" name="submit" value="Submit" /></p>
                    </form>
                <div class="forgot_pass">
                    <form action="<?php echo BASE_URI_HTTPS . 'index.php'?>" id="forgot_pass" method="post">
                        <input type="hidden" name="forgot_password" value="forgot"/>
                        <input type="submit" value="Forgot Password" /> 
                    </form>
                </div>
            </div>
        </div>
     </div>