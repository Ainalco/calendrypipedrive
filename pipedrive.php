<?php

class PipedriveAPI
{
    private $apiToken;
    private $companyDomain;

    public function __construct($apiToken, $companyDomain)
    {
        $this->apiToken = $apiToken;
        $this->companyDomain = $companyDomain;
    }

    public function getPersonDetails($personId)
    {
        $searchUrl = "https://{$this->companyDomain}.pipedrive.com/api/v1/persons/{$personId}?api_token={$this->apiToken}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $searchUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }


        // Close the cURL session
        curl_close($ch);

        return $output;
    }
    
     public function getallperson($page)
   {
       $search_url = "https://{$this->companyDomain}.pipedrive.com/api/v1/persons?start={$page}&limit=500&api_token={$this->apiToken}";
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $search_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
       $output = curl_exec($ch);
       curl_close($ch);       
       return $output;
   }
   
   function mergeperson($person_id, $data) {
     $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/persons/{$person_id}/merge?api_token={$this->apiToken}";
    
     
     $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
          
          
        $output = curl_exec($ch);
        curl_close($ch);
        
        return $output;
    }
    
    public function getPersonDetailsByEmail($email){
        
        $search_url = "https://{$this->companyDomain}.pipedrive.com/api/v1/persons/search?term={$email}&api_token={$this->apiToken}";


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $search_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $output = curl_exec($ch);
    
    
        curl_close($ch);
        
        return $output;
    }
    
     public function getDealDetailsOfPerson($person_id)
    {
        $search_url = 'https://' . $this->companyDomain . '.pipedrive.com/api/v1/persons/' . $person_id . '/deals?api_token=' . $this->apiToken;
    
         $curl = curl_init();
    
         // Set cURL options
         curl_setopt_array($curl, array(
             CURLOPT_URL => $search_url,
             CURLOPT_RETURNTRANSFER => true
         ));
    
         // Execute the cURL requestpi
        $output = curl_exec($curl);
         
        return $output;
    }


    function getLeadDetailsOfPerson($person_id)
    {
    


          $search_url = 'https://' . $this->companyDomain . '.pipedrive.com/api/v1/leads?person_id=' . $person_id . '&api_token=' . $this->apiToken;

        $ch = curl_init();

        // Set cURL options
        curl_setopt_array($ch, array(
            CURLOPT_URL => $search_url,
            CURLOPT_RETURNTRANSFER => true
        ));

        // Execute the cURL request
       $output = curl_exec($ch);
    
        curl_close($ch);
        
        return $output;
    }
    
    
    function createPerson($person_data){
        $url = 'https://' . $this->companyDomain . '.pipedrive.com/api/v1/persons/?api_token=' . $this->apiToken;
    
        $ch = curl_init();
    	
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($person_data));
    	
    
        $output = curl_exec($ch);
    
