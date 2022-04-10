
<h2>Корзина</h2>
<div id="basket">
    <div v-if="basket.length == 0">
        <h3>Корзина пуста</h3>
    </div>
    <table v-else>
        <tr class="basket__row">
           <th></th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
            <th></th>
        </tr>
        <tr v-for="item in basket" class="basket__row">
            <td>
               <a :href="'/product/?product_id=' + item.id"><img :src="'img/catalog/' + item.image" :alt="item.name" width="50px"></a>
           </td>
            <td>
                {{ item.name }}
            </td>
            <td>
                {{ item.price }}  ₽
            </td>
            <td>
                {{ item.amount }}
            </td>
            <td>
                {{ item.price * item.amount }}  ₽
            </td>
            <td>
                <button class="basket__delete-button"
                        :data-product_id="item.product_id"
                        :data-amount="item.amount"
                        :data-basket_item_id="item.id"
                        @click="deleteProductFromBasket"
                >X</button>
            </td>
        </tr>
    </table>
    <h3>ИТОГО: {{ totalBasketCost }} ₽</h3>

    <a href="/checkout">Оформить покупку</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    const basket = new Vue({

      el: '#basket',

      data: {
        basket: [],
      },

      methods: {
        getData(url) {
          return fetch(url).then(data => data.json());
        },

        changeBasketItemAmount(buttonAttribute) {
          this.basket.forEach(item => {
            if (item.id == buttonAttribute.basket_item_id) {
              if (item.amount === 1) {
                this.basket.splice(this.basket.indexOf(item), 1);
              } else {
                item.amount -= 1;
              }
            }
          });
        },

        async deleteProductFromBasket(event) {
          const buttonAttribute = event.target.dataset;
          let data = {
            productId: buttonAttribute.product_id,
            amount: buttonAttribute.amount,
            basketItemId: buttonAttribute.basket_item_id
          }
          const response = await fetch('/basketapi/delete/', {
            method: 'POST',
            headers: new Headers({
              'Content-Type': 'application/json'
            }),
            body: JSON.stringify(data),
          });
          const status = await response.json();
          if (status.result) {
            this.changeBasketItemAmount(buttonAttribute);
          }
        },

      },

      computed: {
        totalBasketCost() {
          let total = 0;
          this.basket.forEach(item => total += item.amount * item.price);
          return total;
        }
      },

      mounted() {
        this.getData('/basketapi/getAll/').then(items => this.basket = items);
        }
    });
</script>




