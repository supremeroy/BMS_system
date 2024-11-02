// JavaScript to calculate total sale amount
document
  .getElementById("quantity_sold")
  .addEventListener("input", calculateTotal);
document
  .getElementById("price_per_unit")
  .addEventListener("input", calculateTotal);
document
  .getElementById("amount_given")
  .addEventListener("input", calculateChange);

// Function to calculate total sale amount
function calculateTotal() {
  const quantityInput = document.getElementById("quantity_sold");
  const priceInput = document.getElementById("price_per_unit");
  const totalInput = document.getElementById("total_sale");

  // Calculate total sale amount
  const quantity = parseFloat(quantityInput.value) || 0;
  const price = parseFloat(priceInput.value) || 0;
  totalInput.value = (quantity * price).toFixed(2); // Update total amount
}

// Function to calculate change
function calculateChange() {
  const amountGivenInput = document.getElementById("amount_given");
  const totalSaleInput = document.getElementById("total_sale");
  const changeInput = document.getElementById("change_amount");

  const amountGiven = parseFloat(amountGivenInput.value) || 0;
  const totalSale = parseFloat(totalSaleInput.value) || 0;

  // Calculate change
  changeInput.value = (amountGiven - totalSale).toFixed(2);
}

// Function to toggle payment fields (if you have more payment methods)
function toggleCashFields() {
  console.log(
    "Payment method selected: " +
      document.getElementById("payment_method").value
  );

  var paymentMethod = document.getElementById("payment_method").value;
  var cashFields = document.getElementById("cash_fields");
  var mpesaFields = document.getElementById("mpesa_fields");

  if (paymentMethod === "cash") {
    cashFields.style.display = "block"; // Show cash fields
    mpesaFields.style.display = "none"; // Hide M-Pesa fields
  } else if (paymentMethod === "mpesa") {
    mpesaFields.style.display = "block";
    cashFields.style.display = "none"; // Hide cash fields
    // Show M-Pesa fields
  } else {
    cashFields.style.display = "none"; // Hide cash fields
    mpesaFields.style.display = "none"; // Hide M-Pesa fields
  }
}


function printTable() {
  window.print();
}


