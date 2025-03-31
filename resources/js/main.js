function addBid(amount, auction, bidder) {
	$.ajax({
		url: './src/addBid.php',
		method: 'post',
		type: 'text',
		datatype: 'text',
		data: { 'amount': amount, 'auction': auction, 'bidder': bidder },
		success: function(response) {
			var result = JSON.parse(response);
			displayBid(result);
		},
		error: function(response) {
			if (response.status == 401) {
				window.location.href = "./login.php";
			}
		}
	})
}

function displayBid(result) {
	var source = $('#bidsHolder');
	var tr = `
    <tr class="border">
        <td class="text-center">
            <img src="./resources/images/avatar.png" alt=""
                style="height:50px; width:50px; border-radius:50%"></img>
        </td>
        <td class="text-left padding-para">
            <p class="table-para font-weight-bold">${result.name}</p>
            <p class="table-para">Rs - ${result.amount}/-</p>
        </td>
    </tr>
    `
	source.append(tr);
}



$('#addbid').click(function() {
	var amount = $('#amount').val();
	var auction = $('#a_id').val();
	var user = $('#user').val();
	addBid(amount, auction, user);
})

function validateLoginForm() {
	if ($('#email').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter email', 'danger'));
		return false;
	}

	if ($('#password').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter password', 'danger'));
		return false;
	}

	return true;
}

function validateRegisterFrom() {
	if ($('#firstName').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter first name', 'danger'));
		return false;
	}

	if ($('#lastName').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter last name', 'danger'));
		return false;
	}

	if ($('#address').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter address', 'danger'));
		return false;
	}

	if ($('#pin').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter pin', 'danger'));
		return false;
	}

	if ($('#email').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter email', 'danger'));
		return false;
	}

	if ($('#phone').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter phone', 'danger'));
		return false;
	}

	if ($('#phone').val().length != 10) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter valid phone', 'danger'));
		return false;
	}

	if ($(typeof ('#phone').val()) != 'Number') {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter valid phone', 'danger'));
		return false;
	}

	if ($('#password').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter password', 'danger'));
		return false;
	}

	if ($('#password').val() != $('#confirmPassword').val()) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Password does not match', 'danger'));
		return false;
	}

	return true;
}

function validateAuctionFrom() {
	if ($('#title').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter title', 'danger'));
		return false;
	}

	if ($('#startTime').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter start time', 'danger'));
		return false;
	}

	if ($('#endTime').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter end time', 'danger'));
		return false;
	}

	if ($('#desc').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter description', 'danger'));
		return false;
	}

	if ($('#location').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter location', 'danger'));
		return false;
	}

	if ($('#category').val() == 'none') {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please select category', 'danger'));
		return false;
	}

	if ($('#subCategory').val() == 'none') {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please select subcategory', 'danger'));
		return false;
	}

	if ($('#price').val().length < 1) {
		$('#msg').html(displayMsg('<strong>Failed! </strong> Please enter price', 'danger'));
		return false;
	}
	return true;
}


function displayMsg(msg, type) {
	return `
        <div class="alert alert-${type} text-center">${msg}</div>
    `;
}
