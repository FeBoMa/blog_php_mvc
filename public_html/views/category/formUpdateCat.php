<form action="?controller=categories&action=formUpdateCat" method="post" enctype="multipart/form-data">
    <table BORDER=5 BORDERCOLOR=RED>
        <tr>  
            <input type="hidden" name="id" value="<?php echo $category->id; ?>">
            <td>Name</td>
            <td><input type='text' name='name' value="<?php echo $category->name; ?>"/></td>
        </tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
    </table>
</form>