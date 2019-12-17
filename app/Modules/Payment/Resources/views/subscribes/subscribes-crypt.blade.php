<script src="https://widget.cloudpayments.ru/bundles/checkout"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<form id="paymentFormSample">
    <div class="form-group">
        <label for="cardNumber">Card Number</label>
        <input type="text" class="form-control" id="cardNumber" aria-describedby="emailHelp" data-cp="cardNumber">
    </div>
    <div class="form-group">
        <label for="expDateMonth">Exp Date Month</label>
        <input type="text" class="form-control" id="expDateMonth" aria-describedby="emailHelp" data-cp="expDateMonth">
    </div>
    <div class="form-group">
        <label for="expDateYear">Exp Date Year</label>
        <input type="text" class="form-control" id="expDateYear" aria-describedby="emailHelp" data-cp="expDateYear">
    </div>
    <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control" id="cvv" aria-describedby="emailHelp" data-cp="cvv">
    </div>
    <button type="button" onclick="createCryptogram()" class="btn btn-primary">Submit</button>
</form>


<script>
    function createCryptogram () {
        var checkout = new cp.Checkout(
            'pk_f5473e33edb52cd05a238f382de02',
            document.getElementById("paymentFormSample")
        );

        var result = checkout.createCryptogramPacket();

        if (result.success) {
            let date = {
                'plan_id': '{{request()->plan_id}}',
                'CardCryptogramPacket': result.packet,
            };

            let response = fetch('/api/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + '{{request()->user_token}}'
                },
                body: JSON.stringify(date)
            }).then(async (res) => {
                let json = await res.json();
                if(json.data.need_validation) {
                    window.location.href = json.data.validation_url;
                }
            }).catch((err) => {
                alert('Service unavailable');
            });

        } else {
            for (var msgName in result.messages) {
                alert(result.messages[msgName]);
            }
        }
    }
</script>
