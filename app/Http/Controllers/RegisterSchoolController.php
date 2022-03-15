<?php
namespace App\Http\Controllers;
use App\SmSchool;
use App\SmSchoolType;
use App\RegisterSchool;
use App\SmEmailSetting;
use App\SmGeneralSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\URL;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
class RegisterSchoolController extends Controller
{
	public function index()
	{
		try {
			$schools_type = SmSchoolType::get();
            //dd($schools_type);
			return view('frontEnd.register_school', compact('schools_type'));
		} 
		catch (\Exception $e)
		{
			Toastr::error('Operation Failed', 'Failed');
			return redirect('register_school')
			->withInput()
			->withErrors($e);
		}
	}
	public function generateRandomString($length = 25) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function create(Request $request){
		$school = SmSchool::latest('id')->first();
		$ab=$school->id;
		$school_id=$ab+1;
		$parameter= Crypt::encrypt($school_id);
		$rules = [
			'school_name' => 'required|string|min:3|max:255|unique:sm_schools',
			'email' => 'required|string|email|max:255|unique:sm_schools',			
			'phone' => 'required|string|min:10|max:255|unique:sm_schools',
			'address' => 'required|string|min:10|max:255',
			'logo_img' => 'nullable|image',
			'school_type' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('register_school')
			->withInput()
			->withErrors($validator);
		}
		else{
			$data = $request->input();
			try{
				if (SmSchool::where('email', '=',$data['email'] )->exists()) {
					Toastr::error('Operation Failed', 'Failed');
					return redirect()->back();
				}
				else
					try{
					$school = SmSchool::latest('id')->first();		
					$file = $request->file('logo_img');
					if ($request->file('main_school_logo') != "")
					{
						$main_school_logo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
						$file->move('public/uploads/settings/', $main_school_logo);
						$main_school_logo = 'public/uploads/settings/' . $main_school_logo;	
					}
					else
					{
						$main_school_logo = 'public/uploads/settings/logo.png' ;
					}
					$schoolCode=$this->generateRandomString(5);
					//dd($this->generateRandomString(5));
					$words = explode(" ", $data['school_name']);
					$acronym = "";

					foreach ($words as $w) {
						$acronym .= $w[0];
					}
					$acronym = $acronym.$schoolCode;
					$student = new RegisterSchool();
					$student->school_name = $data['school_name'];
					$student->email = $data['email'];
					$student->phone = $data['phone'];
					$student->address = $data['address'];
					$student->school_type = $data['school_type'];
					$student->school_code = $acronym;
					$student->school_url='school/'.$acronym;	
					$student->save();
					$result = $student->toArray();
					
					if (!empty($result)) {
						$ldate=date('Y-m-d');
						$general = SmGeneralSettings::find(1);
						$newgeneral=$general->replicate();
						$newgeneral->site_title=$data['school_name'];
						$newgeneral->school_name = $data['school_name'];
						$newgeneral->address = $data['address'];
						$newgeneral->phone = $data['phone'];
						$newgeneral->email = $data['email'];
						$newgeneral->system_activated_date=$ldate ;
						$newgeneral->school_id =$school_id;
						$newgeneral->logo=$main_school_logo ;
						$newgeneral->school_code =$acronym;
						$newgeneral->school_link=$parameter;
						$newgeneral->system_domain='school/'.$acronym;		
						$school_Id1=$parameter;
						$newgeneral->save();						
						Toastr::success('Operation successful', 'Success');
						$data['slug'] = 'admin';
						$data['id'] = $school_Id1;
						Mail::send(['html' => 'backEnd.studentInformation.user_credential'], compact('data'), function ($message) {
							$settings = SmEmailSetting::find(1);
							$latestSchool = SmSchool::latest('id')->first();
							$email = 'admin@gurutecherp.com';
							$Schoolname =$latestSchool->school_name;
							$message->to($latestSchool->email, $Schoolname)->cc("dmmalik@ymail.com")->subject('Registration Details');
							$message->from($email, "GuruTech ERP Solution");
						});
						return redirect()->route('register', [$school_Id1])->with('Success',"Please check your mail for Department register");
					}
					else {
						DB::rollback();
						Toastr::error('Operation Failed', 'Failed');
						return redirect()->back();
					}
				}
				catch(Exception $e){
				DB::rollback();
				return redirect('insert')->with('failed',"operation failed");
			}
			}
			catch(Exception $e){
				DB::rollback();
				return redirect('insert')->with('failed',"operation failed");
			}
		}
	}
}