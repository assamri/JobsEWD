<?php

namespace App\Traits;

use Auth;
use DB;
use Input;
use Carbon\Carbon;
use Redirect;
use App\User;
use App\ProfileEducation;
use App\ProfileEducationMajorSubject;
use App\DegreeLevel;
use App\DegreeType;
use App\ResultType;
use App\MajorSubject;
use App\Country;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ProfileEducationFormRequest;
use App\Helpers\DataArrayHelper;

trait ProfileEducationTrait
{

    public function showProfileEducation(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $html = '';
        if (isset($user) && count($user->profileEducation)):
            foreach ($user->profileEducation as $education):

                $html .= '<!--education Start-->
            <div class="col-md-12" id="education_' . $education->id . '">
              <div class="mt-element-ribbon bg-grey-steel">
                <div class="ribbon ribbon-color-warning uppercase ">' . $education->getDegreeLevel('degree_level') . ' - ' . $education->getDegreeType('degree_type') . '</div>
                <p class="ribbon-content">
				' . $education->degree_title . '<br />               	
                ' . $education->date_completion . ' | ' . $education->getCity('city') . '<br />
                ' . $education->institution . '<br />
                <a href="javascript:void(0);" onclick="showProfileEducationEditModal(' . $education->id . ',' . $education->state_id . ',' . $education->city_id . ' - ' . $education->getCountry('country') . ',' . $education->degree_type_id . ');" class="btn btn-warning">' . __('Edit') . '</a>
				<a href="javascript:void(0);" onclick="delete_profile_education(' . $education->id . ');" class="btn btn-danger">' . __('Delete') . '</a>
                </p>
              </div>
            </div>
            <!--education End-->';
            endforeach;
        endif;

        echo $html;
    }

    public function showFrontProfileEducation(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $html = '<ul class="educationList">';
        if (isset($user) && count($user->profileEducation)):
            foreach ($user->profileEducation as $education):




                $html .= '<li><span class="exdot"></span>
                            <div class="expbox" id="education_' . $education->id . '">
                          <div class="d-flex">
						  <h4>' . $education->getDegreeLevel('degree_level') . ' - ' . $education->getDegreeType('degree_type') . '</h4>						  
<div class="cvnewbxedit ms-auto"><a href="javascript:void(0);" onclick="showProfileEducationEditModal(' . $education->id . ',' . $education->state_id . ',' . $education->city_id . ',' . $education->degree_type_id . ');" class="text text-dark"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0);" onclick="delete_profile_education(' . $education->id . ');" class="text text-danger ms-2"><i class="fas fa-times"></i></a></div>
                          </div>
                          <div class="date">' . e($education->date_completion) . ' - ' . e($education->getCity('city')) . ' - ' . e($education->getCountry('country')) . '</div>		
						  <div class="expcomp"><i class="fas fa-graduation-cap"></i> ' . $education->degree_title . '</div>
						  <div class="expcomp"><i class="fas fa-map-marker-alt"></i> ' . $education->getCity('city') . ' - ' . $education->getCountry('country') . '</div>
						  <div class="expcomp"><i class="fas fa-school"></i>' . $education->institution . '</div>
						  </div>
						
						</li>';
            endforeach;
        endif;

