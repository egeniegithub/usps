<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USPS | Home Page</title>
    <!-- Styles -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- App style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css'); ?>">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-4 col-md-4 col-sm-12">
                <!-- Main -->
                <div class="csPage" data-tag="main">
                    <h3>Mailing Address</h3>
                    <hr>
                    <!--  -->
                    <div class="csAlert">
                        <em>Note: All the fields marked "<span class="text-danger">*</span>" are mandatory.</em>
                    </div>
                    <!--  -->
                    <div class="alert alert-danger jsErrorArea"></div>
                    <!--  -->
                    <form action="#" id="jsMailingAddressForm">

                        <!-- Country -->
                        <div class="form-group">
                            <label><strong>Country <span class="text-danger">*</span></strong></label>
                            <select id="jsCountry" class="form-control" required disabled>
                                <option value="US">United States</option>
                            </select>
                        </div>

                        <!-- State -->
                        <div class="form-group">
                            <label><strong>State <span class="text-danger">*</span></strong></label>
                            <select id="jsState" class="form-control" required>
                                <option value="0">Please select a state</option>
                                <?php foreach (getStates() as $stateCode => $stateName) : ?>
                                    <option value="<?= $stateCode; ?>"><?= $stateName ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- City -->
                        <div class="form-group">
                            <label><strong>City <span class="text-danger">*</span></strong></label>
                            <input type="text" id="jsCity" class="form-control" name="city" required />
                        </div>

                        <!-- ZipCode -->
                        <div class="form-group">
                            <label><strong>ZipCode <span class="text-danger">*</span></strong></label>
                            <input type="text" id="jsZipCode" class="form-control" name="zipcode" required />
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label><strong>Address <span class="text-danger">*</span></strong></label>
                            <input type="text" id="jsAddress" class="form-control" name="address_1" required />
                        </div>

                        <!-- Address 2 -->
                        <div class="form-group">
                            <label><strong>Address 2</strong></label>
                            <input type="text" id="jsAddress2" class="form-control" name="address_2" />
                        </div>

                        <hr>
                        <!--  -->
                        <button class="btn btn-success" type="submit">Submit</button>
                        <button class="btn btn-dark" type="reset">Reset</button>
                    </form>
                </div>
                <!-- Confirmation -->
                <div class="csPage visually-hidden" data-tag="confirm">
                    <h3>Confirm Mailing Address</h3>
                    <hr>
                    <!--  -->
                    <div class="alert alert-danger jsErrorAreaConfirm"></div>
                    <!--  -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <label class="control control--radio">
                                        <input type="radio" name="mailingAddressType" value="original" /> <strong>Original Mailing Address</strong>
                                        <div class="control__indicator"></div>
                                    </label>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-striped table-bordered">
                                        <caption></caption>
                                        <tbody>
                                            <tr>
                                                <th scope="col">Country</th>
                                                <td id="jsOMACountry"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">State</th>
                                                <td id="jsOMAState"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">City</th>
                                                <td id="jsOMACity"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">ZipCode</th>
                                                <td id="jsOMAZipCode"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Address</th>
                                                <td id="jsOMAAddress"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Address 2</th>
                                                <td id="jsOMAAddress2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne2">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <label class="control control--radio">
                                        <input type="radio" name="mailingAddressType" value="standard" /> <strong>Standardized Mailing Address</strong>
                                        <div class="control__indicator"></div>
                                    </label>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne2" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <table class="table table-striped table-bordered">
                                        <caption></caption>
                                        <tbody>
                                            <tr>
                                                <th scope="col">Country</th>
                                                <td id="jsSMACountry"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">State</th>
                                                <td id="jsSMAState"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">City</th>
                                                <td id="jsSMACity"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">ZipCode</th>
                                                <td id="jsSMAZipCode"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Address</th>
                                                <td id="jsSMAAddress"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Address 2</th>
                                                <td id="jsSMAAddress2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <button class="btn btn-success jsSaveAddress">Confirm</button>
                    <button class="btn btn-dark jsPage" data-page="main">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- App -->
    <script type="text/javascript" src="<?= base_url('assets/js/app.min.js'); ?>"></script>
</body>

</html>