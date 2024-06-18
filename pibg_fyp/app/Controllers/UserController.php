<?php namespace App\Controllers;

use App\Models\ParentModel;
use App\Models\UsersModel;
use App\Models\ActivityModel;
use App\Models\ResultModel;
use App\Models\CrowdfundingModel;
use App\Models\StudentModel;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Dompdf\Dompdf;

class UserController extends BaseController
{

    public function index()
    {
        

        // $parentModel = new \App\Models\ParentModel();  //parents
        // $parentInfo = $parentModel->findAll();

        $teacherModel = new \App\Models\UsersModel(); // teachers
        $teacherInfo = $teacherModel->findAll();
        $totalTeacher = count($teacherInfo);

        $resultModel = new \App\Models\ResultModel();  //children results
        $resultInfo = $resultModel->findAll();

        $crowdfundingModel = new \App\Models\CrowdfundingModel();  //children results
        $crowdfundingInfo = $crowdfundingModel->findAll();

        $activityModel = new \App\Models\ActivityModel();  // all activities
        $activityInfo = $activityModel->findAll();
        $totalActivity = count($activityInfo);

        $parentModel = new \App\Models\ParentModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);

        $studentModel = new \App\Models\StudentModel(); // show all students  
        $studentInfo = $studentModel->where('fld_pid', $loggedUserID)->findAll();
        $totalChildren = count($studentInfo);

        $totalMoney = 0;

        foreach ($crowdfundingInfo as $crowdfunding) {
            if ($crowdfunding['fld_pid'] === $loggedUserID) {
                $totalMoney += $crowdfunding['fld_money'];
            }
        }


        $dataInfo = [
            'userInfo'=>$userInfo,
            //'parentInfo'=>$parentInfo,
            'studentInfo'=>$studentInfo,
            'resultInfo'=>$resultInfo,
            'activityInfo'=>$activityInfo,
            'totalChildren' => $totalChildren,
            'totalTeacher' => $totalTeacher,
            'totalActivity' => $totalActivity,
            'totalMoney'=> $totalMoney
        ];
        $data['pageTitle'] = 'Home';

