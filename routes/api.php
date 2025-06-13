<?php



use Illuminate\Http\Request;



/*

  |--------------------------------------------------------------------------

  | Api Routes

  |--------------------------------------------------------------------------

  |

  | Here is where you can register Api routes for your application. These

  | routes are loaded by the RouteServiceProvider within a group which

  | is assigned the "Api" middleware group. Enjoy building your Api!

  |

 */

Route::middleware('auth:Api')->get('/user', function (Request $request) {

    return $request->user();

});



Route::post('register', 'Api\RegisterController@register');



Route::post('login', 'Api\RegisterController@login');



Route::post('company-register', 'Api\RegisterController@employerRegister');
Route::get('jobs', 'Api\JobController@jobsBySearch');
Route::get('job/{slug}', 'Api\JobController@jobDetail');

Route::post('company-login', 'Api\RegisterController@employerLogin');

Route::get('view-public-profile/{id}', 'Api\UserController@viewPublicProfile');

Route::get('job-seekers', 'Api\JobSeekerController@jobSeekersBySearch');

Route::get('subscribe-alert', 'Api\SubscriptionController@submitAlert');

Route::middleware('auth:company-Api')->group( function () {

    Route::get('order-free-package/{id}', 'Api\OrderController@orderFreePackage');



Route::get('order-package/{id}', 'Api\OrderController@orderPackage');

Route::get('order-upgrade-package/{id}', 'Api\OrderController@orderUpgradePackage');

Route::get('paypal-payment-status/{id}', 'Api\OrderController@getPaymentStatus');

Route::get('paypal-upgrade-payment-status/{id}', 'Api\OrderController@getUpgradePaymentStatus');

Route::get('stripe-order-form/{id}/{new_or_upgrade}', 'Api\StripeOrderController@stripeOrderForm');

Route::post('stripe-order-package', 'Api\StripeOrderController@stripeOrderPackage');

Route::post('stripe-order-upgrade-package', 'Api\StripeOrderController@stripeOrderUpgradePackage');





Route::get('payu-order-package', 'Api\PayuController@orderPackage');





Route::get('payu-order-package-status/', 'Api\PayuController@orderPackageStatus');





Route::get('payu-order-cvsearch-package', 'Api\PayuController@orderCvSearchPackage');





Route::get('payu-order-package.cvsearch-status/', 'Api\PayuController@orderPackageCvSearchStatus');







    Route::get('post-job', 'Api\JobPublishController@createFrontJob');
    Route::post('store-front-job', 'Api\JobPublishController@storeFrontJob');
    Route::get('edit-front-job/{id}', 'Api\JobPublishController@editFrontJob');
    Route::put('update-front-job/{id}', 'Api\JobPublishController@updateFrontJob');
    Route::delete('delete-front-job', 'Api\JobPublishController@deleteJob');
    Route::get('list-rejected-users/{id}', 'Api\CompanyController@listRejectedUsers');
    Route::post('submit-message', 'Api\SeekerSendController@submit_message');


    Route::get('company-packages', 'Api\CompanyController@resume_search_packages');

    Route::get('unloced-seekers', 'Api\CompanyController@unlocked_users');
    Route::get('unlock/{user}', 'Api\CompanyController@unlock');

    Route::get('company-home', 'Api\CompanyController@index');



Route::get('company-profile', 'Api\CompanyController@companyProfile');
Route::put('update-company-profile', 'Api\CompanyController@updateCompanyProfile');

Route::get('company/{slug}', 'Api\CompanyController@companyDetail');

Route::post('contact-company-message-send', 'Api\CompanyController@sendContactForm');

Route::post('contact-applicant-message-send', 'Api\CompanyController@sendApplicantContactForm');

Route::get('list-applied-users/{job_id}', 'Api\CompanyController@listAppliedUsers');

Route::get('list-hired-users/{job_id}', 'Api\CompanyController@listHiredUsers');
Route::get('list-favourite-applied-users/{job_id}', 'Api\CompanyController@listFavouriteAppliedUsers');

Route::get('add-to-favourite-applicant/{application_id}/{user_id}/{job_id}/{company_id}', 'Api\CompanyController@addToFavouriteApplicant');

Route::get('remove-from-favourite-applicant/{application_id}/{user_id}/{job_id}/{company_id}', 'Api\CompanyController@removeFromFavouriteApplicant');

Route::get('hire-from-favourite-applicant/{application_id}/{user_id}/{job_id}/{company_id}', 'Api\CompanyController@hireFromFavouriteApplicant');





Route::get('removed-from-hired-applicant/{application_id}/{user_id}/{job_id}/{company_id}', 'Api\CompanyController@removehireFromFavouriteApplicant');

Route::get('applicant-profile/{application_id}', 'Api\CompanyController@applicantProfile');

Route::get('reject-applicant-profile/{application_id}', 'Api\CompanyController@rejectApplicantProfile');
Route::get('user-profile/{id}', 'Api\CompanyController@userProfile');

Route::get('company-followers', 'Api\CompanyController@companyFollowers');

/* Route::get('company-messages', 'Api\CompanyController@companyMessages')->name('company.messages'); */

Route::post('submit-message-seeker', 'CompanyMessagesController@submitnew_message_seeker');



Route::get('company-messages', 'CompanyMessagesController@all_messages');
Route::get('append-messages', 'CompanyMessagesController@append_messages');

Route::get('append-only-messages', 'CompanyMessagesController@appendonly_messages');

Route::post('company-submit-messages', 'CompanyMessagesController@submit_message');

Route::get('company-message-detail/{id}', 'Api\CompanyController@companyMessageDetail');






});

