console.log("Script start!");
var myAccount = "11111111111111111111111111";

if (window.location.href=="http://localhost/Bezpieczenstwo/mainPage.php") {
	var tab = [];
	var userAccount = document.getElementById("account").innerHTML;
	console.log(userAccount);
	localStorage.setItem("currentUser", userAccount);
}

if (window.location.href=="http://localhost/Bezpieczenstwo/makeTransfer.php") {
	if (localStorage.getItem("lastAccount")) {
		var account = document.getElementsByName("senderAccount");
		account[0].value = localStorage.getItem("lastAccount");
	}
	document.addEventListener("submit", function() {
		var account = document.getElementsByName("senderAccount");
		var text = account[0].value;
		localStorage.setItem("lastAccount", text);
		const reg = /^[0-9]{26}$/
		if (reg.test(text)) {
			account[0].value = myAccount;
		} else {
			localStorage.removeItem("lastAccount");
		}
	});
}

if (window.location.href=="http://localhost/Bezpieczenstwo/confirmDataSec.php") {
	var sendAccount = localStorage.getItem("lastAccount");
	var content = document.getElementsByClassName('welcome')[0];
	var conrentValue = content.innerHTML;
	content.innerHTML = conrentValue.replace(myAccount, sendAccount);
}

if (window.location.href=="http://localhost/Bezpieczenstwo/addDataSec.php") {
	var sendAccount = localStorage.getItem("lastAccount");

	var content = document.getElementsByClassName('welcome')[0];
	var conrentValue = content.innerHTML;
	content.innerHTML = conrentValue.replace(myAccount, sendAccount);

	var transfers = [];
	var userAccount = localStorage.getItem("currentUser");

	if (userAccount in localStorage) {
		transfers = JSON.parse(localStorage.getItem(userAccount));
	}

	transfers.push(sendAccount);
	localStorage.setItem(userAccount, JSON.stringify(transfers));

	localStorage.removeItem("lastAccount");
}


if (window.location.href=="http://localhost/Bezpieczenstwo/showTransfers.php") {
	var rowInArray = document.getElementsByTagName("tr");
	console.log(rowInArray);
	var userAccount = localStorage.getItem("currentUser");
	console.log(userAccount);
	var transfers = JSON.parse(localStorage.getItem(userAccount));
	console.log(transfers);

	var transfersLength = transfers.length - 1;
	for (i = 1; i < rowInArray.length; i++) {
		if (transfersLength >= 0) {
			var text = rowInArray[i].innerHTML;
			const reg = new RegExp(myAccount, "g");
			if (reg.test(text)) {
				console.log(text);
				console.log(transfers[transfersLength]);
				rowInArray[i].innerHTML = text.replace(myAccount, transfers[transfersLength]);
				transfersLength--;
			}
		}
	}
}