<div class="bannerImageHolder">
    <?php include("slider.php"); ?>
</div>

<div class="clear"></div>

<div class="infoBoxesWrapper">
    <div class="infoBox">
        <div class="infoBoxImage">
            <img src="<?php echo $img_root; ?>/infobox/drivers_ed.png" alt="xxx" />
        </div>
        <div class="infoBoxTitle">
            <h3>Online Driver's Ed</h3>
        </div>
        <div class="infoBoxText">
            <p>Online Driver's Ed is fast, fun and easy.  It's free to take our course in its entirety - all 10 chapters are available.  Try it Now!</p>
        </div>
    </div>
    <div class="infoBox">
        <div class="infoBoxImage">
            <img src="<?php echo $img_root; ?>/infobox/behind_the_wheel_training.png" alt="xxx" />
        </div>
        <div class="infoBoxTitle">
            <h3>Behind The Wheel Training</h3>
        </div>
        <div class="infoBoxText">
            <p>Our driver training program offers new drivers a fun, rewarding experience while providing the skills needed to drive a car safely in today's traffic.  We offer a structured curriculum and have individual lessons and packages to meet your needs and budget.</p>
        </div>
    </div>
    <div class="infoBox">
        <div class="infoBoxTitle">
            <h3>Login</h3>
        </div>
        <div class="infoBoxLogin">
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

            <form method="POST" id="loginForm" name="loginForm" action="/login">
                <label for="emailAddress">Email Address:</label>
                <input type="text" name="emailAddress" id="emailAddress" value="<?php echo $email_address; ?>" />
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" />
                <label for="type">Type:</label>
                    <select name="type" >
                        <option value="student" >Student</option>
                        <option value="parent" >Parent</option>
                    </select>
                <div style="clear:both;height:10px;width:100%;"></div>
                <button type="submit" id="login_submit" name="login_submit" value="true">Login</button>

                <div style="clear:both;height:10px;width:100%;"></div>

                <script>
                    //A very basic way to open a popup
                    function popup(link, windowname) {
                        window.open(link.href, windowname, 'width=400,height=200,scrollbars=yes');
                        return false;
                    }
                </script>

                <a href='/facebook' onclick="return popup(this,'fblogin')" >Login Using Facebook</a>
                <a href='/website/login/forgotten' >Forgotten Username Or Password?</a>
                <a href='/register' >Register With Us</a>
            </form>
        </div>
    </div>
</div>
