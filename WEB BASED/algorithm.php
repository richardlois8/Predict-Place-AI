<?php  
class Rule{
    private $antencedent;
    private $consequent;

    public function __construct($antencedent, $consequent){
        $this->antencedent = $antencedent;
        $this->consequent = $consequent;
    }

    public function getAntencedent(){
        return $this->antencedent;
    }

    public function getConsequent(){
        return $this->consequent;
    }

    public function printRule(){
        echo $this->getAntencedent() . " => " . $this->getConsequent();
    }
}

function getData($kota){
    switch ($kota){
        # !Expected Result : daerah berbahaya untuk dikunjungi
        case "yogyakarta":
            return array(
                "curahHujan" => "70",
                "daerahResapan" => "3",
                "jumlahPohon" => "6000",
                "kecepatanAngin" => "15"
            );
        # !Expected Result : daerah berbahaya untuk dikunjungi
        # R15 : IF curah hujan rendah and luas daerah resapan sempit THEN daerah rawan banjir.
        # R18 : IF daerah rawan banjir and aman dari pohon tumbang THEN daerah berbahaya untuk dikunjungi.
        case "sleman":
            return array(
                "curahHujan" => "49.5",
                "daerahResapan" => "1.85",
                "jumlahPohon" => "1905",
                "kecepatanAngin" => "28.7"
            );
         # !Expected Result : daerah berbahaya untuk dikunjungi
        # R14 : IF curah hujan tinggi and luas daerah resapan besar THEN daerah rawan banjir.
        # R10 : IF jumlah pohon rendah and kecepatan angin tinggi THEN rawan pohon tumbang.
        case "bantul":
            return array(
                "curahHujan" => "52.5",
                "daerahResapan" => "2.1",
                "jumlahPohon" => "6011",
                "kecepatanAngin" => "38.3"
            );
        # !Expected Result : daerah berbahaya untuk dikunjungi
        # R14 : IF curah hujan tinggi and luas daerah resapan besar THEN daerah rawan banjir.
        # R18 : IF daerah rawan banjir and aman dari pohon tumbang THEN daerah berbahaya untuk dikunjungi.
        case "gunungkidul": 
            return array(
                "curahHujan" => "56.1",
                "daerahResapan" => "2.7",
                "jumlahPohon" => "2077",
                "kecepatanAngin" => "14.7"
            );
        # !Expected Result : daerah aman untuk dikunjungi
        # R16 : IF curah hujan rendah and luas daerah resapan besar THEN daerah aman banjir.
        # R11 : IF jumlah pohon tinggi and kecepatan angin rendah THEN aman dari pohon tumbang.
        case "prambanan":
            return array(
                "curahHujan" => "38.5",
                "daerahResapan" => "3.3",
                "jumlahPohon" => "5152",
                "kecepatanAngin" => "28.7"
            );
         # !Expected Result : daerah berbahaya untuk dikunjungi 
        # R15 : IF curah hujan rendah and luas daerah resapan sempit THEN daerah rawan banjir.
        # R18 : IF daerah rawan banjir and aman dari pohon tumbang THEN daerah berbahaya untuk dikunjungi.
        case "godean":
            return array(
                "curahHujan" => "20.5",
                "daerahResapan" => "1.1",
                "jumlahPohon" => "1077",
                "kecepatanAngin" => "14.7"
            );
        # !Expected Result : daerah berbahaya untuk dikunjungi
        case "pakem":
            return array(
                "curahHujan" => "52.5",
                "daerahResapan" => "1.87",
                "jumlahPohon" => "1527",
                "kecepatanAngin" => "29.9"
            );
        # !Expected Result : daerah berbahaya untuk dikunjungi
        # R10 : IF jumlah pohon rendah and kecepatan angin tinggi THEN rawan pohon tumbang.
        # R19 : IF daerah aman banjir and rawan pohon tumbang THEN daerah berbahaya untuk dikunjungi.
        case "cangkringan":
            return array(
                "curahHujan" => "40.5",
                "daerahResapan" => "2.0",
                "jumlahPohon" => "995",
                "kecepatanAngin" => "30.7"
            );
        # !Expected Result : daerah berbahaya untuk dikunjungi
        case "moyudan":
            return array(
                "curahHujan" => "60.5",
                "daerahResapan" => "1.77",
                "jumlahPohon" => "6077",
                "kecepatanAngin" => "40.7"
            );
        # !Expected Result : daerah aman untuk dikunjungi
        case "ngemplak":
            return array(
                "curahHujan" => "20.5",
                "daerahResapan" => "2.1",
                "jumlahPohon" => "1077",
                "kecepatanAngin" => "21.7"
            );
    }
}

