<?php 
$ts = microtime(true);
$data = file_get_contents("php://input");
file_put_contents('data/'.$ts.'_calendy.json', $data);
//$data='{"created_at":"2024-07-02T11:51:30.000000Z","created_by":"https://api.calendly.com/users/CCFEQDJM2HRRNOL5","event":"invitee.created","payload":{"cancel_url":"https://calendly.com/cancellations/53f6352e-ac8c-4901-a02b-01b89a1b8590","created_at":"2024-07-02T11:51:29.054447Z","email":"hoossein@gmail.com","event":"https://api.calendly.com/scheduled_events/685014e4-8edc-4e36-9631-33d6b14db1c6","first_name":null,"invitee_scheduled_by":null,"last_name":null,"name":"Hoss","new_invitee":null,"no_show":null,"old_invitee":null,"payment":null,"questions_and_answers":[{"answer":"I am currently a Pipedrive User","position":1,"question":"Pipedrive Account?"},{"answer":"HOSS","position":2,"question":"Business Name"},{"answer":"Email Campaigns","position":4,"question":"Please Select any that interest you that you would like to learn more about how we can connect them with Pipedrive Seamlessly."}],"reconfirmation":null,"reschedule_url":"https://calendly.com/reschedulings/53f6352e-ac8c-4901-a02b-01b89a1b8590","rescheduled":false,"routing_form_submission":null,"scheduled_event":{"created_at":"2024-07-02T11:51:29.031181Z","end_time":"2024-07-03T07:30:00.000000Z","event_guests":[],"event_memberships":[{"user":"https://api.calendly.com/users/CCFEQDJM2HRRNOL5","user_email":"jmurphy@luaaksolutions.com","user_name":"Joshua Murphy"}],"event_type":"https://api.calendly.com/event_types/0aa18385-72fc-4cd5-ae27-4e879ceec546","invitees_counter":{"total":1,"active":1,"limit":1},"location":{"data":{"id":84849729157,"settings":{"global_dial_in_numbers":[{"country_name":"US","number":"+1 646 931 3860","type":"toll","country":"US"},{"country_name":"US","city":"Washington DC","number":"+1 301 715 8592","type":"toll","country":"US"},{"country_name":"US","number":"+1 305 224 1968","type":"toll","country":"US"},{"country_name":"US","number":"+1 309 205 3325","type":"toll","country":"US"},{"country_name":"US","city":"Chicago","number":"+1 312 626 6799","type":"toll","country":"US"},{"country_name":"US","city":"New York","number":"+1 646 558 8656","type":"toll","country":"US"},{"country_name":"US","number":"+1 507 473 4847","type":"toll","country":"US"},{"country_name":"US","number":"+1 564 217 2000","type":"toll","country":"US"},{"country_name":"US","number":"+1 669 444 9171","type":"toll","country":"US"},{"country_name":"US","number":"+1 689 278 1000","type":"toll","country":"US"},{"country_name":"US","number":"+1 719 359 4580","type":"toll","country":"US"},{"country_name":"US","city":"Denver","number":"+1 720 707 2699","type":"toll","country":"US"},{"country_name":"US","number":"+1 253 205 0468","type":"toll","country":"US"},{"country_name":"US","city":"Tacoma","number":"+1 253 215 8782","type":"toll","country":"US"},{"country_name":"US","city":"Houston","number":"+1 346 248 7799","type":"toll","country":"US"},{"country_name":"US","number":"+1 360 209 5623","type":"toll","country":"US"},{"country_name":"US","number":"+1 386 347 5053","type":"toll","country":"US"}]},"extra":{"intl_numbers_url":"https://us06web.zoom.us/u/kbLOSF1L81"},"password":"646335"},"join_url":"https://us06web.zoom.us/j/84849729157?pwd=eHc6vBmgEyPAW6ljiq94NMsfKyD7Uv.1","status":"pushed","type":"zoom"},"meeting_notes_html":null,"meeting_notes_plain":null,"name":"30-Min Consultation Luaak Solutions","start_time":"2024-07-03T07:00:00.000000Z","status":"active","updated_at":"2024-07-02T11:51:29.031181Z","uri":"https://api.calendly.com/scheduled_events/685014e4-8edc-4e36-9631-33d6b14db1c6"},"scheduling_method":null,"status":"active","text_reminder_number":null,"timezone":"Australia/Adelaide","tracking":{"utm_campaign":null,"utm_source":null,"utm_medium":null,"utm_content":null,"utm_term":null,"salesforce_uuid":null},"updated_at":"2024-07-02T11:51:29.054447Z","uri":"https://api.calendly.com/scheduled_events/685014e4-8edc-4e36-9631-33d6b14db1c6/invitees/53f6352e-ac8c-4901-a02b-01b89a1b8590"}}';
    $getcalendlydata = json_decode($data);
    $eventdata = $getcalendlydata->payload;
    //print_r($eventdata);
    $eventname = $eventdata->scheduled_event->name;
    $name = ucwords(strtolower($eventdata->name));
    $email = $eventdata->email;
    $timezone = $eventdata->timezone;
    
    $newgetdatetime = $eventdata->scheduled_event->start_time;
    $neweventendtime = $eventdata->scheduled_event->end_time;
    $mettingurl = $eventdata->scheduled_event->location->join_url;
    
    $eventstarttime = date("Y-m-d H:i:s", strtotime($newgetdatetime));
    $eventendtime = date("Y-m-d H:i:s", strtotime($neweventendtime));
    $datetime1 = new DateTime($eventstarttime);
    $datetime2 = new DateTime($eventendtime);
    $interval = $datetime1->diff($datetime2);
    $hour = ($interval->h > 0) ? sprintf('%02d', $interval->h) : '00';
    $minute = ($interval->i > 0) ? sprintf('%02d', $interval->i) : '00';
    if ($hour > 0) {
        $duration = $hour . ':' . $minute;
    } else {
        $duration = $minute;
    }
    
    $stagechangeTime = date('Y-m-d H:i', strtotime($eventendtime . ' +30 minutes'));
    
    $sharemetting = $eventdata->questions_and_answers[0]->answer;
    
    $note = $sharemetting;
    $content = "<strong>EVENT:</strong> " . $eventname . "<br/>";
    $content .= "<strong>START TIME:</strong> " . $eventstarttime . "<br/>";
    $content .= "<strong>LINK TO JOIN:</strong> " . $mettingurl . "<br/>";
    $content .= "<strong>NOTE:</strong> " . $note . "<br/>";
    
    require_once('pipedrive.php');
    $objPipedrive = new PipedriveAPI('50a881f6105a89356252d6c3543073a8caf40e09', 'rf-luaaksolutions');
    $getperoninfo = json_decode($objPipedrive->getPersonDetailsByEmail($email));
    
    if (!empty($getperoninfo->data->items)) {
        $exitspersonid = $getperoninfo->data->items[0]->item->id;
        $persondata = array(
            'name' => $name,
            'email' => $email,
            '58ecd6cd080bcac2fab7402f23473569145a02ec963' => $timezone,
            'dfa04ac838025d8b28f11545efaae4db3d2c81b4c3' => $sharemetting
        );
        $objPipedrive->updatePerson($exitspersonid, $persondata);
        $getdeals = json_decode($objPipedrive->getDealDetailsOfPerson($exitspersonid));
    
        if (!empty($getdeals->data)) {
            $dealid = $getdeals->data[0]->id;
            $detailsdeals = json_decode($objPipedrive->getDealDetails($dealid));
            $pipelineid = $detailsdeals->data->pipeline_id;
            $stageid = $detailsdeals->data->stage_id;
            if (($pipelineid == 1) && ($stageid == 7 || $stageid == 78 || $stageid == 103)) {
                $dealsdata = array(
                    'title' => $name,
                    'person_id' => $exitspersonid,
                    'pipeline_id' => 20,
                    'stage_id' => 129,
                    '1f3fcc80ae3376dca0538aab343d96df6258af2a32' => $eventstarttime,
                    'e43e29f4ddbd3cd426dec9aefe99a34285dec0d227' => $duration,
                    '82902a1626aa2dee54ae3e887934b811b491183107' => 202
                );
            } else {
                $dealsdata = array(
                    'title' => $name,
                    'person_id' => $exitspersonid,
                    '1f3fcc80ae3376dca0538aab3d34396df6258af2a32' => $eventstarttime,
                    'e43e29f4ddbd3cd426dec9aefe99a283435dec0d227' => $duration,
                    '82902a1626aa2dee54ae3e8879b811b434391183107' => 202
                );
            }
            $dealupdate = json_decode($objPipedrive->updateDeal($dealid, $dealsdata));
            $mydealid = $dealid;
            $objPipedrive->createDealNote($dealid, $content);
        } else {
            $dealsdata = array(
                'title' => $name,
                'person_id' => $exitspersonid,
                '1f3fcc80ae3376dca0538aab3d96343df6258af2a32' => $eventstarttime,
                'e43e29f4ddbd3cd426dec9aefe99a285343dec0d227' => $duration,
                '82902a1626aa2dee54ae3e8879b811b493431183107' => 202,
                'pipeline_id' => 20,
                'stage_id' => 129
    
            );
            $dealcreate = json_decode($objPipedrive->createDeal($dealsdata));
            $mydealid = $dealcreate->data->id;
            $objPipedrive->createDealNote($mydealid, $content);
        }
    } else {
        $persondata = array(
            'name' => $name,
            'email' => $email,
            '58ecd6cd080bcac2fab7402f7356913445a02ec963' => $timezone,
            'dfa04ac838025d8b28f115efaae4db3d3432c81b4c3' => $sharemetting
        );
        $newperson = json_decode($objPipedrive->createPerson($persondata));
        $personid = $newperson->data->id;
        $dealsdata = array(
            'title' => $name,
            'person_id' => $personid,
            '1f3fcc80ae3376dca0538aab3433d96df6258af2a32' => $eventstarttime,
            'e43e29f4ddbd3cd426dec9aefe99a23485dec0d227' => $duration,
            '82902a1626aa2dee54ae3e8879b811b34491183107' => 202,
            'pipeline_id' => 20,
            'stage_id' => 120
        );
        $dealcreate = json_decode($objPipedrive->createDeal($dealsdata));
        $mydealid = $dealcreate->data->id;
        $objPipedrive->createDealNote($mydealid, $content);
    }
?>