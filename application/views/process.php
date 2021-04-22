<?php


date_default_timezone_set("Asia/Singapore");

if($this->input->post('reset')){
    session_destroy();
    header("location: /ninja-gold-ci/ninja");

}

function randomizer($min,$max){
    return rand($min,$max);
}
function resultLog ($result){

    $ci =& get_instance(); //If you want to access the CI framework from inside a plain function, you need to get an instance of CI.

    $shiftedlog = $ci->session->userdata("logs");

    array_unshift($shiftedlog,"<p class='bg_earn'>You entered a {$ci->input->post("building")} and earned $result golds. " . date("F d Y h:i A") . "</p>");
    $ci->session->set_userdata('logs',$shiftedlog);
  
    
}
if (empty($this->session->userdata('score'))){
    $this->session->set_userdata("score",0);
    $this->session->set_userdata("logs",[]);
    
    var_dump($this->session->userdata("logs"));
    echo $this->session->userdata("score");
   
}

if($this->input->post("building") && $this->input->post("building") == "farm"){
    $result = randomizer(10,20);
    $score = $this->session->userdata("score");
    $score += $result;
    $score = $this->session->set_userdata("score",$score);
    resultLog($result);
}
if($this->input->post("building") && $this->input->post("building") == "cave"){
    $result = randomizer(5,10);
    $score = $this->session->userdata("score");
    $score += $result;
    $score = $this->session->set_userdata("score",$score);
    resultLog($result);
}
if($this->input->post("building") && $this->input->post("building") == "house"){
    $result = randomizer(2,5);
    $score = $this->session->userdata("score");
    $score += $result;
    $score = $this->session->set_userdata("score",$score);
    resultLog($result);
}
if($this->input->post("building") && $this->input->post("building") == "casino"){
    $earn_or_take = randomizer(0, 1);
    $result = randomizer(0,50);
    if ($earn_or_take) {

        $score = $this->session->userdata("score");
        $score += $result;
        $score = $this->session->set_userdata("score",$score);
        resultLog($result);
    } else {
        $score = $this->session->userdata("score");
        $score -= $result;
        $score = $this->session->set_userdata("score",$score);

        $ci =& get_instance(); //If you want to access the CI framework from inside a plain function, you need to get an instance of CI.

        $shiftedlog = $ci->session->userdata("logs");
        array_unshift($shiftedlog,"<p class='bg_lost'> You entered a {$ci->input->post("building")} and lost $result golds. " . date("F d Y h:i A") ."</p>");
        $ci->session->set_userdata('logs',$shiftedlog);
    
    }
}


header("location: /ninja-gold-ci/ninja");

die();