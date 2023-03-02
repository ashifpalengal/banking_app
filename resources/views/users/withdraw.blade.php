@extends('template.master')
@section('title')
Withdraw
@endsection
@section('content')

<div class="row">

    <div class="col-md-2">
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-elements-sm-inline">
                <h4 class="card-title">Withdraw Money</h4>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Account Number :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ Auth::user()->account->account_number }}" disabled readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Account Type :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ Auth::user()->account->account_type }}" disabled readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Balance :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ Auth::user()->account->balance }}" disabled readonly id="balance">
                    </div>
                </div>

                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>

                <form action="{{ route('user.addWithdraw') }}" method="post" enctype="multipart/form-data" id="withdraw_form">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Enter Amount :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="amount" placeholder="Enter Withdraw Amount" id="amount">
                            <span class="form-text text-sm text-danger" id="error_msg"></span>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Withdraw <i class="icon-paperplane ml-2"></i></button>
                    </div>
                    @csrf
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>

</div>

<script>
    const form = document.getElementById('withdraw_form');
    const amountInput = document.getElementById('amount');
    const balance = document.getElementById('balance');
    const errorMsg = document.getElementById('error_msg');

    form.addEventListener('submit', (event) => {
        errorMsg.innerText = '';

        const amountValue = parseFloat(amountInput.value.trim());
        const balanceValue = parseFloat(balance.value.trim());
        const regex = /^[+-]?\d+(\.\d+)?$/;

        if (!regex.test(amountInput.value.trim())) {
            event.preventDefault();
            errorMsg.innerText = 'Please enter a valid amount';
            amountInput.value = '';
        } else if (amountValue > balanceValue) {
            event.preventDefault();
            errorMsg.innerText = 'Amount should not be greater than '+ balance.value;
            amountInput.value = '';
        } else if (amountValue <= 0) {
            event.preventDefault();
            errorMsg.innerText = 'Amount should not be 0 or less';
            amountInput.value = '';
        } else {
            errorMsg.innerText = '';
        }
    });
</script>

@endsection
