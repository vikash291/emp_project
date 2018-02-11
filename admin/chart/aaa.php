<?php
if(isset($_POST['sub']))
{
$num1=$_POST['num1'];
$num2=$_POST['num2'];
if($_POST['sub']==" + "){
   $res=$num1+$num2;
}else if($_POST['sub']==" - "){
   $res=$num1-$num2;

}else if($_POST['sub']==" * "){
   $res=$num1*$num2;

}else{
   $res=$num1/$num2;

}
}
?>

<form method="post" action="">
no1:<input type="number" name="num1" value="<?php echo $num1; ?>"><br>
no2:<input type="text" name="num2" value="<?php echo $num2; ?>"><br>
res:<input type="text" name="res" value="<?php echo $res; ?>"><br>
<input type="submit" name="sub" value=" + ">
<input type="submit" name="sub" value=" - ">
<input type="submit" name="sub" value=" * ">
<input type="submit" name="sub" value=" / ">
</form>
