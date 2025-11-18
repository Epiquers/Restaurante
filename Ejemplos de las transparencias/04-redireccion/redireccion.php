<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $numero=6;
        //Si el número es 6 redirigimos a pagina1.php
        if ($numero==6) {
            header("Location:pagina1.php");
        }
        else{
            header("Location:error.php");
        }
    ?>

</body>
</html>