Route::get('companies', 'Api\CompanyController@company_listing');
Route::post('forgot-password', 'Api\Auth\AuthController@forgot_password');
Route::middleware('auth:Api')->group( function () {

    //forgot password and change password passport Api's
    
    //change password from app when you are login
    Route::post('change-password', 'Api\Auth\AuthController@change_password');
    Route::post('jobs/search', 'Api\JobController@job_search');

    Route::get('jobs/categories', 'Api\JobController@job_categories');
    Route::get('jobs/category/show', 'Api\JobController@jobs_by_category');
    Route::get('jobs/show', 'Api\JobController@display_job_details');
    Route::get('jobs/apply', 'Api\JobController@apply_job_form');
    Route::post('jobs/apply', 'Api\JobController@store_apply_job');


    Route::get('apply/{slug}', 'Api\JobController@applyJob');
    Route::post('apply/{slug}', 'Api\JobController@postApplyJob');
    Route::get('add-to-favourite-job/{job_slug}', 'Api\JobController@addToFavouriteJob');
    Route::get('remove-from-favourite-job/{job_slug}', 'Api\JobController@removeFromFavouriteJob');
    Route::get('my-job-applications', 'Api\JobController@myJobApplications');
    Route::get('my-favourite-jobs', 'Api\JobController@myFavouriteJobs');



    Route::get('my-profile', 'Api\UserController@myProfile');
    Route::put('my-profile', 'Api\UserController@updateMyProfile');
    Route::post('update-front-profile-summary/{id}', 'Api\UserController@updateProfileSummary');
    Route::post('update-immediate-available-status', 'Api\UserController@updateImmediateAvailableStatus');
    Route::get('add-to-favourite-company/{company_slug}', 'Api\UserController@addToFavouriteCompany');
    Route::delete('remove-from-favourite-company/{company_slug}', 'Api\UserController@removeFromFavouriteCompany');
    Route::get('my-followings', 'Api\UserController@myFollowings');
   // Route::get('my-messages', 'Job\SeekerSendController@all_messages');
    Route::get('my-messages', 'Api\SeekerSendController@all_messages');
    // Route::get('seeker-append-messages', 'Job\SeekerSendController@append_messages');
    Route::get('seeker-append-messages', 'Api\SeekerSendController@append_messages');
  //  Route::get('seeker-append-only-messages', 'Job\SeekerSendController@appendonly_messages');
    Route::get('seeker-append-only-messages', 'Api\SeekerSendController@appendonly_messages');
  //  Route::post('seeker-submit-messages', 'Job\SeekerSendController@submitnew_message');
    Route::post('seeker-submit-messages', 'Api\SeekerSendController@submitnew_message');
    Route::get('applicant-message-detail/{id}', 'Api\UserController@applicantMessageDetail');
/* * *********************************** */
Route::post('show-front-profile-cvs/{id}', 'Api\UserController@showProfileCvs');
Route::post('get-front-profile-cv-form/{id}', 'Api\UserController@getFrontProfileCvForm');
Route::post('store-front-profile-cv/{id}', 'Api\UserController@storeProfileCv');
Route::post('get-front-profile-cv-edit-form/{user_id}', 'Api\UserController@getFrontProfileCvEditForm');
Route::post('update-front-profile-cv/{id}/{user_id}', 'Api\UserController@updateFrontProfileCv');
Route::delete('delete-front-profile-cv', 'Api\UserController@deleteProfileCv');
Route::post('show-front-profile-projects/{id}', 'Api\UserController@showFrontProfileProjects');
Route::post('show-applicant-profile-projects/{id}', 'Api\UserController@showApplicantProfileProjects');
Route::post('upload-front-project-temp-image', 'Api\UserController@uploadProjectTempImage');
Route::post('get-front-profile-project-form/{id}', 'Api\UserController@getFrontProfileProjectForm');
Route::post('store-front-profile-project/{id}', 'Api\UserController@storeFrontProfileProject');
Route::post('get-front-profile-project-edit-form/{user_id}', 'Api\UserController@getFrontProfileProjectEditForm');
Route::put('update-front-profile-project/{id}/{user_id}', 'Api\UserController@updateFrontProfileProject');;
Route::delete('delete-front-profile-project', 'Api\UserController@deleteProfileProject');
/* * *********************************** */
Route::post('show-front-profile-experience/{id}', 'Api\UserController@showFrontProfileExperience');
Route::post('show-applicant-profile-experience/{id}', 'Api\UserController@showApplicantProfileExperience');
Route::post('get-front-profile-experience-form/{id}', 'Api\UserController@getFrontProfileExperienceForm');
Route::post('store-front-profile-experience/{id}', 'Api\UserController@storeFrontProfileExperience');
Route::post('get-front-profile-experience-edit-form/{id}', 'Api\UserController@getFrontProfileExperienceEditForm');
Route::put('update-front-profile-experience/{profile_experience_id}/{user_id}', 'Api\UserController@updateFrontProfileExperience');
Route::delete('delete-front-profile-experience', 'Api\UserController@deleteProfileExperience');
/* * *********************************** */
Route::post('show-front-profile-education/{id}', 'Api\UserController@showFrontProfileEducation');
Route::post('show-applicant-profile-education/{id}', 'Api\UserController@showApplicantProfileEducation');
Route::post('get-front-profile-education-form/{id}', 'Api\UserController@getFrontProfileEducationForm');
Route::post('store-front-profile-education/{id}', 'Api\UserController@storeFrontProfileEducation');
Route::post('get-front-profile-education-edit-form/{id}', 'Api\UserController@getFrontProfileEducationEditForm');
Route::put('update-front-profile-education/{education_id}/{user_id}', 'Api\UserController@updateFrontProfileEducation');
Route::delete('delete-front-profile-education', 'Api\UserController@deleteProfileEducation');
/* * *********************************** */
Route::post('show-front-profile-skills/{id}', 'Api\UserController@showProfileSkills');
Route::post('show-applicant-profile-skills/{id}', 'Api\UserController@showApplicantProfileSkills');
Route::post('get-front-profile-skill-form/{id}', 'Api\UserController@getFrontProfileSkillForm');
Route::post('store-front-profile-skill/{id}', 'Api\UserController@storeFrontProfileSkill');
Route::post('get-front-profile-skill-edit-form/{id}', 'Api\UserController@getFrontProfileSkillEditForm');
Route::put('update-front-profile-skill/{skill_id}/{user_id}', 'Api\UserController@updateFrontProfileSkill');
Route::delete('delete-front-profile-skill', 'Api\UserController@deleteProfileSkill');
/* * *********************************** */
Route::post('show-front-profile-languages/{id}', 'Api\UserController@showProfileLanguages');
Route::post('show-applicant-profile-languages/{id}', 'Api\UserController@showApplicantProfileLanguages');
Route::post('get-front-profile-language-form/{id}', 'Api\UserController@getFrontProfileLanguageForm');
Route::post('store-front-profile-language/{id}', 'Api\UserController@storeFrontProfileLanguage');
Route::post('get-front-profile-language-edit-form/{id}', 'Api\UserController@getFrontProfileLanguageEditForm');
Route::put('update-front-profile-language/{language_id}/{user_id}', 'Api\UserController@updateFrontProfileLanguage');
Route::delete('delete-front.profile-language', 'Api\UserController@deleteProfileLanguage');
/*************************************/


Route::get('my-alerts', 'Api\UserController@myAlerts');
Route::get('delete-alert/{id}', 'Api\UserController@delete_alert');

});






