<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

    public function view($page = 'home')
    {

        $data['title'] = 'Connect to Email';

        $this->load->view('templates/header');
        $this->load->view('pages/' . $page,$data);
        $this->load->view('templates/footer');
    }

    

    public function connect()
    {


        $this->form_validation->set_rules('email', 'Email',  'required|valid_email|htmlspecialchars');
        $this->form_validation->set_rules('password', 'Password', 'required|htmlspecialchars');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Connect to Email';

            $this->load->view('templates/header');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Emails';


            $server = '{imap.gmail.com:993/imap/ssl}INBOX';
            $username = $this->input->post('email');
            $password = $this->input->post('password') ?: 'bqmxbkevybxhtaea';
            $number = $this->input->post('number') ?: 5;

            // echo $username,$password,$number;
            // die();

            // Connect to Gmail account using IMAP
            $imap = imap_open($server, $username, $password) or die('Cannot connect to email: ' . imap_last_error());

            // Check if the connection is successful
            if ($imap) {

                $detailsArray=array();
                $numMessages = imap_num_msg($imap);
                for ($i = $numMessages; $i > ($numMessages - $number); $i--) {
                    $header = imap_headerinfo($imap, $i);

                    $fromInfo = $header->from[0];
                    $replyInfo = $header->reply_to[0];
                    $details = array(
                        "fromAddr" => (isset($fromInfo->mailbox) && isset($fromInfo->host))
                            ? $fromInfo->mailbox . "@" . $fromInfo->host : "",
                        "fromName" => (isset($fromInfo->personal))
                            ? $fromInfo->personal : "",
                        "replyAddr" => (isset($replyInfo->mailbox) && isset($replyInfo->host))
                            ? $replyInfo->mailbox . "@" . $replyInfo->host : "",
                        "replyName" => (isset($replyInfo->personal))
                            ? $replyInfo->personal : "",
                        "subject" => (isset($header->subject))
                            ? imap_utf8($header->subject) : "",
                        "udate" => (isset($header->udate))
                            ? $header->udate : ""
                    );

                    $uid = imap_uid($imap, $i);

                    $body = get_body($uid, $imap);
                    $details['body']=$body;

                    $detailsArray=[...$detailsArray,$details];

                }

                $data['details']=$detailsArray;
               


                // Close the IMAP connection when done
                imap_close($imap);
            } else {
                // Connection failed. Handle the error.
                echo "Failed to connect to Gmail account.";
            }

            $this->load->view('templates/header');
            $this->load->view('pages/emails', $data);
            $this->load->view('templates/footer');
        }

    }
}
