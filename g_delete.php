<?
include_once("./global.php");

$table = $_GET['t'];
$row = $_GET['r'];
$id = $_GET['i'];
$id_value = $_GET['iv'];
$callback = $_GET['c'];

$sql="delete from $table where $id='$id_value' ";
//echo $sql;
    if(!mysqli_query($con,$sql))
    {
        echo "err";
        echo mysqli_error($con);
    }else{
    ?>
    <script type="text/javascript">
        window.location = "<?echo $callback;?>";
    </script>
    <?
}

    

?>