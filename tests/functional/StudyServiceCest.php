<?php

use App\Models\Sponsor;


class StudyServiceCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    private function sampleStudyFormData()
    {
        $studyData = factory('App\Models\StudyService')->make()->toArray();

        return $studyData;
    }

    public function createStudyServiceTest(FunctionalTester $I)
    {
        $study = $I->have('App\Models\Study'); 

        $I->amLoggedinAsAdmin($I);
        $I->amOnPage(route('studies.study-services.create', $study));
        $I->see('Create Study Travel Parameters');    

        $formValues = $this->sampleStudyFormData();
        $formActionUrl = route('studies.study-services.store', $study);

        $I->submitForm("form[action='$formActionUrl']", $formValues);
        $I->seeResponseCodeIs(200);
        $I->see('Study Travel Parameters created!');
    }

    public function editStudyServiceTest(FunctionalTester $I)
    {
        $studyService = $I->have('App\Models\StudyService');

        $I->amLoggedInAsAdmin($I);
        $I->amOnPage(route('studies.study-services.edit', [$studyService->study_id, $studyService]));
        $I->see('Edit Study Travel Parameters');    

        $formValues = $this->sampleStudyFormData();
        $formActionUrl = route('studies.study-services.update', [$studyService->study_id, $studyService]);

        $I->submitForm("form[action='$formActionUrl']", $formValues);
        $I->seeResponseCodeIs(200);
        $I->see('Study Travel Parameters updated!');
        $I->seeRecord('study_services', ['ground_default' => $formValues['ground_default']]);
    }

}
