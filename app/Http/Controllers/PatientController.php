<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Referred;
use Auth;
use Log;

class PatientController extends Controller
{
    public function ReferPatient(Request $request) {
        if($request->user()->type != 'doctor'){
            return response()->json(['errors'=>['Only a doctor can refer a patient']], 422);
        }
        $this->validate($request, [
			'name' => 'required',
			'phone' => 'required|digits:10',
		],[
            'phone.digits' => 'Please enter a valid phone number',
        ]);
        
        $name = $request->input('name');
        $phone = $request->input('phone');
		
		$patient = Patient::where('name',$name)
		                    ->where('phone',$phone)
		                    ->first();
		
		if($patient) {
		    
		    $referred = new Referred;
    		$referred->patient_id = $patient->id;
    		$referred->description = $request->input('description');
    		//$referred->discount = $request->input('discount');
    		$referred->referred_user_id = $request->user()->id;
    		$referred->save();
    		
		} else {
		    
		    $this->validate($request, [
    			'phone' => 'unique:patients,phone',
    		],[
                'phone.unique' => 'This phone number is already registered with another patient',
            ]);
		    
		    $patient = new Patient;
    		$patient->name = $request->input('name');
    		$patient->phone = $request->input('phone');
    		$patient->save();
    		
    		$referred = new Referred;
    		$referred->patient_id = $patient->id;
    		$referred->description = $request->input('description');
    		//$referred->discount = $request->input('discount');
    		$referred->referred_user_id = $request->user()->id;
    		$referred->save();
    		
		}
		
		$msg[] = 'Patient referred successfully.';
		
		if($request -> ajax() || $request->is('api/*')){
			return response()->json(['msg' => $msg[0]]);
		}
    }
    
    public function ShowSearch() {
    	$patients = Patient::all();
    	$doctors = User::where('type','doctor')
    					->get();
    	
    	$data = [ "doctors" => $doctors, "patients" => $patients ];
        
        return view('searchpatient')->with($data);
    }
    
    public function SearchPatient(Request $request) {
    	$this->validate($request, [
			'doctor_id' => 'required_without:patient_id',
        ],[
            'doctor_id.required_without' => 'Please select Patient or Doctor Referred By',
        ]);
        
        $patient_id = $request->input('patient_id');
        $doctor_id = $request->input('doctor_id');
        
        $referred = Referred::where(function($query) use($patient_id, $doctor_id) {
                        if($patient_id) {
                            $query->where('patient_id', $patient_id);
                        }
                        if($doctor_id) {
                            $query->where('referred_user_id', $doctor_id);
                        }
        			})
        			->get();
        			
        $data = [ "referred" => $referred ];
        
        return view('patientresults')->with($data);
    }
    
    public function ShowReferredPatient($id) {
        $referred = Referred::find($id);
        
        $data = [ "referred" => $referred ];
        
        return view('referredpatiententry')->with($data);
        
    }
    
    public function ReferredPatientEntry(Request $request, $id) {
    	$this->validate($request, [
			'arrived_at' => 'required',
		]);
		
		$patient = Referred::find($id);
		$patient->arrived_at = $request->input('arrived_at');
		$patient->commission = $request->input('commission');
		$patient->save();
		
		$data = ["msg" => ["Referred patient entry successfully"]];
		return redirect()->back()->with($data);
    }
    
    public function ShowNewPatientForm() {
        $doctors = User::where('type','doctor')
    					->get();
    	
    	$data = [ "doctors" => $doctors ];
        return view('newpatient')->with($data);
    }
    
    public function ReferPatientAdmin(Request $request) {
        $this->validate($request, [
			'name' => 'required',
			'phone' => 'required|digits:10',
			'discount' => 'numeric|max:45',
		],[
            'phone.digits' => 'Please enter a valid phone number',
            'discount.numeric' => 'Please enter the discount in numbers only',
            'discount.max' => 'Maximum discount available is 45%',
        ]);
        
        $name = $request->input('name');
        $phone = $request->input('phone');
		
		$patient = Patient::where('name',$name)
		                    ->where('phone',$phone)
		                    ->first();
		
		if($patient) {
		    
		    $referred = new Referred;
    		$referred->patient_id = $patient->id;
    		//$referred->description = $request->input('description');
    		$referred->discount = $request->input('discount');
    		$referred->referred_user_id = $request->input('doctor_id');
    		$referred->save();
    		
		} else {
		    
		    /*$this->validate($request, [
    			'phone' => 'unique:patients,phone',
    		],[
                'phone.unique' => 'This phone number is already registered with another patient',
            ]);*/
		    
		    $patient = new Patient;
    		$patient->name = $request->input('name');
    		$patient->phone = $request->input('phone');
    		$patient->save();
    		
    		$referred = new Referred;
    		$referred->patient_id = $patient->id;
    		//$referred->description = $request->input('description');
    		$referred->discount = $request->input('discount');
    		$referred->referred_user_id = $request->input('doctor_id');
    		$referred->save();
    		
		}
		
		$msg[] = 'Patient referred successfully.';
		
		return redirect('showreferred/'.$referred->id)->with($msg);
    }
}
