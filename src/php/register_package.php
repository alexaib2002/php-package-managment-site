<?php

require_once 'persistent_elements.php';
/**
 *  @var string $top_navbar
 */


$display_form = $_SERVER['REQUEST_METHOD'] === "POST";

function generateActorCard(string $form_id, string $title): string {
    return <<<HTML
<div class="card-header"> <!--TODO add background image-->
    <h4>$title</h4>
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <div class="row g-2">
            <div class="col form-floating">
                <input type="text" aria-label="First name" class="form-control" value="" id="input$form_id.FirstName" name="input$form_id.FirstName" required>
                <label for="input$form_id.FirstName">First name</label>
                <div class="valid-tooltip">
                    Looks good!
                </div>
            </div>
            <div class="col form-floating">
                <input type="text" aria-label="Last name" class="form-control" value="" id="input$form_id.LastName" name="input$form_id.FirstName" required>
                <label for="input$form_id.LastName">Last name</label>
            </div>
        </div>
        <div class="input-group my-2">
            <input type="text" aria-label="E-Mail username" class="form-control" placeholder="$form_id's mail username" id="input$form_id.EmailUser" name="input$form_id.EmailUser" required>
            <span class="input-group-text">@</span>
            <input type="text" aria-label="E-Mail domain" class="form-control" placeholder="$form_id's email domain" id="input$form_id.EmailDomain" name="input$form_id.EmailDomain" required>
            <select class="form-select" id="input$form_id.EmailDomainExtension">
                <option value="com">.com</option>
                <option value="es">.es</option>
                <option value="net">.net</option>
                <option value="org">.org</option>
                <option value="edu">.edu</option>
                <option value="gov">.gov</option>
                <option value="int">.int</option>
            </select>
        </div>
        <div class="row my-2 g-2">
            <div class="col form-floating">
                <select class="form-floating form-select" id="input$form_id.PhoneExtension" name="input$form_id.EmailDomain" required>
                    <option value="+34">+34 (Spain)</option>
                    <option value="+1">+1 (USA)</option>
                    <option value="+44">+44 (UK)</option>
                    <option value="+49">+49 (Germany)</option>
                    <option value="+33">+33 (France)</option>
                    <option value="+39">+39 (Italy)</option>
                    <option value="+41">+41 (Switzerland)</option>
                </select>
                <label class="mx-2" for="input$form_id.PhoneExtension">Number extension:</label>
            </div>
            <div class="col form-floating">
                <input type="tel" class="form-control" id="input$form_id.PhoneNumber" value="" name="input$form_id.PhoneNumber" required>
                <label class="mx-2" for="input$form_id.PhoneNumber">Phone number</label>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="input-group">
            <span class="input-group-text">Address</span>
            <input type="text" class="form-control" placeholder="Street" id="input$form_id.Address.Street" name="input$form_id.Address.Street" required>
            <input type="text" class="form-control" placeholder="City" id="input$form_id.Address.City" name="input$form_id.Address.City" required>
            <input type="text" class="form-control" placeholder="State" id="input$form_id.Address.State" name="input$form_id.Address.State" required>
            <input type="text" class="form-control" placeholder="Zip" id="input$form_id.Address.Zip" name="input$form_id.Address.Zip" required>
        </div>
    </li>
    <li class="list-group-item">
        <div class="container row">
            <div class="form-check form-switch col">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="input$form_id.FlexSwitchCheckDefault">
              <label class="form-check-label" for="flexSwitchCheckDefault">Send package status updates</label>
            </div>
            <div class="form-check form-switch col">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="input$form_id.FlexSwitchCheckDefault">
              <label class="form-check-label" for="flexSwitchCheckDefault">Send info related to promotions</label>
            </div>
        </div>
    </li>
</ul>
HTML;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Package Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/form_submitter_validator.js"></script>
</head>
<body>

<?php

if (!$display_form) {
    $sender_card = generateActorCard("Sender", "Who's sending the package?");
    $receiver_card = generateActorCard("Receiver", "Who's receiving the package?");
    echo $top_navbar;
    echo <<<HTML
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-8 text-left">
            <h1>Register new delivery</h1>
            <p>Please, complete the form below to add a new package to the system</p>
            <hr>
            <!--needs-validation is just a pseudo-class, its not defined, its only there for js to know which forms 
            need validation-->
            <form action="register_package.php" method="post" class="needs-validation" novalidate>
                <!-- Sender Card -->
                <div class="card m-3 w-75 mx-auto" id="sender_details">
                    $sender_card
                </div>
                <!-- Receiver Card -->
                <div class="card m-3 w-75 mx-auto" id="receiver_details">
                    $receiver_card
                </div>
                <!-- Package Card -->
                <div class="card m-3 w-75 mx-auto" id="package_details">
                    <div class="card-header">
                        <h4>Package</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="input-group col m-1 w-50">
                                    <span class="input-group-text w-25">Weight</span>
                                    <input type="text" aria-label="Weight" class="form-control" placeholder="0" id="inputWeight" name="inputWeight" required>
                                    <select id="inputWeightUnit" class="form-select" name="inputWeightUnit" required>
                                        <option value="kg">kg</option>
                                        <option value="lb">lb</option>
                                    </select>
                                </div>
                                <div class="input-group col m-1 w-50">
                                    <span class="input-group-text w-25">Length</span>
                                    <input type="text" aria-label="Length" class="form-control" placeholder="0" id="inputLength" name="inputLength" required>
                                    <select id="inputLengthUnit" class="form-select" name="inputLengthUnit" required>
                                        <option value="cm">cm</option>
                                        <option value="in">in</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group col m-1 w-25">
                                    <span class="input-group-text w-25">Width</span>
                                    <input type="text" aria-label="Width" class="form-control" placeholder="Width" id="inputWidth" name="inputWidth" required>
                                    <select id="inputWidthUnit" class="form-select" name="inputWidthUnit" required>
                                        <option value="cm">cm</option>
                                        <option value="in">in</option>
                                    </select>
                                </div>
                                <div class="input-group col m-1 w-25">
                                    <span class="input-group-text w-25">Height</span>
                                    <input type="text" aria-label="Height" class="form-control" placeholder="Height" id="inputHeight" name="inputHeight" required>
                                    <select id="inputHeightUnit" class="form-select" name="inputHeightUnit" required>
                                        <option value="cm">cm</option>
                                        <option value="in">in</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Delivery type</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="deliveryTypeRadios" id="standardRadio" value="standard" checked required>
                                        <label class="form-check-label" for="standardRadio">Standard</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="deliveryTypeRadios" id="expressRadio" value="express" required>
                                        <label class="form-check-label" for="expressRadio">Express</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="deliveryTypeRadios" id="overnightRadio" value="overnight" required>
                                        <label class="form-check-label" for="overnightRadio">Overnight</label>
                                    </div>
                                </div>
                            </fieldset>
                        </li>
                    </ul>
                </div>
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary m-3">Register new deliver</button>
                    <button type="reset" class="btn btn-danger">Reset form</button>
                </div>
            </form>
        </div>
    </div>
</div>
HTML;

} else {
    echo "Now POST is set up";
    // TODO notify user
}
?>
</body>
<footer>
    <!--form validator needs to be placed here, so it can be executed after PHP has finished HTML composing-->
    <script type="text/javascript">
        addValidationListeners();
    </script>
</footer>
</html>

