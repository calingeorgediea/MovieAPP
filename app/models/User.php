<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
    public $name;
    public $timestamps = [];
    protected $fillable = ['username', 'email'];
    public function get_users(){
        foreach (User::all() as $user) {
            print_r($user->username);
        }
    }
    public function check_user($email) {
        if( User::where('email', '=', $email)->exists()) {
            return '1';
        } else {
            return '0';
        }
    }
    public function find_user($email, $username) {
        if ($email) {
            return User::where('email', '=', $email)->firstOrFail();
        } elseif ($username) {
            return User::where('username', '=', $username)->firstOrFail();
        } else {
            return 0;
        }
    }
    public function delete_user($email) {
        if(User::where('email', '=', $email)->exists()){
            print_r("Succesfully deleted");
            return User::where('email', '=', $email)->delete();
        } else {
            print_r("Record not found");
        }
    }
}

?>
