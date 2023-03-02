@extends('template.master')
@section('title')
Transfer
@endsection
@section('content')

<div class="row">

    <div class="col-md-2">
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-elements-sm-inline">
                <h4 class="card-title">Transfer Money</h4>
            </div>

            <div class="card-body">

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Email :</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" placeholder="Enter User Email Id" id="email">
                        <span class="form-text text-sm text-danger" id="email_error_msg"></span>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-primary" id="search" data-popup="tooltip" title data-original-title="Search User"> <i class="icon-search4 "></i></button>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Name :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Account Number :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" disabled readonly id="account_number">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Account Type :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" disabled readonly id="account_type">
                    </div>
                </div>

                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>

                <form action="{{ route('user.addTransfer') }}" method="post" enctype="multipart/form-data" id="transfer_form">
                    <input type="hidden" class="form-control" name="user_id" id="user_id">

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Balance :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" value="{{ Auth::user()->account->balance }}" disabled readonly id="balance">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Enter Amount :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="amount" placeholder="Enter Amount to transfer" id="amount">
                            <span class="form-text text-sm text-danger" id="error_msg"></span>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Transfer <i class="icon-paperplane ml-2"></i></button>
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
    const form = document.getElementById('transfer_form');
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

    const emailErrorMsg = document.getElementById('email_error_msg');
    const name = document.getElementById('name');
    const accountNumber = document.getElementById('account_number');
    const accountType = document.getElementById('account_type');
    const userId = document.getElementById('user_id');

    $(document).ready(function() {
        $('#search').click(function() {
            var email = $('#email').val();
            $.ajax({
                url: '/get-user-data',
                method: 'get',
                data: { email: email },
                dataType: 'json',
                success: function(data) {

                    console.log(data.success); // for debugging

                    if (data.success) {
                        name.value = data.data.name;
                        accountNumber.value = data.data.account_number;
                        accountType.value = data.data.account_type;
                        userId.value = data.data.id;
                    } else {
                        emailErrorMsg.innerText = data.errorMsg;
                    }

                    $('#result').text(data.name);
                },
                error: function(xhr, status, error) {

                    console.log(xhr.responseText); // for debugging
                }
            });
        });
    });





</script>

@endsection
