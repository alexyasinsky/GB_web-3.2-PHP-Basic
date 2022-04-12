<h2>Все заказы</h2>
<div id="orders">

    <div v-if="orders.length == 0">
        <h3>У нас еще ничего не заказали =(</h3>
    </div>
    <table v-else>
        <tr class="table__row">
            <th>Номер заказа</th>
            <th>Имя клиента</th>
            <th>Телефон</th>
            <th>Статус</th>
        </tr>
        <tr v-for="item in orders" class="table__row">
            <td>
                <a :href="'/oneorder/?order_id=' + item.id">{{item.id}}</a>
            </td>
            <td>
                {{ item.name }}
            </td>
            <td>
                {{ item.tel }}
            </td>
            <td>
                <select v-model="item.status" @change="changeOrderStatus(item.id, item.status)">
                    <option value="created">создан</option>
                    <option value="approved">подтвержден</option>
                    <option value="inDelivery">передан в доставку</option>
                    <option value="delivered">доставлен</option>
            </td>
        </tr>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
  const basket = new Vue({

    el: '#orders',

    data: {
      orders: [],
    },

    methods: {
      getData(url) {
        return fetch(url).then(data => data.json());
      },

      async changeOrderStatus(id, status) {
        const data = {
          orderId: id,
          status: status
        };
        const response = await fetch('/orderapi/changeStatus/', {
          method: 'POST',
          headers: new Headers({
            'Content-Type': 'application/json'
          }),
          body: JSON.stringify(data),
        });
        console.log(await response.json());
      }

      // changeBasketItemAmount(buttonAttribute) {
      //   this.basket.forEach(item => {
      //     if (item.id == buttonAttribute.basket_item_id) {
      //       if (item.amount === 1) {
      //         this.basket.splice(this.basket.indexOf(item), 1);
      //       } else {
      //         item.amount -= 1;
      //       }
      //     }
      //   });
      // },
      //
      // async deleteProductFromBasket(event) {
      //   const buttonAttribute = event.target.dataset;
      //   let data = {
      //     productId: buttonAttribute.product_id,
      //     amount: buttonAttribute.amount,
      //     basketItemId: buttonAttribute.basket_item_id
      //   }
      //   const response = await fetch('/basketapi/delete/', {
      //     method: 'POST',
      //     headers: new Headers({
      //       'Content-Type': 'application/json'
      //     }),
      //     body: JSON.stringify(data),
      //   });
      //   const status = await response.json();
      //   if (status.result) {
      //     this.changeBasketItemAmount(buttonAttribute);
      //   }
      // },
    },

    mounted() {
      this.getData('/orderapi/getAll/').then(items => this.orders = items);
    }

  });
</script>