function getFact($arrFact){
    $A = $arrFact["curahHujan"];
    $B = $arrFact["daerahResapan"];
    $C = $arrFact["jumlahPohon"];
    $D = $arrFact["kecepatanAngin"];

    $facts = [];
    if($A >= 50){
        $facts[] = "E";
    }else{
        $facts[] = "F";
    }
    if($B >= 2){
        $facts[] = "G";
    }else{
        $facts[] = "H";
    }
    if($C >= 5000){
        $facts[] = "I";
    }else{
        $facts[] = "J";
    }
    if($D >= 30){
        $facts[] = "K";
    }else{
        $facts[] = "L";
    }
    return $facts;
}

function solve($facts){
    $R1 = new Rule("A >= 50", "E");
    $R2 = new Rule("A < 50", "F");
    $R3 = new Rule("B >= 2", "G");
    $R4 = new Rule("B < 2", "H");
    $R5 = new Rule("C >= 5000", "I");
    $R6 = new Rule("C < 5000", "J");
    $R7 = new Rule("D >= 30", "K");
    $R8 = new Rule("D < 30", "L");
    $R9 = new Rule("I AND K", "M");
    $R10 = new Rule("J AND K", "MN");
    $R11 = new Rule("I AND L", "MN");
    $R12 = new Rule("J AND L", "N");
    $R13 = new Rule("E AND H", "O");
    $R14 = new Rule("E AND G", "OP");
    $R15 = new Rule("F AND H", "OP");
    $R16 = new Rule("F AND G", "P");
    $R17 = new Rule("O AND M", "X");
    $R18 = new Rule("M AND OP", "XY");
    $R19 = new Rule("MN AND O", "XY");
    $R20 = new Rule("O AND N", "Y");
    $R21 = new Rule("MN AND OP", "Y");
    $R22 = new Rule("P AND M", "Y");
    $R23 = new Rule("N AND OP", "YZ");
    $R24 = new Rule("MN AND P", "YZ");
    $R25 = new Rule("P AND N", "Z");
    $rules = [$R1,$R2,$R3,$R4,$R5,$R6,$R7,$R8,$R9,$R10,$R11,$R12,$R13,$R14,$R15,$R16,$R17,$R18,$R19,$R20,$R21,$R22,$R23,$R24,$R25];
    $consDef = array("O"=>"Daerah rawan banjir", "M"=>"Daerah rawan pohon tumbang", "N"=>"Daerah aman dari pohon tumbang", "P"=>"Daerah aman dari banjir","MN"=>"Waspada pohon tumbang","OP"=>"Waspada banjir");
    
    $result = [];
    while(true){
        for($i=0;$i<count($rules);$i++){
            $antecedents = $rules[$i]->getAntencedent();
            $consequent = $rules[$i]->getConsequent();
            $antecedents = explode("AND",$antecedents);
            if(in_array(trim($antecedents[0]),$facts) && in_array(trim($antecedents[1]),$facts)){
                $facts[] = $consequent;
            }
        }
        // echo "Iterasi ke-" . $counter . "<br>";
        // var_dump($facts);
        // $counter++;
        if(in_array("X",$facts)){
            $result[] = "Daerah sangat berbahaya untuk dikunjungi. Kami menyarankan untuk tidak mengunjungi daerah ini.";
            break;
        }elseif(in_array("Y",$facts)){
            $result[] = "Daerah berbahaya tingkat menengah. Kami menyarankan anda untuk menghindari daerah ini.";
            break;
        }
        elseif(in_array("XY",$facts)){
            $result[] = "Daerah berbahaya tingkat menengah atas. Kami menyarankan anda untuk menghindari daerah ini.";
            break;
        }
        elseif(in_array("YZ",$facts)){
            $result[] = "Daerah berbahaya tingkat rendah. Kami menyarankan anda untuk menghindari daerah ini.";
            break;
        }
        elseif(in_array("Z",$facts)){
            $result[] = "Daerah aman untuk dikunjungi. Semoga perjalanan Anda menyenangkan.";
            break;
        }
    }
    $result[] = $consDef[$facts[count($facts)-3]];
    $result[] = $consDef[$facts[count($facts)-2]];

    return $result;
}