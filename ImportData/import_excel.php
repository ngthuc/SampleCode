<?php
$db_host = "localhost"; // Giữ mặc định là localhost
$db_name	= 'import_exceldata';// Can thay doi
$db_username	= 'root'; //Can thay doi
$db_password	= 'usbw';//Can thay doi
@mysql_connect("{$db_host}", "{$db_username}", "{$db_password}") or die("Không thể kết nối database");
@mysql_select_db("{$db_name}") or die("Không thể chọn database");
?>
<html>
<head>
<style type="text/css">
body
{
margin: 0;
padding: 0;
background-color:#FFFFFF;
text-align:center;
}
.top-bar
{
width: 100%;
height: auto;
text-align: center;
background-color:#FFF;
border-bottom: 1px solid #000;
margin-bottom: 20px;
}
.inside-top-bar
{
margin-top: 5px;
margin-bottom: 5px;
}
.link
{
font-size: 18px;
text-decoration: none;
background-color: #000;
color: #FFF;
padding: 5px;
}
.link:hover
{
background-color: #FCF3F3;
}
</style>

</head>
<body>
<div class="top-bar">
<div class="inside-top-bar">Import Excelsheet Data in mysql table<br><br>
</div>
</div>
<div style="text-align:left; border:1px solid #333333; width:304px; margin:0 auto; padding:10px;">

<form name="import" method="post" enctype="multipart/form-data">
<input type="file" name="file" />
<input type="submit" name="submit" value="Submit" />
</form>
<?php
if(isset($_POST['submit']))
{
$file = $_FILES['file']['tmp_name'];
$handle = fopen($file, "r");
$c = 0;
while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
{
$name = $filesop[0];
$project = $filesop[1];

$sql = mysql_query("INSERT INTO mytask (name, project) VALUES ('$name','$project')");
$c = $c + 1;
}

if($sql){
echo 'You database has imported successfully. You have inserted '. $c .' recoreds';
}else{
echo 'Sorry! There is some problem.';
}

}
?>
</div>
</body>
</html>