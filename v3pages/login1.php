<div class="leftHolder">
    <div class="titleHolder"><h1><?php echo $page_title; ?></h1></div>

    <div class="contentHolder">
        <?php
            if(isset($errors) && $errors) {
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
            <form method="POST" id="loginForm" name="loginForm" action="/login">
                <div class="formLine">
                    <label for="emailAddress">Email Address:</label>
                    <input type="text" name="emailAddress" id="emailAddress"  />
                </div>
                <div class="formLine">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" />
                </div>
                 <!-- <div class="formLine">
                    <label for="type">Type:</label>
                    <select name="type" >
                        <option value="student" >Student</option>
                        <option value="parent" >Parent</option>
                    </select>
                </div> -->
                <div style="clear:both;height:10px;width:100%;"></div>
                <button type="submit" id="login_submit" name="login_submit" value="true">Login</button>
            </form>
        </div>
    </div>
</div>

<!-- include the contact form on the right side -->
<?php include("contactUsForm.php"); ?>