        $data = array_merge($data, $dataInfo);
        return view('dashboard/home', $data);

    }

    public function profile()
    {
        $parentModel = new \App\Models\ParentModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);
        $dataInfo = [
            'userInfo'=>$userInfo
        ];
        $data['pageTitle'] = 'Edit Profile';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/profile',$data);
    }


    public function activity()
    {
        $activityModel = new \App\Models\ActivityModel();
        $data['activities'] = $activityModel->findAll();

        $participantModel = new \App\Models\ParticipantModel();
        $participantInfo = $participantModel->findAll();
        

        $parentModel = new \App\Models\ParentModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);
        $dataInfo = [
            'userInfo' => $userInfo,
            'participants'=>$participantInfo
        ];
        $data['session'] = session();
        $data['pageTitle'] = 'Activity';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/activity', $data);
    }

    public function result()
    {
        $parentModel = new \App\Models\ParentModel();
        $resultModel = new \App\Models\ResultModel();
        $studentModel = new \App\Models\StudentModel();

        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);
        $resultInfo = $resultModel->findAll();

        $studentInfo = $studentModel->where('fld_pid', $loggedUserID)->findAll();
        //$studentInfo = $studentModel->findAll();

        $dataInfo = [
            'userInfo' => $userInfo,
            'resultInfo'=>$resultInfo,
            'studentInfo' => $studentInfo,
            //'loggedUserID'=> $loggedUserID
        ];
        $data['pageTitle'] = 'Children';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/result', $data);

    }

    // public function report_Final()
    // {
    //     $parentModel = new \App\Models\ParentModel();
    //     $resultModel = new \App\Models\ResultModel();
    //     $studentModel = new \App\Models\StudentModel();

    //     $loggedUserID = session()->get('loggedUser');
    //     $userInfo = $parentModel->find($loggedUserID);
    //     $resultInfo = $resultModel->findAll();

    //     $studentInfo = $studentModel->where('fld_pid', $loggedUserID)->findAll();
    //     //$studentInfo = $studentModel->findAll();

    //     $dataInfo = [
    //         'userInfo' => $userInfo,
    //         'resultInfo'=>$resultInfo,
    //         'studentInfo' => $studentInfo,
    //         //'loggedUserID'=> $loggedUserID
    //     ];

    //     $data['pageTitle'] = 'Report Card';
    //     $data = array_merge($data, $dataInfo);

    //     return view('dashboard/report_Final',$data);
    // }

    // public function report_Mid()
    // {
    //     $parentModel = new \App\Models\ParentModel();
    //     $resultModel = new \App\Models\ResultModel();
    //     $studentModel = new \App\Models\StudentModel();

    //     $loggedUserID = session()->get('loggedUser');
    //     $userInfo = $parentModel->find($loggedUserID);
    //     $resultInfo = $resultModel->findAll();

    //     $studentInfo = $studentModel->where('fld_pid', $loggedUserID)->findAll();
    //     //$studentInfo = $studentModel->findAll();

    //     $dataInfo = [
    //         'userInfo' => $userInfo,
    //         'resultInfo'=>$resultInfo,
    //         'studentInfo' => $studentInfo,
    //         //'loggedUserID'=> $loggedUserID
    //     ];

    //     $data['pageTitle'] = 'Report Card';
    //     $data = array_merge($data, $dataInfo);

    //     return view('dashboard/report_Mid',$data);
    // }

    public function crowdfunding()
    {
        $activityModel = new \App\Models\ActivityModel();
        $activityInfo = $activityModel->findAll();

        $crowdfundingModel = new \App\Models\crowdfundingModel();
        //$crowdfundingInfo = $crowdfundingModel->findAll();

        $parentModel = new \App\Models\ParentModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);

        $crowdfundingInfo = $crowdfundingModel->where('fld_pid', $loggedUserID)->findAll();

        $dataInfo = [
            'userInfo'=>$userInfo,
            'activityInfo'=>$activityInfo,
            'crowdfundingInfo'=>$crowdfundingInfo,
            'loggedUserID'=> $loggedUserID

        ];
        $data['pageTitle'] = 'Crowd Funding';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/crowdfunding',$data);
    }

    public function viewTeacher()
    {
        $parentModel = new \App\Models\ParentModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);

        $teacherModel = new \App\Models\UsersModel();
        $teacherInfo = $teacherModel->findAll();

        $dataInfo = [
            'userInfo'=>$userInfo,
            'teacherInfo'=>$teacherInfo
        ];
        $data['pageTitle'] = 'Teachers';
        $data = array_merge($data, $dataInfo);
        return view('dashboard/viewTeacher',$data);
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
            'dob' => $this->request->getPost('dob'),
            'income' => $this->request->getPost('income')
        ];

        //Validate the input data
        $validationRules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'cpassword' => 'required|matches[password]',
            'phone' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'income' => 'required|numeric'
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed, return an error message or redirect back to the edit form
            return redirect()->back()->with('fail','Something went wrong');
        }

        // Get the current user's profile data from the database
        $userId = session()->get('loggedUser');
        $userModel = new \App\Models\ParentModel();
        $profile = $userModel->find($userId);

        // Update the relevant fields
        $updatedProfile = [
            'fld_name' => $data['name'],
            'fld_email' => $data['email'],
            'fld_phone' => $data['phone'],
            'fld_address' => $data['address'],
            'fld_dob' => $data['dob'],
            'fld_income' => $data['income']
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
        return redirect()->to('usercontroller/profile')->with('success', 'Profile updated successfully');
    }

    public function generateReportCardPDF()
    {
        // Load the required libraries and models
        require_once APPPATH.'../vendor/autoload.php';
        $dompdf = new \Dompdf\Dompdf();
    
        // Retrieve the necessary data from the models
        $parentModel = new \App\Models\ParentModel();
        $resultModel = new \App\Models\ResultModel();
        $studentModel = new \App\Models\StudentModel();
        
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);
        $studentInfo = $studentModel->where('fld_pid', $loggedUserID)->findAll();
        $resultInfo = $resultModel->findAll();
        
        // Build the HTML content
        $html = '
            <div class="report-card">
                <h1>Student Report Card</h1>';
    
        foreach ($studentInfo as $student) {
            foreach ($resultInfo as $result) {
                if ($student['fld_id'] === $result['fld_id'] && $result['fld_type'] === 'Mid Year') {
                    $html .= '
                    <div class="section">
                        <h2>Student Information</h2>
                        <p><strong>Name: </strong>' . $student['fld_name'] . '</p>
                        <p><strong>Class: </strong>' . $student['fld_class'] . '</p>
                        <p><strong>Result: </strong>' . $result['fld_type'] . '</p>
                    </div>
    
                    <div class="section">
                        <h2>Grades</h2>
                        <div class="table-container">
                            <table>
                                <tr>
                                    <th>Subject</th>
                                    <th>Marks</th>
                                    <th>Grade</th>
                                </tr>
                                <tr>
                                    <td>Malay</td>
                                    <td>' . $result['fld_bm'] . '</td>
                                    <td>' . ($result['fld_bm'] >= 80 ? 'A' : ($result['fld_bm'] >= 60 ? 'B' : ($result['fld_bm'] >= 40 ? 'D' : 'E'))) . '</td>
                                </tr>
                                <tr>
                                    <td>English</td>
                                    <td>' . $result['fld_bi'] . '</td>
                                    <td>' . ($result['fld_bi'] >= 80 ? 'A' : ($result['fld_bi'] >= 60 ? 'B' : ($result['fld_bi'] >= 40 ? 'D' : 'E'))) . '</td>
                                </tr>
                                <tr>
                                    <td>History</td>
                                    <td>' . $result['fld_history'] . '</td>
                                    <td>' . ($result['fld_history'] >= 80 ? 'A' : ($result['fld_history'] >= 60 ? 'B' : ($result['fld_history'] >= 40 ? 'D' : 'E'))) . '</td>
                                </tr>
                                <tr>
                                    <td>Mathematics</td>
                                    <td>' . $result['fld_maths'] . '</td>
                                    <td>' . ($result['fld_maths'] >= 80 ? 'A' : ($result['fld_maths'] >= 60 ? 'B' : ($result['fld_maths'] >= 40 ? 'D' : 'E'))) . '</td>
                                </tr>
                                <tr>
                                    <td>Science</td>
                                    <td>' . $result['fld_science'] . '</td>
                                    <td>' . ($result['fld_science'] >= 80 ? 'A' : ($result['fld_science'] >= 60 ? 'B' : ($result['fld_science'] >= 40 ? 'D' : 'E'))) . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
    
                    <div class="section">
                        <h2>Comments</h2>
                        <p>' . $result['fld_description'] . '</p>
                    </div>';
                }
            }
        }
    
        $html .= '</div>';
    
        // Set the HTML content for PDF generation
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the PDF
        $dompdf->render();
        
        // Generate and output the PDF file
        $dompdf->stream("student_report_card.pdf", array("Attachment" => false));
    }
    

}