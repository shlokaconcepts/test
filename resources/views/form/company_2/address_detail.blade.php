<fieldset class="mt-3">
    <legend>
        <p>Full Address</p>
    </legend>
    <fieldset>
        <legend>
            <p>Permanent Address (स्थायी पता )</p>
        </legend>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>House / Flat No (मकान संख्या)<span class="requiredt">*</span></label>
                    <input type="text" id="permanent_house_number" name="permanent_house_number"
                        class="form-control" required
                        value="{{ isset($user->permanent_house_number) ? $user->permanent_house_number : old('permanent_house_number') }}">
                    <span class="invalid-feedback permanent_house_number d-none" role="alert">
                        <strong class="permanent_house_number_msg"></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Street / Village (गली/गााँव)<span class="requiredt">*</span></label>
                    <input type="text" name="permanent_house_street_village"
                        id="permanent_house_street_village" class="form-control" required
                        value="{{ isset($user->permanent_house_street_village) ? $user->permanent_house_street_village : old('permanent_house_street_village') }}">
                    <span class="invalid-feedback permanent_house_street_village d-none"
                        role="alert">
                        <strong class="permanent_house_street_village_msg"></strong>
                    </span>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label>Post Office / Tehsil / डाकघर / तहसील<span class="requiredt">*</span></label>
                    <input type="text" name="permanent_post_office_tehsil"
                        id="permanent_post_office_tehsil" class="form-control" required
                        value="{{ $user->permanent_post_office_tehsil }}">
                    <span class="invalid-feedback permanent_post_office_tehsil d-none" role="alert">
                        <strong class="permanent_post_office_tehsil_msg"></strong>
                    </span>
                </div>
            </div>


            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>State / राज्य <span class="requiredt">*</span></label><br>
                    <select class="form-select  @error('permanent_state') is-invalid @enderror"
                        name="permanent_state" id="permanent_state" required="">
                        <option value="">Select State</option>
                        @foreach ($pr_state as $state)
                            <option value="{{ $state->id }}"
                                @if (isset($user->permanent_state) && $user->permanent_state == $state->id) selected @endif>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback permanent_state d-none" role="alert">
                        <strong class="permanent_state_msg"></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>District (जिला)<span class="requiredt">*</span></label><br>
                    <select class="form-select" name="permanent_district" id="permanent_district"
                        required="">
                        <option value="">Select District</option>
                    </select>
                    <span class="invalid-feedback permanent_district d-none" role="alert">
                        <strong class="permanent_district_msg"></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Pin Code / पिन कोड <span class="requiredt">*</span></label>
                    <input type="number" id="permanent_pincode" name="permanent_pincode"
                        value="{{ isset($user->permanent_pincode) ? $user->permanent_pincode : old('permanent_pincode') }}"
                        class="form-control " required="">
                    <span class="invalid-feedback d-none permanent_pincode" role="alert">
                        <strong class="permanent_pincode_msg"></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Landline/Mobile / लैंडलाइन/मोबाइल<span class="requiredt">*</span></label>
                    <input type="number" id="permanent_landline_mobile"
                        name="permanent_landline_mobile"
                        value="{{ $user->permanent_landline_mobile }}" class="form-control">
                    <span class="invalid-feedback d-none permanent_landline_mobile" role="alert">
                        <strong class="permanent_landline_mobile_msg"></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Period of Stay from</label>
                    <input type="text" id="permanent_stay_from" name="permanent_stay_from"
                        value="{{ $user->permanent_stay_from }}" class="form-control">
                    <span class="invalid-feedback d-none permanent_stay_from" role="alert">
                        <strong class="permanent_stay_from_msg"></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Period of Stay to</label>
                    <input type="text" id="permanent_stay_to" name="permanent_stay_to"
                        value="{{ $user->permanent_stay_to }}" class="form-control">
                    <span class="invalid-feedback d-none permanent_stay_to" role="alert">
                        <strong class="permanent_stay_to_msg"></strong>
                    </span>
                </div>
            </div>
        </div>
    </fieldset>


    <fieldset class="mt-2">
        <legend>
            <p>Present Address (वर्तमान पता)</p>
        </legend>
        <div class="row mt-2">
            <div class="col-md-12">
                <label>
                    <input class="form-check-input me-1" type="checkbox" id="same_address">
                    <b> Is your present address same as permanent address ?</b>
                </label>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>House / Flat No (मकान संख्या)<span class="requiredt">*</span></label>
                    <input type="text" name="present_house_number" class="form-control"
                        id="present_house_number" required
                        value="{{ isset($user->present_house_number) ? $user->present_house_number : old('present_house_number') }}">
                    <span class="invalid-feedback present_house_number d-none" role="alert">
                        <strong class="present_house_number_msg"></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Street / Village (गली/गााँव)<span class="requiredt">*</span></label>
                    <input type="text" name="present_house_street_village"
                        id="present_house_street_village" class="form-control" required
                        value="{{ isset($user->present_house_street_village) ? $user->present_house_street_village : old('present_house_street_village') }}">
                    <span class="invalid-feedback present_house_street_village d-none" role="alert">
                        <strong class="present_house_street_village_msg"></strong>
                    </span>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label>Post Office / Tehsil / डाकघर / तहसील<span class="requiredt">*</span></label>
                    <input type="text" name="present_post_office_tehsil"
                        id="present_post_office_tehsil" class="form-control" required
                        value="{{ $user->present_post_office_tehsil }}">
                    <span class="invalid-feedback present_post_office_tehsil d-none" role="alert">
                        <strong class="present_post_office_tehsil_msg"></strong>
                    </span>
                </div>
            </div>


            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>State / राज्य <span class="requiredt">*</span></label><br>
                    <select class="form-select" name="present_state" id="present_state"
                        required="">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                @if (isset($user->present_state) && $user->present_state == $state->id) selected @endif>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback present_state d-none" role="alert">
                        <strong class="present_state_msg"></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>District (जिला)<span class="requiredt">*</span></label><br>
                    <select class="form-select" name="present_district" id="present_district"
                        required="">
                        <option value="">Select District</option>
                    </select>
                    <span class="invalid-feedback present_state d-none" role="alert">
                        <strong class="present_state_msg"></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Pin Code / पिन कोड <span class="requiredt">*</span></label>
                    <input type="number" name="present_pincode" id="present_pincode"
                        value="{{ isset($user->present_pincode) ? $user->present_pincode : old('present_pincode') }}"
                        class="form-control" required="">
                    <span class="invalid-feedback present_pincode d-none" role="alert">
                        <strong class="present_pincode_msg"></strong>
                    </span>
                </div>
            </div>




            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Landline/Mobile / लैंडलाइन/मोबाइल<span class="requiredt">*</span></label>
                    <input type="number" id="present_landline_mobile" name="present_landline_mobile"
                        value="{{ $user->present_landline_mobile }}" class="form-control">
                    <span class="invalid-feedback d-none present_landline_mobile" role="alert">
                        <strong class="present_landline_mobile_msg"></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Period of Stay from</label>
                    <input type="text" id="present_stay_from" name="present_stay_from"
                        value="{{ $user->present_stay_from }}" class="form-control">
                    <span class="invalid-feedback d-none present_stay_from" role="alert">
                        <strong class="present_stay_from_msg"></strong>
                    </span>
                </div>
            </div>

            <div class="col-md-4 mt-2">
                <div class="form-group">
                    <label>Period of Stay to</label>
                    <input type="text" id="present_stay_to" name="present_stay_to"
                        value="{{ $user->present_stay_to }}" class="form-control">
                    <span class="invalid-feedback d-none present_stay_to" role="alert">
                        <strong class="present_stay_to_msg"></strong>
                    </span>
                </div>
            </div>


        </div>
    </fieldset>
</fieldset>