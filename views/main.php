<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>USPS</title>
    <link rel="stylesheet" href="<?= baseUrl('assets/css/bootstrap/bootstrap.min.css'); ?>">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= baseUrl('assets/css/custom.css'); ?>">
</head>

<body>
    <div class="wrapper">

        <div class="address-container">
            <div class="card card-address mx-auto">
                <div class="card-body">
                    <form class="form-horizontal" action="#" method="post" id="jsMailingAddressForm">

                        <h1>Address Validator </h1>
                        <p>Validate/Standardizes address using USPS</p>
                        <hr>

                        <fieldset class="clearfix">

                            <div class="input-group-address">
                                <label for="jsAddress">Address Line 1</label>

                                <div class="input-group">
                                    <input id="jsAddress" type="text" Placeholder="Suite 6100">

                                </div>
                            </div>
                            <div class="input-group-address">
                                <label for="jsAddress2">Address Line 2</label>

                                <div class="input-group">
                                    <input id="jsAddress2" type="text" Placeholder="185 Berry St">

                                </div>
                            </div>
                            <div class="input-group-address">
                                <label for="jsCity">City</label>

                                <div class="input-group">
                                    <input id="jsCity" type="text" Placeholder="San Francisco">

                                </div>
                            </div>
                            <div class="input-group-address">
                                <label for="jsState">State</label>
                                <select id="jsState" class="input-group">
                                    <?php foreach (getStates() as $stateCode => $stateName) : ?>
                                        <option value="<?= $stateCode; ?>"><?= $stateName; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="input-group-address">
                                <label for="jsZipCode">Zip Code</label>

                                <div class="input-group">
                                    <input id="jsZipCode" type="text" Placeholder="94556">

                                </div>
                            </div>
                            <div class="alert alert-danger jsErrorArea"></div>

                            <div class="input-group-address">


                                <div class="input-group  no-border">
                                    <input type="submit" value="Validate" class="btn validate_btn">


                                </div>
                            </div>

                            <div class="mt-4 fg-password">



                            </div>

                        </fieldset>

                    </form>
                </div>
            </div>
        </div>

    </div>


    <!-- // modal -->
    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Save Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Which address format do you want to save?</label>
                            <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                <label id="original-data" class="btn btn-secondary active">
                                    <input type="radio" name="options" autocomplete="off" checked value="original"> Original
                                </label>
                                <label id="standardized-data" class="btn btn-secondary">
                                    <input type="radio" name="options" autocomplete="off" value="standardized"> Standardized (USPS)
                                </label>

                            </div>

                            <div class="dataLoad">
                                <div id="original">
                                    <p>Address Line 1: <span id="jsOMAAddress"></span></p>
                                    <p>Address Line 2: <span id="jsOMAAddress2"></span></p>
                                    <p>City: <span id="jsOMACity"></span></p>
                                    <P>State: <span id="jsOMAState"></span></P>
                                    <p>Zip Code: <span id="jsOMAZipCode"></span></p>
                                </div>
                                <div id="standardized">
                                    <p>Address Line 1: <span id="jsSMAAddress"></span></p>
                                    <p>Address Line 2: <span id="jsSMAAddress2"></span></p>
                                    <p>City: <span id="jsSMACity"></span></p>
                                    <P>State: <span id="jsSMAState"></span></P>
                                    <p>Zip Code: <span id="jsSMAZipCode"></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-danger jsErrorAreaConfirm" id="">
                        </div>
                        <div class="alert alert-success jsSuccessAreaConfirm" id="">
                            Address Saved Successfully!
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success jsSaveAddress">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="<?= baseUrl('assets/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"></script>
    <script src="<?= baseUrl('assets/js/app.min.js'); ?>"></script>

</body>

</html>