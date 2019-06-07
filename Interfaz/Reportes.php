<?php include "Templete/Header.php"; ?>
<?php 
$list= null;
$directorio = opendir("../Excel/");

while ($elemento = readdir($directorio)) {
    if ($elemento != "." && $elemento!="..") {
        // if (is_dir("../Interfaz/".$elemento)) {
        //     $list .= "<li><a href='../Excel/$elemento target='_blank'>$elemento</a></li>";
        // }
        // else{
        //     $list .= "<li><a href='../Excel/$elemento target='_blank'>$elemento</a></li>";
        // }
        $list=$elemento;
    }
}

echo $list;
?>

<?php include "Templete/Footer.php"; ?>
