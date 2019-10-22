<?php
# encoding: WINDOWS-1251 (# coding: WINDOWS-1251)
//include("magazin.inc");

Class prn{
    var $myStr;
    var $pometka_doc;
    var $sum_v_kassu;
    var $sum_doc;
    var $sum_doc_rozn;
    var $flg_opt;
    var $skidka_prc;

    function prn_cennik($kod_tov) {
           // $tovar = new Tovar;
           // $strTov = $tovar->find_line($kod_tov) ;
           // $srt_arr = explode("~~",$strTov);

           global $db;

            $txt_sql = "SELECT `Tovar`,`Price`, `Sostav` FROM `Tovar` WHERE `Kod` = '" . $kod_tov . "' ";
            $sql     = mysql_query($txt_sql, $db);
            $srt_arr   = mysql_fetch_array($sql, MYSQL_BOTH);

           $str = $this->f_bold(
                   $this->r_simvol(
                   $this->a_centr( "ФОП Керимова О.В.\n") , 3)) ;

            $t = $this->encode(trim( $srt_arr['Tovar']));
            $str .= $this->perenos( $t ) . "\n" ;

            $str .= $this->a_centr(
                    $this->f_bold(
                     "Цiна: " . trim( $srt_arr['Price'] ) . "\n" )) ;

            $str2 = $this->f_mini(
              "Дата виробництва: " . date('Y') . "\n" );

            if(trim( $srt_arr['Sostav'])  !== '' ){
                $t = $this->encode(trim( $srt_arr['Sostav']));
                $str2 .=  $this->r_stroka(
                          $this->f_mini(
                          "Склад: " .  $t . "\n" ), 5) ;
                }
           $str .= $this->r_stroka( $str2, 5);


            $str .=  $this->a_centr(
                $this->prn_barcode($kod_tov) ) . "\n"   ;


            $this->prn_str($str);

    }


    //печатаем штрихкод
    function prn_barcode($num) {
        $str = chr(0x1D) . 'h' . chr(50); // высота
        $str = $str . chr(0x1D) . 'w' . chr(2); // длинна
        $str = $str . chr(0x1D) . 'H' . chr(2)
              . chr(0x1D) . 'k' .
                 chr(4) . $num . chr(0) ;

         //$this->prn_str($str);

         return $str;
    }


    //печатаем шапку документа
    function prn_hapka_doc( $id_doc ){
        global $db;
        $txt_sql = "SELECT `firms`.`name_firm`,`firms`.`okpo`,`firms`.`nom_svid`, `firms`.`adres`,  `firms`.`tel_firm`,"
    .         "`Klient`.`name_klient`, `Klient`.`diskont`,`DocHd`.`id`,`DocHd`.`nomDoc`,`DocHd`.`flg_optPrice`,"
    .         " `DocHd`.`DataDoc`,`DocHd`.`sum_v_kassu`, `DocHd`.`SumDoc`, `StatusDoc`.`nameStatus`,"
    .         "`DocHd`.`SkidkaProcent`,`DocHd`.`Pometka` ,`DocHd`.`oplataBank`, `VidDoc`.`name_doc`, `users`.`full_name`\n"
    . "FROM `firms`\n"
    . " LEFT JOIN `DocHd`     ON `firms`.`id` = `DocHd`.`firms_id` \n"
    . " LEFT JOIN `Klient`    ON `DocHd`.`Klient_id` = `Klient`.`id_` \n"
    . " LEFT JOIN `VidDoc`    ON `DocHd`.`VidDoc_id` = `VidDoc`.`Id` \n"
    . " LEFT JOIN `StatusDoc` ON `DocHd`.`statusDoc` = `StatusDoc`.`idStatus` \n"
    . " LEFT JOIN `users`     ON `DocHd`.`users_id` = `users`.`id` \n"
    . "WHERE (`DocHd`.`id` = " . $id_doc . " ) ";

  //  $ok=  $prn->prn_hapka_doc("ТОВАРНИЙ ЧЕК", "N_".$s_arr['nomDoc'] ,
  //      datesql_to_str($s_arr['DataDoc']) . date( ' H:i:s' ) , $s_arr['name_klient'], $s_arr['name_firm'] , $oplata  )


//echo ' = ' . $txt_sql; 

    $sql     = mysql_query($txt_sql, $db);
    $s_arr   = mysql_fetch_array($sql, MYSQL_BOTH);

      $oplata = '';
    if($s_arr['oplataBank'] == 1 ) $oplata = 'безналичный расчет';

    $nm_doc = strtoupper( $s_arr['name_doc']) ;
    $nom_chek = " N_" . $s_arr['nomDoc'];
    $date_chek = datesql_to_str( $s_arr['DataDoc']) . date( ' H:i:s' )  ;
    $nom_diskont=$s_arr['diskont'];

    $this->myStr = "";
    $this->pometka_doc = $s_arr['Pometka'];
    $this->sum_v_kassu=  $s_arr['sum_v_kassu'];
    $this->sum_doc    =  $s_arr['SumDoc'];
    $this->flg_opt    =  $s_arr['flg_optPrice'];
    $this->sum_doc_rozn = 0;
    $this->skidka_prc  = $s_arr['SkidkaProcent'];
    
    $nmFirm = $s_arr['name_firm'];
    echo '='.$nmFirm;
    $okpo   = $s_arr['okpo'];
    $nom_svid = $s_arr['nom_svid'];
    $adr    = 'вул. Велика Перспективна, буд. 17/10';//$s_arr['adres'];
    $tel    = $s_arr['tel_firm'];

    		$str='';
             $str.= $this->r_stroka( $this->a_centr( $this->f_bold("Магазин Kancler.com\n")),7);   
             $str.= $this->r_stroka( $this->a_centr( $this->f_bold($nmFirm."\n")),7);
             $str.= $this->r_stroka( $this->a_centr( $this->f_mini("IД". $okpo . "\n")),7);
             $str.= $this->r_stroka( $this->a_centr( $this->f_mini($nom_svid . ",\n")),0); // gorod
             $str.= $this->r_stroka( $this->a_centr( $this->f_mini( $this->perenos( $adr) ."\n")),5) ;
             $str.= $this->r_stroka( $this->a_centr( $this->f_mini( "тел.: " . $tel ."\n")),5);
             $str.= $this->r_stroka( $this->r_simvol( $this->a_centr( $this->f_bold( $nm_doc . "\n") ) , 12),10);
             $str.= $this->a_centr( "" . $nom_chek . "  " . $date_chek . "\n");
             //$str.= $this->a_centr( "" . $nom_diskont . " \n \n");
             //$str.= $this->a_centr( "" . $oplata . " \n \n");
             $str.= $this->a_centr( " \n \n");
             $this->myStr = $str;
//echo 'str=' . $str;
                 return 'ok' ;

      } // prn_hapka

    //печатаем строку документа
    function prn_str_doc( $nom_str, $nameTov , $cena , $kvo , $sum , $skidka , $pometka="" ) {
         $tov = trim($nameTov);
         $tov = $this->encode($tov);

         $str = trim($nom_str) . ". " . $tov;
         $str .= "  " . $cena . "x" . $kvo ;
         if(trim($skidka) != '0' ) $str .= "x" . $skidka . "%"  ;
         $str .=  "=" . $sum ;
         $str = $this->perenos($str , 31 , 1 )  ;

         if(trim($pometka) != "") {
             $pometka = $this->perenos( $this->encode($pometka)) ;
             $pometka = $this->f_mini($pometka);
             $pometka = $this->r_stroka($pometka, 5) . "\n" ;
             $str .= "\n" . $pometka;
         }

         $str .= " \n \n ";
         $this->myStr .= $str;
         return 'ok' ;


     }  //prn_str_doc

    //печатаем подвал документа
    function prn_footer_doc(  ) {

         $pometka = $this->pometka_doc;
         $sum_kassa = $this->sum_v_kassu;
         $it_sum    = $this->sum_doc;
	 $itog = "";

         
         if($this->flg_opt > 0 ){
             $itog .= "Сума в роздрiб: "  . sprintf("%.2f",$this->sum_doc_rozn) . "\n" ;
         }
         
         if($this->skidka_prc > 0 ){
             $itog .= "Сума без знижки: "  . sprintf("%.2f",$this->sum_doc_rozn) . "\n" ;
         }
         
         
         
         $itog .= $this->a_right( $this->f_bold("Всього на суму:" . $it_sum . "\n" ) );
         if($pometka != "" ){
             $itog .= "\n" . $this->f_mini($pometka);
         }
         
         if($sum_kassa > 0 ){
	     $zd = $sum_kassa - $it_sum ;
             $itog .= "В касу: "  . $sum_kassa  . " решта: " . $zd . "\n" ;
         }
         
         $itog .= "\n \n" . $this->a_centr( $this->f_bold("Дякуємо за покупку!"));
         $itog .= "\n \n" ;
         $this->myStr .= $itog;
         return 'ok' ;

     }  //prn_footer_doc

    //***********************************  baba-jaga@i.ua  ********************************************************
    //печатаем документ
    function prn_doc($id_doc) {
        global $db;
        $ok = $this->prn_hapka_doc($id_doc);

        $txt_sql = "SELECT `DocTab`.`id` as idstr , `DocTab`.`nomstr`, `Tovar`.`Kod`, `Tovar`.`Tovar`, `DocTab`.`Cena`,"
                . " `Tovar`.`Price`,`DocTab`.`Kvo`, `DocTab`.`Skidka`\n"
                . "FROM `DocTab`\n"
                . " LEFT JOIN `Tovar` ON `DocTab`.`Tovar_id` = `Tovar`.`id_tovar` \n"
                . "WHERE (`DocTab`.`DocHd_id` ='" . $id_doc . "' AND `Kvo` >0)\n"
                . "ORDER BY `DocTab`.`id` DESC ";

         //echo '=' . $txt_sql ;

        $sql = mysql_query($txt_sql, $db);

        $sum_itog = 0;

        while ($s_arr = mysql_fetch_array($sql, MYSQL_BOTH)) {

            $it = sprintf("%.2f", $s_arr['Cena'] * $s_arr['Kvo'] * (1 - $s_arr['Skidka'] / 100 ));

            $this->sum_doc_rozn = $this->sum_doc_rozn +  $s_arr['Price'] * $s_arr['Kvo'];
            
            //$nom_str, $nameTov , $cena , $kvo , $sum , $skidka , $pometka
            $ok       = $this->prn_str_doc($s_arr['nomstr'], $s_arr['Tovar'], $s_arr['Cena'], $s_arr['Kvo'], $it, $s_arr['Skidka']);
           //$sum_itog = $sum_itog + $s_arr['Cena'] * $s_arr['Kvo'] * (1 - $s_arr['Skidka'] / 100 );
        }

        //$sum_itog = sprintf("%.0f", $sum_itog);
        $ok       = $this->prn_footer_doc();
        $ok       = $this->prn_str('');
    }


    //находим символы которые неправильно переносятся в СР866
    // и переделываем пока нашел такую i
    function encode($str) {
        $str = str_replace(chr(179), "i", $str);
        return $str;
    }

     // здесь нужно показать код каждого символа из строки

        // перенос строки на пробеле
        // $len - длинна строки , больше которой делаем перенос
        // 31 - размер строки на принтере
        // align = 1  - первая строка влево, остальные вправо
        //       = 0   - все влево
    function perenos($str ,  $len = 31 , $align = 0 ) {

        if( strlen($str)  < $len+1 )  return $str;

        $str = wordwrap($str, $len, "\n");

        $str_arr = explode("\n", $str) ;
        $new_str = "";
        for ($index = 0; $index < count($str_arr); $index++) {
            if($align == 1){                // первая лево, остальное вправо
                if($index == 0){
                    $new_str .= $this->a_left( trim( $str_arr[$index])) . "\n";
                }  else {
                    $new_str .= $this->a_right( trim($str_arr[$index])) . "\n" ;
                }
            }  else {
                $new_str = $str;
            }
        }

        return $new_str;
    }

        // Это будем печатать жирным
        function f_bold($str) {
             $str =  chr(0x1B) . 'G' . chr(1)
                        . $str .
                     chr(0x1B) . 'G' . chr(0) ;
             return $str;
        }

        // Это будем печатать наклонным
        function f_italic($str) {
             $str =  chr(0x1B) . 'I' . chr(1)
                        . $str .
                     chr(0x1B) . 'I' . chr(0) ;
             return $str;
        }

        // Это будем печатать мелким шрифтом
        function f_mini($str) {
             $str =  chr(0x1B) . 'M' . chr(1)
                        . $str .
                     chr(0x1B) . 'M' . chr(0) ;
             return $str;
        }

        //выравниваем по центру
        function a_centr($str) {
                 $str =  chr(0x1B) . 'a' . chr(1)
                        . $str .
                     chr(0x1B) . 'a' . chr(0) ;
             return $str;
        }

        //выравниваем по левому
        function a_left($str) {
                 $str =  chr(0x1B) . 'a' . chr(0)
                        . $str .
                     chr(0x1B) . 'a' . chr(0) ;
             return $str;
        }

        //выравниваем по правому
        function a_right($str) {
                 $str =  chr(0x1B) . 'a'  . chr(2)
                        . $str .
                     chr(0x1B) . 'a'  . chr(2) ;
             return $str;
        }


        //расстояние между символами n не больше 20-ти
        function r_simvol($str, $n ) {

                 $str =  chr(0x1B) . ' ' . chr($n)
                        . $str .
                     chr(0x1B) . ' ' . chr(0) ;

             return $str;
        }

        //расстояние между строками до 0 от 50
        function r_stroka($str , $n ) {
                 $str =  chr(0x1B) . "3" . chr($n)
                        . $str ;
                    // chr(0x1B) . "2"  ;
             return $str;
        }


    // выводит на принтер заданную строку
    // вызывается из внутренних функций
    function prn_str($str) {

        if($str == '') $str = $this->myStr;

        $handle = fopen('data/ttt2.txt', 'w'); //

	$str  = $str . "\n   \n  \n   \n   \n   \n"; //чтоб можно было оторвать
        $str  = $str . chr(0x7) . chr(0x7)  ; // пищит два раза
        fwrite($handle, $str) ;
        fclose($handle);

                // конвертим в CP866 - рус кодировка принтера
           exec('iconv   -f WINDOWS-1251 -t CP866 data/ttt2.txt > data/ttt1.txt');
          // exec('/usr/bin/libreoffice -pt "TSC_TDP-225" "/home/san/webServer/km/data/hkod.fods"');

           // Следующие стоки тестят сом порт и выдают ошибку
           // $fp = fopen ("/dev/ttyS0", "w+");
           // if (!$fp) {
           //      echo "Uh-oh. Port not opened.";
           //  } else {

            //exec('cp /home/sales1/Websites/km/data/ttt2.txt /dev/usb/lp1' );
            //exec('cp /home/san/webServer/km/data/ttt2.txt /dev/usb/lp1' );
                
           //  }
           $this->prn_na_ftp('ttt1.txt');

    }



    //***********************************  baba-jaga@i.ua  **************************************
    // отправляем файл для печати по фтп, На клиента на котором установлен требуемый принтер
    //'data/cennik_sr.fods'
    function prn_na_ftp($filename){
        
        
               $ipadrr = $_SERVER["REMOTE_ADDR"];// ip adres klienta
        
                $connect = ftp_connect('192.168.0.115');
                echo '='.$ipadrr ;
                //$connect = ftp_connect($ipadrr);
                if (!$connect) {
                    echo("<H1>Не!! включен компьютер с принтером</H1>");
                    return  ;
                }

                $result = ftp_login($connect, 'sales', '111');
                if(!$result){
                    echo("<H1>Нет подключения к папкам , возможно нужно перезагрузить <br>"
                            . " компютер, на котром установлен принтер для печати ценников</H1>");
                    return ;
                }
                 // включение пассивного режима
                ftp_pasv($connect, true);
                //echo("Соединение установлено<br>");
                //if(! ftp_chdir($connect, $const->ftp_catalog) ){ // переход в каталог

                  //  $err = 'не верно задана дирректория на сервере';
                  //  save_log('Ошибка отправки данных', $err );
                 //}

                //$filename = 'cennik_sr.fods';   // имя без пути
                if (ftp_put($connect, $filename,'data/ttt1.txt', FTP_BINARY)) {
                    echo "Если принтер включен, то напечатано.";
                    //save_log('Отправка данных', 'Файл: '.  $filename. '  отправлен на сервер. '   );

                }    
    }


}

?>
