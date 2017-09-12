<?php

use App\Models\Sponsor;
use App\Models\Site;


class StudyCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    private function sampleStudyFormData()
    {
        $studyData = factory('App\Models\Study')->make()->toArray();
        $studyData['country_ids'] = '1,3,5,10';
        $studyData['site_ids'] = '1,3,5,10';

        return $studyData;
    }

    // tests
    public function indexStudyTest(FunctionalTester $I)
    {
        $sponsor = $I->have('App\Models\Sponsor');

        $I->amLoggedInAsAdmin($I);
        $I->amOnPage(route('sponsors.studies.index', $sponsor));
        $I->seeResponseCodeIs(200);
        $I->see("Studies for $sponsor->name");
    }

    public function showStudyTest(FunctionalTester $I)
    {
        $study = $I->have('App\Models\Study');

        $I->amLoggedInAsAdmin($I);
        $I->amOnPage(route('sponsors.studies.show', [$study->sponsor, $study]));
        $I->seeResponseCodeIs(200);
        $I->see($study->name);
    }

    public function createStudyTest(FunctionalTester $I)
    {
        $sponsor = $I->have('App\Models\Sponsor'); 

        $I->amLoggedinAsAdmin($I);
        $I->amOnPage(route('sponsors.studies.create', $sponsor));
        $I->see('Create Study');    

        $formValues = $this->sampleStudyFormData();
        $formActionUrl = route('sponsors.studies.store', $sponsor);

        $I->submitForm("form[action='$formActionUrl']", $formValues);
        $I->seeResponseCodeIs(200);
        $I->seeInCurrentUrl('studies');
        $I->see('Study created!');
    }

    public function editStudyTest(FunctionalTester $I)
    {
        $study = $I->have('App\Models\Study');

        $I->amLoggedInAsAdmin($I);
        $I->amOnPage(route('sponsors.studies.edit', [$study->sponsor_id, $study]));
        $I->see('Edit Study');    

        $formValues = $this->sampleStudyFormData();
        $formActionUrl = route('sponsors.studies.update', [$study->sponsor_id, $study]);

        $I->submitForm("form[action='$formActionUrl']", $formValues);
        $I->seeResponseCodeIs(200);
        $I->seeInCurrentUrl('studies');
        $I->see('Study updated!');
        $I->seeRecord('studies', [ 'name' => $formValues['name']]);
    }
    
    public function deleteStudyTest(FunctionalTester $I)
    {
        $I->amLoggedInAsAdmin($I);
        $study = $I->have('App\Models\Study'); 

        $I->amOnPage(route('sponsors.studies.edit', [$study->sponsor_id, $study]));
        $I->click('Delete');
        $I->seeInCurrentUrl('sponsors');
        $I->see('Study deleted!');
        $I->dontSeeRecord('studies', [ 'id' => $study->id]);

    }
}
