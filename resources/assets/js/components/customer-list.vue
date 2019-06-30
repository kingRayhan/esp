<template>
  <div>
    <input
      type="text"
      class="form-control"
      placeholder="Search doctor by Name"
      v-model="searchCustomer"
    />
    <table class="table">
      <tr>
        <td>Name</td>
        <td>Phone Number</td>
        <td>Total billed amount</td>
        <td>Action</td>
      </tr>

      <tr v-for="doctor in filteredCustomer" :key="doctor.id">
        <td>
          <a :href=" $POS.url +  '/doctors/' + doctor.doctor_id">{{ doctor.name }}</a>
        </td>
        <td>{{ doctor.number }}</td>
        <td
          :class="{ 'text-muted' : !doctor.shopping_spend }"
        >{{ doctor.shopping_spend ? doctor.shopping_spend : 'No Shopping' }}</td>
        <td>
          <a
            :href="`${$POS.url}/doctors/${doctor.doctor_id}/shoppinghistory`"
            class="btn btn-info btn-sm"
            v-if="doctor.shopping_spend"
          >
            <i class="fa fa-list"></i>
          </a>
          <a :href="$POS.url + '/doctors/' + doctor.doctor_id" class="btn btn-primary btn-sm">
            <i class="fa fa-eye"></i>
          </a>
          <a
            :href="$POS.url + '/doctors/' + doctor.doctor_id + '/edit'"
            class="btn btn-success btn-sm"
          >
            <i class="fa fa-pencil"></i>
          </a>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  created() {
    axios.get(`${AppRootPath}/apirequest/doctors/index`).then(res => {
      this.customerList = res.data.data;
    });
  },
  data() {
    return {
      customerList: "",
      searchCustomer: ""
    };
  },
  computed: {
    filteredCustomer() {
      return Array.from(this.customerList).filter(doctor => {
        return doctor.name
          .toLowerCase()
          .includes(this.searchCustomer.toLowerCase());
      });
    }
  }
};
</script>
<style scoped>
.text-muted {
  color: #caccce !important;
}
</style>

