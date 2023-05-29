<?php

if (!isset($_SESSION)) {
    echo '<script>alert("Não tens sessão iniciada. Faça login!"); window.location.href = "../index.php";</script>';
}
session_start();
session_destroy();
echo '<script>alert("Você saiu!"); window.location.href = "../index.php";</script>';
