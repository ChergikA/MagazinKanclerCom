<?php
require("header.inc.php");
include("milib.inc");
global $db;

$id_doc = -1;

$my_const = new cls_my_const();
$kvo_def = $my_const->kvo_def;

$h_kod =''; $info_tovar=""; $kvo   = $kvo_def ;
if (isset($_GET['id_doc']) ) { // 
    $id_doc = $_GET['id_doc'];
    if (write_doc($id_doc)) {
        $info_tovar = "<a style=' color: #1864fc; text-decoration: underline; font-size: 11px; ' 
                        href='javascript: podbor_tovar();'> ��������� �� �����-����� </a>";
    }
}

// ���� ������ ����� ���
if (isset($_GET['h_kod']) ) {

    $h_kod = $_GET['h_kod'];
    $kvo   = $_GET['kvo'];
    $txt_sql = "SELECT `Tovar`, `Price`,`Ostatok` FROM `Tovar` WHERE `Kod` = '" . $h_kod . "' ";
    if ($kvo == '' or $kvo == '0') {                    //����� ��� ��� ����������
        //���������� ���� � ������

        $sql     = mysql_query($txt_sql, $db);
        $s_arr   = mysql_fetch_array($sql, MYSQL_BOTH);
        if ($s_arr['Tovar'] == NULL) {
            $info_tovar = "��� ������ � �����:" . $h_kod;
            $h_kod      = '';
        }else $info_tovar = $s_arr['Tovar'] . "  ����:" . $s_arr['Price'] . "  ���.:" . $s_arr['Ostatok'];


    }else {                                             // ������� � ���������� ������� ������ � ��
        //������� ���� ������

        $sql     = mysql_query($txt_sql, $db);
        $s_arr   = mysql_fetch_array($sql, MYSQL_BOTH);
        if ($s_arr['Price'] == NULL) {
            $info_tovar = "��� ������ � �����:" . $h_kod;
            $h_kod      = '';
        }else {
            $id_doc = $_GET['id_doc'];
            $h_kod  = $_GET['h_kod'];
            $kvo    = $_GET['kvo'];

            $err = upd_tabdoc($id_doc , $h_kod , $s_arr['Price'] , $kvo , 0 , 0, 0 );
            if($err != '') $info_tovar = $err;
            //������� ���� ����� ����� �� ����� ����
            $h_kod ='';  $kvo   = $kvo_def ;
        }

    }
}



//"doc_chek.php?id_doc=" + iddoc + "&idstr=" + idstr + "&skidka=" + newskidka ;
//����������� ������������� ���� ����� ������ � ����������� ���
if (isset($_GET['newcena'])) {

    $newsk  = $_GET['newcena'];
    $id_str = $_GET['idstr'];
    $id_doc = $_GET['id_doc'];
    //$txt_sql =  "UPDATE `DocHd` SET `SkidkaProcent` = '". $newsk ."' WHERE `DocHd`.`id` = '" . $id_doc . "'; \n";
    //$sql     = mysql_query($txt_sql, $db);
    if (write_doc($id_doc)) {
        $txt_sql = " UPDATE `DocTab` SET `Cena` = '" . $newsk . "' WHERE `id` = '" . $id_str . "' ;";
        $sql     = mysql_query($txt_sql, $db);
        savesumdoc($id_doc);


    }
}

//����������� ���������� ��������� ��� ����� ��� ������ ��� ��� ���������
if (isset($_GET['pometka'])) {

    $id_str = '';
    if (isset($_GET['idstr'])) $id_str = $_GET['idstr'];

    $pometka = $_GET['pometka'];
    $id_doc = $_GET['id_doc'];



    if(trim($id_str) == ''){
        $txt_sql = "UPDATE `DocHd` SET `Pometka` = '" . $pometka . "' WHERE `DocHd`.`id` = '" . $id_doc . "'; \n";
    }
        else {
        $txt_sql = " UPDATE `DocTab` SET `pometka` = '" . $pometka . "' WHERE `id` = '" . $id_str . "' ;";
    }


    $sql     = mysql_query($txt_sql, $db);

}

//document.location = "doc_chek.php?id_doc=" + iddoc + "&delstr=" + idstr  ;
// �������� ������� ���������
if (isset($_GET['delstr'])) {
    $id_str = $_GET['delstr'];
    $id_doc = $_GET['id_doc'];

    delstrdoc( $id_doc , $id_str ) ;
}

