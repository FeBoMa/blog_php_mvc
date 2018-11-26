<DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <header>
                <a href='/blog_php_mvc/public_html'>Home</a>
                <a href='?controller=posts&action=index'>Posts</a>
                <a href='?controller=posts&action=insert'>Insertar</a>
            </header>

            <?php require_once('routes.php'); ?>

            <footer>
                Copyright
            </footer>
        </body>
    </html>