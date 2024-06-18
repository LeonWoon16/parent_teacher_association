<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Hash;
use App\Models\UsersModel;
use App\Models\ParentModel;

class Auth extends Controller {


        public function __construct(){
                helper(['url','form']);
        }

        public function index()
        {
                return view('auth/login');
        }

        public function register()
        {
                return view('auth/choose');
        }

        public function loginTeacher()
        {
                return view('auth/loginTeacher');
        }

        public function loginAdmin()
        {
                return view('auth/loginAdmin');
        }

        // public function register()
        // {
        //         return view('auth/register'); //direct to register teacher
        // }

        public function registerParent()
        {
                return view('auth/registerParent');
        }

        public function registerTeacher()
        {
                return view('auth/register');
        }

        public function save(){   //insert teacher data into database

                // $validation = $this->validate([
                //  'name'=>'required',
                //  'email'=>'required|valid_email|is_unique[tbl_teacher.fld_email]',
                //  'password'=>'required|min_length[5]|max_length[12]',
                //  'cpassword'=>'required|min_length[5]|max_length[12]|matches[password]',

                // ]);

                // validate the data insert is in the correct format

                $validation = $this->validate([
                        'name'=>[
                                'rules'=>'required',
                                'errors'=>['required'=>'Your full name is required']
                                ],
                        'password'=>[
                                'rules'=>'required|min_length[5]|max_length[12]',
                                'errors'=>['required'=>'Password is required',
                                           'min_length'=>'Password must have at least 5 characters in length',
                                           'max_length'=>'Password must not have characters more than 12 in length']
                                ],
                        'cpassword'=>[
                                'rules'=>'required|min_length[5]|max_length[12]|matches[password]',
                                'errors'=>['required'=>'Confirm password is required',
                                           'min_length'=>'Confirm password must have at least 5 characters in length',
                                           'max_length'=>'Confirm password must not have characters more than 12 in length',
                                           'matches'=>'Confirm password not matches with Password']
                                ],
                        'email'=>[
                                'rules'=>'required|valid_email|is_unique[tbl_teacher.fld_email]',
                                'errors'=>['required'=>'Email is required',
                                           'valid_email'=>'You must enter a valid email',
                                           'is_unique'=>'Email already taken']
                                ],
                        'phone' => [
                                'rules' => 'required|regex_match[/^[0-9]{10,11}$/]',
                                'errors' => ['required' => 'Phone number is required',
                                             'regex_match' => 'Phone number must be a 10 or 11-digit number']
                                ],
                        'address'=>[
                                'rules'=>'required',
                                'errors'=>['required'=>'Your full address is required']
                                ],
                        'dob'=>[
                                'rules'=>'required',
                                'errors'=>['required'=>'Your date of birth is required']
                                ]
                ]);

                if(!$validation){
                        // return view('auth/registerTeacher',['validation'=>$this->validator]);
                        return view('auth/register',['validation'=>$this->validator]);
                }else{
                        //echo 'Form validated successfully';
                        $name = $this->request->getPost('name');
                        $email = $this->request->getPost('email');
                        $password = $this->request->getPost('password');
                        $phone = $this->request->getPost('phone');
                        $role = $this->request->getPost('role');
                        $address = $this->request->getPost('address');
                        $dob = $this->request->getPost('dob');

                        $values=[
                        'fld_role'=>$role,
                        'fld_name'=>$name,
                        'fld_email'=>$email,
                        'fld_password'=>$password,
                        'fld_phone'=>$phone,
                        'fld_address'=>$address,
                        'fld_dob'=>$dob,
                        ];

                        $usersModel = new \App\Models\UsersModel();
                        $query = $usersModel->insert($values);
                        if(!$query){
                                return redirect()->back()->with('fail','Something went wrong');
                                return redirect()->to('auth/registerTeacher')->with('fail','Something went wrong');

                        }else{
                                return redirect()->to('auth/registerTeacher')->with('success','You are successfully registered');

                        }
                }

        }

        public function saveParent(){   //insert parent into database
   
                $validation = $this->validate([
                        'name'=>[
                                'rules'=>'required',
                                'errors'=>['required'=>'Your full name is required']
                                ],
                        'password'=>[
                                'rules'=>'required|min_length[5]|max_length[12]',
                                'errors'=>['required'=>'Password is required',
                                           'min_length'=>'Password must have at least 5 characters in length',
                                           'max_length'=>'Password must not have characters more than 12 in length']
                                ],
                        'cpassword'=>[
                                'rules'=>'required|min_length[5]|max_length[12]|matches[password]',
                                'errors'=>['required'=>'Confirm password is required',
                                           'min_length'=>'Confirm password must have at least 5 characters in length',
                                           'max_length'=>'Confirm password must not have characters more than 12 in length',
                                           'matches'=>'Confirm password not matches with Password']
                                ],
                        'email'=>[
                                'rules'=>'required|valid_email|is_unique[tbl_teacher.fld_email]',
                                'errors'=>['required'=>'Email is required',
                                           'valid_email'=>'You must enter a valid email',
                                           'is_unique'=>'Email already taken']
                                ],
                        'phone' => [
                                'rules' => 'required|regex_match[/^[0-9]{10,11}$/]',
                                'errors' => ['required' => 'Phone number is required',
                                             'regex_match' => 'Phone number must be a 10 or 11-digit number']
                                ],
                        'address'=>[
                                'rules'=>'required',
                                'errors'=>['required'=>'Your full address is required']
                                ],
                        'dob'=>[
                                'rules'=>'required',
                                'errors'=>['required'=>'Your date of birth is required']
                                ],
                        'income' => [
                                'rules' => 'required|numeric',
                                'errors' => [
                                    'required' => 'Income is required',
                                    'numeric' => 'Income should only contain digits']
                            ],


                ]);
                
                if(!$validation){
                        return view('auth/registerParent',['validation'=>$this->validator]);
                }else{
                        //echo 'Form validated successfully';
                        $name = $this->request->getPost('name');
                        $email = $this->request->getPost('email');
                        $password = $this->request->getPost('password');
                        $phone = $this->request->getPost('phone');
                        $role = $this->request->getPost('role');
                        $address = $this->request->getPost('address');
                        $dob = $this->request->getPost('dob');
                        $income = $this->request->getPost('income');

                        $values=[
                        'fld_role'=>$role,
                        'fld_name'=>$name,
                        'fld_email'=>$email,
                        'fld_password'=>$password,
                        'fld_phone'=>$phone,
                        'fld_address'=>$address,
                        'fld_dob'=>$dob,
                        'fld_income'=>$income,
                        ];

                        $usersModel = new \App\Models\ParentModel();
                        $query = $usersModel->insert($values);
                        if(!$query){
                                return redirect()->back()->with('fail','Something went wrong');
                                return redirect()->to('auth/registerParent')->with('fail','Something went wrong');

                        }else{
                                return redirect()->to('auth/registerParent')->with('success','You are successfully registered');

                        }
                }

        }

        function check(){   //login for teacher

                $validation = $this->validate([
                        'email'=>[
                                'rules'=>'required|valid_email|is_not_unique[tbl_teacher.fld_email]',
                                'errors'=>[
                                        'required'=>'Email is required',
                                        'valid_email'=>'Enter a valid email address',
                                        'is_not_unique'=>'This email is not registered'
                                ]
                                ],
                        'password'=>[
                                'rules'=>'required|min_length[5]|max_length[12]',
                                'errors'=>[
                                        'required'=>'Password is required',
                                        'min_length'=>'Password must have at least 5 characters in length',
                                        'max_length'=>'Password must not have characters more than 12 in length'
                                ]
                                ]
                ]);


                if(!$validation){
                        return view('auth/loginTeacher',['validation'=>$this->validator]);
                }else{

                        $email = $this->request->getPost('email');
                        $password = $this->request->getPost('password');
                        $usersModel = new \App\Models\UsersModel();
                        $user_info = $usersModel->where('fld_email',$email)->first();
                        $check_password = Hash::check($password, $user_info['fld_password']);

                        if(!$check_password){
                                session()->setFlashdata('fail','Incorrect password');
                                return redirect()->to('/auth/loginTeacher')->withInput();
                        }else{
                                $user_id = $user_info['fld_id'];
                                session()->set('loggedUser', $user_id);
                                // return redirect()->to('/dashboard');
                                return redirect()->to('/teachercontroller');
                                // return redirect()->to('/usercontroller');
                        }
                }

                }

                function checkParent(){   //login for parent

                        $validation = $this->validate([
                                'email'=>[
                                        'rules'=>'required|valid_email|is_not_unique[tbl_parent.fld_email]',
                                        'errors'=>[
                                                'required'=>'Email is required',
                                                'valid_email'=>'Enter a valid email address',
                                                'is_not_unique'=>'This email is not registered'
                                        ]
                                        ],
                                'password'=>[
                                        'rules'=>'required|min_length[5]|max_length[12]',
                                        'errors'=>[
                                                'required'=>'Password is required',
                                                'min_length'=>'Password must have at least 5 characters in length',
                                                'max_length'=>'Password must not have characters more than 12 in length'
                                        ]
                                        ]
                        ]);
        
        
                        if(!$validation){
                                return view('auth/login',['validation'=>$this->validator]);
                        }else{
        
                                $email = $this->request->getPost('email');
                                $password = $this->request->getPost('password');
                                $usersModel = new \App\Models\ParentModel();
                                $user_info = $usersModel->where('fld_email',$email)->first();
                                $check_password = Hash::check($password, $user_info['fld_password']);
        
                                if(!$check_password){
                                        session()->setFlashdata('fail','Incorrect password');
                                        return redirect()->to('/auth')->withInput();
                                }else{
                                        $user_id = $user_info['fld_id'];
                                        session()->set('loggedUser', $user_id);
                                        return redirect()->to('/usercontroller');
                                }
                        }
        
                        }

                        function checkAdmin(){   //login for admin

                                $validation = $this->validate([
                                        'email'=>[
                                                'rules'=>'required|valid_email|is_not_unique[tbl_admin.fld_email]',
                                                'errors'=>[
                                                        'required'=>'Email is required',
                                                        'valid_email'=>'Enter a valid email address',
                                                        'is_not_unique'=>'This email is not registered'
                                                ]
                                                ],
                                        'password'=>[
                                                'rules'=>'required|min_length[5]|max_length[12]',
                                                'errors'=>[
                                                        'required'=>'Password is required',
                                                        'min_length'=>'Password must have at least 5 characters in length',
                                                        'max_length'=>'Password must not have characters more than 12 in length'
                                                ]
                                                ]
                                ]);
                
                
                                if(!$validation){
                                        return view('auth/login',['validation'=>$this->validator]);
                                }else{
                
                                        $email = $this->request->getPost('email');
                                        $password = $this->request->getPost('password');
                                        $usersModel = new \App\Models\AdminModel();
                                        $user_info = $usersModel->where('fld_email',$email)->first();
                                        $check_password = Hash::check($password, $user_info['fld_password']);
                
                                        if(!$check_password){
                                                session()->setFlashdata('fail','Incorrect password');
                                                return redirect()->to('/auth')->withInput();
                                        }else{
                                                $user_id = $user_info['fld_id'];
                                                session()->set('loggedUser', $user_id);
                                                return redirect()->to('/admincontroller');
                                        }
                                }
                
                                }
        }
