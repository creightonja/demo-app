<?php

use App\Models\Sponsor;
use App\Models\StudyCost;


class StudyCostCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    private function sampleStudyCostFormData()
    {
        $studyData = factory('App\Models\StudyCost')->make()->toArray();

        return $studyData;
    }

    public function createStudyCostTest(FunctionalTester $I)
    {
        $study = $I->have('App\Models\Study'); 

        $I->amLoggedinAsAdmin($I);
        $I->amOnPage(route('studies.study-costs.create', $study));
        $I->see('Create Study Costs');    

        $formValues = $this->sampleStudyCostFormData();
        $formActionUrl = route('studies.study-costs.store', $study);

        $I->submitForm("form[action='$formActionUrl']", $formValues);
        $I->seeResponseCodeIs(200);
        $I->see('Study Costs created!');
    }

    public function editStudyCostTest(FunctionalTester $I)
    {
        $studyCost = $I->have('App\Models\StudyCost');

        $I->amLoggedInAsAdmin($I);
        $I->amOnPage(route('studies.study-costs.edit', [$studyCost->study_id, $studyCost]));
        $I->see('Edit Study Costs');    

        $formValues = $this->sampleStudyCostFormData();
        $formActionUrl = route('studies.study-costs.update', [$studyCost->study_id, $studyCost]);

        $I->submitForm("form[action='$formActionUrl']", $formValues);
        $I->seeResponseCodeIs(200);
        $I->see('Study Costs updated!');
        $I->seeRecord('study_costs', ['airfare' => $formValues['airfare'] . '00']); // Values received must come in decimal form or get two 0s added.
    }

}