//document.location = "doc_chek.php?id_doc=" + iddoc + "&prodano=no";
// ��������� ������ � ����������, ���� �������, ���� ������
$closedoc = '';
if (isset($_GET['prodano'])) {
    $prodano = $_GET['prodano'];
    $id_doc  = $_GET['id_doc'];

    if (write_doc($id_doc)) {

        if ($prodano == 'ok') {
            $idstatus = id_status('������');
        }
        else {
            $idstatus = id_status('������');
        }

        $txt_sql  = "UPDATE `DocHd` SET `statusDoc` = '" . $idstatus . "' WHERE `DocHd`.`id` = '" . $id_doc . "'; \n";
        $sql      = mysql_query($txt_sql, $db);
        savesumdoc($id_doc);
    }
    $closedoc = 'close';
}

// ���� ��������� ����� �������, ��� �� ����� �������� ���������
if (isset($_GET['id_doc'])) {
    $id_doc = $_GET['id_doc'];
    // ������� ������ ��� �����
    $txt_sql = "SELECT `firms`.`name_firm`, `Klient`.`name_klient`,`DocHd`.`id`,`DocHd`.`nomDoc`,"
    .         " `DocHd`.`DataDoc`, `DocHd`.`SumDoc`, `StatusDoc`.`nameStatus`,"
    .         "`DocHd`.`SkidkaProcent`, `DocHd`.`Pometka`, `VidDoc`.`name_doc`, `users`.`full_name`\n"
    . "FROM `firms`\n"
    . " LEFT JOIN `DocHd`     ON `firms`.`id` = `DocHd`.`firms_id` \n"
    . " LEFT JOIN `Klient`    ON `DocHd`.`Klient_id` = `Klient`.`id_` \n"
    . " LEFT JOIN `VidDoc`    ON `DocHd`.`VidDoc_id` = `VidDoc`.`Id` \n"
    . " LEFT JOIN `StatusDoc` ON `DocHd`.`statusDoc` = `StatusDoc`.`idStatus` \n"
    . " LEFT JOIN `users`     ON `DocHd`.`users_id` = `users`.`id` \n"
    . "WHERE (`DocHd`.`id` = " . $id_doc . " ) ";

//echo ' = ' . $txt_sql;

    $sql     = mysql_query($txt_sql, $db);
    $s_arr   = mysql_fetch_array($sql, MYSQL_BOTH);
    $nm_firm = $s_arr['name_firm'];
    $nm_klient = $s_arr['name_klient'];
    //$skidka_doc =  $s_arr['SkidkaProcent'];
    $nm_doc =  $s_arr['name_doc'] . ' �_' . $s_arr['nomDoc'] . ' ��:' . datesql_to_str( $s_arr['DataDoc']) ; //�������� ��� �_32 �� 28.11.2012
    $avtor  =  "�����: " . $s_arr['full_name'];
    $pometka = addslashes( $s_arr['Pometka']) ; // ���������� �������

    if( ! write_doc($id_doc)) $nm_doc = $nm_doc . ' (��������)';




}

//***********************************  baba-jaga@i.ua  ********************************************************
//������� ������ ���������
function str_view(){
    global $id_doc;
    global $db;
    if($id_doc==-1) return FALSE;

    $txt_sql = "SELECT `DocTab`.`id` as idstr , `DocTab`.`nomstr`, `Tovar`.`Kod`, `Tovar`.`Tovar`, `DocTab`.`Cena`,"
                    ." `DocTab`.`Cena2`, `DocTab`.`Kvo2`, `DocTab`.`pometka`, "
                    ." `DocTab`.`Kvo`, `DocTab`.`Skidka`\n"
    . "FROM `DocTab`\n"
    . " LEFT JOIN `Tovar` ON `DocTab`.`Tovar_id` = `Tovar`.`id_tovar` \n"
    . "WHERE (`DocTab`.`DocHd_id` =".$id_doc.")\n"
    . "ORDER BY `DocTab`.`timeShtamp` DESC ";

     //   color: #F93D00 ; /* �������  */
     //   color: #00f  /* �����  */
                               // <tr>
                               //     <td>�/�</td>
                               //     <th class="Odd"> ���</th>
                               //     <th>             ������������</th>
                               //     <th  class="Odd"> �-�� <br> ������� </th>
                               //     <th >����</th>
                               //     <th  class="Odd">�����</th>
                               //     <th>�������</th>
                               //     <th>&nbsp;</th>

                                //</tr>

    $sql     = mysql_query($txt_sql, $db);
    while ($s_arr = mysql_fetch_array($sql, MYSQL_BOTH) ) {


        $sumvzv = sprintf("%.2f", $s_arr['Cena'] *  $s_arr['Kvo']  ) ;

        echo '<tr>';
        echo '<td>'. $s_arr['nomstr'] .'</td>';
        echo '<th class="Odd">'. $s_arr['Kod'] .'</th>';
        echo '<th>'. $s_arr['Tovar'] .'</th>';
        echo '<td class="Odd">'. $s_arr['Kvo'] .'</td>';           // �������
        echo '<td >'. sprintf("%.2f", $s_arr['Cena']) .'</td>';
        echo '<td class="Odd" >'. $sumvzv .'</td>';

        $pometka = '___';
        if(  trim($s_arr['pometka']) != '') $pometka = $s_arr['pometka'];

        echo '<td >            <a href="#"           onclick="javascript:show_editpometka(event,'. $s_arr['idstr'] .',' . "'" . $s_arr['pometka'] . "'" . ' )" > '. $pometka .' </a>   </td>';

        echo '<th><a href="#"  onclick="javascript:delstr('. $s_arr['idstr'] .' )" > <img src="images/b_drop.png" border=0> </a> </th>';
        echo '</tr>';


    }

}



