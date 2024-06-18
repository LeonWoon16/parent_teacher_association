<?php namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ParentModel;
use App\Models\UsersModel;
use App\Models\StudentModel;

class AdminController extends BaseController
{

    protected $parentModel;
    protected $studentModel;

    public function __construct()
    {
        $this->parentModel = new \App\Models\ParentModel();
        $this->studentModel = new \App\Models\StudentModel();
    }

    public function index()
    {

        $studentModel = new \App\Models\StudentModel();
        $studentInfo = $studentModel->findAll();
        $totalStudent = count($studentInfo);
        $totalAssign = 0;
        $totalUnassign = 0;

        foreach ($studentInfo as $student) {
            if ($student['fld_status'] === 'Assigned') {
                $totalAssign++;
            }
        }

        foreach ($studentInfo as $student) {
            if ($student['fld_status'] === 'Unassigned') {
                $totalUnassign++;
            }
        }

        $parentModel = new \App\Models\ParentModel();
        $parentInfo = $parentModel->findAll();
        $totalParent = count($parentInfo);

        $teacherModel = new \App\Models\UsersModel();
        $teacherInfo = $teacherModel->findAll();
        $totalTeacher = count($teacherInfo);

        $crowdfundingModel = new \App\Models\CrowdfundingModel();  //children results
        $crowdfundingInfo = $crowdfundingModel->findAll();

        $resultModel = new \App\Models\ResultModel();
        $resultInfo = $resultModel->findAll();

        $activityModel = new \App\Models\ActivityModel();
        $activityInfo = $activityModel->findAll();
        $totalActivity = count($activityInfo);

        $adminModel = new \App\Models\AdminModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $adminModel->find($loggedUserID);

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
            'totalParent' => $totalParent,
            'totalTeacher' => $totalTeacher,
            'totalActivity' => $totalActivity,
            'totalSum'=> $totalSum,
            'count'=>$count,
            'assign'=>$totalAssign,
            'unassign'=>$totalUnassign
        ];
        $data['pageTitle'] = 'Home';

        $data = array_merge($data, $dataInfo);
        return view('dashboard/homeAdmin', $data);

    }

    public function profile()
    {

        $studentModel = new \App\Models\StudentModel();
        $studentInfo = $studentModel->findAll();

        $parentModel = new \App\Models\ParentModel();
        $parentInfo = $parentModel->findAll();

        $adminModel = new \App\Models\AdminModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $adminModel->find($loggedUserID);

        $teacherModel = new \App\Models\UsersModel();
        $teacherInfo = $teacherModel->findAll();

        $dataInfo = [
            'userInfo'=>$userInfo,
            'teacherInfo'=>$teacherInfo,
            'parentInfo'=>$parentInfo,
            'studentInfo'=>$studentInfo
        ];
        $data['pageTitle'] = 'Profile';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/profileAdmin',$data);
    }

    public function activity()
    {
        $activityModel = new \App\Models\ActivityModel();
        $data['activities'] = $activityModel->findAll();

        $participantModel = new \App\Models\ParticipantModel();
        $participantInfo = $participantModel->findAll();

        $adminModel = new \App\Models\AdminModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $adminModel->find($loggedUserID);
        $dataInfo = [
            'userInfo'=>$userInfo,
            'participants'=>$participantInfo
        ];
        $data['pageTitle'] = 'Activity';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/activityAdmin',$data);
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

        $adminModel = new \App\Models\AdminModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $adminModel->find($loggedUserID);

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
        return view('dashboard/crowdfundingAdmin',$data);
    }

    public function assign()
    {

        $studentModel = new \App\Models\StudentModel();
        $studentInfo = $studentModel->findAll();

        $parentModel = new \App\Models\ParentModel();
        $parentInfo = $parentModel->findAll();

        $adminModel = new \App\Models\AdminModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $adminModel->find($loggedUserID);
        $dataInfo = [
            'userInfo'=>$userInfo,
            'parentInfo'=>$parentInfo,
            'studentInfo'=>$studentInfo
        ];
        $data['pageTitle'] = 'Assign Student';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/assign',$data);
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

    public function assignChildren()
    {
    // Retrieve selected children and parent names from the form submission
    $selectedChildren = $this->request->getVar('children');
    $parentNames = $this->request->getVar('parent_id');

    // Load the model to access the student information
    $studentModel = new \App\Models\StudentModel();
    $parentModel = new \App\Models\ParentModel();
    $studentInfo = $studentModel->findAll();
    $parentInfo = $parentModel->findAll();

    foreach ($studentInfo as &$student) {
        if (in_array($student['fld_id'], $selectedChildren)) {
            $childId = $student['fld_id'];

            $parentId = $this->request->getPost('parent_id');

            $parentName = $parentModel->find($parentId)['fld_name'];
            $student['fld_parent'] = $parentName;

            if (!empty($parentId)) {
                $parentName = $parentModel->find($parentId)['fld_name'];
                $student['fld_parent'] = $parentName;
                $student['fld_status'] = "Assigned";
                $student['fld_pid'] = $parentId; // Assign parent ID to fld_pid field
            } else {
                $student['fld_parent'] = null;
                $student['fld_status'] = "Unassigned";
            }

            // Update the student's database record
            $studentModel->update($childId, $student);
        } 
    }

    $adminModel = new \App\Models\AdminModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $adminModel->find($loggedUserID);
        $data= [
            'userInfo'=>$userInfo,
            'parentInfo'=>$parentInfo,
            'studentInfo'=>$studentInfo
        ];
    
    // Redirect or display a success message
    return view('dashboard/assign', $data);

        }

        public function result()
        {
            $studentModel = new \App\Models\StudentModel();
            $studentInfo = $studentModel->findAll();
    
            $resultModel = new \App\Models\ResultModel();
            $resultInfo = $resultModel->findAll();
    
            $adminModel = new \App\Models\AdminModel();
            $loggedUserID = session()->get('loggedUser');
            $userInfo = $adminModel->find($loggedUserID);
            $dataInfo = [
                'userInfo'=>$userInfo,
                'resultInfo'=>$resultInfo,
                'studentInfo'=>$studentInfo
            ];
            $data['pageTitle'] = 'Result';
            $data = array_merge($data, $dataInfo);
            return view('dashboard/resultAdmin',$data);
    
        }

        public function class()
        {
            $studentModel = new \App\Models\StudentModel();
            $resultModel = new \App\Models\ResultModel();
            $adminModel = new \App\Models\AdminModel();

            $loggedUserID = session()->get('loggedUser');
            $userInfo = $adminModel->find($loggedUserID);

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
            
            return view('dashboard/classAdmin', $data);
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
            return redirect()->to('admin/result')->with('fail', 'Result for this type already exists.');
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
    
        return redirect()->to('admin/result')->with('success', 'Result has been added successfully.');
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
        return redirect()->to('admin/result')->with('success', 'Result has been updated successfully.');
    
        }
    
        public function delete($resultId)
        {
            $resultModel = new \App\Models\ResultModel();
            $resultModel->delete($resultId);
            return redirect()->to('admin/result')->with('fail', 'Result has been deleted successfully.');
        }

    }

