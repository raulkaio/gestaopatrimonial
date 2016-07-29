<?php
if (!isset($_SESSION['usuario'])) {
    header('location: index.php?class=alert-warning&titulo=Área restrita&mensagem=Somente usuários logados acessam esta página.');
    exit;
} 
?>