<?php

function jsonify_reponse( $response ){
    $response=str_replace('},
    ]',"}]",$response);
    return json_decode($response);
}

class home extends Controller {

    protected $user;
    public function __construct(){
        $this->movie = $this->model('movie');
    }

    public function index($name = '') {
        $this->view('/home/index', ['name' => $user->name]);
    }

    public function user() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $body = file_get_contents('php://input');
            $body = jsonify_reponse($body);
            if($this->user->check_user($body->email) == "1") {
                print_r("Already registered email");
            } else {
                User::create([
                    'username' => $body->username,
                    'email' => $body->email
                ]);
                print_r("Succesfully registered");
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $body = file_get_contents('php://input');
            $body = jsonify_reponse($body);
            if($body->email) {
                print_r($this->user->find_user($body->email, '')['username']);
            }
            elseif($body->username) {
                print_r($this->user->find_user('', $body->mail)['email']);
            }
            else {
                print_r("User not found");
                return 0;
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $body = file_get_contents('php://input');
            $body = jsonify_reponse($body);
            $this->user->delete_user($body->email);
        }
        if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
            $body = file_get_contents('php://input');
            $body = jsonify_reponse($body);
            if($this->user->check_user($body->oldMail) == "1") {
                User::where('email', $body->oldMail)->update(['email'=>$body->newMail]);
                print_r("Succesfully updated");
            } else {
                print_r("Could not find user");
            }
        }
    }

    public function find($mail) {
        print_r($this->user->find_user($mail)['username']);
    }

    public function create($username = '', $email= '') {
        /** :: este Scope Resolution Operator, il utilizez cand am nevoie sa accesez constante,propietati si metode la nivel de clasa */
       User::create([
            'username' => $username,
            'email' => $email
        ]);
    }
    public function echo() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            print_r("ok");
        }

        /** :: este Scope Resolution Operator, il utilizez cand am nevoie sa accesez constante,propietati si metode la nivel de clasa */
        print_r('ok');
    }
}