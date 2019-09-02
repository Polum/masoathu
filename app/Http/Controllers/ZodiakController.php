<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZodiakController extends Controller
{
    public function results(Request $request)
    {
        $request = $request->all();
        $data = array();
        
        $resultList = '59087';
        // $data["constituencyCode"] = $request["constituencyCode"];
        $data["constituencyCode"] = '59087';
        $data["formSerialNumber"] = $request["formSerialNumber"];
        $data["formType"] = "Form 71";
        $data["phoneNumber"] = $request["phoneNumber"];
        $data["username"] = "Smarcello";

        $candidates = array();

        array_push($candidates, array("candidateCode"=>'quaerat', "votes"=>$request["Professor_John_Eugene_Chisi"]));
        array_push($candidates, array("candidateCode"=>'laudantium', "votes"=>$request["Peter_Dominic_Sinosi_Driver_Kuwani"]));
        array_push($candidates, array("candidateCode"=>'nisi', "votes"=>$request["Joyce_Hilda_Banda"]));
        array_push($candidates, array("candidateCode"=>'fuga', "votes"=>$request["Lazarus_Chakwera"]));
        // array_push($candidates, array("candidateCode"=>'skc', "votes"=>$request["Saulos_Klaus_Chilima"]));
        // array_push($candidates, array("candidateCode"=>'atupele', "votes"=>$request["Atupele_Austin_Muluzia"]));
        // array_push($candidates, array("candidateCode"=>'Hadwick', "votes"=>$request["Reverend_Hadwick_Kaliya"]));
        // array_push($candidates, array("candidateCode"=>'Peter', "votes"=>$request["Professor_Arthur_Peter_Mutharika"]));

        foreach($candidates as $candidate){
            $resultList = $resultList.','.$candidate["votes"];
        }
        $data["results"] = $candidates;
        $data['checksum'] = bcrypt($resultList);

        $result = $this->callAPI("POST", "http://347efd30.ngrok.io/api/results/presidential", json_encode($data));

        return $result;
    }


    public function callAPI($method, $url, $data){
        $curl = curl_init();
     
        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
     
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
     }
}
