<template>
  <div class="selectbox">
    <input type="text" class="search-input" placeholder="Pick Product" v-model="searchProduct">
    <div class="div-list products-list-wrp">
      <div
        class="single-product"
        v-for="product in filteredProduct"
        :key="product.id"
        @click="$emit('productSelected' , product)"
      >
        <b>{{ product.name }}</b>
        <br>
        <b>Price:</b>
        {{ product.price }}
        <br>
        <b>Category:</b>
        {{ product.category }}
        <br>
        <b>BarCode ID:</b>
        {{ product.barcode }}
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["categorySelected"],
  data() {
    return {
      products: "",
      product_temp: "",
      searchProduct: ""
    };
  },
  created() {
    axios.get(`${AppRootPath}/apirequest/products/index`).then(res => {
      this.products = res.data.data;
      this.product_temp = res.data.data;
    });
  },
  watch: {
    categorySelected: function(cat_id) {
      if (cat_id == "all") {
        this.product_temp = this.products;
      } else {
        this.product_temp = [...this.products].filter(
          product => product.category_id == cat_id
        );
      }
    }
  },
  computed: {
    filteredProduct() {
      return [...this.product_temp].filter(product =>
        product.name.toLowerCase().includes(this.searchProduct.toLowerCase())
      );
    }
  }
};
</script>