
	<h2>Full Scope Services</h2>
	<hr>
    <div class="bootstrap-cplex">
        <div class="columns">
            <div class="column">
                <div class="columns">
                    <h3>Air Transportation Expenses</h3>
                </div>
                
                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('airfare', number_format($studyCost->airfare * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Airfare Cost') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('airfare_qty', $studyCost->airfare_qty, ['min' => 0, 'step' => 1], 'Airfare Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <hr>

        <div class="columns">
            <div class="column">
                <div class="columns">
                    <h3>Ground Transportation Expenses</h3>
                </div>
                
                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('home_to_airport', number_format($studyCost->home_to_airport * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Home to Airport Costs (roundtrip)') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('home_to_airport_qty', $studyCost->home_to_airport_qty, ['min' => 0, 'step' => 1], 'Home to Airport Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('airport_to_site', number_format($studyCost->airport_to_site * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Airport/Rail to Site (one-way)') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('airport_to_site_qty', $studyCost->airport_to_site_qty, ['min' => 0, 'step' => 1], 'Airport/Rail to Site Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('site_to_airport', number_format($studyCost->site_to_airport * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Site to Airport/Rail (one-way)') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('site_to_airport_qty', $studyCost->site_to_airport_qty, ['min' => 0, 'step' => 1], 'Site to Airport/Rail Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <hr>

        <div class="columns">
            <div class="column">
                <div class="columns">
                    <h3>Hotel Expenses</h3>
                </div>
                
                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('hotel', number_format($studyCost->hotel * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Hotel Cost') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('hotel_qty', $studyCost->hotel_qty, ['min' => 0, 'step' => 1], 'Hotel Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <hr>

        <div class="columns">
            <div class="column is-full-width">
                <div class="columns">
                    <h3>Patient Payment Expenses</h3>
                </div>
                
                <div class="columns">
                    <div class="column">
                            <div class="columns">
                                <div class="column is-one-quarter">
                                {!! Form::buNumber('meal_per_diem', number_format($studyCost->meal_per_diem * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Meal Per Diem/day') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('meal_per_diem_qty', $studyCost->meal_per_diem_qty, ['min' => 0, 'step' => 1], 'Meal Per Diem/day Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('stipend', number_format($studyCost->stipend * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Stipend') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('stipend_qty', $studyCost->stipend_qty, ['min' => 0, 'step' => 1], 'Stipend Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('expense_reimbursement', number_format($studyCost->expense_reimbursement * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Expense Reimbursements') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('expense_reimbursement_qty', $studyCost->expense_reimbursement_qty, ['min' => 0, 'step' => 1], 'Expense Reimbursements Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <h2>Limited Scope Services</h2>
        <hr>
        <div class="columns">
            <div class="column">
                <div class="columns">
                    <h3>Local Ground Transportation Expenses</h3>
                </div>
                
                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('local_home_to_site', number_format($studyCost->local_home_to_site * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Home to Site (roundtrip)') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('local_home_to_site_qty', $studyCost->local_home_to_site_qty, ['min' => 0, 'step' => 1], 'Home to Site Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="columns">
            <div class="column is-full-width">
                <div class="columns">
                    <h3>Local Patient Payment Expenses</h3>
                </div>
                
                <div class="columns">
                    <div class="column">
                            <div class="columns">
                                <div class="column is-one-quarter">
                                {!! Form::buNumber('local_meal_per_diem', number_format($studyCost->local_meal_per_diem * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Local Meal Per Diem/day') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('local_meal_per_diem_qty', $studyCost->local_meal_per_diem_qty, ['min' => 0, 'step' => 1], 'Local Meal Per Diem/day Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('local_stipend', number_format($studyCost->local_stipend * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Local Stipend') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('local_stipend_qty', $studyCost->local_stipend_qty, ['min' => 0, 'step' => 1], 'Local Stipend Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('local_expense_reimbursement', number_format($studyCost->local_expense_reimbursement * .01, 2, '.', ''), ['min' => 0.00, 'step' => 0.01], 'Local Expense Reimbursements') !!}
                            </div>
                            <div class="column is-one-quarter">
                                {!! Form::buNumber('local_expense_reimbursement_qty', $studyCost->local_expense_reimbursement_qty, ['min' => 0, 'step' => 1], 'Local Expense Reimbursements Quantity') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        {!! Form::buSubmitButton() !!}
    </div>
