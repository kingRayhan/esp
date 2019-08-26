<template>
  <div id="root">
    <div class="row" v-if="!doneShopping">
      <!--<div class="row" v-if="false">-->
      <div class="col-md-3">
        <products
          :categorySelected="selected_category_id"
          @productSelected="pushProductByProductListClick"
        />
      </div>

      <div class="col-md-3">
        <category @categorySelected="categorySelected" />
        <customers @customerSelected="customerSelected" />
      </div>

      <div class="col-md-6">
        <div>
          <table class="table table-bordered">
            <tr>
              <td>
                <b>Refered Doctor:</b>
              </td>
              <td>{{ selected_customer.name ? selected_customer.name : 'Guest Customer' }}</td>
            </tr>
            <tr>
              <td>
                <b>Total Bill:</b>
              </td>
              <td>{{ totalBill }}</td>
            </tr>
          </table>

          <div class="mt-3 mb-3">
            <h5 class="text-uppercase pull-left pr-2">Billing Card</h5>
            <button
              v-if="bagsUpdated.length && selected_customer"
              @click="doneShopping = true"
              class="pull-left btn btn-primary btn-sm text-uppercase"
            >Proceed</button>
          </div>

          <barcode @fetchedProduct="pushProductByBarcode" />
          <cart ref="cartCom" :newProduct="pushProduct" @bagsUpdated="updateBags" />
        </div>
      </div>
    </div>
    <div v-if="doneShopping">
      <invoice
        :bags="bagsUpdated"
        :customer="selected_customer"
        @purchased="confirmPurchases"
        @cancelOrder="doneShopping=false"
        @customer_name="customer_name = $event"
        @customer_age="customer_age = $event"
        @bill_date="bill_date = $event"
        @customer_gender="customer_gender = $event"
        @discount="discount = $event"
        @paid="paid = $event"
      />
    </div>
  </div>
</template>



<script>
export default {
  mounted() {
    const ProductListWrapper = document.querySelector(".products-list-wrp");
    const BodyHeight = document.body.clientHeight;
    const NavbarHeight = document.querySelector(".navbar").clientHeight;
    const ProductSearchHeight = document.querySelector(".search-input")
      .clientHeight;

    const CategoryWrapper = document.querySelector("#categoryList");

    ProductListWrapper.style.setProperty(
      "height",
      `${BodyHeight - (NavbarHeight + ProductSearchHeight)}px`
    );
    ProductListWrapper.style.setProperty("overflow-y", `scroll`);
  },
  data() {
    return {
      selected_category_id: "",
      selected_customer: "",
      productSelected: "",
      pushProduct: "",
      bagsUpdated: "",

      InvoiceData: "",

      confirmPurchase: false,
      doneShopping: false,
      errorHappened: false,

      //
      bill_date: null,
      customer_name: null,
      customer_age: null,
      customer_gender: "male",
      discount: null,
      paid: null
    };
  },
  methods: {
    categorySelected(cat_id) {
      this.selected_category_id = cat_id;
    },
    customerSelected(customer) {
      this.selected_customer = customer;
    },
    pushProductByProductListClick(product) {
      this.$refs.cartCom.addProduct(product);
    },
    pushProductByBarcode(product) {
      this.pushProduct = product;
    },

    updateBags(bag) {
      this.bagsUpdated = bag;
    },
    confirmPurchases() {
      var _this = this;
      axios
        .post(`${AppRootPath}/sells/sellProduct`, {
          bags: this.bagsUpdated,
          customer_name: this.customer_name,
          customer_age: this.customer_age,
          customer_gender: this.customer_gender,
          paid: this.paid,
          discount: this.discount,
          doctor_id: this.selected_customer.doctor_id,
          bill_date: String(this.billTimeStamp)
        })
        .then(res => {
          this.confirmPurchase = true;
          window.location.href = `${AppRootPath}/slip/${res.data.id}`;
        })
        .catch(function(error) {
          _this.errorHappened = true;
          console.error(error);
        });
    }
  },
  computed: {
    totalBill() {
      if (this.bagsUpdated.length == 0) return 0;

      return this.bagsUpdated.reduce((total, currentbag) => {
        return (total += currentbag.price * currentbag.quantity);
      }, 0);
    },
    billTimeStamp() {
      const date = new Date(this.bill_date);
      return date.getTime();
    }
  }
};
</script>
<style scoped>
.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,
.col,
.col-auto,
.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-sm,
.col-sm-auto,
.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11,
.col-md-12,
.col-md,
.col-md-auto,
.col-lg-1,
.col-lg-2,
.col-lg-3,
.col-lg-4,
.col-lg-5,
.col-lg-6,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-10,
.col-lg-11,
.col-lg-12,
.col-lg,
.col-lg-auto,
.col-xl-1,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl,
.col-xl-auto {
  padding-left: 3px;
  padding-right: 3px;
}
#root {
  margin-top: -15px;
}
html,
body {
  height: 100%;
}
</style>