        echo $html . '</ul>';
    }

    public function showApplicantProfileEducation(Request $request, $user_id)
{
    $user = User::find($user_id);
    $html = '';

    if (isset($user) && $user->profileEducation->count() > 0) {
        $html .= '<ul class="educationList">';
        foreach ($user->profileEducation as $education) {
            $majorSubjects = $education->getProfileEducationMajorSubjectsStr();

            $html .= '<li><span class="exdot"></span>
                <div class="expbox">                
                    <h4>' . e($education->getDegreeLevel('degree_level')) . ' - ' . e($education->getDegreeType('degree_type')) . '</h4>
                    <div class="date">' . e($education->date_completion) . ' - ' . e($education->getCity('city')) . ' - ' . e($education->getCountry('country')) . '</div>				
                    <div class="expcomp"><i class="fas fa-graduation-cap"></i>' . e($education->degree_title) . '</div>
                    <div class="expcomp"><i class="fas fa-school"></i>' . e($education->institution) . '</div>				
                    <div class="expcomp"><i class="fas fa-book"></i>' . e($majorSubjects) . '</div>
                </div>
            </li>';
        }
        $html .= '</ul>';
    } else {
        $html .= '<p class="no-records">' . __('No Education Added') . '</p>';
    }

    echo $html;
}


    public function getProfileEducationForm(Request $request, $user_id)
    {

        $degreeLevels = DataArrayHelper::defaultDegreelevelsArray();
        $resultTypes = DataArrayHelper::defaultResultTypesArray();
        $majorSubjects = DataArrayHelper::defaultMajorSubjectsArray();
        $countries = DataArrayHelper::defaultCountriesArray();

        $profileEducationMajorSubjectIds = array();

        $user = User::find($user_id);
        $returnHTML = view('admin.user.forms.education.education_modal')
                ->with('user', $user)
                ->with('degreeLevels', $degreeLevels)
                ->with('resultTypes', $resultTypes)
                ->with('majorSubjects', $majorSubjects)
                ->with('profileEducationMajorSubjectIds', $profileEducationMajorSubjectIds)
                ->with('countries', $countries)
                ->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function getFrontProfileEducationForm(Request $request, $user_id)
    {

        $degreeLevels = DataArrayHelper::langDegreelevelsArray();
        $resultTypes = DataArrayHelper::langResultTypesArray();
        $majorSubjects = DataArrayHelper::langMajorSubjectsArray();
        $countries = DataArrayHelper::langCountriesArray();
        $profileEducationMajorSubjectIds = array();

        $user = User::find($user_id);
        $returnHTML = view('user.forms.education.education_modal')
                ->with('user', $user)
                ->with('degreeLevels', $degreeLevels)
                ->with('resultTypes', $resultTypes)
                ->with('majorSubjects', $majorSubjects)
                ->with('profileEducationMajorSubjectIds', $profileEducationMajorSubjectIds)
                ->with('countries', $countries)
                ->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function storeProfileEducation(ProfileEducationFormRequest $request, $user_id)
    {

        $profileEducation = new ProfileEducation();
        $profileEducation = $this->assignEducationValues($profileEducation, $request, $user_id);
        $profileEducation->save();
        /*         * ************************************ */
        $this->storeprofileEducationMajorSubjects($request, $profileEducation->id);
        /*         * ************************************ */
        $returnHTML = view('admin.user.forms.education.education_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    public function storeFrontProfileEducation(ProfileEducationFormRequest $request, $user_id)
    {

        $profileEducation = new ProfileEducation();
        $profileEducation = $this->assignEducationValues($profileEducation, $request, $user_id);
        $profileEducation->save();
        /*         * ************************************ */
        $this->storeprofileEducationMajorSubjects($request, $profileEducation->id);
        /*         * ************************************ */
        $returnHTML = view('user.forms.education.education_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    private function assignEducationValues($profileEducation, $request, $user_id)
    {
        $profileEducation->user_id = $user_id;
        $profileEducation->degree_level_id = $request->input('degree_level_id');
        $profileEducation->degree_type_id = $request->input('degree_type_id');
        $profileEducation->degree_title = $request->input('degree_title');
        $profileEducation->country_id = $request->input('country_id');
        $profileEducation->state_id = $request->input('state_id');
        $profileEducation->city_id = $request->input('city_id');
        $profileEducation->date_completion = $request->input('date_completion');
        $profileEducation->institution = $request->input('institution');
        $profileEducation->degree_result = $request->input('degree_result');
        $profileEducation->result_type_id = $request->input('result_type_id');
        return $profileEducation;
    }

    public function getProfileEducationEditForm(Request $request, $user_id)
    {
        $education_id = $request->input('education_id');

        $degreeLevels = DataArrayHelper::defaultDegreelevelsArray();
        $resultTypes = DataArrayHelper::defaultResultTypesArray();
        $majorSubjects = DataArrayHelper::defaultMajorSubjectsArray();
        $countries = DataArrayHelper::defaultCountriesArray();

        $profileEducation = ProfileEducation::find($education_id);
        $profileEducationMajorSubjectIds = $profileEducation->getProfileEducationMajorSubjectsArray();
        $user = User::find($user_id);

        $returnHTML = view('admin.user.forms.education.education_edit_modal')
                ->with('user', $user)
                ->with('profileEducation', $profileEducation)
                ->with('degreeLevels', $degreeLevels)
                ->with('resultTypes', $resultTypes)
                ->with('majorSubjects', $majorSubjects)
                ->with('profileEducationMajorSubjectIds', $profileEducationMajorSubjectIds)
                ->with('countries', $countries)
                ->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function getFrontProfileEducationEditForm(Request $request, $user_id)
    {
        $education_id = $request->input('education_id');

        $degreeLevels = DataArrayHelper::langDegreelevelsArray();
        $resultTypes = DataArrayHelper::langResultTypesArray();
        $majorSubjects = DataArrayHelper::langMajorSubjectsArray();
        $countries = DataArrayHelper::langCountriesArray();

        $profileEducation = ProfileEducation::find($education_id);
        $profileEducationMajorSubjectIds = $profileEducation->getProfileEducationMajorSubjectsArray();
        $user = User::find($user_id);

        $returnHTML = view('user.forms.education.education_edit_modal')
                ->with('user', $user)
                ->with('profileEducation', $profileEducation)
                ->with('degreeLevels', $degreeLevels)
                ->with('resultTypes', $resultTypes)
                ->with('majorSubjects', $majorSubjects)
                ->with('profileEducationMajorSubjectIds', $profileEducationMajorSubjectIds)
                ->with('countries', $countries)
                ->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function updateProfileEducation(ProfileEducationFormRequest $request, $education_id, $user_id)
    {

        $profileEducation = ProfileEducation::find($education_id);
        $profileEducation = $this->assignEducationValues($profileEducation, $request, $user_id);
        $profileEducation->update();
        /*         * ************************************ */
        $this->storeprofileEducationMajorSubjects($request, $profileEducation->id);
        /*         * ************************************ */

        $returnHTML = view('admin.user.forms.education.education_edit_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    public function updateFrontProfileEducation(ProfileEducationFormRequest $request, $education_id, $user_id)
    {

        $profileEducation = ProfileEducation::find($education_id);
        $profileEducation = $this->assignEducationValues($profileEducation, $request, $user_id);
        $profileEducation->update();
        /*         * ************************************ */
        $this->storeprofileEducationMajorSubjects($request, $profileEducation->id);
        /*         * ************************************ */

        $returnHTML = view('user.forms.education.education_edit_thanks')->render();
        return response()->json(array('success' => true, 'status' => 200, 'html' => $returnHTML), 200);
    }

    private function storeprofileEducationMajorSubjects($request, $profile_education_id)
    {
        if ($request->has('major_subjects')) {
            ProfileEducationMajorSubject::where('profile_education_id', '=', $profile_education_id)->delete();
            $major_subjects = $request->input('major_subjects');
            foreach ($major_subjects as $major_subject_id) {
                $profileEducationMajorSubject = new ProfileEducationMajorSubject();
                $profileEducationMajorSubject->profile_education_id = $profile_education_id;
                $profileEducationMajorSubject->major_subject_id = $major_subject_id;
                $profileEducationMajorSubject->save();
            }
        }
    }

    public function deleteAllProfileEducation($user_id)
    {
        $profileEducations = ProfileEducation::where('user_id', '=', $user_id)->get();
        foreach ($profileEducations as $profileEducation) {
            echo $this->removeProfileEducation($profileEducation->id);
        }
    }

    public function deleteProfileEducation(Request $request)
    {
        $id = $request->input('id');
        echo $this->removeProfileEducation($id);
    }

    private function removeProfileEducation($id)
    {
        try {
            $profileEducation = ProfileEducation::findOrFail($id);
            ProfileEducationMajorSubject::where('profile_education_id', '=', $id)->delete();
            $profileEducation->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

}