        curl_close($ch);
        return  $output;
    }
    
    function updatePerson($person_id, $person_data) {
     $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/persons/{$person_id}?api_token={$this->apiToken}";
    
     $json_data = json_encode($person_data);
    
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
     curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         'Content-Type: application/json',
         'Content-Length: ' . strlen($json_data)
     ));
    
     $output = curl_exec($ch);
    
     curl_close($ch);
    
     return $output;

    }
    
    
    
     public function getOwnerDetails($owner_id)
    {
        $searchUrl = "https://{$this->companyDomain}.pipedrive.com/api/v1/users/{$owner_id}?api_token={$this->apiToken}";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $searchUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $output = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }
    
        // Close the cURL session
        curl_close($ch);
    
        return $output;
    }

    public function getDealDetails($dealId)
    {
        $searchUrl = "https://{$this->companyDomain}.pipedrive.com/api/v1/deals/{$dealId}?api_token={$this->apiToken}";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $searchUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $output = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }
    
        // Close the cURL session
        curl_close($ch);
    
        return $output;
    }
    
    
    public function getDealFieldsDetails($fieldsid)
    {
        $searchUrl = "https://{$this->companyDomain}.pipedrive.com/api/v1/dealFields/{$fieldsid}?api_token={$this->apiToken}";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $searchUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $output = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }
    
        // Close the cURL session
        curl_close($ch);
    
        return $output;
    }
  
    
    
    public function moveUpdatedDealStage($stage_id,$dealId)
    {
        $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/deals/{$dealId}?api_token={$this->apiToken}";

        $data=[
            'stage_id'=>$stage_id
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        
        echo 'Sending request...' . PHP_EOL;
        
        $output = curl_exec($ch);
        curl_close($ch);
    
        return $output;
    }
    
    public function searchOfdeals($name)
   {
       $search_url = "https://{$this->companyDomain}.pipedrive.com/api/v1/deals/search?term=".urlencode(trim($name))."&exact_match=true&api_token={$this->apiToken}";
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $search_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
       $output = curl_exec($ch);
       curl_close($ch);       
       return $output;
   }

   public function getalldeals()
   {
       $search_url = "https://{$this->companyDomain}.pipedrive.com/api/v1/deals?api_token={$this->apiToken}";
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $search_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
       $output = curl_exec($ch);
       curl_close($ch);       
       return $output;
   }
    
    
    function createDeal($data){
    
        $url = 'https://' . $this->companyDomain . '.pipedrive.com/api/v1/deals?api_token=' . $this->apiToken;
    
        $ch = curl_init();
        
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        
        $output = curl_exec($ch);
        
        curl_close($ch);
        
        return $output;
    
    }
    
    function updateDeal($deal_id, $data) {
     $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/deals/{$deal_id}?api_token={$this->apiToken}";
    
     
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
          
          
        $output = curl_exec($ch);
        curl_close($ch);
        
        return $output;
    }

    function mergeDeal($deal_id, $data) {
     $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/deals/{$deal_id}/merge?api_token={$this->apiToken}";
    
     
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
          
          
        $output = curl_exec($ch);
        curl_close($ch);
        
        return $output;
    }
    
    function createDealNote($deal_id,$content) {

    // Define endpoint URL
    $endpoint = "https://" . $this->companyDomain . ".pipedrive.com/api/v1/notes?api_token=" . $this->apiToken;

    // Define note data to be sent to API
    $data = array(
        "content" => $content,
        "deal_id" => $deal_id
    );

    // Send request to API
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    // Check if request was successful
    if (!$result) {
        return false;
    }

    // Return response from API
    return $result;
}

public function getallorganization()
{
    $searchUrl = "https://{$this->companyDomain}.pipedrive.com/api/v1/organizations?api_token={$this->apiToken}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $searchUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        exit;
    }
    // Close the cURL session
    curl_close($ch);
    return $output;
}

    function createOrganization($data) {
      $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/organizations?api_token={$this->apiToken}";
    
    //   $data = array(
    //     'name' => $name
    //     // Add other fields as needed
    //   );
    
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
      $response = curl_exec($curl);
    
      // Check if the request was successful
      $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
      curl_close($curl);
    
      return $response;
    }

    
    function searchOrganizationsByName($name) {
    
      $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/organizations/search?term={$name}&name={$name}&api_token={$this->apiToken}";
    
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
      $response = curl_exec($curl);
    
      // Check if the request was successful
      $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
      curl_close($curl);
      
      return $response;
    }
    
    function findOrgId($org_details,$org_name,$org_data){
                    $org_data['name']=$org_name;
                    $org_found=0;
                    if(isset($org_details->data->items[0]->item)){
                        
                        foreach($org_details->data->items as $items){
                            if($items->item->name==$org_name){
                               $org_found=1; 
                            }
                        }
                        if($org_found==1){
                              $org_id=$org_details->data->items[0]->item->id;
                        }else{
                            
                            $create_org=$this->createOrganization($org_data);
        
                            $search_org=json_decode($create_org);
                            $org_id=$search_org->data->id;

                        }
                   
                        
                        
                        
                    }else{
                        
                        
                    $create_org=$this->createOrganization($org_data);

                    $search_org=json_decode($create_org);
                    $org_id=$search_org->data->id;
                  

                    }
                    
                    return $org_id;
    }


    function searchOrganizationById($organizationId) {

        $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/organizations/{$organizationId}?api_token={$this->apiToken}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        // Check if the request was successful
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode === 200) {
            return $response;
        } else {
            throw new Exception('Failed to retrieve organization data.');
        }

        curl_close($curl);
        
        return $response;

    }

   function dealsassociatedorganization($organizationId) {
        $searchUrl = "https://{$this->companyDomain}.pipedrive.com/api/v1/organizations/{$organizationId}/deals?api_token={$this->apiToken}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $searchUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }
        // Close the cURL session
        curl_close($ch);
        return $output;

   }

   public function searchOfleads($name)
   {
       $search_url = "https://{$this->companyDomain}.pipedrive.com/api/v1/leads/search?term=".urlencode(trim($name))."&exact_match=true&api_token={$this->apiToken}";
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $search_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
       $output = curl_exec($ch);
       curl_close($ch);       
       return $output;
   }

function createLead($data) {
    $url = 'https://' . $this->companyDomain . '.pipedrive.com/api/v1/leads?api_token=' . $this->apiToken;

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    $output = curl_exec($ch);
    
    curl_close($ch);
    
    return $output;
}


function updateLead($lead_id, $data) {
    $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/leads/{$lead_id}?api_token={$this->apiToken}";

    $json_data = json_encode($data);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_data)
    ));
    
    
    $output = curl_exec($ch);
    
    curl_close($ch);
    
    return $output;
}

    
    function createLeadNote($lead_id,$content) {

    // Define endpoint URL
    $endpoint = "https://" . $this->companyDomain . ".pipedrive.com/api/v1/notes?api_token=" . $this->apiToken;

    // Define note data to be sent to API
    $data = array(
        "content" => $content,
        "lead_id" => $lead_id
    );

    // Send request to API
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    // Check if request was successful
    if (!$result) {
        return false;
    }

    // Return response from API
    return $result;
}

public function getactivityDetails($activityid)
    {
        $getactivityUrl = "https://{$this->companyDomain}.pipedrive.com/api/v1/activities/{$activityid}?api_token={$this->apiToken}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $getactivityUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
            exit;
        }


        // Close the cURL session
        curl_close($ch);

        return $output;
    }
    function updateactivity($activityid, $data) {
        $url = "https://{$this->companyDomain}.pipedrive.com/api/v1/activities/{$activityid}?api_token={$this->apiToken}";
       
        
            $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
           curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
             
             
           $output = curl_exec($ch);
           curl_close($ch);
           
           return $output;
       }
   




    
    
    


}



?>
