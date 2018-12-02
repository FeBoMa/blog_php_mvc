<p><strong>Post #<?php echo $post->id; ?></strong></p>
<p><strong>Title: </strong><?php echo $post->title; ?></p>
<p><strong>Autor: </strong><?php echo $post->author; ?></p>
<p><strong>Category: </strong><?php echo $catName; ?></p>
<p><strong>Post: </strong><?php echo $post->content; ?></p>
<p><strong>Created: </strong><?php echo $post->created; ?></p>
<p><strong>Modified: </strong><?php echo $post->modified; ?></p>
<p><strong>Image: </strong><?php echo $post->image; ?></p>
<p><img src='uploads/<?php echo $post->image; ?>' style='width:300px;'/></p>