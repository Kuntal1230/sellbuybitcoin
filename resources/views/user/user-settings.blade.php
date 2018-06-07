@extends('buysellbitcoin.partial.master') @section('content')

<!--account_col_L design start hear-->
<div class="container-fluid account_fluid">
    <div class="container">
        <div class="col-lg-3 col-md-3 col-xs-12">
            <div class="acount_col_L">
                <ul class="account_ul nav nav-pills nav-stacked">
                    <li class="account_li active">
                        <a class="account_a_1" data-toggle="tab" href="#profile">Profile</a>
                    </li>
                    <li class="account_li">
                        <a class="account_a_2" data-toggle="tab" href="#security">Security</a>
                    </li>
                    <li class="account_li">
                        <a class="account_a_4" data-toggle="tab" href="#question">Set Security Questions</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div role="tabpanel" id="profile" class="col-lg-9 col-md-9 col-xs-12 tab-pane fade in active">
                <div class="acount_col_R">
                    <div class="account_settings">
                        <h3 class="account_settings_h3">Account settings
                            <span class="account_settings_span"> ({{ Auth::user()->email }})</span>
                        </h3>
                    </div>
                    <div class="account_col_9div">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="user_div">
                                <h4 class="user_h41">Username</h4>
                                <h4 class="user_h42">{{ Auth::user()->name }}</h4>
                                <span class="user_span1"></span>
                                <span class="user_span2"></span> 
                                <div class="It_div">
                                        <p class="It_p">It is mandatory to set answers to your security questions in case you have to reset or
                                            change phone number.
                                            <a class="It_a" href="#" data-toggle="modal" data-target="#setSecurityAnswersModal">Set answers</a>
                                        </p>
                                    </div>                              
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <h4 class="user_h41">Profile picture</h4>
                            <img class="user_img" src="{{ asset('images/default-avatar.svg') }}">
                            <button class="user_button" type="button" onclick="">Update Profile Picture</button>
                        </div>
                    </div>
                    <span class="user_span3"></span>
                    <span class="user_span4"></span>
                    <form action="{{ route('user.updateprofile') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="account_col_9div2">
                            <div class="col-lg-6 col-md-6 col-xs-12 pp">
                                <h4 class="user_h41">FIRST NAME</h4>
                                <input class="phone_input" type="text" name="fname" value="{{ Auth::user()->firstname}}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 pp">
                                <h4 class="user_h41">LAST NAME</h4>
                                <input class="phone_input" type="text" name="lname" value="{{ Auth::user()->lastname}}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 pp">
                                <h4 class="user_h41">BIO </h4>
                                <textarea class="user_textarea" name="bio">
                                    {{ Auth::user()->bio}}
                                </textarea>
                                <p class="textarea_p">Maximum 3 lines and 180 characters</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 pp">
                                <h4 class="user_h41">PREFERRED CURRENCY </h4>
                                <select class="user_option" name="preferred_currency">
                                    @foreach ($countreis as $country)
                                    <option value="{{ $country->currency_code }}">{{ $country->currency_name }}</option>
                                        
                                    @endforeach
                                </select>
                                <p class="textarea_p">Select which currency your wallet will use</p>
                            </div>

                        </div>
                        <button class="code_button2" type="submit">SAVE CHANGES</button>
                    </form>
                </div>

            </div>
            <div role="tabpanel" id="security" class="col-lg-9 col-md-9 col-xs-12 tab-pane fade">
                <div class="acount_col_R">

                    <div class="account_col_9div">
                        <div class="col-md-12 col-xs-12">
                            <div class="account_settings">
                                <h3 class="account_settings_h3">Change password</h3>
                            </div>

                            <h4 class="user_h41">Current</h4>
                            <input class="phone_input" type="password" placeholder="" name="password">

                            <h4 class="user_h41">Enter a new password</h4>
                            <input class="phone_input" type="password" placeholder="" name="password">

                            <h4 class="user_h41">Verify password</h4>
                            <input class="phone_input" type="password" placeholder="" name="password">
                            <p class="textarea_p">Changing password will delete all your active web sessions.</p>

                            <button class="code_button2" type="button" onclick="">Change password</button>

                            <p class="textarea_p">If you forgot your current password, please logout and in top right corner click Login and Forgot
                                password link.</p>
                        </div>

                    </div>

                    <span class="user_span3"></span>
                    <span class="user_span4"></span>

                    <div class="account_col_9div2">
                        <div class="account_settings">
                            <h3 class="account_settings_h3">Active sessions</h3>
                        </div>
                        <h4 class="security_factor_h4_2">Web sessions </h4>

                        <div class="Active_div">
                            <table class="Active_table">
                                <tr class="Active_tr">
                                    <th class="Active_th">Signed in</th>
                                    <th class="Active_th">Browser</th>
                                    <th class="Active_th">IP Address</th>
                                    <th class="Active_th">Location</th>
                                    <th class="Active_th">Current</th>
                                </tr>
                                <tbody>
                                    <tr class="Active_tr">
                                        <td class="Active_td">19 seconds ago</td>
                                        <td class="Active_td">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td">202.40.186.82</td>
                                        <td class="Active_td">Bangladesh, Dhaka</td>
                                        <td class="Active_td"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>





                    <span class="user_span3"></span>
                    <span class="user_span4"></span>


                    <div class="account_col_9div3">
                        <div class="account_settings">
                            <h3 class="account_settings_h3">Account activity</h3>
                        </div>
                        <h4 class="security_factor_h4_2">Last 20 actions </h4>

                        <div class="Active_div2">
                            <table class="Active_table">
                                <tr class="Active_tr2">
                                    <th class="Active_th2">Action</th>
                                    <th class="Active_th2">Browser</th>
                                    <th class="Active_th2">IP Address</th>
                                    <th class="Active_th2">Near</th>
                                    <th class="Active_th2">When</th>
                                </tr>
                                <tbody>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User logout</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>

                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>

                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User logout</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User logout</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User logout</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User login</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>
                                    <tr class="Active_tr3">
                                        <td class="Active_td2">User logout</td>
                                        <td class="Active_td2">Chrome ( Windows 10.0)</td>
                                        <td class="Active_td2">202.40.186.82</td>
                                        <td class="Active_td2">Bangladesh, Dhaka</td>
                                        <td class="Active_td2">54 minutes ago</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="account_col_9div3">

                    </div>
                </div>

            </div>
            <div role="tabpanel" id="question" class="col-lg-9 col-md-9 col-xs-12 tab-pane fade">
                <div class="acount_col_R">

                    <div class="account_col_9div">
                        <div class="user_div">
                            <div class="account_settings">
                                <h3 class="account_settings_h3">Set your security questions</h3>
                            </div>
                            <div class="It_div It_div2">
                                <p class="It_p">It is mandatory to set answers to your security questions in case you have to reset or change
                                    phone number.
                                    <br>
                                    <a class="It_a" href="#" data-toggle="modal" data-target="#setSecurityAnswersModal">Set answers</a>
                                    <br> Choose carefully and remember your answers as later you would need them for certain
                                    cases to verify your identity.</p>
                            </div>
                        </div>




                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!--account_col_L design start hear-->

