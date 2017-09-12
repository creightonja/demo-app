@extends('layouts.default')

@section('content')
@section('pageTitle', 'Study - ' . $study->name)

@if(Session::has('message'))
    <div class="notification is-success">
        <button class="delete"></button>
        {{ Session::get('message') }}
    </div>
@endif

<div class="container">
    <div class="columns">
        <div class="column is-three-quarters">
            <tabs>
                <tab name="Study Patients" :selected="true">
                    
                        @if (isset($study->set_up_complete))
                            <list table_heading="Patients in this Study" :list_items="{{ $study->patients }}" :searchable_columns="{{ json_encode(['Name' => 'fullName', 'Level of Support' => 'level_of_support', 'Date of Birth' => 'date_of_birth', 'Phone Number' => 'phone', 'Email' => 'email']) }}"></list>
                        @else
                            <div>
                                No patients in this study yet.
                            </div>
                        @endif
                        @if ($study->set_up_complete)
                        <a href="{{ route('studies.patients.create', [$study]) }}" class="is-pulled-right button is-primary">Add Patient to Study</a>
                        @else
                        <div>
                            Study travel parameters and pass through costs must be set prior to adding patients to the study.
                        </div>
                        @endif

                    
                </tab>

                <tab name="Study Travel Parameters">
                    @if ($study->studyService)
                        <div class="columns">
                            <div class="column">
                                <div class="columns">
                                    <div class="column">
                                        <h3>Accomodation Services</h3>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        Hotel Accomodation
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->accomodation_hotel ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Relocation Accomodation
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->accomodation_relocation ? 'Yes' : 'No' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="columns">
                            <div class="column">
                                <div class="columns">
                                    <div class="column">
                                        <h3>Air Services</h3>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        Air Ambulance
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->air_ambulance ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Commercial Air
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->air_commercial ? 'Yes' : 'No' }}
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <hr>
                        <div class="columns">
                            <div class="column">
                                <div class="columns">
                                    <div class="column">
                                        <h3>Ground Services</h3>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        Ground Ambulance
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->ground_ambulance ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Ground Sedan
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->ground_sedan ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Ground Shared
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->ground_shared ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Ground WAV
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->ground_wav ? 'Yes' : 'No' }}
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        Default Ground Transit
                                    </div>
                                    <div class="column">
                                        {{ isset($study->studyService->ground_default) ? $groundServiceTypes[$study->studyService->ground_default] : 'None' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="columns">
                            <div class="column">
                                <div class="columns">
                                    <div class="column">
                                        <h3>Payments Services</h3>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        Payments Reimbursement
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->payments_reimbursement ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Payments Stipend
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->payments_stipend ? 'Yes' : 'No' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="columns">
                            <div class="column">
                                <div class="columns">
                                    <div class="column">
                                        <h3>Other Services</h3>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        Visa and Passport
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->visa_passport ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Traveling Nurse
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->traveling_nurse ? 'Yes' : 'No' }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        Travel Companion
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->travel_companion ? 'Yes' : 'No' }}
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        International Health Insurance
                                    </div>
                                    <div class="column">
                                        {{ $study->studyService->international_health_insurance ? 'Yes' : 'No' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        
                        @can('create study services')
                            <a href="{{ route('studies.study-services.edit', [$study, $study->studyService]) }}" class="is-pulled-right button is-primary">Edit Study Travel Parameters</a>
                        @endcan
                    @else 
                        @can('create study services')
                            <a href="{{ route('studies.study-services.create', [$study]) }}" class="is-pulled-right button is-primary">Add Study Travel Parameters</a>
                        @else
                            No patient services currently assigned.
                        @endcan
                    @endif
                </tab>

                <tab name="Pass Through Costs">
                    @if ($study->studyCost)
                        <h3>Full Scope Services</h3>
                        <table class="table">
                            <thead>
                                <th>
                                    Unit Type
                                </th>
                                <th>
                                    Unit Cost
                                </th>
                                <th>
                                    Unit Quantity
                                </th>
                                <th>
                                    Expected Total Cost
                                </th>
                            </thead>
                            <tbody>
                            @php(setlocale(LC_MONETARY, 'en_US.utf8'))
                                <th>Air Transportation Expenses</th>
                                <tr>
                                    <td>
                                        Airfare
                                    </td>
                                    <td>    
                                        {{ money_format('%.2n', $study->studyCost->airfare * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->airfare_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', ($study->studyCost->airfare * 0.01 * $study->studyCost->airfare_qty))  }}
                                    </td>
                                </tr>
                                <th>Ground Transportation Expenses</th>
                                <tr>
                                    <td>
                                        Home to Departure Airport/Rail (roundtrip)
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->home_to_airport * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->home_to_airport_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->home_to_airport * .01 * $study->studyCost->home_to_airport_qty)  }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Airport/Rail to Site (one-way)
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->airport_to_site * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->airport_to_site_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->airport_to_site * .01 * $study->studyCost->airport_to_site_qty) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Site to Airport/Rail (one-way)
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->site_to_airport * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->site_to_airport_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->site_to_airport * .01 * $study->studyCost->site_to_airport_qty) }}
                                    </td>
                                </tr>
                                <th>Hotel Expenses</th>
                                <tr>
                                    <td>
                                        Hotel Accomodations
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->hotel * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->hotel_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->hotel * .01 * $study->studyCost->hotel_qty) }}
                                    </td>
                                </tr>
                                <th>Patient Payment Expenses</th>
                                <tr>
                                    <td>
                                        Meal Per Diem/day
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->meal_per_diem * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->meal_per_diem_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->meal_per_diem * .01 * $study->studyCost->meal_per_diem_qty) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Stipend
                                    </td>
                                   <td>
                                        {{ money_format('%.2n', $study->studyCost->stipend * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->stipend_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->stipend * .01 * $study->studyCost->stipend_qty) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Expense Reimbursements
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->expense_reimbursement * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->expense_reimbursement_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->expense_reimbursement * .01 * $study->studyCost->expense_reimbursement_qty) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h3>Limited Scope Services (local/regional)</h3>
                        <table class="table">
                            <thead>
                                <th>
                                    Unit Type
                                </th>
                                <th>
                                    Unit Cost
                                </th>
                                <th>
                                    Unit Quantity
                                </th>
                                <th>
                                    Expected Total Cost
                                </th>
                            </thead>
                            <tbody>
                                <th>Ground Transportation Expenses</th>
                                <tr>
                                    <td>
                                        Home to Site (roundtrip)
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->local_home_to_site * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->local_home_to_site_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->local_home_to_site * .01 * $study->studyCost->local_home_to_site_qty)  }}
                                    </td>
                                </tr>
                                <th>Patient Payment Expenses</th>
                                <tr>
                                    <td>
                                        Meal Per Diem/day
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->local_meal_per_diem * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->local_meal_per_diem_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->local_meal_per_diem * .01 * $study->studyCost->local_meal_per_diem_qty) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Stipend
                                    </td>
                                   <td>
                                        {{ money_format('%.2n', $study->studyCost->local_stipend * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->local_stipend_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->local_stipend * .01 * $study->studyCost->local_stipend_qty) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Expense Reimbursements
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->local_expense_reimbursement * .01) }}
                                    </td>
                                    <td>
                                        {{ $study->studyCost->local_expense_reimbursement_qty }}
                                    </td>
                                    <td>
                                        {{ money_format('%.2n', $study->studyCost->local_expense_reimbursement * .01 * $study->studyCost->local_expense_reimbursement_qty) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="columns">
                            <div class="column">
                                <strong><h3>Total Estimated Program Service Costs:<h3></strong>
                            </div>
                            <div class="column">
                                <h3>
                                {{ money_format('%.2n', 
                                ($study->studyCost->local_expense_reimbursement * .01 * $study->studyCost->local_expense_reimbursement_qty) +
                                ($study->studyCost->local_stipend * .01 * $study->studyCost->local_stipend_qty) +
                                ($study->studyCost->local_meal_per_diem * .01 * $study->studyCost->local_meal_per_diem_qty) +
                                ($study->studyCost->local_home_to_site * .01 * $study->studyCost->local_home_to_site_qty) +
                                ($study->studyCost->expense_reimbursement * .01 * $study->studyCost->expense_reimbursement_qty) +
                                ($study->studyCost->stipend * .01 * $study->studyCost->stipend_qty) +
                                ($study->studyCost->meal_per_diem * .01 * $study->studyCost->meal_per_diem_qty) +
                                ($study->studyCost->hotel * .01 * $study->studyCost->hotel_qty) +
                                ($study->studyCost->site_to_airport * .01 * $study->studyCost->site_to_airport_qty) +
                                ($study->studyCost->airport_to_site * .01 * $study->studyCost->airport_to_site_qty) +
                                ($study->studyCost->home_to_airport * .01 * $study->studyCost->home_to_airport_qty) +
                                ($study->studyCost->airfare * .01 * $study->studyCost->airfare_qty)) }}
                                </h3>
                            </div>
                        </div>
                        @can('create study services')
                            <a href="{{ route('studies.study-costs.edit', [$study, $study->studyCost]) }}" class="is-pulled-right button is-primary">Edit Study Costs</a>
                        @endcan
                    @else 
                        @can('create study services')
                            <a href="{{ route('studies.study-costs.create', [$study]) }}" class="is-pulled-right button is-primary">Add Study Costs</a>
                        @else
                            No study costs projected.
                        @endcan
                    @endif
                </tab>
            </tabs>
        </div>
        <div class="column is-one-quarter">
          @include('components.cards.studyInfoCard')          
        </div>
    </div>
</div>
@endsection