?>
<!--

-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
        <title> <?php echo  $nm_doc ; ?> </title>
        <link href="vivat.css" rel="stylesheet" type="text/css" media="screen" />

        <script type="text/javascript">



            //**********************baba-jaga@i.ua**********************
            // submit
            function go_searh(){
                return true ;
            }

            //**********************baba-jaga@i.ua**********************
            //����� ����� ���� � ����
            function re_h_kod(){
                var iddoc = <?php echo $id_doc; ?> ;
                var h_kod = document.frm_searh.h_kod.value;
                var kvo   = document.frm_searh.kvo.value;
                document.location = "doc_vzv_sklad.php?id_doc=" + iddoc + "&h_kod=" + h_kod + "&kvo=" + kvo  ;
            }

            //**********************baba-jaga@i.ua**********************
            //������ ������ ������ �� ����� ����� ����
            function otmena_h_kod(){
                var iddoc = <?php echo $id_doc; ?> ;
                document.location = "doc_vzv_sklad.php?id_doc=" + iddoc ;
            }

            //**********************baba-jaga@i.ua**********************
            //��������� ����������� ������ ��� �������������� ������������� ����
            function show_bar(event, idstr, oldskidka) {

                var MouseX = event.clientX + document.body.scrollLeft;
                var MouseY = event.clientY + document.body.scrollTop;
                var obj = document.getElementById("win");

                obj.style.top = MouseY - 40 + 'px' ;
                obj.style.left = MouseX -160 + 'px' ;
                obj.style.visibility = "visible";
                document.getElementById('_edit').value  = oldskidka;
                document.getElementById('_idstr').value  = idstr;

                document.getElementById('_edit').focus();


            }

            //**********************baba-jaga@i.ua**********************
            //������ ��������� ���� �������������� ������ ���� ��� �������
            function hide_bar() {
                document.getElementById('h_kod').focus();
                document.getElementById("win").style.visibility="hidden";
                document.getElementById("winpometka").style.visibility="hidden";
            }

            //*********************baba-jaga@i.ua**********************
            // ���� �������������� ����������
            function show_editpometka(event, idstr ,txtpometka){
                var MouseX = event.clientX + document.body.scrollLeft;
                var MouseY = event.clientY + document.body.scrollTop;
                var obj = document.getElementById("winpometka");

                var pox = -620;
                if(idstr == '' ) pox=20;

                obj.style.width =  '600px' ;
                obj.style.top = MouseY -60 + 'px' ;
                obj.style.left = MouseX + pox + 'px' ;
                obj.style.visibility = "visible";

                document.getElementById('_idstrp').value  = idstr;

                document.getElementById('_editpometka').style.width =  '500px' ;
                document.getElementById('_editpometka').value  = txtpometka ;
                document.getElementById('_editpometka').focus();
            }

            //**********************baba-jaga@i.ua**********************
            //����� ������������� ���� � ������
            function re_skidka_str(){
                ///alert('reskidka_str');
                var iddoc = <?php echo $id_doc; ?> ;
                document.getElementById('h_kod').focus();
                document.getElementById("win").style.visibility="hidden"

                var newskidka = document.getElementById('_edit').value ;
                var idstr     = document.getElementById('_idstr').value;
                //alert('=' + document.frm_searh.skidka_doc.value + ' iddoc= ' + iddoc  );

                document.location = "doc_vzv_sklad.php?id_doc=" + iddoc + "&idstr=" + idstr + "&newcena=" + newskidka ;
            }

            //*********************baba-jaga@i.ua**********************
            //���������� ������� � ��������� ����
            function re_pometka(){
                var iddoc = <?php echo $id_doc; ?> ;
                var newpometka = document.getElementById('_editpometka').value ;
                var idstr     = document.getElementById('_idstrp').value;
                //document.getElementById('h_kod').focus();
                //document.getElementById("winpometka").style.visibility="hidden"

                //alert('=' + document.frm_searh.skidka_doc.value + ' iddoc= ' + iddoc  );
                if(idstr == '') {
                   document.location = "doc_vzv_sklad.php?id_doc=" + iddoc + "&pometka=" + newpometka ;
                }else{
                   document.location = "doc_vzv_sklad.php?id_doc=" + iddoc + "&idstr=" + idstr + "&pometka=" + newpometka  ;
                }

            }

            //**********************baba-jaga@i.ua**********************
            //������ �������� ������
            function delstr(idstr ){
                var iddoc = <?php echo $id_doc; ?> ;
                document.location = "doc_vzv_sklad.php?id_doc=" + iddoc + "&delstr=" + idstr  ;
            }


            //**********************baba-jaga@i.ua**********************
            //������� ����� ��������� ��� � �������� �������
            function prodano(){
                var iddoc = <?php echo $id_doc; ?> ;
                document.location = "doc_vzv_sklad.php?id_doc=" + iddoc + "&prodano=ok";

            }

            //**********************baba-jaga@i.ua**********************
            // ������ ������� ��������� ��� � �������� ������
            function ne_prodano(){
                var iddoc = <?php echo $id_doc; ?> ;
                document.location = "doc_vzv_sklad.php?id_doc=" + iddoc + "&prodano=no";

            }

            //**********************baba-jaga@i.ua**********************
            function on_load(){

                var h_kod =   <?php echo '"' . $h_kod . '"'; ?>;

                var closedoc =   <?php echo '"' . $closedoc . '"'; ?>;
                //alert('=='+closedoc);
                if(closedoc != '') window.close();

                document.frm_searh.h_kod.value =  h_kod  ;
                document.frm_searh.kvo.value  = <?php echo '"' . $kvo . '"'; ?>;

                if( h_kod == '' ) document.getElementById('h_kod').focus();
                else {
                    document.getElementById('kvo').focus() ;
                    document.getElementById('kvo').select() ;
                }

                plays();
               // hide_bar(); // �� ���������� ���� ����

            }
            
                        //**********************baba-jaga@i.ua**********************
            // ��������� ����� ������� �� �����-�����
            function podbor_tovar(){
                //alert('=' +iddoc + "  vid = " + viddoc );
                var iddoc = <?php echo $id_doc; ?> ;
                window.open("podbor_tovar.php?id_doc=" + iddoc );
                window.close();

            }

            //**********************baba-jaga@i.ua**********************
            // ������ ������ �������
            function closeWin(){
               window.close();
            }

            //**********************baba-jaga@i.ua**********************
            // �� ���� ��������� ��� �������
            function plays() {
              var snd = new Audio("images/ok.wav");

               snd.preload = "auto";

                 snd.load();
                 snd.play();

            }


        </script>
    </head>
    <body onload="javascript:on_load()" >

        <!-- ������� ������� �������� -->
        <table cellspacing='3' border='0' style=" width: 100%;  margin: 10px " >
            <col >
            <col width="800px">
            <col >
            <tr>
                <td style="background: #ffeded;" >&nbsp;</td> <!-- ����� ������� �������� ������� -->
                <td> <!-- ������� ������� �������� ������� -->


                    <form name ="frm_searh"  id="frm_searh" onsubmit="return go_searh()" >
                            <!-- ������� �������������� ������ ����� ����� -->
                            <table cellspacing='0' border='0' style=" width: 100%;  " >
                                <col width="170px">
                                <col width="200px">
                                <col width="190px">
                                <col width="100px">
                                <col width="80px">
                                <col >
                                <tr> <!-- ������ ������ ����� -->
                                    <td> <h3 style="font-size: 1.3em; text-align: left " > <?php echo  $nm_firm ; ?>  </h3> </td>
                                    <td colspan="2" > <h3 style="font-size: 1.3em; text-align: center" > <?php echo  $nm_doc ; ?>   </h3> </td>
                                    <td colspan="3" > <h3 style="font-size: 1.1em; text-align: right " > <?php echo  $avtor ; ?>   </h3> </td>
                                </tr>
                                <tr> <!-- ������ ������ ����� -->
                                    <td colspan="2" > <h4> <?php echo  $nm_klient ; ?>  </h4> </td>
                                    <td> &nbsp;</td>

                                    <td> <h4> &nbsp;</h4> </td>
                                    <td>  &nbsp; </td>
                                    <td> <a href="#" onclick="javascript:prodano()" > <img src="images/btnDA.jpg" border=0> </a> </td>
                                </tr>
                                <tr> <!-- ������ ������ ����� ���� � ������ -->
                                    <td colspan="3" >
                                        <h3 style="font-size: 1.2em; font-style: italic; font-weight: normal; " >
                                             <?php echo  $info_tovar ; ?>
                                        </h3>
                                    </td>
                                    <td> <h4>&nbsp;</h4> </td>
                                    <td> &nbsp;</td>
                                    <td><a href="#" onclick="javascript:closeWin()" > <img src="images/btnClose.jpg" border=0> </a> </td>
                                </tr >
                                <tr  > <!-- ��������� ������ ����� -->
                                    <td colspan="3" >

                                        ��� ������: &nbsp; <input type="text" name="h_kod" id="h_kod" size="7" maxlength="13"
                                                                  tabindex="0" onchange="javascript:re_h_kod()" >
                                        &nbsp; &nbsp; &nbsp; �-��:
                                        <input type="text" name="kvo" id ="kvo"  size="4" maxlength="13"
                                               tabindex="1" onchange="javascript:re_h_kod()" >
                                        <input type="button" name="button_ok" id="button_ok"  onclick="javascript:re_h_kod()" value="  Ok  "    >
                                        <input type="button" name="button_re" id="button_re"  onclick="javascript:otmena_h_kod()" value="  ������  "    >

                                    </td>
                                    <td> <h4>�����: </h4> </td>
                                    <td> <input type="text" readonly="true" name="sum_vsego" id ="sum_vsego" size="5" value= <?php echo '"' . sumdoc($id_doc) . '"' ; ?>  > </td>
                                    <td> <a href="#" onclick="javascript:ne_prodano()" > <img src="images/btnDel.jpg" border=0> </a>  </td>

                                </tr>
                            </table>


                   </form>



                    <div style=" padding: 10px 0px 0px 0px " >
                        <!-- ��������� ����� ��������� -->
                        <table cellspacing='0' border='0' class="Design5" >
                            <col width="35px">
                            <col width="70px">
                            <col width="310px">  <!-- ������������ -->
                            <col width="60px">
                            <col width="60px"> <!-- ���� -->
                            <col width="60px">
                            <col width="170px"><!-- pometka -->


                            <thead>
                                <tr>
                                    <td>�/�</td>
                                    <th class="Odd"> ���</th>
                                    <th>             ������������</th>
                                    <th  class="Odd"> �-�� <br> ������� </th>
                                    <th >����</th>
                                    <th  class="Odd">�����</th>
                                    <th>�������</th>
                                    <th>&nbsp;</th>

                                </tr>
                            </thead>

                            <?php  str_view() ; ?>


                        </table>
                    </div>

                    <div>
                        <br>
                        <a href="#" onclick="javascript:show_editpometka(event, '' ,<?php echo "'" . $pometka . "'" ; ?> )" > ����������:</a>  <?php echo $pometka ; ?>

                    </div>

                </td> <!-- ����� ������� ������� �������� ������� -->
                <td style="background: #ffeded;" >&nbsp;</td> <!-- ������ ������� �������� ������� -->
            </tr></table> <!--����� ������� ������� �������� -->

            <!-- ����������� ���� ��� �������������� ������ � ������� -->
            <div id=win class=bar>
                <div align=right>
                <span style='cursor: pointer' title='�������' onclick='hide_bar()'>x</span>
                </div>
                ����: <input type="text" name="_edit" id ="_edit" size="5" onchange="javascript:re_skidka_str()" >
                <input type="hidden" id ="_idstr">
            </div>

            <!-- ����������� ���� ��� �������������� ���������� -->
            <div id=winpometka class=bar>
                <div align=right>
                <span style='cursor: pointer' title='�������' onclick='hide_bar()'>x</span>
                </div>
                ����������: <input type="text" name="_editpometka" id ="_editpometka"  onchange="javascript:re_pometka()" >
                <input type="hidden" id ="_idstrp">
            </div>


    </body>
</html>
