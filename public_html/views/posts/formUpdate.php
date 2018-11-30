<form action="?controller=posts&action=formUpdate" method="post" enctype="multipart/form-data">
    <table BORDER=5 BORDERCOLOR=RED>
        <tr>  
        <input type="hidden" name="id" value="<?php echo $post->id; ?>">
        <input type="hidden" name="imageDefault" value="<?php echo $post->image; ?>">
        <td>Title</td>
        <td><input type='text' name='title' value="<?php echo $post->title; ?>"/></td>
        </tr>
        <tr>
            <td>Author</td>
            <td><input type='text' name='author' value="<?php echo $post->author; ?>"/></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <!-- categories select drop-down will be here -->
                <?php
// put them in a select drop-down
                echo "<select class='form-control' name='category_id'>";

                echo "<option>Please select...</option>";
                while ($row_category = $catlist->fetch(PDO::FETCH_ASSOC)) {
                    $category_id = $row_category['id'];
                    $category_name = $row_category['name'];

                    // current category of the product must be selected
                    if ($post->category_id == $category_id) {
                        echo "<option value='$category_id' selected>";
                    } else {
                        echo "<option value='$category_id'>";
                    }

                    echo "$category_name</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td>Content</td>
            <td><textarea name="content" rows="5" cols="22"><?php echo $post->content; ?></textarea></td>
        </tr>
        <tr>
            <td >Photo</td>

            <td>
                <p><img src='uploads/<?php echo $post->image; ?>' style='width:300px;'/></p>
                <input type="file" name="image" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>

    </table>

</form>