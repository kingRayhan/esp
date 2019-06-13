<template>
  <form>
    <div class="selectbox">
      <input type="reset" value="x" class="deselect" @click="$emit('customerSelected' , '' )">
      <input type="text" class="search-input" placeholder="Select Doctor" v-model="searchCustomer">
      <ul class="list">
        <li v-for="doctor in filteredCustomer" :key="doctor.doctor_id">
          <label
            :data-customer-id="doctor.doctor_id    "
            @click="$emit('customerSelected' , doctor)"
          >
            <input type="radio" name="customer">
            {{ doctor.name }}
          </label>
        </li>
      </ul>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      customers: "",
      searchCustomer: ""
    };
  },
  created() {
    axios.get(`${AppRootPath}/apirequest/doctors/index`).then(res => {
      this.customers = res.data.data;
    });
  },
  computed: {
    filteredCustomer() {
      return [...this.customers].filter(doctor => {
        return (
          doctor.name.includes(this.searchCustomer) ||
          doctor.number.includes(this.searchCustomer) ||
          doctor.email.includes(this.searchCustomer)
        );
      });
    }
  }
};
</script>
<style scoped>
.title {
  font-size: 13px;
  text-transform: uppercase;
}
li {
  border: 1px solid #ddd;
  margin: 8px 0;
}
.deselect {
  font-size: 13px;
  border: none;
  background: red;
  color: #fff;
  cursor: pointer;
  position: absolute;
  border-radius: 50%;
  padding: 0 10px;
  top: 0;
  right: 0;
}

.deselect:focus {
  outline: none;
}
.selectbox {
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
  padding: 2px;
}
</style>