/* * ******** UserController ************ */

// Route::get('my-messages', 'Api\UserController@myMessages')->name('my.messages'); 









/* * *********************************** */
Route::post('show-front-profile-projects/{id}', 'Api\UserController@showFrontProfileProjects');
Route::post('show-applicant-profile-projects/{id}', 'Api\UserController@showApplicantProfileProjects');
Route::post('upload-front-project-temp-image', 'Api\UserController@uploadProjectTempImage');
Route::post('get-front-profile-project-form/{id}', 'Api\UserController@getFrontProfileProjectForm');
Route::post('store-front-profile-project/{id}', 'Api\UserController@storeFrontProfileProject');
Route::post('get-front-profile-project-edit-form/{user_id}', 'Api\UserController@getFrontProfileProjectEditForm');
Route::put('update-front-profile-project/{id}/{user_id}', 'Api\UserController@updateFrontProfileProject');;
Route::delete('delete-front-profile-project', 'Api\UserController@deleteProfileProject');
/* * *********************************** */
Route::post('show-front-profile-experience/{id}', 'Api\UserController@showFrontProfileExperience');
Route::post('show-applicant-profile-experience/{id}', 'Api\UserController@showApplicantProfileExperience');
Route::post('get-front-profile-experience-form/{id}', 'Api\UserController@getFrontProfileExperienceForm');
Route::post('store-front-profile-experience/{id}', 'Api\UserController@storeFrontProfileExperience');
Route::post('get-front-profile-experience-edit-form/{id}', 'Api\UserController@getFrontProfileExperienceEditForm');
Route::put('update-front-profile-experience/{profile_experience_id}/{user_id}', 'Api\UserController@updateFrontProfileExperience');
Route::delete('delete-front-profile-experience', 'Api\UserController@deleteProfileExperience');
/* * *********************************** */
Route::post('show-front-profile-education/{id}', 'Api\UserController@showFrontProfileEducation');
Route::post('show-applicant-profile-education/{id}', 'Api\UserController@showApplicantProfileEducation');
Route::post('get-front-profile-education-form/{id}', 'Api\UserController@getFrontProfileEducationForm');
Route::post('store-front-profile-education/{id}', 'Api\UserController@storeFrontProfileEducation');
Route::post('get-front-profile-education-edit-form/{id}', 'Api\UserController@getFrontProfileEducationEditForm');
Route::put('update-front-profile-education/{education_id}/{user_id}', 'Api\UserController@updateFrontProfileEducation');
Route::delete('delete-front-profile-education', 'Api\UserController@deleteProfileEducation');
/* * *********************************** */
Route::post('show-front-profile-skills/{id}', 'Api\UserController@showProfileSkills');
Route::post('show-applicant-profile-skills/{id}', 'Api\UserController@showApplicantProfileSkills');
Route::post('get-front-profile-skill-form/{id}', 'Api\UserController@getFrontProfileSkillForm');
Route::post('store-front-profile-skill/{id}', 'Api\UserController@storeFrontProfileSkill');
Route::post('get-front-profile-skill-edit-form/{id}', 'Api\UserController@getFrontProfileSkillEditForm');
Route::put('update-front-profile-skill/{skill_id}/{user_id}', 'Api\UserController@updateFrontProfileSkill');
Route::delete('delete-front-profile-skill', 'Api\UserController@deleteProfileSkill');
/* * *********************************** */
Route::post('show-front-profile-languages/{id}', 'Api\UserController@showProfileLanguages');
Route::post('show-applicant-profile-languages/{id}', 'Api\UserController@showApplicantProfileLanguages');
Route::post('get-front-profile-language-form/{id}', 'Api\UserController@getFrontProfileLanguageForm');
Route::post('store-front-profile-language/{id}', 'Api\UserController@storeFrontProfileLanguage');
Route::post('get-front-profile-language-edit-form/{id}', 'Api\UserController@getFrontProfileLanguageEditForm');
Route::put('update-front-profile-language/{language_id}/{user_id}', 'Api\UserController@updateFrontProfileLanguage');
Route::delete('delete-front.profile-language', 'Api\UserController@deleteProfileLanguage');
/*************************************/


