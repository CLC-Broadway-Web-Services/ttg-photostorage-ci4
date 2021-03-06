<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h4 class="nk-block-title">Manage Client</h4>
                </div>
                <div class="col-md-6 col-12">
                    <a href="#" type="button" class="btn btn-primary float-right ml-2" data-toggle="modal" data-target="#modalDefault"><em class="icon ni ni-plus"></em><span>Add New Client</span> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Client ID</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">User</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Mobile No.</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manage_client as $key => $clients) : ?>
                        <tr class="nk-tb-item">

                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                    <label class="custom-control-label" for="uid1"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead"><?= $clients['id'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span><?= strtoupper(substr($clients['name'], 0, 2)); ?></span>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead"><?= $clients['name'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                        <span><?= $clients['email'] ?></span>
                                    </div>
                                </div>
                            </td>
                            <!-- <td class="nk-tb-col tb-col-mb" data-order="35040.34">
                                <span class="tb-amount"><?= $clients['name'] ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span><?= $clients['email'] ?></span>
                            </td> -->
                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                <ul class="list-status">
                                    <li> <span><?= $clients['mobile'] ?></span></li>
                                </ul>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span><?= $clients['country'] ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <?php if ($clients['crn_status'] == 'super') {

                                ?>
                                    <span class="badge badge-dot badge-dot-xs badge-success"><?= ucfirst($clients['crn_status']) ?></span>
                                <?php  } elseif ($clients['crn_status'] == 'normal') { ?>
                                    <span class="badge badge-dot badge-dot-xs badge-primary"><?= ucfirst($clients['crn_status']) ?></span>
                                <?php  } elseif ($clients['crn_status'] == 'national') { ?>
                                    <span class="badge badge-dot badge-dot-xs badge-warning"><?= ucfirst($clients['crn_status']) ?></span>
                                <?php } ?>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">

                                                    <?= $clients['crn_status'] == 'super' ? '' : '<li><a href="javascript:void(0);" onclick="grnId(' . "'" . $clients['id'] . "'" . ')" data-toggle="modal" data-target="#assignCrn"><em class="icon ni ni-user-check-fill"></em><span>Assign CRN</span></a></li>' ?>
                                                    <li><a href="javascript:void(0);" onclick="editData('<?= $clients['id']; ?>')"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                    <li><a href="javascript:void(0);" onclick="deleteData('<?= $clients['id']; ?>')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <form class="modal-content" action="" novalidate="novalidate" method="post" enctype="multipart/form-data">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add Client</h5>
            </div>
            <div class="modal-body">
                <div class="form-validate is-alter row">
                    <input name="client_id" value="0" class="d-none" id="modal_client_id">
                    <div class="form-group col-md-6 col-12">
                        <label class="form-label" for="dmodal_client_name">Name</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-user"></em>
                            </div>
                            <input type="text" class="form-control" id="modal_client_name" name="name" required placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label class="form-label" for="modal_client_email">Email address</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-mail"></em>
                            </div>
                            <input type="email" class="form-control" id="modal_client_email" name="email" required placeholder="Email address">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label class="form-label" for="modal_client_mobile">Phone</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-mobile"></em>
                            </div>

                            <input type="number" class="form-control" id="modal_client_mobile" name="mobile" required maxlength="10" minlength="10" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label class="form-label" for="modal_client_country">Country</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-globe"></em>
                            </div>
                            <!-- <input type="text" class="form-control" name="country" placeholder="Country"> -->
                            <select name="country" class="country form-control" id="modal_client_country" required onchange="edituser(this)" placeholder="Country">
                                <option value="India">India</option>
                                <option value="australia">Australia</option>
                                <option value="canada">Canada</option>
                                <option value="usa">USA</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bonaire">Bonaire</option>
                                <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Canary Islands">Canary Islands</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Channel Islands">Channel Islands</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos Island">Cocos Island</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote DIvoire">Cote DIvoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Curaco">Curacao</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands">Falkland Islands</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Ter">French Southern Ter</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Great Britain">Great Britain</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Hawaii">Hawaii</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="North Korea">North Korea</option>
                                <option value="South Korea">South Korea</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Midway Islands">Midway Islands</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Nambia">Nambia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherland Antilles">Netherland Antilles</option>
                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                <option value="Nevis">Nevis</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau Island">Palau Island</option>
                                <option value="Palestine">Palestine</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Phillipines">Philippines</option>
                                <option value="Pitcairn Island">Pitcairn Island</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Republic of Montenegro">Republic of Montenegro</option>
                                <option value="Republic of Serbia">Republic of Serbia</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="St Barthelemy">St Barthelemy</option>
                                <option value="St Eustatius">St Eustatius</option>
                                <option value="St Helena">St Helena</option>
                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                <option value="St Lucia">St Lucia</option>
                                <option value="St Maarten">St Maarten</option>
                                <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                                <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                                <option value="Saipan">Saipan</option>
                                <option value="Samoa">Samoa</option>
                                <option value="Samoa American">Samoa American</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Tahiti">Tahiti</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Erimates">United Arab Emirates</option>
                                <option value="Uraguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City State">Vatican City State</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                <option value="Wake Island">Wake Island</option>
                                <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zaire">Zaire</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label class="form-label" for="modal_client_password">Password</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-eye"></em>
                            </div>
                            <input type="text" class="form-control" id="modal_client_password" name="pass" required placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label class="form-label" for="modal_client_crn_status">Status</label>
                        <div class="form-control-wrap">
                            <select class="form-select" id="modal_client_crn_status" name="crn_status" required>
                                <option value="">Select Client Status</option>
                                <option value="normal">Normal</option>
                                <option value="national">National</option>
                                <option value="super">Super</option>
                            </select>
                        </div>
                    </div>
                    <input name="add_client" class="d-none" value="add_client">
                    <div class="form-group col-12">
                        <label class="form-label" for="user_avatarLabel">Profile Pic</label>
                        <div class="form-control-wrap">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="user_avatar" name="profile_pic">
                                <label class="custom-file-label" for="user_avatar">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-1">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>



<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="assignCrn">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Assign CRN</h5>
            </div>
            <div class="modal-body">
                <form action="" class="input-daterange  input-group" method="post">

                    <input type="hidden" id="as" name="assign_crn" class="form-control">
                    <input type="text" id="assign_crn" name="assign_crn" class="form-control">
                    <a href="javascript:void(0);" class="btn btn-dim btn-primary ml-2" onclick="assignCrn('<?= $clients['id']; ?>')">Assign</a>
                </form>
                <div class="card card-preview mt-4 bg-light">
                    <div class="card-inner">
                        <table class="nk-tb-list nk-tb-ulist" id="datatableX" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"><span class="sub-text">CRN</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>nskjncs</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <span><a href="#" class="btn btn-dim btn-sm btn-outline-danger">Remove</a></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
                <div class="mt-2">
                </div>
            </div>
            <div class="modal-footer bg-light">

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script>
    function deleteData(id) {
        console.log(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '',
                        data: {
                            delete: 'del',
                            id: id
                        },
                        success: function(result) {
                            console.log(result)
                            location.reload();
                        },
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    }

    function grnId(id) {
        var clientId = id
        $("#as").val('clientId');
    }

    function assignCrn() {
        console.log();
        grnId();
        var formData = {
            id: clientId,
            assign: 'assign',
            superheroAlias: $("#assign_crn").val(),
        };
        $.ajax({
            type: 'POST',
            url: '',
            data: formData,

            success: function(result) {
                console.log(result)
                // location.reload();
            },
        });
    }
    async function editData(id) {
        console.log(id);

        await $.ajax({
            type: 'POST',
            url: '',
            data: {
                edit: 'edit',
                id: id
            },
            success: function(result) {
                // console.log(result);
                var response = JSON.parse(result);

                $('#modal_client_id').val(response.id);
                $('#modal_client_name').val(response.name);
                $('#modal_client_email').val(response.email);
                $('#modal_client_mobile').val(response.mobile);
                $('#modal_client_country').val(response.country);
                $('#modal_client_crn_status').val(response.crn_status);
                // $('#modal_client_password').val(response.pass);

                $('#modalDefault').modal('show')
                // console.log(result);
                // location.reload();
            }
        });
    }

    $('#modalDefault').on('hidden.bs.modal', function(event) {
        $('modal_client_id').val(0);
        $('modal_client_name').val('');
        $('modal_client_email').val('');
        $('modal_client_mobile').val('');
        $('modal_client_country').val('');
        $('modal_client_password').val('');
        $('modal_client_crn_status').val('');
    });

    <?php if (session()->get("clientsave")) { ?>
        // console.log('clientsave found');
        const savedData = '<?= session()->get("clientsave.success") ?>'
        const message = "<?= session()->get("clientsave.message") ?>";
        console.log(savedData);
        console.log(message);
        if (savedData == true) {
            console.log('clientsave success found');
            swal({
                title: "Saved",
                text: message,
                icon: "success",
            });
        } else {
            console.log('clientsave success not found');
            swal({
                title: "Sorry",
                text: message,
                icon: "error",
            });
        }
    <?php } ?>
    <?php session()->remove("clientsave") ?>
</script>
<?= $this->endSection() ?>