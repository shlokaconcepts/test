

<fieldset class="mt-3">
    <legend>
        <p>Family Details</p>
    </legend>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped mt-4 ">
            <thead>
                <th>Sl.No</th>
                <th>Relation <br>
                    With <br>
                    Candidate <br>
                    (सम्बन्ध)</th>
                <th>Name <br>
                    नाम</th>
                <th>Study <br>
                    पढाई</th>
                <th>
                    Age <br>आय
                </th>
                <th>
                    Profession <br>
                    पेशा
                </th>
                <th>
                    Monthly <br>
                    income <br>
                    मासिक आय
                </th>
                <th>
                    Owned
                    Land / <br>
                    Property / <br>
                    House <br>
                    भूमि / संपत्ति
                </th>
                <th>Income from <br>
                    Other <br>
                    Sources (ANY) <br>
                    अन्य स्रोत</th>
                <th>
                    Contact no <br>
                    संपर्क नंबर।
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Grandpa / दादा</td>
                    <td>
                        <input type="text" name="grandpa_name" id="grandpa_name"
                            value="{{ $user->grandpa_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandpa_education" id="grandpa_education"
                            value="{{ $user->grandpa_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandpa_age" id="grandpa_age"
                            value="{{ $user->grandpa_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandpa_profession" id="grandpa_profession"
                            value="{{ $user->grandpa_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandpa_income" id="grandpa_income"
                            value="{{ $user->grandpa_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandpa_property" id="grandpa_property"
                            value="{{ $user->grandpa_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandpa_other_income" id="grandpa_other_income"
                            value="{{ $user->grandpa_other_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandpa_contact_no" id="grandpa_contact_no"
                            value="{{ $user->grandpa_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Grandmother / दादी माँ</td>
                    <td>
                        <input type="text" name="grandmother_name" id="grandmother_name"
                            value="{{ $user->grandmother_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandmother_education" id="grandmother_education"
                            value="{{ $user->grandmother_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandmother_age" id="grandmother_age"
                            value="{{ $user->grandmother_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandmother_profession"
                            id="grandmother_profession" value="{{ $user->grandmother_profession }}"
                            class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandmother_income" id="grandmother_income"
                            value="{{ $user->grandmother_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandmother_property" id="grandmother_property"
                            value="{{ $user->grandmother_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandmother_other_income"
                            id="grandmother_other_income"
                            value="{{ $user->grandmother_other_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="grandmother_contact_no"
                            id="grandmother_contact_no" value="{{ $user->grandmother_contact_no }}"
                            class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Father / पापा</td>
                    <td>
                        <input type="text" name="father_name" id="father_name"
                            value="{{ $user->father_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_education" id="father_education"
                            value="{{ $user->father_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_age" id="father_age"
                            value="{{ $user->father_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_occupation" id="father_occupation"
                            value="{{ $user->father_occupation }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_annual_income" id="father_annual_income"
                            value="{{ $user->father_annual_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_property" id="father_property"
                            value="{{ $user->father_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_other_income" id="father_other_income"
                            value="{{ $user->father_other_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_contact_no" id="father_contact_no"
                            value="{{ $user->father_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Mother / मां</td>
                    <td>
                        <input type="text" name="mother_name" id="mother_name"
                            value="{{ $user->mother_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_education" id="mother_education"
                            value="{{ $user->mother_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_age" id="mother_age"
                            value="{{ $user->mother_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_occupation" id="mother_occupation"
                            value="{{ $user->mother_occupation }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_annual_income" id="mother_annual_income"
                            value="{{ $user->mother_annual_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_property" id="mother_property"
                            value="{{ $user->mother_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_other_income" id="mother_other_income"
                            value="{{ $user->mother_other_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_contact_no" id="father_contact_no"
                            value="{{ $user->father_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Guardian / अभिभावक</td>
                    <td>
                        <input type="text" name="guardian_name" id="guardian_name"
                            value="{{ $user->guardian_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="guardian_education" id="guardian_education"
                            value="{{ $user->guardian_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="guardian_age" id="guardian_age"
                            value="{{ $user->guardian_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="guardian_profession" id="guardian_profession"
                            value="{{ $user->guardian_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="guardian_income" id="guardian_income"
                            value="{{ $user->guardian_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="guardian_property" id="guardian_property"
                            value="{{ $user->guardian_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="guardian_other_income" id="guardian_other_income"
                            value="{{ $user->guardian_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="guardian_contact_no" id="guardian_contact_no"
                            value="{{ $user->guardian_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Uncle / चाचा / ताऊ 1</td>
                    <td>
                        <input type="text" name="uncle1_name" id="uncle1_name"
                            value="{{ $user->uncle1_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle1_education" id="uncle1_education"
                            value="{{ $user->uncle1_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle1_age" id="uncle1_age"
                            value="{{ $user->uncle1_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle1_profession" id="uncle1_profession"
                            value="{{ $user->uncle1_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle1_income" id="uncle1_income"
                            value="{{ $user->uncle1_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle1_property" id="uncle1_property"
                            value="{{ $user->uncle1_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle1_other_income" id="uncle1_other_income"
                            value="{{ $user->uncle1_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle1_contact_no" id="uncle1_contact_no"
                            value="{{ $user->uncle1_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Uncle / चाचा / ताऊ 2</td>
                    <td>
                        <input type="text" name="uncle2_name" id="uncle2_name"
                            value="{{ $user->uncle2_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle2_education" id="uncle2_education"
                            value="{{ $user->uncle2_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle2_age" id="uncle2_age"
                            value="{{ $user->uncle2_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle2_profession" id="uncle2_profession"
                            value="{{ $user->uncle2_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle2_income" id="uncle2_income"
                            value="{{ $user->uncle2_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle2_property" id="uncle2_property"
                            value="{{ $user->uncle2_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle2_other_income" id="uncle2_other_income"
                            value="{{ $user->uncle2_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="uncle2_contact_no" id="uncle2_contact_no"
                            value="{{ $user->uncle2_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Husband or wife <br> / पति या पत्नी</td>
                    <td>
                        <input type="text" name="wife_name" id="wife_name"
                            value="{{ $user->wife_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="wife_education" id="wife_education"
                            value="{{ $user->wife_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="wife_age" id="wife_age"
                            value="{{ $user->wife_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="wife_occupation" id="wife_occupation"
                            value="{{ $user->wife_occupation }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="wife_annual_income" id="wife_annual_income"
                            value="{{ $user->wife_annual_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="wife_property" id="wife_property"
                            value="{{ $user->wife_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="wife_other_income" id="wife_other_income"
                            value="{{ $user->wife_other_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="wife_contact_no" id="wife_contact_no"
                            value="{{ $user->wife_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Children / बच्चे 1</td>
                    <td>
                        <input type="text" name="child1name" id="child1name"
                            value="{{ $user->child1name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child1_education" id="child1_education"
                            value="{{ $user->child1_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child1sage" id="child1sage"
                            value="{{ $user->child1sage }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child1_profession" id="child1_profession"
                            value="{{ $user->child1_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child1_income" id="child1_income"
                            value="{{ $user->child1_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child1_property" id="child1_property"
                            value="{{ $user->child1_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child1_other_income" id="child1_other_income"
                            value="{{ $user->child1_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="child1_contact_no" id="child1_contact_no"
                            value="{{ $user->child1_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Children / बच्चे 2</td>
                    <td>
                        <input type="text" name="child2name" id="child2name"
                            value="{{ $user->child2name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child2_education" id="child2_education"
                            value="{{ $user->child2_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child2sage" id="child2sage"
                            value="{{ $user->child2sage }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child2_profession" id="child2_profession"
                            value="{{ $user->child2_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child2_income" id="child2_income"
                            value="{{ $user->child2_income }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child2_property" id="child2_property"
                            value="{{ $user->child2_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="child2_other_income" id="child2_other_income"
                            value="{{ $user->child2_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="child2_contact_no" id="child2_contact_no"
                            value="{{ $user->child2_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Brother / Sister <br> भाई बहन 1</td>
                    <td>
                        <input type="text" name="s1name" id="s1name"
                            value="{{ $user->s1name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s1_education" id="s1_education"
                            value="{{ $user->s1_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s1sage" id="s1sage"
                            value="{{ $user->s1sage }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s1soccupation" id="s1soccupation"
                            value="{{ $user->s1soccupation }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s1sannualincome" id="s1sannualincome"
                            value="{{ $user->s1sannualincome }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s1_property" id="s1_property"
                            value="{{ $user->s1_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s1_other_income" id="s1_other_income"
                            value="{{ $user->s1_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="s1_contact_no" id="s1_contact_no"
                            value="{{ $user->s1_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Brother / Sister <br> भाई बहन 2</td>
                    <td>
                        <input type="text" name="s2name" id="s2name"
                            value="{{ $user->s2name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s2_education" id="s2_education"
                            value="{{ $user->s2_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s2sage" id="s2sage"
                            value="{{ $user->s2sage }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s2soccupation" id="s2soccupation"
                            value="{{ $user->s2soccupation }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s2sannualincome" id="s2sannualincome"
                            value="{{ $user->s2sannualincome }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s2_property" id="s2_property"
                            value="{{ $user->s2_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="s2_other_income" id="s2_other_income"
                            value="{{ $user->s2_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="s2_contact_no" id="s2_contact_no"
                            value="{{ $user->s2_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr class=" d-none depend_on_marital_status">
                    <td>13</td>
                    <td>Mother-in-law / सास</td>
                    <td>
                        <input type="text" name="mother_in_law_name" id="mother_in_law_name"
                            value="{{ $user->mother_in_law_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_in_law_education"
                            id="mother_in_law_education"
                            value="{{ $user->mother_in_law_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_in_law_age" id="mother_in_law_age"
                            value="{{ $user->mother_in_law_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_in_law_profession"
                            id="mother_in_law_profession"
                            value="{{ $user->mother_in_law_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_in_law_income"
                            id="mother_in_law_income" value="{{ $user->mother_in_law_income }}"
                            class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_in_law_property"
                            id="mother_in_law_property"
                            value="{{ $user->mother_in_law_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_in_law_other_income"
                            id="mother_in_law_other_income"
                            value="{{ $user->mother_in_law_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="mother_in_law_contact_no"
                            id="mother_in_law_contact_no"
                            value="{{ $user->mother_in_law_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr class=" d-none depend_on_marital_status">
                    <td>14</td>
                    <td>Father-in-law / ससुर</td>
                    <td>
                        <input type="text" name="father_in_law_name" id="father_in_law_name"
                            value="{{ $user->father_in_law_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_in_law_education"
                            id="father_in_law_education"
                            value="{{ $user->father_in_law_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_in_law_age" id="father_in_law_age"
                            value="{{ $user->father_in_law_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_in_law_profession"
                            id="father_in_law_profession"
                            value="{{ $user->father_in_law_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_in_law_income"
                            id="father_in_law_income" value="{{ $user->father_in_law_income }}"
                            class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_in_law_property"
                            id="father_in_law_property"
                            value="{{ $user->father_in_law_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="father_in_law_other_income"
                            id="father_in_law_other_income"
                            value="{{ $user->father_in_law_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="father_in_law_contact_no"
                            id="father_in_law_contact_no"
                            value="{{ $user->father_in_law_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr class=" d-none depend_on_marital_status">
                    <td>15</td>
                    <td>Brother-in-law / साला</td>
                    <td>
                        <input type="text" name="brother_in_law_name" id="brother_in_law_name"
                            value="{{ $user->brother_in_law_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="brother_in_law_education"
                            id="brother_in_law_education"
                            value="{{ $user->brother_in_law_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="brother_in_law_age" id="brother_in_law_age"
                            value="{{ $user->brother_in_law_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="brother_in_law_profession"
                            id="brother_in_law_profession"
                            value="{{ $user->brother_in_law_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="brother_in_law_income"
                            id="brother_in_law_income" value="{{ $user->brother_in_law_income }}"
                            class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="brother_in_law_property"
                            id="brother_in_law_property"
                            value="{{ $user->brother_in_law_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="brother_in_law_other_income"
                            id="brother_in_law_other_income"
                            value="{{ $user->brother_in_law_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="brother_in_law_contact_no"
                            id="brother_in_law_contact_no"
                            value="{{ $user->brother_in_law_contact_no }}" class=" form-control">
                    </td>
                </tr>
                <tr class=" d-none depend_on_marital_status">
                    <td>16</td>
                    <td>Sister-in-law / साली</td>
                    <td>
                        <input type="text" name="sister_in_law_name" id="sister_in_law_name"
                            value="{{ $user->sister_in_law_name }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="sister_in_law_education"
                            id="sister_in_law_education"
                            value="{{ $user->sister_in_law_education }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="sister_in_law_age" id="sister_in_law_age"
                            value="{{ $user->sister_in_law_age }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="sister_in_law_profession"
                            id="sister_in_law_profession"
                            value="{{ $user->sister_in_law_profession }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="sister_in_law_income"
                            id="sister_in_law_income" value="{{ $user->sister_in_law_income }}"
                            class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="sister_in_law_property"
                            id="sister_in_law_property"
                            value="{{ $user->sister_in_law_property }}" class=" form-control">
                    </td>
                    <td>
                        <input type="text" name="sister_in_law_other_income"
                            id="sister_in_law_other_income"
                            value="{{ $user->sister_in_law_other_income }}" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="sister_in_law_contact_no"
                            id="sister_in_law_contact_no"
                            value="{{ $user->sister_in_law_contact_no }}" class=" form-control">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label>Any Loan liability on Family/ Self / परिवार/स्वयं/पर कोई ऋण देयता
            </label>
            <textarea name="any_loan_iability" id="any_loan_iability" class=" form-control" rows="2">{{ $user->any_loan_iability }}</textarea>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label>Is any of your relative government employed? क्या आपका कोई रिश्तेदार सरकारी/प्रशासनिक
                सेवा में कार्यरत है
            </label>
            <div class="col-md-3">
                <select name="relative_government_employed" class=" form-select"
                    id="relative_government_employed">
                    <option value="NO" @selected($user->relative_government_employed == 'No')>NO</option>
                    <option value="YES" @selected($user->relative_government_employed == 'YES')>YES</option>
                </select>
            </div>
        </div>
    </div>
    <div class=" mt-3 row d-none depend_on_rel_gov_emp">
        <label><b>If yes, then enter his/her name, relation, यदि हां, तो उसका नाम, संबंध दर्ज
                करें</b></label>
        <div class="col-md-3">
            <div class="form-group">
                <label>Name / नाम</label>
                <input type="text" class=" form-control" name="rel_name_gov_emp"
                    id="rel_name_gov_emp" value="{{ $user->rel_name_gov_emp }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Relation / सम्बन्ध</label>
                <input type="text" class=" form-control" name="rel_relation_gov_emp"
                    id="rel_relation_gov_emp" value="{{ $user->rel_relation_gov_emp }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Business / व्यवसाय</label>
                <select name="rel_buss_gov_emp" id="rel_buss_gov_emp" class=" form-select">
                    <option value="">Select Business</option>
                    <option value="Police Service" @selected($user->rel_buss_gov_emp == 'Police Service')> Police Service
                    </option>
                    <option value="Politics" @selected($user->rel_buss_gov_emp == 'Politics')> Politics / राजनीति</option>
                    <option value="IAS" @selected($user->rel_buss_gov_emp == 'IAS')>IAS / आईएएस</option>
                    <option value="Collector" @selected($user->rel_buss_gov_emp == 'Collector')>कलेक्टर</option>
                    <option value="ITO" @selected($user->rel_buss_gov_emp == 'ITO')>ITO / आईटीओ</option>
                    <option value="Lawyer" @selected($user->rel_buss_gov_emp == 'Lawyer')>Lawyer / वकील</option>
                    <option value="Bureaucracy" @selected($user->rel_buss_gov_emp == 'Bureaucracy')>Bureaucracy / नौकरशाही
                    </option>
                </select>
            </div>
        </div>
    </div>
</fieldset>