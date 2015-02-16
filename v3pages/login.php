<div class="leftHolder">
    <div class="titleHolder"><h1><?php echo $page_title; ?></h1></div>

    <div class="contentHolder">
        <?php
            if($errors) {
        ?>
            <div class="errorsHolder" style="display:block;margin-top:-5px;">
                <ul style="margin-top:2px;">
                    <?php
                        foreach($errors AS $error) {
                            echo "<li>$error</li>";
                        }
                    ?>
                </ul>
            </div>
        <?php
            }
        ?>

        <div class="clear"></div>

        <div class="formHolder">
            <form method="POST" id="loginForm" name="loginForm" action="/<?php echo $login_type; ?>/login/submit">
                <div class="formLine">
                    <label for="emailAddress">Email Address:</label>
                    <input type="text" name="emailAddress" id="emailAddress" value="<?php echo $email_address; ?>" />
                </div>
                <div class="formLine">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" />
                </div>

                <div style="clear:both;height:10px;width:100%;"></div>
                <button type="submit" id="login_submit" name="login_submit" value="true">Login</button>
            </form>
        </div>
    </div>
</div>

<!-- include the contact form on the right side -->
<?php include("contactUsForm.php"); ?>
