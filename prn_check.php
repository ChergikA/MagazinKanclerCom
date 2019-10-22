<?php

require("header.inc.php");
include("milib.inc");

$iddoc = $_GET['iddoc'];

global $db;

$txt_sql = "SELECT `nomDoc`,`DataDoc`,`SumDoc`,`sum_v_kassu`, `SkidkaProcent`,
        `flg_optPrice`,`Pometka` FROM `DocHd` WHERE `id` = " . $iddoc ;
$s_arrHD = mysql_fetch_array(mysql_query($txt_sql, $db), MYSQL_BOTH);

?>


<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 11">
<!--<link rel=File-List href="Ценник.files/filelist.xml">
[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="Ценник_20362_Styles">
<!--table
	{mso-displayed-decimal-separator:"\,";
	mso-displayed-thousand-separator:" ";}
.xl1520362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2420362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2520362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2620362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2720362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:fill;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2820362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:"\@";
	text-align:general;
	vertical-align:121;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl2920362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3020362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3120362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:right;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3220362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:right;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3320362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3420362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:justify;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3520362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:"\@";
	text-align:justify;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl3620362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3720362
	{padding:0px;
	mso-ignore:padding;
	color:blue;
	font-size:8.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3820362
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Cyr";
	mso-generic-font-family:auto;
	mso-font-charset:204;
	mso-number-format:"\@";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
-->
</style>
</head>

    <body  onload="window.print(); window.close();"  >
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--Следующие сведения были подготовлены мастером публикации веб-страниц
Microsoft Office Excel.-->
<!--При повторной публикации этого документа из Excel все сведения между тегами
DIV будут заменены.-->
<!----------------------------->
<!--НАЧАЛО ФРАГМЕНТА ПУБЛИКАЦИИ МАСТЕРА ВЕБ-СТРАНИЦ EXCEL -->
<!----------------------------->

<div id="Ценник_20362" align=center x:publishsource="Excel">

<table x:str border=0 cellpadding=0 cellspacing=0 width=192 style='border-collapse:
 collapse;table-layout:fixed;width:144pt'>
 <col width=12 span=16 style='mso-width-source:userset;mso-width-alt:438;
 width:9pt'>
 <tr height=13 style='mso-height-source:userset;height:9.75pt'>
  <td colspan=14 height=13 class=xl3720362 width=168 style='height:9.75pt;
  width:126pt'><a href="http://www.ozone.ua/" target="_parent"><span
  style='font-size:8.0pt;font-weight:700;font-style:italic'>www.ozone.ua</span></a></td>
  <td class=xl1520362 width=12 style='width:9pt'></td>
  <td class=xl1520362 width=12 style='width:9pt'></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl1520362 style='height:12.75pt'></td>
  <td class=xl1520362></td>
  <td align=left valign=top><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
   coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
   filled="f" stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas>
    <v:f eqn="if lineDrawn pixelLineWidth 0"/>
    <v:f eqn="sum @0 1 0"/>
    <v:f eqn="sum 0 0 @1"/>
    <v:f eqn="prod @2 1 2"/>
    <v:f eqn="prod @3 21600 pixelWidth"/>
    <v:f eqn="prod @3 21600 pixelHeight"/>
    <v:f eqn="sum @0 0 1"/>
    <v:f eqn="prod @6 1 2"/>
    <v:f eqn="prod @7 21600 pixelWidth"/>
    <v:f eqn="sum @8 21600 0"/>
    <v:f eqn="prod @7 21600 pixelHeight"/>
    <v:f eqn="sum @10 21600 0"/>
   </v:formulas>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:shapetype><v:shape id="_x0000_s1025" type="#_x0000_t75" style='position:absolute;
   margin-left:0;margin-top:0;width:89.25pt;height:39pt;z-index:1'>
   <v:imagedata src="Ценник.files/Ценник_20362_image001.jpg" o:title="ozone_cn"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:0px;margin-top:0px;width:119px;
  height:52px'><img width=119 height=52
  src="images/image002.jpg" v:shapes="_x0000_s1025"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=17 class=xl1520362 width=12 style='height:12.75pt;width:9pt'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl1520362 style='height:12.75pt'></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl1520362 style='height:12.75pt'></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl2620362 colspan=9 style='height:12.75pt'>ЧП Дьякова
  Т.В.</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=13 style='mso-height-source:userset;height:9.95pt'>
  <td height=13 class=xl2520362 colspan=9 style='height:9.95pt'>г.Днепропетровск</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=13 style='mso-height-source:userset;height:9.95pt'>
  <td height=13 class=xl2520362 colspan=8 style='height:9.95pt'>пр. Героев, 18а</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=13 style='mso-height-source:userset;height:9.95pt'>
  <td height=13 class=xl2520362 colspan=13 style='height:9.95pt'>тел./ф. +38
  (056) 371-26-20</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=13 style='mso-height-source:userset;height:9.95pt'>
  <td height=13 class=xl2520362 colspan=13 style='height:9.95pt'>&nbsp;</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>




 <tr height=17 style='height:12.75pt'>
  <td colspan=14 height=17 class=xl3620362 style='height:12.75pt'>
      <?php echo 'Чек №_' .  $s_arrHD['nomDoc'] .' '. datesql_to_str( $s_arrHD['DataDoc']) . ' ' . date('H:i') ?>
  </td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>

<!--//

 <tr height=60 style='mso-height-source:userset;height:12.75pt'>
  <td colspan=2 height=60 class=xl3420362 style='height:12.75pt'>1.</td>
  <td colspan=12 class=xl3520362 width=144 style='width:108pt'>
      20138 AMMAN-20 чулки с вол.20138 AMMAN-20 чулки с вол.20138 AMMAN-20 чулки с вол.
  </td>
  <td class=xl2820362 width=12 style='width:9pt'></td>
  <td class=xl2820362 width=12 style='width:9pt'></td>
 </tr>
 <tr height=15 style='mso-height-source:userset;height:11.25pt'>
  <td height=15 class=xl1520362 style='height:11.25pt'></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td colspan=3 class=xl3220362>23.40</td>
  <td class=xl2920362>*</td>
  <td colspan=2 class=xl3320362 x:num>15</td>
  <td class=xl2920362>*</td>
  <td colspan=4 class=xl3220362>1275.00</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
//-->

<?php
 // выводим данные продаж в таблицу


$txt_sql = "SELECT `DocTab`.`id` as idstr , `DocTab`.`nomstr`, `Tovar`.`Kod`,  `Tovar`.`Kod1C`, `Tovar`.`Tovar`, `DocTab`.`Cena`,"
    ." `DocTab`.`Kvo`, `DocTab`.`Skidka`\n"
    . "FROM `DocTab`\n"
    . " LEFT JOIN `Tovar` ON `DocTab`.`Tovar_id` = `Tovar`.`id_tovar` \n"
    . "WHERE (`DocTab`.`DocHd_id` =".$iddoc." AND `DocTab`.`Kvo` > 0 )\n"
    . "ORDER BY `DocTab`.`id` ASC ";



$sql = mysql_query($txt_sql, $db);
$sum_itog=0;  $sum_sum=0; $skidka=0;
while ($srt_arr = mysql_fetch_array($sql, MYSQL_BOTH) ) {

  $sum = sprintf("%.2f", $srt_arr['Kvo'] *  $srt_arr['Cena']);
  $it  = sprintf("%.2f", $srt_arr['Kvo'] *  $srt_arr['Cena']  * (1 - $srt_arr['Skidka']/100  ) );
  $sum_itog = $sum_itog +   $srt_arr['Kvo'] *  $srt_arr['Cena']  * (1 - $srt_arr['Skidka']/100  );
  $sum_sum = $sum_sum + $sum;
  $skidka = round( skidkadoc($iddoc) ,2) ; //$srt_arr['Skidka'];
  $cena = sprintf('%.2f', $srt_arr['Cena']);

  $s = '&#9675;';

  $art_tv = $srt_arr['Kod1C'];
  $pos = strpos($art_tv, $s);
  $art_tv = substr($art_tv, 0, $pos);

  $nm_tv = $art_tv ." ". $srt_arr['Tovar'];

  echo "
  <tr height=60 style='mso-height-source:userset;height:12.75pt'>
  <td colspan=2 height=60 class=xl3420362 style='height:12.75pt'>" . $srt_arr['nomstr'].".</td>
  <td colspan=12 class=xl3520362 width=144 style='width:108pt'>" .$nm_tv ."</td>
  <td class=xl2820362 width=12 style='width:9pt'></td>
  <td class=xl2820362 width=12 style='width:9pt'></td>
 </tr>
 <tr height=15 style='mso-height-source:userset;height:11.25pt'>
  <td height=15 class=xl1520362 style='height:11.25pt'></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td colspan=4 class=xl3220362>$cena</td>
  <td class=xl2920362>*</td>
  <td colspan=2 class=xl3320362 x:num>" .$srt_arr['Kvo']."</td>
  <td class=xl2920362>*</td>
  <td colspan=4 class=xl3220362>$sum</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>    ";

}

    $sum_itog  = sprintf("%.2f",$sum_itog);
    $sum_sum = sprintf("%.2f",$sum_sum);

?>



 <tr height=17 style='height:12.75pt'>
  <td colspan=9 height=17 class=xl3120362 style='height:12.75pt'>всего на
  сумму:</td>
  <td colspan=5 class=xl3120362><?php 	 echo $sum_itog; ?> </td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>

    <?php
        if( $s_arrHD['sum_v_kassu'] > 0 ){

            $vkassu = sprintf("%.2f", $s_arrHD['sum_v_kassu']);
            $sdacha = sprintf("%.2f", $vkassu - $sum_itog );

        echo "
        <tr height=17 style='height:12.75pt'>
         <td colspan=9 height=17 class=xl3120362 style='height:12.75pt'>в кассу:</td>
         <td colspan=5 class=xl3120362>$vkassu</td>
         <td class=xl1520362></td>
         <td class=xl1520362></td>
        </tr>
        <tr height=17 style='height:12.75pt'>
         <td colspan=9 height=17 class=xl3120362 style='height:12.75pt'>сдача:</td>
         <td colspan=5 class=xl3120362>$sdacha</td>
         <td class=xl1520362></td>
         <td class=xl1520362></td>
        </tr>
       ";

        }
    ?>




 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl1520362 style='height:12.75pt'></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td colspan=14 height=17 class=xl3020362 style='height:12.75pt'>Благодарим за
  покупку</td>
  <td class=xl1520362></td>
  <td class=xl1520362></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
  <td width=12 style='width:9pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--КОНЕЦ ФРАГМЕНТА ПУБЛИКАЦИИ МАСТЕРА ВЕБ-СТРАНИЦ EXCEL-->
<!----------------------------->
</body>

</html>
