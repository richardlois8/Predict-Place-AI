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
        case "yogyakarta":
            return array(
                "curahHujan" => "70",
                "daerahResapan" => "3",
                "jumlahPohon" => "6000",
                "kecepatanAngin" => "15"
            );
        case "sleman":
            return array(
                "curahHujan" => "50",
                "daerahResapan" => "2",
                "jumlahPohon" => "4000",
                "kecepatanAngin" => "10"
            );
        case "bantul":
            return array(
                "curahHujan" => "30",
                "daerahResapan" => "1",
                "jumlahPohon" => "2000",
                "kecepatanAngin" => "5"
            );
        case "gunungkidul":
            return array(
                "curahHujan" => "20",
                "daerahResapan" => "0",
                "jumlahPohon" => "1000",
                "kecepatanAngin" => "2"
            );
        case "kulonprogo":
            return array(
                "curahHujan" => "30",
                "daerahResapan" => "10",
                "jumlahPohon" => "15000",
                "kecepatanAngin" => "10"
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
    $R10 = new Rule("J AND K", "M");
    $R11 = new Rule("I AND L", "N");
    $R12 = new Rule("J AND L", "N");
    $R13 = new Rule("E AND H", "O");
    $R14 = new Rule("E AND G", "O");
    $R15 = new Rule("F AND H", "O");
    $R16 = new Rule("F AND G", "P");
    $R17 = new Rule("O AND M", "X");
    $R18 = new Rule("O AND N", "X");
    $R19 = new Rule("P AND M", "X");
    $R20 = new Rule("P AND N", "Y");
    $rules = [$R1,$R2,$R3,$R4,$R5,$R6,$R7,$R8,$R9,$R10,$R11,$R12,$R13,$R14,$R15,$R16,$R17,$R18,$R19,$R20];
    
    $result = "";
    // $counter = 1;
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
            $result = "Daerah berbahaya untuk dikunjungi";
            break;
        }elseif(in_array("Y",$facts)){
            $result = "Daerah aman untuk dikunjungi";
            break;
        }
    }

    return $result;
}