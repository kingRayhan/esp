<template>
  <table class="table table-bordered" v-if="bags.length">
    <tr>
      <th>Product Name</th>
      <th>Price</th>
      <!-- <th>Quantity</th> -->
      <th>Net Price</th>
    </tr>
    <tr class="single-product-row" v-for="(product,i) in bags" :key="i">
      <td v-text="product.name"></td>
      <td>
        <input type="number" id="sell_price" class="cart-input" v-model="product.price" disabled>
      </td>
      <!-- <td>
        <input type="number" class="cart-input" v-model="product.quantity">
      </td>-->

      <td>{{ product.price * product.quantity }}</td>
      <button @click="removeProduct(i)" class="btn btn-danger btn-sm">
        <i class="fa fa-times"></i>
      </button>
    </tr>
  </table>
</template>

<script>
export default {
  props: ["newProduct"],
  data() {
    return {
      bags: [],
      quantity: 1
    };
  },
  methods: {
    addProduct(product) {
      console.log(product);
      const newProduct = {
        product_id: product.product_id,
        name: product.name,
        price: product.price,
        quantity: 1
      };

      var founded = false;

      if (this.bags.length) {
        this.bags.forEach(item => {
          if (item.product_id == newProduct.product_id) {
            // item.quantity++;
            founded = true;
          }
        });
      }

      if (!founded) {
        this.bags.push(newProduct);
      }
      this.$emit("bagsUpdated", this.bags);
    },
    removeProduct(index) {
      this.bags.splice(index, 1);
      this.$emit("bagsUpdated", this.bags);
    }
  },
  watch: {
    newProduct(newProduct) {
      this.addProduct(newProduct);
    }
  }
};
</script>
<style scoped>
.cart-input {
  width: 100%;
  border: 1px solid #ddd;
  padding: 3px;
}
</style>