@endsection @section('modal')
<div class="modal fade" id="setSecurityAnswersModal" tabindex="-1" role="dialog" aria-labelledby="setSecurityAnswersModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" accept-charset="UTF-8" role="form" id="security-questions-answers-form" class="form-horizontal nobottommargin">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Set answers</h4>
                </div>
                <div class="modal-body">
                    <span class="help-block">Each answer must be minimum 3 characters long</span>
                    <div class="form-group">
                        <label for="security_question_1" class="control-label col-sm-12 tleft">Security question 1</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="security_question_1" name="security_question_1">
                                <option value="0">What city were your parents married?</option>
                                <option value="1">What was your first pet's name?</option>
                                <option value="2">What was your major in college?</option>
                                <option value="3">What was the first foreign country you visited?</option>
                                <option value="4">Which city were you married in?</option>
                                <option value="5">What was the name of street you grew up on?</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="security_question_1_answer" class="col-sm-3 control-label">Answer 1</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="security_question_1_answer" type="text" id="security_question_1_answer">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="security_question_2" class="control-label col-sm-12 tleft">Security question 2</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="security_question_2" name="security_question_2">
                                <option value="0">What was the city of your first elementary school?</option>
                                <option value="1">What was your first teacher name?</option>
                                <option value="2">What is the nickname of your oldest child?</option>
                                <option value="3">What was your first high school name?</option>
                                <option value="4">Who was your first boss first name?</option>
                                <option value="5">Who first told you about bitcoin?</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="security_question_2_answer" class="col-sm-3 control-label">Answer 2</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="security_question_2_answer" type="text" id="security_question_2_answer">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save-security-answers-btn" class="btn btn-primary ladda-button" data-style="zoom-in">
                        <span class="ladda-label">Save</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection