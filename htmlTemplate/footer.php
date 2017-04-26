<footer>
    <div>
        <?php
        echo "You are served by the server IP: <b>" . $_SERVER['SERVER_ADDR'] . "</b></br>";

        $datetime = date("j F, Y, g:i a");

        echo "on: <b>" . $datetime . "</b>";

        ?>

    </div>
</footer>