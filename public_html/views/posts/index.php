<p><strong>Listado de los posts:</strong><a href='?controller=posts&action=insert'>Insertar</a></p>
<?php foreach ($posts as $post) { ?>
    <p>
        <?php echo $post->author; ?>
        <a href='?controller=posts&action=show&id=<?php echo $post->id; ?>'>Ver
            contenido</a>
        <a href='?controller=posts&action=update&id=<?php echo $post->id; ?>'>Update</a>
        <a href='?controller=posts&action=delete&id=<?php echo $post->id; ?>'>Delete</a>
    </p>
<?php } ?>