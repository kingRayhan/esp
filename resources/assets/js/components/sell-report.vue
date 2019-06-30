<template>
  <div>
    <div class="buttons pb-2 statics">
      <button class="btn btn-primary" @click="visibility = 'all'">All</button>
      <button class="btn btn-primary" @click="visibility = 'today'">Today</button>
      &nbsp;
      &nbsp;
      <b>From:&nbsp;</b>
      <input type="date" v-model="fromDate" forma placeholder="from Date" class="date-filter">
      &nbsp;
      <b>To:&nbsp;</b>
      <input type="date" v-model="toDate" placeholder="from Date" class="date-filter">
      <button @click="visibility = 'dateRange'">Filter</button>

      <div class="py-3">
        <b>Select Doctor</b>
        <select class="ml-3" v-model="filtered_doctors">
          <option
            :value="doctor.doctor_id"
            v-for="doctor in doctors"
            :key="doctor.doctor_id"
          >{{doctor.name}}</option>
        </select>
      </div>

      <div class="pt-3">
        <table>
          <tr>
            <td>
              <h4>Total sells:</h4>
            </td>
            <td>
              <h4>{{ totalSell }}</h4>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <table class="table">
      <tr>
        <th>Sell ID</th>
        <th>Refered Doctor</th>
        <th>Time</th>
        <th>Test Name</th>
        <th>Price</th>
      </tr>

      <tr v-for="s in filteredSells" :key="s.sell_id">
        <td>{{ s.sell_id }}</td>
        <td v-if="s.doctor != null">
          <a :href="`/doctors/${s.doctor.id}`">{{ s.doctor.name }}</a>
        </td>
        <td v-if="s.doctor == null">Other Doctor</td>
        <td>{{ s.date }}&nbsp;&nbsp;&nbsp;{{ s.time }}</td>
        <td>{{ s.product_name }}</td>
        <td>{{ s.total_sell_price }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  created() {
    axios.get(`${AppRootPath}/apirequest/sells/index`).then(res => {
      this.sellReports = res.data.data;
    });
    axios.get(`${AppRootPath}/apirequest/doctors/index`).then(res => {
      this.doctors = res.data.data;
    });
  },
  data() {
    return {
      sellReports: "",
      visibility: "all",
      fromDate: "",
      toDate: "",
      doctors: [],
      filtered_doctors: null
    };
  },
  computed: {
    filteredSells() {
      var data = "";

      if (this.filtered_doctors) {
        this.sellReports = this.sellReports.filter(sell => {
          return sell.doctor.id === this.filtered_doctors;
        });
      }

      if (this.visibility == "all") data = this.sellReports;
      else if (this.visibility == "today") {
        data = this.sellReports.filter(sell => {
          var today = new Date();
          var dd = today.getDate();
          var mm = today.getMonth() + 1; //January is 0!

          var yyyy = today.getFullYear();
          if (dd < 10) {
            dd = "0" + dd;
          }
          if (mm < 10) {
            mm = "0" + mm;
          }
          var today = `${dd}/${mm}/${yyyy}`;

          return sell.date.match(today);
        });
      } else if (this.visibility == "dateRange") {
        data = this.sellReports.filter(sell => {
          return (
            new Date(sell.date).getTime() >= this.fromTimeStamp &&
            new Date(sell.date).getTime() <= this.toTimeStamp
          );
        });
      }
      return data;
    },
    totalProfit() {
      var totalP = 0;
      Array.from(this.filteredSells).forEach(el => {
        totalP += el.net_profit;
      });
      return totalP;
    },
    totalSell() {
      var total = 0;
      Array.from(this.filteredSells).forEach(el => {
        total += el.total_sell_price;
      });
      return total;
    },
    fromTimeStamp(date) {
      var newDate = this.fromDate.split("-");
      var fromDate = `${newDate[2]}/${newDate[1]}/${newDate[0]}`;

      return new Date(fromDate).getTime();
    },
    toTimeStamp(date) {
      var newDate = this.toDate.split("-");
      var fromDate = `${newDate[2]}/${newDate[1]}/${newDate[0]}`;
      return new Date(fromDate).getTime();
    }
  }
};
</script>


<style scoped>
input.date-filter {
  border: 1px solid #ddd;
  padding: 1px 10px;
}
.statics {
  background: #f2f2f2;
  padding: 11px 11px;
}
</style>