Route::get('my-alerts', 'Api\UserController@myAlerts');
Route::get('delete-alert/{id}', 'Api\UserController@delete_alert');



Route::get('email-to-friend/{job_slug}', 'Api\ContactController@emailToFriend');

Route::post('email-to-friend/{job_slug}', 'Api\ContactController@emailToFriendPost');

Route::get('email-to-friend-thanks', 'Api\ContactController@emailToFriendThanks');

Route::get('report-abuse/{job_slug}', 'Api\ContactController@reportAbuse');
Route::post('report-abuse/{job_slug}', 'Api\ContactController@reportAbusePost');

Route::get('report-abuse-thanks', 'Api\ContactController@reportAbuseThanks');

Route::get('report-abuse-company/{company_slug}', 'Api\ContactController@reportAbuseCompany');

Route::post('report-abuse-company/{company_slug}', 'Api\ContactController@reportAbuseCompanyPost');

Route::get('report-abuse-company-thanks', 'Api\ContactController@reportAbuseCompanyThanks');


Route::get('cms/{slug}', 'Api\CmsController@getPage');

Route::get('terms-of-use', 'Api\CmsController@termsOfUse');

Route::get('contact-us', 'Api\ContactController@index');

Route::post('contact-us', 'Api\ContactController@postContact');

