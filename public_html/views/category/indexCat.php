<p><strong>Listado de las categorias:</strong> <a href='?controller=categories&action=insertCat'>Insertar</a></p>
<?php foreach ($categories as $category) { ?>
    <p>
        <?php echo $category->name; ?>
        <a href='?controller=categories&action=showCat&id=<?php echo $category->id; ?>'>Ver
            contenido</a>
        <a href='?controller=categories&action=updateCat&id=<?php echo $category->id; ?>'>Update</a>
        <a href='?controller=categories&action=deleteCat&id=<?php echo $category->id; ?>'>Delete</a>
    </p>
<?php } ?>