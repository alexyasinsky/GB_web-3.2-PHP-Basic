<h2>Оформить заказ</h2>

<div id="checkout">
    <div v-if="!isChecked">
    <h5>Введите свои контактные данные и мы с Вами свяжемся для подтверждения заказа</h5>
    <form @submit.prevent="sendUserData">
        <input type="text" placeholder="Имя и фамилия" v-model.lazy="name"><br><br>
        <input type="tel" name="tel" v-model.lazy="tel" placeholder="Телефон"><br><br>
        <button type="submit">Оформить заказ</button>
    </form>
    </div>
    <div v-else>
        Спасибо за Ваш заказ! Наш специалист свяжется с Вами в ближайшее время!
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    const checkout = new Vue({
      el: '#checkout',

      data: {
        name: '<?=$name?>',
        tel: '',
        isChecked: false
      },

      methods: {
        async addPostQueryToElement (url, data) {
          let response = await fetch(url, {
            method: 'POST',
            headers: new Headers({
              'Content-Type': 'application/json'
            }),
            body: JSON.stringify(data),
          });
          return await response.json();
        },

        sendUserData() {
          const data = {
            name: this.name,
            tel: this.tel
          };
          const response = this.addPostQueryToElement('/orderapi/checkout', data);
          response.then(data => console.log(data));
          this.isChecked = !this.isChecked;
        },
      },
    });
</script>



