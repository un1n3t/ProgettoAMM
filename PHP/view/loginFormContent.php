<nav id="login-bar">
    <!-- Form di login -->
    <form  id="primaryLogin" class="login-form" action="?" method="post">
        <fieldset id="login-field">
            <ul id="login-buttons">
                <li>
                        <input id="userid" name="userid" type="text" placeholder="Insert your username" required autofocus>
                </li>
                <li>
                        <input id="password" name="password" type="password" placeholder="Your password.." required>
                </li>
                <li>
                        <button type="submit" name="login" class="confirmBTN">OK</button>
                </li>
            </ul>
        </fieldset>
    </form>

    <section id="options">
        <ul class="authOptions">
            <li><a href="index.php?page=registration">Registrati</a> | </li>
            <li><a href="index.php?page=forgotPassword"> Ho dimenticato la password</a></li>
        </ul>
    </section>
    
</nav>

