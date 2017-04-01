<?php
$claseBody = "pag-nueva-blog";
$scriptsPagina = '<script src="js/tinymce/tinymce.min.js"></script>' .
                 '<script>' .
                    'tinymce.init({' .
                    'selector:"textarea",' .
                    'menubar: ""' .
                 '});' .
                 '</script>';
?>

<div class="container">
  <div class="row">
    <div class="col-md-12 col-formulario">
      <form enctype="multipart/form-data" action="blog.php" method="post">
        <div class="form-group">
          <input type="text" name="titulo" placeholder="Título" class="form-control"/>
        </div>
        <div class="form-group">
          <textarea name="contenido" class="form-control" placeholder="Contenido" rows="10"/></textarea>
        </div>
        <div class="form-group" id="subir-imagen-blog">
          <label>Imagen: </label>
          <input type="file" name="imagen"/>
        </div>
        <input type="submit" value="Enviar" class="btn btn-primary btn-block"/>
      </form>
    </div>
  </div>
</div>