Route::get('contact-us-thanks', 'Api\ContactController@thanks');



Route::get('blog', 'Api\BlogController@index');
Route::get('blog/search', 'Api\BlogController@search');
Route::get('blog/{slug}', 'Api\BlogController@details');
Route::get('/blog/category/{blog}', 'Api\BlogController@categories');





Route::post('filter-default-cities-dropdown', 'Api\AjaxController@filterDefaultCities');

Route::post('filter-default-states-dropdown', 'Api\AjaxController@filterDefaultStates');

Route::post('filter-lang-cities-dropdown', 'Api\AjaxController@filterLangCities');
Route::post('filter-lang-states-dropdown', 'Api\AjaxController@filterLangStates');

Route::post('filter-cities-dropdown', 'Api\AjaxController@filterCities');

Route::post('filter-states-dropdown', 'Api\AjaxController@filterStates');

Route::post('filter-degree-types-dropdown', 'Api\AjaxController@filterDegreeTypes');


Route::get('/testing',function(){
    
  $email =  Mail::send('emails.emailVerificationEmail', ['token' => 'dfssdfsadfsadfsadfw3w34324342'],function($message) {
       $message->to("vikashkeswani@gmail.com");
       $message->subject('Email Verification Mail -- OLD Project Jobeify');
   });

   return response()->json([
       'message' => 'Email Successfully Sent FROM OLD Jobeify Project Vikash'
   ]);
}) ;