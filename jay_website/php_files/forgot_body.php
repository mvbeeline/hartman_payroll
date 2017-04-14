    <div class="header_1">
        <div id="header_4">
            <div class="login">
                <form action="<?php echo BASE_URI_HTTPS . 'index.php'?>" method="post">
                    <h3 id="login">New Password Login:</h3>
                        
                    <p id="user_id" >UserID:
                    
                        <input type="text" id="id" 
                               <?php if (isset($_SESSION['id'])) {
                                    echo "value=" . $_SESSION['id']; 
                                }?> 
                               size="15" name="id" />
                        
                    </p>
                    <p id="password" >Password:
                    <input type="password" id="pass" size="15" name="password" />
                        
                        
                    <input type="submit" id="login_submit" name="submit" value="Submit" /></p>
                </form>
                <p>Your temporary new password will be sent to the email address associated with this userID.</p>
                <p>Once you are logged in please change your temporary password to something unique.</p>
            </div>
        </div>
     </div>