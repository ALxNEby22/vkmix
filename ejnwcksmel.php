<?php
include_once("config.php");
db_connect($dbhost, $dbuser, $dbpass, $dbname);
mysql_query("SET NAMES 'utf-8'");
$result = mysql_query("SELECT * FROM $dbtable");
$all = (mysql_num_rows($result))-100;
?>
 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>�������� �����������</title>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
</head>
<body>
 
<script type="text/javascript">
function ClearLog() {
document.getElementById('z_status').innerHTML = "<br /><br /><B>��� �������� �������� ������!</B>";
}
 
function SendMsg() {
var sOldText = document.getElementById('z_status').innerHTML;
var sSendText = document.getElementById('z_sendtext').value;
var sPosition = document.getElementById('z_position').value;
var sFinish = parseInt("<? echo $all;?>");
var sCurrent = parseInt(sPosition);
 
if (sSendText == '') {
 
document.getElementById('z_status').innerHTML = sOldText+ "<br /><br /><B>����������, ������� ����� �����������!</B>";
} else {
 
if(document.getElementById('s_box').checked) {
 
 
if (sFinish < sCurrent) {
document.getElementById('z_status').innerHTML = sOldText+ "<br /><br /><B>�������� ����������� ���������, ���� �������� �������� ID.</B>"+'<span id="s_finish"></span>';
document.getElementById('s_finish').scrollIntoView();
 
} else {
document.getElementById('z_status').innerHTML = sOldText+ "<br /><br />�������� ����������� �� ������� <b>" + sPosition + "</b> �� <b><? echo $all;?></b> ...";
$.post("/z_sender.php",{fromid: sPosition, fromtb: '<? echo $dbtable;?>', yourtext: sSendText},onAjaxSuccess);}
 
} else {
document.getElementById('z_status').innerHTML = sOldText+ "<br /><br /><B>�������� ����������� ��������������, ���� �� ��������!</B>"+'<span id="s_finish"></span>';
document.getElementById('s_finish').scrollIntoView();
}
}
}
 
function onAjaxSuccess(data)
{
var sOldText = document.getElementById('z_status').innerHTML;
var sPosition = parseInt(document.getElementById('z_position').value) + 100;
document.getElementById('z_position').value = sPosition;
document.getElementById('z_status').innerHTML = sOldText + "<br />" + data + '<span id="yak' + sPosition + '"></span>';
document.getElementById('yak'+sPosition).scrollIntoView();
 
SendMsg();
}
 
 
</script>
 
<h1>�������� �����������</h1>
������ �������� � ������� (�� 0 �� <?=$all?>):<br />
<input type="text" id="z_position" style="width:100px;" value="0">
<input type="checkbox" id="s_box" checked> ��������\��������� ��������
<br />
����� ����������� (�������� 1024 �������):<br />
<textarea id="z_sendtext" cols="50" rows="5"></textarea><br /><br />
<input type="button" value="���������" onClick="SendMsg()"> <input type="button" value="��������" onClick="ClearLog()"><br />
<div style="margin-top: 6px; border: 0px solid #E0E0E0; width: 800px; height: 250px; overflow: auto;">
<span id="z_status"></span>
</div>
</body>
</html>