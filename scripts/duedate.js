document.addEventListener('DOMContentLoaded', function() {
  const methodSelect = document.getElementById('method');
  const inputContainer = document.getElementById('input-container');
  const lastPeriodInput = document.getElementById('last-period-input');
  const conceptionInput = document.getElementById('conception-input');
  const calculateBtn = document.getElementById('calculate-btn');
  const resultContainer = document.getElementById('result');

  methodSelect.addEventListener('change', function() {
    if (methodSelect.value === 'lastPeriod') {
      lastPeriodInput.style.display = 'block';
      conceptionInput.style.display = 'none';
    } else if (methodSelect.value === 'conception') {
      lastPeriodInput.style.display = 'none';
      conceptionInput.style.display = 'block';
    }
  });

  calculateBtn.addEventListener('click', function() {
    const selectedMethod = methodSelect.value;
    let dueDate;

    if (selectedMethod === 'lastPeriod') {
      const lastPeriodDate = new Date(document.getElementById('lastPeriodDate').value);
      const cycleLength = parseInt(document.getElementById('cycleLength').value);
      // Adjusted for longer or shorter cycles
      dueDate = new Date(lastPeriodDate);
      dueDate.setDate(dueDate.getDate() + (cycleLength * 7) + 280); // Adding 280 days for a typical pregnancy
    } else if (selectedMethod === 'conception') {
      const conceptionDate = new Date(document.getElementById('conceptionDate').value);
      // Adjusted for longer or shorter cycles (266 days)
      dueDate = new Date(conceptionDate);
      dueDate.setDate(dueDate.getDate() + 266); // Adding 266 days for a typical pregnancy
    }

    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDueDate = dueDate.toLocaleDateString('en-US', options);

    resultContainer.innerHTML = `Your approximate due date is: ${formattedDueDate}`;
  });
});
