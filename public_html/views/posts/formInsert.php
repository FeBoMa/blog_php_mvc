<form action="?controller=posts&action=formInsert" method="post" enctype="multipart/form-data">
    <table BORDER=5 BORDERCOLOR=RED>
        <tr>
            <td>Title</td>
            <td><input type='text' name='title'/></td>
        </tr>
        <tr>
            <td>Author</td>
            <td><input type='text' name='author'/></td>
        </tr>
        <tr>
            <td>Content</td>
            <td><textarea name="content" rows="5" cols="22"></textarea></td>
        </tr>
        <tr>
            <td>Photo</td>
            <td><input type="file" name="image" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>

    </table>
</form>