<?php



class Contact {

    public function action_index() {
    
    }

    /*
     ***************************************************************************
     * the functions below will only be called by AJAX. So will be treated as such
     */
    public function action_Process() {
        $errors = $this->validateFormData($this->mail->validate->get($this->request->post()));

        if(!empty($errors)) {
            $this->response->body = json_encode($errors);
            $this->execute = false;
        } else {
           $this->sendFormEmail($this->request->post());

            $this->response->body = json_encode(array("status"=>"success"));
            $this->execute = false;
        }
    }

    protected function validateFormData($formValidate) {
        $formValidate->field('name')->rule('filled')->error("Name must be given.");

        $formValidate->field('email')->rule('filled')->error("Email must be given.");
        $formValidate->field('email',true)->rule('email')->error("Invalid email address given.");

        $formValidate->field('phone')->rule('filled')->error("Phone number must be given.");
        $formValidate->field('phone',true)->rule('phone')->error("Invalid phone number given.");

        $formValidate->field('comments')->rule('filled')->error("Comments cannot be empty.");
        if($this->request->post("subject"))
          $formValidate->field('subject')->rule('filled')->error("Subject cannot be empty.");

        return $formValidate->errors();
    }

    protected function sendFormEmail($data){

        $message  = "Contact form from ".$data['currentpage']."\n\n";
        $message .= "Message received from contact form\n\n";
        $message .= "Name: " . $data['name'] . "\n";
        $message .= "Email: " . $data['email'] . "\n";
        $message .= "Phone: " . $data['phone'] . "\n\n";
        $message .= $data['comments'];

        mail("info@safetyfirstds.com",$data['email'],"Contact Form Submission Received",$message);
    }

  

}
