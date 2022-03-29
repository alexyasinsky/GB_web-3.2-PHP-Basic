<link rel="stylesheet" href="css/calcJS.css">
<h2>Калькулятор на JS</h2>

<main class="calcJS_form">
    <div>
        <input type='number' name="arg1JS">
        <input type='number' name="arg2JS">
    </div>
    <div>
        <button name="operationJS" value="sum">+</button>
        <button name="operationJS" value="sub">-</button>
        <button name="operationJS" value="mult">*</button>
        <button name="operationJS" value="div">/</button>
    </div>
    <div class="calcJS_result">
        Ответ: <span id="calcJS_result"></span>
    </div>
</main>

<script>

  window.onload = function () {
    async function postQuery(url, data) {
      const response = await fetch(url, {
          method: 'POST',
          headers: new Headers({
            'Content-Type': 'application/json'
          }),
          body: JSON.stringify(data),
        });
      return await response.json();
    }

    function addListeners(){

      let operationButtons = document.querySelectorAll("button[name='operationJS']");
      let resultField = document.querySelector('#calcJS_result');

      operationButtons.forEach(button => {
        button.addEventListener('click', (e) => {
          const arg1 = document.querySelector("input[name='arg1JS']").value;
          const arg2 = document.querySelector("input[name='arg2JS']").value;
          const answer = postQuery('/queries/calcOperations.php', {
            arg1: arg1,
            arg2: arg2,
            operation: e.target.value
          })
          .then(response => {
            let value = response.result;
            resultField.innerHTML = value;
          });
        });
      });
    }

    addListeners();

  }



</script>