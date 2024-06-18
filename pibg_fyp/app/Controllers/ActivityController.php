<?php namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\UserModel;
use App\Models\ParticipantModel;

class ActivityController extends BaseController
{

    protected $activityModel;
    protected $participantModel;

    public function __construct()
    {
        $this->activityModel = new \App\Models\ActivityModel();
        $this->participantModel = new \App\Models\ParticipantModel();
    }

    public function index()
    {
        $activityModel = new \App\Models\ActivityModel();
        $participantModel = new \App\Models\ParticipantModel();
        $activityInfo = $activityModel->findAll();
        $participantInfo = $participantModel->findAll();

        $data=[
            'activities'=>$activityInfo,
            'participants'=>$participantInfo
        ];

        return view('dashboard/activityTeacher', $data);
    }

    public function create()
    {
        $activityModel = new \App\Models\ActivityModel();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'fld_name' => $this->request->getPost('name'),
                'fld_description' => $this->request->getPost('description'),
                'fld_date' => $this->request->getPost('date'),
                'fld_budget' => $this->request->getPost('budget'),
                'fld_help' => $this->request->getPost('help'),
                'fld_participants' => $this->request->getPost('participant')
            ];

            $activityModel->insert($data);

            return redirect()->to('teacher/activity')->with('success', 'Activity created successfully.');
        }

        return view('dashboard/activityTeacher');
    }

    public function createAdmin()
    {
        $activityModel = new \App\Models\ActivityModel();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'fld_name' => $this->request->getPost('name'),
                'fld_description' => $this->request->getPost('description'),
                'fld_date' => $this->request->getPost('date'),
                'fld_budget' => $this->request->getPost('budget'),
                'fld_help' => $this->request->getPost('help'),
                'fld_participants' => $this->request->getPost('participant')
            ];

            $activityModel->insert($data);

            return redirect()->to('admin/activity')->with('success', 'Activity created successfully.');
        }

        return view('dashboard/activityAdmin');
    }

    public function update($id)
    {

        $activityModel = new \App\Models\ActivityModel();
        //$update = $activityModel->find($id);

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date'),
            'budget' => $this->request->getPost('budget'),
            'help' => $this->request->getPost('help'),
            'participant' => $this->request->getPost('participant')
        ];

        //$activityModel->update($id,$data);


        //Validate the input data
        $validationRules = [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'budget' => 'required',
            'help' => 'required',
            'participant' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed, return an error message or redirect back to the edit form
            return redirect()->back()->with('fail','Something went wrong');
        }

        // Update the relevant fields
        $updateActivity = [
            'fld_name' => $data['name'],
            'fld_description' => $data['description'],
            'fld_date' => $data['date'],
            'fld_budget' => $data['budget'],
            'fld_help' => $data['help'],
            'fld_participants' => $data['participant']
        ];

        // Save the updated profile data back to the database
        $activityModel->update($id, $updateActivity);

        // Pass the complete data array to the view
        $dataInfo = [
            'userInfo' => $updateActivity
        ];
        $data['pageTitle'] = 'Activity';
        $data = array_merge($data, $dataInfo);

        // Redirect to the profile page with a success message
        return redirect()->to('teacher/activity')->with('success', 'Activity updated successfully');
    }

    public function updateAdmin($id)
    {

        $activityModel = new \App\Models\ActivityModel();
        //$update = $activityModel->find($id);

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'date' => $this->request->getPost('date'),
            'budget' => $this->request->getPost('budget'),
            'help' => $this->request->getPost('help'),
            'participant' => $this->request->getPost('participant')
        ];

        //$activityModel->update($id,$data);


        //Validate the input data
        $validationRules = [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'budget' => 'required',
            'help' => 'required',
            'participant' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed, return an error message or redirect back to the edit form
            return redirect()->back()->with('fail','Something went wrong');
        }

        // Update the relevant fields
        $updateActivity = [
            'fld_name' => $data['name'],
            'fld_description' => $data['description'],
            'fld_date' => $data['date'],
            'fld_budget' => $data['budget'],
            'fld_help' => $data['help'],
            'fld_participants' => $data['participant']
        ];

        // Save the updated profile data back to the database
        $activityModel->update($id, $updateActivity);

        // Pass the complete data array to the view
        $dataInfo = [
            'userInfo' => $updateActivity
        ];
        $data['pageTitle'] = 'Activity';
        $data = array_merge($data, $dataInfo);

        // Redirect to the profile page with a success message
        return redirect()->to('admin/activity')->with('success', 'Activity updated successfully');
    }

    public function delete($id)
    {
        $activityModel = new \App\Models\ActivityModel();
        $activityModel->delete($id);
        return redirect()->to('teacher/activity')->with('success', 'Activity deleted successfully.');
    }

    public function deleteAdmin($id)
    {
        $activityModel = new \App\Models\ActivityModel();
        $activityModel->delete($id);
        return redirect()->to('admin/activity')->with('success', 'Activity deleted successfully.');
    }

    public function join($id)
    {
        // Retrieve user information from the session or wherever it is stored
        $loggedUserID = session()->get('loggedUser');
        $parentModel = new \App\Models\ParentModel();
        $activityModel = new \App\Models\ActivityModel();

        $parentInfo = $parentModel->find($loggedUserID);
        $activityInfo = $activityModel->find($id);

        $participantModel = new \App\Models\ParticipantModel();

        $data = [
            'fld_aid' => $activityInfo['fld_id'],
            'fld_activity' => $activityInfo['fld_name'],
            'fld_pid' => $parentInfo['fld_id'],
            'fld_name' =>$parentInfo['fld_name'],
            'fld_email' =>$parentInfo['fld_email'],
            'fld_phone' =>$parentInfo['fld_phone']
        ];

        // Check if the user has already joined the activity
            $existingParticipant = $participantModel->where('fld_aid', $activityInfo['fld_id'])
            ->where('fld_pid', $parentInfo['fld_id'])
            ->first();

            if (!$existingParticipant) {
            $data = [
            'fld_aid' => $activityInfo['fld_id'],
            'fld_activity' => $activityInfo['fld_name'],
            'fld_pid' => $parentInfo['fld_id'],
            'fld_name' => $parentInfo['fld_name'],
            'fld_email' => $parentInfo['fld_email'],
            'fld_phone' => $parentInfo['fld_phone']
            ];

        $participantModel->insert($data);

        // Redirect to a success page or do any other necessary action
        return redirect()->to('user/activity')->with('success', 'You have joined this activity.');
        }

        return redirect()->to('user/activity')->with('fail', 'You have already joined this activity.');
    }

    public function unjoin($id)
    {
        $participantModel = new \App\Models\ParticipantModel();
        $participantModel->delete($id);
        return redirect()->to('user/activity')->with('success', 'Activity deleted successfully.');
    }
}
