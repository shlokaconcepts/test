<fieldset class=" mt-3">
    <legend>
        <p>Other Information</p>
    </legend>
    <div class="row">
        <div class="col-md-4 mt-2">
            <div class="form-group">
                <label>What are your major achievements in your experience? <br> आपके अनुभव में आपकी
                    प्रमुख
                    उपलब्धियां क्या हैं?</label>
                <input type="text" name="your_major_achievement" value="{{ $user->your_major_achievement }}"
                    id="your_major_achievement" class="form-control">
                <span class="invalid-feedback d-none your_major_achievement" role="alert">
                    <strong class="your_major_achievement_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="form-group">
                <label> What are your hobbies 1<br> आपके शौक क्या हैं 1</label>
                <input type="text" name="your_hobbies_one" value="{{ $user->your_hobbies_one }}"
                    id="your_hobbies_one" class="form-control">
                <span class="invalid-feedback d-none your_hobbies_one" role="alert">
                    <strong class="your_hobbies_one_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="form-group">
                <label> What are your hobbies 2<br> आपके शौक क्या हैं 2</label>
                <input type="text" name="your_hobbies_two" value="{{ $user->your_hobbies_two }}"
                    id="your_hobbies_two" class="form-control">
                <span class="invalid-feedback d-none your_hobbies_two" role="alert">
                    <strong class="your_hobbies_two_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="form-group">
                <label> What are your hobbies 3<br> आपके शौक क्या हैं 3</label>
                <input type="text" name="your_hobbies_three" value="{{ $user->your_hobbies_three }}"
                    id="your_hobbies_three" class="form-control">
                <span class="invalid-feedback d-none your_hobbies_three" role="alert">
                    <strong class="your_hobbies_three_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="form-group">
                <label>Do you know four wheeler driving? / क्या आप चार पहिये वाली गाड़ी चलाना
                    जानते
                    हैं : </label>
                <select class="form-select" name="car_driving" id="car_driving">
                    <option value="NO" @if (isset($user->car_driving) && $user->car_driving == 'NO') selected @endif>NO
                        (ना)
                    </option>
                    <option value="YES" @if (isset($user->car_driving) && $user->car_driving == 'YES') selected @endif>YES
                        (हाँ)
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-4 mt-2 car_driving_detail" style="display: none;">
            <div class="form-group">
                <label>Driving Licence No <br> लाइसेंस नंबर:</label><br>
                <input type="text" name="driving_license"
                    value="{{ isset($user->driving_license) ? $user->driving_license : old('driving_license') }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="form-group">
                <label>What do you think, is mobile necessary? if so why <br> आपको क्या लगता है, क्या
                    मोबाइल जरूरी है? यदि ऐसा है तो क्यों</label>
                <input type="text" name="mobile_necessary" value="{{ $user->mobile_necessary }}"
                    id="mobile_necessary" class="form-control">
                <span class="invalid-feedback d-none mobile_necessary" role="alert">
                    <strong class="mobile_necessary_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-8 mt-2">
            <div class="form-group">
                <label>How many phones do you have (please specify the model)<br>आपके पास कितने फ़ोन हैं
                    (कृपया मॉडल निर्दिष्ट करें)</label>
                <input type="text" name="how_many_mobile" value="{{ $user->how_many_mobile }}" id="how_many_mobile"
                    class="form-control">
                <span class="invalid-feedback d-none how_many_mobile" role="alert">
                    <strong class="how_many_mobile_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label>Does your phone have/don't have internet connection? If yes, which plan do you
                    have (2G, 3G, 4G) <br> क्या आपके फोन में इंटरनेट कनेक्शन है/नहीं है? अगर हां, तो
                    आपके पास कौन सा प्लान है (2जी, 3जी, 4जी)</label>
                <input type="text" name="internet_connection" value="{{ $user->internet_connection }}"
                    id="internet_connection" class="form-control">
                <span class="invalid-feedback d-none internet_connection" role="alert">
                    <strong class="internet_connection_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label>Do you think mobile should be used while lunch/studying/working?<br> क्या आपको
                    लगता है कि लंच/पढ़ाई/काम करते समय मोबाइल का इस्तेमाल करना चाहिए?</label>
                <input type="text" name="mobile_uses" value="{{ $user->mobile_uses }}" id="mobile_uses"
                    class="form-control">
                <span class="invalid-feedback d-none mobile_uses" role="alert">
                    <strong class="mobile_uses_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label>what do you use the internet for on the phone <br> आप फोन पर इंटरनेट का उपयोग किस
                    लिए करते हैं</label>
                <input type="text" name="what_you_use_net" value="{{ $user->what_you_use_net }}"
                    id="what_you_use_net" class="form-control">
                <span class="invalid-feedback d-none what_you_use_net" role="alert">
                    <strong class="what_you_use_net_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label>Why do you want to associate with Suzuki Motor Gujarat Private Limited<br> आप
                    सुजुकी मोटर गुजरात प्राइवेट लिमिटेड के साथ क्यों जुड़ना चाहते हैं?</label>
                <input type="text" name="want_to_associate" value="{{ $user->want_to_associate }}"
                    id="want_to_associate" class="form-control">
                <span class="invalid-feedback d-none want_to_associate" role="alert">
                    <strong class="want_to_associate_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label>Do you have any relative or friend working in Suzuki Group of Companies? If yes,
                    please share the details<br> क्या आपका कोई रिश्तेदार या दोस्त सुजुकी ग्रुप ऑफ कंपनीज
                    में काम करता है? यदि हाँ, तो कृपया विवरण साझा करें</label>
                <input type="text" name="relative_work_with_company"
                    value="{{ $user->relative_work_with_company }}" id="relative_work_with_company"
                    class="form-control">
                <span class="invalid-feedback d-none relative_work_with_company" role="alert">
                    <strong class="relative_work_with_company_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label>Have you suffered any major accident/ illness/ operation in the past? If yes,
                    please share the details <br> क्या आप पूर्व में किसी बड़ी दुर्घटना/बीमारी/ऑपरेशन से
                    पीड़ित हुए हैं? यदि हाँ, तो कृपया विवरण साझा करें</label>
                <input type="text" name="have_you_suffered" value="{{ $user->have_you_suffered }}"
                    id="have_you_suffered" class="form-control">
                <span class="invalid-feedback d-none have_you_suffered" role="alert">
                    <strong class="have_you_suffered_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="form-group">
                <label>Are you ready to work in Hansalpur, Gujarat? <br> क्या आप गुजरात के हंसलपुर, में
                    काम करने के लिए तैयार हैं?</label>
                <select name="are_you_ready_work_in_plc" id="are_you_ready_work_in_plc" class=" form-select">
                    <option value="NO" @selected($user->are_you_ready_work_in_plc == 'NO')>NO</option>
                    <option value="YES" @selected($user->are_you_ready_work_in_plc == 'YES')>YES</option>
                </select>
                <span class="invalid-feedback d-none are_you_ready_work_in_plc" role="alert">
                    <strong class="are_you_ready_work_in_plc_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="form-group">
                <label>Are you ready to relocate anywhere in India or abroad? <br> क्या आप भारत या विदेश
                    में कहीं भी स्थानांतरित होने के लिए तैयार हैं?</label>
                <select name="are_you_ready_rel_anyw" id="are_you_ready_rel_anyw" class=" form-select">
                    <option value="NO" @selected($user->are_you_ready_rel_anyw == 'NO')>NO</option>
                    <option value="YES" @selected($user->are_you_ready_rel_anyw == 'YES')>YES</option>
                </select>
                <span class="invalid-feedback d-none are_you_ready_rel_anyw" role="alert">
                    <strong class="are_you_ready_rel_anyw_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="form-group">
                <label>Are you physically
                    handicapped <br> क्या आप
                    शारीरिक
                    रूप से विकलांग हैंा? </label>
                <select class="form-select" name="physically_handicapped" id="physically_handicapped">
                    <option value="NO" @if ($user->physically_handicapped == 'NO') selected @endif>NO
                        (ना)</option>
                    <option value="YES" @if ($user->physically_handicapped == 'YES') selected @endif>
                        YES (हाँ)
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-6 mt-2 d-none physically_handicapped_detail">
            <div class="form-group">
                <label>If you are handicapped, then give further information <br> अगर आप विकलांग
                    हैं तो
                    और
                    जानकारी दें </label>
                <input type="text" name="physically_handicap_information"
                    value="{{ $user->physically_handicap_information }}" class="form-control">
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="form-group">
                <label>Have you or your family been prosecuted by any court? <br> क्या आप या आपके परिवार
                    पर किसी न्यायालय द्वारा मुकदमा चलाया गया है?</label>
                <select class="form-select" name="gov_action" id="gov_action">
                    <option value="NO" @if ($user->gov_action = 'NO') selected @endif>NO
                        (ना)</option>
                    <option value="YES" @if ($user->gov_action == 'YES') selected @endif>
                        YES (हाँ)
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-6 mt-2 d-none gov_action_detail">
            <div class="form-group">
                <label>If yes,
                    please share the details <br> यदि हाँ, तो कृपया विवरण साझा करें</label>
                <input type="text" name="gov_action_detail" value="{{ $user->gov_action_detail }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="form-group">
                <label>Have you appeared in Suzuki Motors or Mr. Suzuki Interview or Written Test
                    before? <br>क्या आप पहले Suzuki Motors या Mr. Suzuki साक्षात्कार या लिखित परीक्षा
                    में उपस्थित हुए हैं?</label>
                <select class="form-select" name="have_you_appeared_this_com" id="have_you_appeared_this_com">
                    <option value="NO" @if ($user->have_you_appeared_this_com = 'NO') selected @endif>NO
                        (ना)</option>
                    <option value="YES" @if ($user->have_you_appeared_this_com == 'YES') selected @endif>
                        YES (हाँ)
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-6 mt-2 d-none have_you_appeared_this_com_detail">
            <div class="form-group">
                <label>If yes,
                    please share the details <br> यदि हाँ, तो कृपया विवरण साझा करें</label>
                <input type="text" name="have_you_appeared_this_com_detail"
                    value="{{ $user->have_you_appeared_this_com_detail }}" class="form-control">
            </div>
        </div>
        <div class="col-md-6  mt-2">
            <div class="form-group">
                <label>Have you worked with this company<br>क्या आपने इस कंपनी के साथ काम किया
                    है</label>
                <select class="form-select" name="already_worked" id="already_worked">
                    <option value="NO" @if ($user->already_worked == 'NO') selected @endif>
                        NO
                    </option>
                    <option value="YES" @if ($user->already_worked == 'YES') selected @endif>YES
                    </option>
                </select>
                <span class="invalid-feedback d-none already_worked" role="alert">
                    <strong class="already_worked_msg"></strong>
                </span>
            </div>
        </div>
        <div class="col-md-6 mt-2 d-none already_worked_detail">
            <div class="form-group">
                <label>If yes, give details of designation, season and duration<br>यदि हाँ, तो पदनाम,
                    ऋतु और अवधि का विवरण दें</label>
                <input type="text" name="already_worked_detail" value="{{ $user->already_worked_detail }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-12 mt-3">
            <label for=""> <b>Provide details of 2 responsible references, other than family
                    members and friends / परिवार के सदस्यों और दोस्तों के अलावा 2 जिम्मेदार संदर्भों का
                    विवरण प्रदान करें</b> </label>
            <div class=" table-responsive">
                <table class="table  table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl.No <br> क्रमांक </th>
                            <th>Name of Person <br>/ व्यक्ति का नाम</th>
                            <th>Address <br>/पता</th>
                            <th>Contact No <br>/संपर्क नंबर</th>
                            <th>Since when you know<br>/आप कब से जानते हैं</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="text" name="resp_per_name_one"
                                    value="{{ $user->resp_per_name_one }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resp_per_address_one"
                                    value="{{ $user->resp_per_address_one }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resp_per_cont_one"
                                    value="{{ $user->resp_per_cont_one }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resp_per_since_know_one"
                                    value="{{ $user->resp_per_since_know_one }}" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <input type="text" name="resp_per_name_two"
                                    value="{{ $user->resp_per_name_two }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resp_per_address_two"
                                    value="{{ $user->resp_per_address_two }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resp_per_cont_two"
                                    value="{{ $user->resp_per_cont_two }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resp_per_since_know_two"
                                    value="{{ $user->resp_per_since_know_two }}" class="form-control">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 mt-3">
            <label for=""> <b>Additional Information for Background Verification / पृष्ठभूमि
                    सत्यापन के लिए अतिरिक्त जानकारी </b> </label>
            <p> <b> Address History: Furnish addresses of your residence in the last ten (10) years.
                    (Attach additional sheet if you have
                    more than 5 residential addresses in the last ten years)
                </b></p>
            <div class="table-responsive">
                <table class="table  table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Period of stay From</th>
                            <th>Period of stay To</th>
                            <th>Address </th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Zip Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" name="addit_info_back_stay_from_one"
                                    value="{{ $user->add_info_back_stay_from_one }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_back_stay_to_one"
                                    value="{{ $user->add_info_back_stay_to_one }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_address_one"
                                    value="{{ $user->add_info_address_one }}" class="form-control">
                            </td>
                            <td>
                                <select name="addit_info_state_one" class=" form-select" id="addit_info_state_one">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @selected($user->addit_info_state_one == $state->id)>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="addit_info_country_one"
                                    value="{{ $user->add_info_country_one }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_zip_code_one"
                                    value="{{ $user->add_info_zip_code_one }}" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addit_info_back_stay_from_two"
                                    value="{{ $user->add_info_back_stay_from_two }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_back_stay_to_two"
                                    value="{{ $user->add_info_back_stay_to_two }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_address_two"
                                    value="{{ $user->add_info_address_two }}" class="form-control">
                            </td>
                            <td>
                                <select name="addit_info_state_two" class=" form-select" id="addit_info_state_two">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @selected($user->addit_info_state_two == $state->id)>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="addit_info_country_two"
                                    value="{{ $user->add_info_country_two }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_zip_code_two"
                                    value="{{ $user->add_info_zip_code_two }}" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addit_info_back_stay_from_three"
                                    value="{{ $user->add_info_back_stay_from_three }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_back_stay_to_three"
                                    value="{{ $user->add_info_back_stay_to_three }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_address_three"
                                    value="{{ $user->add_info_address_three }}" class="form-control">
                            </td>
                            <td>
                                <select name="addit_info_state_three" class=" form-select"
                                    id="addit_info_state_three">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @selected($user->addit_info_state_three == $state->id)>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="addit_info_country_three"
                                    value="{{ $user->add_info_country_three }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_zip_code_three"
                                    value="{{ $user->add_info_zip_code_three }}" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addit_info_back_stay_from_four"
                                    value="{{ $user->add_info_back_stay_from_four }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_back_stay_to_four"
                                    value="{{ $user->add_info_back_stay_to_four }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_address_four"
                                    value="{{ $user->add_info_address_four }}" class="form-control">
                            </td>
                            <td>
                                <select name="addit_info_state_four" class=" form-select" id="addit_info_state_four">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @selected($user->addit_info_state_four == $state->id)>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="addit_info_country_four"
                                    value="{{ $user->add_info_country_four }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_zip_code_four"
                                    value="{{ $user->add_info_zip_code_four }}" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addit_info_back_stay_from_five"
                                    value="{{ $user->add_info_back_stay_from_five }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_back_stay_to_five"
                                    value="{{ $user->add_info_back_stay_to_five }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_address_five"
                                    value="{{ $user->add_info_address_five }}" class="form-control">
                            </td>
                            <td>
                                <select name="addit_info_state_five" class=" form-select" id="addit_info_state_five">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @selected($user->addit_info_state_five == $state->id)>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="addit_info_country_five"
                                    value="{{ $user->add_info_country_five }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="addit_info_zip_code_five"
                                    value="{{ $user->add_info_zip_code_five }}" class="form-control">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</fieldset>

<div class="col-12 text-center">
    <a href="#" class="btn btn-custom-2 btn-prev-tab btn-radius py-1" data-target="pills-step-1" data-href="pills-step-1-tab"><i class="fas fa-arrow-left"></i> Prev</a>
    <button type="submit" class="btn btn-custom"><i class="fas fa-save"></i> Save Details</button>
    <a href="#" class="btn btn-custom-2 btn-next-tab btn-radius py-1" data-target="pills-step-project" data-href="pills-step-project-tab">Next <i class="fas fa-arrow-right"></i></a>
</div>
