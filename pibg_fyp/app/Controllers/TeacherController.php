<?php namespace App\Controllers;

use App\Models\UsersModel;

class TeacherController extends BaseController
{

    public function index()
    {
        $parentModel = new \App\Models\ParentModel();  //parents
        $parentInfo = $parentModel->findAll();

        // $teacherModel = new \App\Models\UsersModel(); // teachers
        // $teacherInfo = $teacherModel->findAll();
        // $totalTeacher = count($teacherInfo);

        $studentModel = new \App\Models\StudentModel(); // show all students  
        $studentInfo = $studentModel->findAll();
        $totalStudent = count($studentInfo);

        $resultModel = new \App\Models\ResultModel();  //children results
        $resultInfo = $resultModel->findAll();

        $crowdfundingModel = new \App\Models\CrowdfundingModel();  //children results
        $crowdfundingInfo = $crowdfundingModel->findAll();

        $activityModel = new \App\Models\ActivityModel();  // all activities
        $activityInfo = $activityModel->findAll();
        $totalActivity = count($activityInfo);

        $teacherModel = new \App\Models\UsersModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $teacherModel->find($loggedUserID);

        $totalSum = 0; // Variable to store the total sum

            foreach ($crowdfundingInfo as $crowdfunding) {
                $totalSum += $crowdfunding['fld_money'];
            }

        $classCounts = array();

            foreach ($studentInfo as $student) {
                $classType = $student['fld_class'];
                
                if (array_key_exists($classType, $classCounts)) {
                    $classCounts[$classType]++;
                } else {
                    $classCounts[$classType] = 1;
                }
            }

            $count = count($classCounts);

        $dataInfo = [
            'userInfo'=>$userInfo,
            'parentInfo'=>$parentInfo,
            'studentInfo'=>$studentInfo,
            'resultInfo'=>$resultInfo,
            'activityInfo'=>$activityInfo,
            'totalStudent' => $totalStudent,
            'totalActivity' => $totalActivity,
            'totalSum'=> $totalSum,
            'count'=>$count
        ];
        $data['pageTitle'] = 'Home';

        $data = array_merge($data, $dataInfo);
        return view('dashboard/homeTeacher', $data);

    }

    public function profile()
    {
        $teacherModel = new \App\Models\UsersModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $teacherModel->find($loggedUserID);
        $dataInfo = [
            'userInfo'=>$userInfo
        ];
        $data['pageTitle'] = 'Profile';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/profileTeacher',$data);
    }

    public function activity()
    {

        $activityModel = new \App\Models\ActivityModel();
        $data['activities'] = $activityModel->findAll();

        $participantModel = new \App\Models\ParticipantModel();
        $participantInfo = $participantModel->findAll();

        $teacherModel = new \App\Models\UsersModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $teacherModel->find($loggedUserID);
        $dataInfo = [
            'userInfo'=>$userInfo,
            'participants'=>$participantInfo
        ];
        $data['pageTitle'] = 'Activity';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/activityTeacher',$data);
    }

    public function class()
        {
            $studentModel = new \App\Models\StudentModel();
            $resultModel = new \App\Models\ResultModel();
            $teacherModel = new \App\Models\UsersModel();

            $loggedUserID = session()->get('loggedUser');
            $userInfo = $teacherModel->find($loggedUserID);

            // Get the selected class from the request
            $selectedClass = $this->request->getVar('class');

            // Fetch all students or students from the selected class
            if ($selectedClass) {
                $studentInfo = $studentModel->where('fld_class', $selectedClass)->findAll();
            } else {
                $studentInfo = $studentModel->findAll();
            }

            $resultInfo = $resultModel->findAll();

            $dataInfo = [
                'userInfo' => $userInfo,
                'resultInfo' => $resultInfo,
                'studentInfo' => $studentInfo
            ];

            $data['pageTitle'] = 'Class';
            $data = array_merge($data, $dataInfo);
            
            return view('dashboard/classTeacher', $data);
        }

    // public function participants()
    // {
    //     $teacherModel = new \App\Models\UsersModel();
    //     $loggedUserID = session()->get('loggedUser');
    //     $userInfo = $teacherModel->find($loggedUserID);
    //     $dataInfo = [
    //         'userInfo'=>$userInfo
    //     ];
    //     $data['pageTitle'] = 'Participants';
    //     $data = array_merge($data, $dataInfo);
    //     return view('teacher/participants',$data);
    // }

    public function result()
    {
        $studentModel = new \App\Models\StudentModel();
        $studentInfo = $studentModel->findAll();

        $resultModel = new \App\Models\ResultModel();
        $resultInfo = $resultModel->findAll();

        $teacherModel = new \App\Models\UsersModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $teacherModel->find($loggedUserID);
        $dataInfo = [
            'userInfo'=>$userInfo,
            'resultInfo'=>$resultInfo,
            'studentInfo'=>$studentInfo
        ];
        $data['pageTitle'] = 'Result';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/resultTeacher',$data);

    }

    public function saveResult()
    {
        $resultModel = new \App\Models\ResultModel();

        $student_id = $this->request->getPost('student_id');
        $type = $this->request->getPost('result_type');
        $description = $this->request->getPost('description');
        $malay = $this->request->getPost('malay');
        $english = $this->request->getPost('english');
        $history = $this->request->getPost('history');
        $science = $this->request->getPost('science');
        $maths = $this->request->getPost('maths');

        $existingResult = $resultModel->where('fld_id', $student_id)->where('fld_type', $type)->first();
        if ($existingResult) {
            return redirect()->to('teacher/result')->with('fail', 'Result for this type already exists.');
        }

        $totalMarks = $malay + $english + $history + $science + $maths;

        $data = [
            'fld_id' => $student_id,
            'fld_type' => $type,
            'fld_description' => $description,
            'fld_bm' => $malay,
            'fld_bi' => $english,
            'fld_history' => $history,
            'fld_science' => $science,
            'fld_maths' => $maths,
            'fld_marks' => $totalMarks,
        ];

        $resultModel->insert($data);

        return redirect()->to('teacher/result')->with('success', 'Result has been added successfully.');
    }


    public function updateResult($resultId)
    {

    // Retrieve the form data
    $type = $this->request->getPost('type');
    $malay = $this->request->getPost('malay');
    $science = $this->request->getPost('science');
    $maths = $this->request->getPost('maths');
    $history = $this->request->getPost('history');
    $english = $this->request->getPost('english');
    $description = $this->request->getPost('description');

    $totalMarks = $malay + $english + $history + $science + $maths;

    // Update the result in the database
    $resultModel = new \App\Models\ResultModel();
    $resultModel->update($resultId, [
        'fld_type' => $type,
        'fld_bm' => $malay,
        'fld_science' => $science,
        'fld_maths' => $maths,
        'fld_history' => $history,
        'fld_bi' => $english,
        'fld_description' => $description,
        'fld_marks' => $totalMarks,
    ]);

    // Redirect or display a success message
    return redirect()->to('teacher/result')->with('success', 'Result has been updated successfully.');

    }

    public function delete($resultId)
    {
        $resultModel = new \App\Models\ResultModel();
        $resultModel->delete($resultId);
        return redirect()->to('teacher/result')->with('fail', 'Result has been deleted successfully.');
    }

    public function crowdfunding()
    {
        $crowdfundingModel = new \App\Models\CrowdfundingModel();  //children results
        $crowdfundingInfo = $crowdfundingModel->findAll();

        $parentModel = new \App\Models\ParentModel();  //parents
        $parentInfo = $parentModel->findAll();

        $activityModel = new \App\Models\ActivityModel();  // all activities
        $activityInfo = $activityModel->findAll();
        $totalActivity = count($activityInfo);

        $teacherModel = new \App\Models\UsersModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $teacherModel->find($loggedUserID);

        $totalSum = 0; // Variable to store the total sum

        foreach ($crowdfundingInfo as $crowdfunding) {
            $totalSum += $crowdfunding['fld_money'];
        }

        $dataInfo = [
            'userInfo'=>$userInfo,
            'crowdfundingInfo'=>$crowdfundingInfo,
            'activityInfo'=>$activityInfo,
            'parentInfo'=>$parentInfo,
            'totalSum'=>$totalSum,
            'totalActivity'=>$totalActivity

        ];
        $data['pageTitle'] = 'Crowd Funding';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/crowdfundingTeacher',$data);
    }

    public function viewStudent()
    {

        $studentModel = new \App\Models\StudentModel();
        $studentInfo = $studentModel->findAll();

        $parentModel = new \App\Models\ParentModel();
        $parentInfo = $parentModel->findAll();

        $teacherModel = new \App\Models\UsersModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $teacherModel->find($loggedUserID);
        $dataInfo = [
            'userInfo'=>$userInfo,
            'parentInfo'=>$parentInfo,
            'studentInfo'=>$studentInfo
        ];
        $data['pageTitle'] = 'Students and Parents';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/viewStudent',$data);
    }


    public function logout()
    {
        // Destroy session data
        session()->destroy();

        // Set cache control header to prevent page caching
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');

        // Redirect to login page
        return redirect()->to(base_url('login').'?token='.md5(uniqid(rand(), true)));
        // return redirect()->to('login');
    }


    public function updateProfile()
    {
    // Retrieve form input data
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'cpassword' => $this->request->getPost('cpassword'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'dob' => $this->request->getPost('dob')
        ];

        //Validate the input data
        $validationRules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'cpassword' => 'required|matches[password]',
            'phone' => 'required',
            'address' => 'required',
            'dob' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed, return an error message or redirect back to the edit form
            return redirect()->back()->with('fail','Something went wrong');
        }

        // Get the current user's profile data from the database
        $userId = session()->get('loggedUser');
        $userModel = new \App\Models\UsersModel();
        $profile = $userModel->find($userId);

        // Update the relevant fields
        $updatedProfile = [
            'fld_name' => $data['name'],
            'fld_email' => $data['email'],
            'fld_phone' => $data['phone'],
            'fld_address' => $data['address'],
            'fld_dob' => $data['dob']
        ];

        // Update the password if it is not empty
        if (!empty($data['password'])) {
            $updatedProfile['fld_password'] = $data['password'];
        }

        // Save the updated profile data back to the database
        $userModel->update($userId, $updatedProfile);

        // Pass the complete data array to the view
        $dataInfo = [
            'userInfo' => $updatedProfile
        ];
        $data['pageTitle'] = 'Profile';
        $data = array_merge($data, $dataInfo);

        // Redirect to the profile page with a success message
        return redirect()->to('teachercontroller/profile')->with('success', 'Profile updated successfully');
    }

    

}