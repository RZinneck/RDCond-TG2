<?php

session_start();

unset($_SESSION['email']);
unset($_SESSION['id_usuario']);
unset($_SESSION['cond_nome']);
unset($_SESSION['cond_codigo']);
unset($_SESSION['id_cond']);
unset($_SESSION['fk_condominio']);
unset($_SESSION['usuario_tipo']);
unset($_SESSION['usuario_ap']);
session_unset($_SESSION);

header('Location: index.php');
