<?php
header('Content-Type: text/html; charset=utf-8');

        $string_to_crypt  = "password";
        $crypt_code       = "4581";
        $abc_table        = "{aábcdeéfghijklmnoöpqrstuüvxyz} (29) ";
        $abc = array(   "1" => "a" , "2" => "á" , "3" => "b" ,
                                        "4" => "c" , "5" => "d" , "6" => "e" ,
                                        "7" => "é" , "8" => "f" , "9" => "g" ,
                                        "10" => "h", "11" => "i", "12" => "j",
                                        "13" => "k", "14" => "l", "15" => "m",
                                        "16" => "n", "17" => "o", "18" => "ö",
                                        "19" => "p", "20" => "q", "21" => "r",
                                        "22" => "s", "23" => "t", "24" => "u",
                                        "25" => "ü", "26" => "v", "27" => "x",
                                        "28" => "y", "29" => "z", "30" => "w",
                                );
       
       
        $string_to_crypt = str_replace("_", "",$string_to_crypt);
       
        /* CRYPTER */  
        print "<h4>Crypter</h4>";
        $split_str = str_split($string_to_crypt);
        $split_code= str_split($crypt_code);   
 
        for($i = 0; $i<strlen($string_to_crypt);$i++) {
                $crypt_code .= $crypt_code;
                        $crypt_code = substr($crypt_code,0,strlen($string_to_crypt));
        }
               
        $crypted_string = "";
        for($i = 0; $i<strlen($string_to_crypt);$i++)
        {
                for($y = 1; $y<=count($abc); $y++) {
                        if($abc[$y] == $split_str[$i]) {
                                if(($y + $crypt_code[$i]) > count($abc))
                                {
                                        $both = ($y + $crypt_code[$i]) - count($abc);
                                        //print $abc[$y]." => ".$y." + ".$crypt_code[$i]." => ".$abc[$both]." (".$both.")<br/>";
                                        $crypted_string .= $abc[$both];
                                }
                                else
                                {
                                        $both = $y + $crypt_code[$i];
                                        //print $abc[$y]." => ".$y." + ".$crypt_code[$i]." => ".$abc[$both]." (".$both.")<br/>";
                                        $crypted_string .= $abc[$both];
                                }
                        }
                }
        }
        print "
                String___: <b>".$string_to_crypt."</b> (".strlen($string_to_crypt).")<br/>
                Code____: <b>".$crypt_code."</b> <br/>
                Crypted__: <b>".$crypted_string."</b> (".strlen($crypted_string).") <br/>
                ABC_TABLE: <b>".$abc_table."</b>";
       
        //DECRYPTER
        print "<h4>Decrypter</h4>";
        $split_str_crypted = str_split($crypted_string);
        $decrypted_string = "";
        for($i = 0; $i<strlen($crypted_string);$i++)
        {
                for($y = 1; $y<=count($abc); $y++) {
                        if($abc[$y] == $split_str_crypted[$i]) {
                                if($y - $crypt_code[$i] <= 0)
                                {
                                        $both = (count($abc) - $crypt_code[$i]) + $y;
                                        $decrypted_string .= $abc[$both];                               }
                                else
                                {
                                        $both = $y - $crypt_code[$i];
                                        $decrypted_string .= $abc[$both];
                                }
                        }
                }
        }
        print "
                Crypted string__: <b>".$crypted_string."</b> (".strlen($crypted_string).") <br/>
                Code_________: <b>".$crypt_code."</b> <br/>
                Decrypted string: <b>".$decrypted_string."</b> (".strlen($decrypted_string).") <br/>
                ABC_TABLE_______: <b>".$abc_table."</b>";
 
?>