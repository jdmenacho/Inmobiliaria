<?php

function hacerPaginacion($count, $limit) {
  $paginas = ceil($count / $limit);
  $paginaActual = (!empty($_GET["pagina"])) ? $_GET["pagina"] : 1;
  ?>

  <div id="paginacion">
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li<?= ($paginaActual == 1 || $count <= 1) ? " class='disabled'" : "" ?>>
          <a href="?pagina=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
        </li>

        <?php
        if ($paginas <= 11) {
          $inicio = 1;
          $final = $paginas;
        } elseif (($paginaActual > 6) && ($paginas - $paginaActual >= 5)) {
          $inicio = $paginaActual - 5;
          $final = $paginaActual + 5;
        } elseif ($paginas - $paginaActual < 5) {
          $inicio = $paginas - 11;
          $final = $paginas;
        } elseif ($paginaActual - 5 <= 0) {
          $inicio = 1;
          $final = 11;
        }
        for ($x = $inicio; $x <= $final; $x++) {
          $active = ($x == $paginaActual) ? " class='active'" : "";
          echo "<li$active><a href='?pagina=$x'>$x</a></li>";
        }
        ?>

        <li<?= ($paginaActual == $paginas || $count <= 1) ? " class='disabled'" : "" ?>>
          <a href="?pagina=<?= $paginas ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
        </li>
      </ul>
    </nav>
  </div>

  <?php
}

?>
