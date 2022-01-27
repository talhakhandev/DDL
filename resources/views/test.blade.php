<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Credit Card Validation Demo</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/demo.css">

    <style type="text/css">
      .creditCardForm {
    max-width: 700px;
    background-color: #fff;
    margin: 100px auto;
    overflow: hidden;
    padding: 25px;
    color: #4c4e56;
}

.creditCardForm label {
    width: 100%;
    margin-bottom: 10px;
}

.creditCardForm .heading h1 {
    text-align: center;
    font-family: 'Open Sans', sans-serif;
    color: #4c4e56;
}

.creditCardForm .payment {
    float: left;
    font-size: 18px;
    padding: 10px 25px;
    margin-top: 20px;
    position: relative;
}

.creditCardForm .payment .form-group {
    float: left;
    margin-bottom: 15px;
}

.creditCardForm .payment .form-control {
    line-height: 40px;
    height: auto;
    padding: 0 16px;
}

.creditCardForm .owner {
    width: 63%;
    margin-right: 10px;
}

.creditCardForm .CVV {
    width: 35%;
}

.creditCardForm #card-number-field {
    width: 100%;
}

.creditCardForm #expiration-date {
    width: 49%;
}

.creditCardForm #credit_cards {
    width: 50%;
    margin-top: 25px;
    text-align: right;
}

.creditCardForm #pay-now {
    width: 100%;
    margin-top: 25px;
}

.creditCardForm .payment .btn {
    width: 100%;
    margin-top: 3px;
    font-size: 24px;
    background-color: #2ec4a5;
    color: white;
}

.creditCardForm .payment select {
    padding: 10px;
    margin-right: 15px;
}

.transparent {
    opacity: 0.2;
}

@media(max-width: 650px) {
    .creditCardForm .owner,
    .creditCardForm .CVV,
    .creditCardForm #expiration-date,
    .creditCardForm #credit_cards {
        width: 100%;
    }
    .creditCardForm #credit_cards {
        text-align: left;
    }
}


/*  Examples Section */

.examples {
  max-width: 700px;
  background-color: #fff;
  margin: 0 auto 75px;
  padding: 30px 50px;
  color: #4c4e56;
}

.examples-note{
    text-align: center;
    font-size: 14px;
    max-width: 370px;
    margin: 0 auto 40px;
    line-height: 1.7;
    color: #7a7a7a;
}

.examples table {
    margin: 5px 0 0 0;
    font-size: 14px;
}

    </style>
</head>

<body>
    <div class="container-fluid">
        <header>
            <div class="limiter">
                <h3>Demo: Credit Card Validation With Payform.js</h3>
                <a href="http://tutorialzine.com/2016/11/simple-credit-card-validation-form/">Download</a>
            </div>
        </header>
        <div class="creditCardForm">
            <div class="heading">
                <h1>Confirm Purchase</h1>
            </div>
            <div class="payment">
                <form>
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" id="owner">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select>
                            <option value="01">January</option>
                            <option value="02">February </option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select>
                            <option value="16"> 2016</option>
                            <option value="17"> 2017</option>
                            <option value="18"> 2018</option>
                            <option value="19"> 2019</option>
                            <option value="20"> 2020</option>
                            <option value="21"> 2021</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="{{ url('images/payment/visa.jpg') }}" id="visa">
                                    <img src="{{ url('images/payment/mastercard.jpg') }}" id="mastercard">
                                    <img src="{{ url('images/payment/amex.jpg') }}" id="amex">
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
                    </div>
                </form>
            </div>
        </div>

        <p class="examples-note">Here are some dummy credit card numbers and CVV codes so you can test out the form:</p>

        <div class="examples">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Card Number</th>
                            <th>Security Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Visa</td>
                            <td>4716108999716531</td>
                            <td>257</td>
                        </tr>
                        <tr>
                            <td>Master Card</td>
                            <td>5281037048916168</td>
                            <td>043</td>
                        </tr>
                        <tr>
                            <td>American Express</td>
                            <td>342498818630298</td>
                            <td>3156</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ url('js/jquery.min.js') }}"></script>  
    <script src="{{ url('admin_assets/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/jquery.payform.min.js')}}" charset="utf-8"></script>
<script src="{{ url('js/script.js') }}"></script>
</body>

</html>
