<div id="login">
    <div class="wrapper">
        <div class="nav">
            <ul>
                <li id="log-btn"class="button">Login</li>
                <li id="reg-btn"class="button">Registracija</li>
            </ul>
        </div>
        <div id="log-box">
            <form id="login-form" method="post" action="<?php echo URL; ?>login/log" autocomplete="on">
                <p>Uloguj se</p>
                <div class="text-box">
                    <input type="email" name="email" placeholder="Email" autocomplete="off"/>
                </div>
                <div class="text-box">
                    <input type="password" name="password" placeholder="Password" autocomplete="off"/>
                </div>    
                <input type="submit" value="Uloguj se"/>          
            </form>
        </div>
        <div id="reg-box">
            <form id="registration-form" method="post" action="<?php echo URL; ?>login/registration" autocomplete="off">
                <p>Registruj se</p>
                <div class="text-box">
                    <input id="username-input" type="text" name="name" placeholder="User name" autocomplete="off"/>
                    <span id="error-username"class="error-msg"></span>
                </div>
                <div class="text-box">
                    <input id="password-input" type="text" name="password" placeholder="Password" autocomplete="off"/>
                    <span id="error-password" class="error-msg"></span>
                </div>
                <div class="text-box">
                    <input id="email-input" type="email" name="email" placeholder="Email" autocomplete="off"/>
                    <span id="error-email" class="error-msg"></span>
                </div>
                <div>
                    <input type="radio" id="male" value="m" checked name="gender"/><label for="male">musko</label><br>
                    <input type="radio" id="female" value="z" name="gender"/><label for="female">zensko</label>
                </div>
                <input type="submit" value="Registruj se"/>
                
            </form>
        </div>
    </div>
</div>
