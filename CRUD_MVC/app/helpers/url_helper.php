<?php
    //Para redireccionar la página
    function redireccionar($pagina) {
        header('location: ' . RUTA_URL . $pagina);
    }

?>