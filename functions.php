<?php

    function getMessage(): void
    {
        if(isset($_SESSION["message"])){
            ?>
                <p id="message" class='<?= $_SESSION["message"]['type'] ?>'>
                    <?= $_SESSION["message"]['msg'] ?> 
                </p>
            <?php
                unset($_SESSION["message"]);
        }
    }

    function setMessage(string $type, string $msg): void
    {
        $_SESSION['message'] = ["type" => $type, 'msg' => $msg];
    }

    function redirect($url): void
    {
        header("Location:".$url);
        die;
    }