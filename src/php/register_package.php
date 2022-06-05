<?php

function generateActorCard(string $role): string {
    try {
        if ($role === "sender") {
            $card_title = "Sender";
        } else if ($role === "receiver") {
            $card_title = "Receiver";
        } else {
            throw new \http\Exception\InvalidArgumentException("Unknown role: $role");
        }
    } catch (\http\Exception\InvalidArgumentException $e) {
        error_log("Invalid argument: " . $e->getMessage());
    }
    assert(isset($card_title));
    return <<<HTML
<div class="card-header"> <!--TODO add background image-->
    <h4>$card_title</h4>
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <div class="row g-2">
            <div class="col form-floating">
                <input type="text" aria-label="First name" class="form-control" value="" id="input".$card_title."FirstName">
                <label for="input".$card_title."FirstName">First name</label>
            </div>
            <div class="col form-floating">
                <input type="text" aria-label="Last name" class="form-control" value="" id="input".$card_title."LastName">
                <label for="input".$card_title."LastName">Last name</label>
            </div>
        </div>
        <div class="input-group m-1">
            <input type="text" aria-label="E-Mail username" class="form-control" placeholder="$card_title's mail username" id="input".$card_title."EmailUser">
            <span class="input-group-text">@</span>
            <input type="text" aria-label="E-Mail domain" class="form-control" placeholder="$card_title's email domain" id="input".$card_title."EmailDomain">
            <select id="input".$card_title."EmailDomainExtension" class="form-select">
                <option value="com">.com</option>
                <option value="es">.es</option>
                <option value="net">.net</option>
                <option value="org">.org</option>
                <option value="edu">.edu</option>
                <option value="gov">.gov</option>
                <option value="int">.int</option>
            </select>
        </div>
        <div class="form-floating my-2 mx-1 w-50">
            <input type="tel" class="form-control" id="inputSenderPhone" value="">
            <label for="inputSenderPhone">Phone number</label>
        </div>

    </li>
    <li class="list-group-item">
        <div class="input-group">
            <span class="input-group-text">Address</span>
            <input type="text" class="form-control" placeholder="Street">
            <input type="text" class="form-control" placeholder="City">
            <input type="text" class="form-control" placeholder="State">
            <input type="text" class="form-control" placeholder="Zip">
        </div>
    </li>
    <li class="list-group-item">
        <div class="input-group">

        </div>
    </li>
</ul>
HTML;;
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
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light sticky-top w-100">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <!--suppress CheckImageSize -->
            <img src="../assets/logo.png" height="64" alt="64"> <!--source: freepik.com-->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-scroll">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-8 text-left">
            <h1>Register new delivery</h1>
            <p>Please, complete the form below to add a new package to the system</p>
            <hr>
            <form>
                <!-- Sender Card -->
                <div class="card m-3 w-75 mx-auto" id="sender_details">
                    <?php echo generateActorCard("sender"); ?>
                </div>
                <!-- Receiver Card -->
                <div class="card m-3 w-75 mx-auto" id="receiver_details">
                    <?php echo generateActorCard("receiver"); ?>
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
                                    <input type="text" aria-label="Weight" class="form-control" placeholder="0" id="inputWeight">
                                    <select id="inputWeightUnit" class="form-select">
                                        <option value="kg">kg</option>
                                        <option value="lb">lb</option>
                                    </select>
                                </div>
                                <div class="input-group col m-1 w-50">
                                    <span class="input-group-text w-25">Length</span>
                                    <input type="text" aria-label="Length" class="form-control" placeholder="0" id="inputLength">
                                    <select id="inputLengthUnit" class="form-select">
                                        <option value="cm">cm</option>
                                        <option value="in">in</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group col m-1 w-25">
                                    <span class="input-group-text w-25">Width</span>
                                    <input type="text" aria-label="Width" class="form-control" placeholder="Width" id="inputWidth">
                                    <select id="inputWidthUnit" class="form-select">
                                        <option value="cm">cm</option>
                                        <option value="in">in</option>
                                    </select>
                                </div>
                                <div class="input-group col m-1 w-25">
                                    <span class="input-group-text w-25">Height</span>
                                    <input type="text" aria-label="Height" class="form-control" placeholder="Height" id="inputHeight">
                                    <select id="inputHeightUnit" class="form-select">
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
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="standard" checked>
                                        <label class="form-check-label" for="gridRadios1">Standard</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="express">
                                        <label class="form-check-label" for="gridRadios2">Express</label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="overnight">
                                        <label class="form-check-label" for="gridRadios3">Overnight</label>
                                    </div>
                                </div>
                            </fieldset>
                        </li>
                    </ul>
                </div>
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary m-3">Register new deliver</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

