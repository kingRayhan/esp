<template>
  <div>
    <div class="buttons pb-2 statics">
      <!-- <button class="btn btn-primary" @click="visibility = 'all'">All</button> -->
      <!-- <button class="btn btn-primary" @click="visibility = 'today'">Today</button> -->
      &nbsp;
      &nbsp;
      <b>From:&nbsp;</b>
      <input
        type="date"
        data-date-filter-type="fromDate"
        @input="fillDateFilter"
        forma
        placeholder="from Date"
        class="date-filter"
      />
      &nbsp;
      <b>To:&nbsp;</b>
      <input
        type="date"
        data-date-filter-type="toDate"
        @input="fillDateFilter"
        placeholder="from Date"
        class="date-filter"
      />
      <button @click="fromDate = null;toDate = null">x</button>

      <div class="py-3">
        <b>Test</b>
        <select class="ml-3" v-model="filtered_test_id">
          <option
            :value="test.product_id"
            v-for="test in tests"
            :key="test.product_id"
          >{{test.name}}</option>
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
          <tr>
            <td>
              <h4>Count:</h4>
            </td>
            <td>
              <h4>{{ count }}</h4>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <table class="table">
      <tr>
        <th>Sell ID</th>
        <th>Time</th>
        <th>Test Name</th>
        <th>Price</th>
      </tr>

      <tr v-for="s in filteredSells" :key="s.sell_id">
        <td>{{ s.sell_id }}</td>
        <td>{{ renderTime(s.date) }}</td>
        <td>{{ s.product_name }}</td>
        <td>{{ s.price }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import moment from "moment";
export default {
  async created() {
    const {
      data: { data: sellReports }
    } = await axios.get(`${AppRootPath}/apirequest/sells/index`);
    this.sellReports = sellReports;

    const {
      data: { data: tests }
    } = await axios.get(`${AppRootPath}/apirequest/products/index`);
    this.tests = tests;
  },
  data() {
    return {
      sellReports: "",
      visibility: "all",
      fromDate: null,
      toDate: null,
      tests: [],
      filtered_test_id: null
    };
  },
  computed: {
    count() {
      return this.filteredSells.length;
    },
    filteredSells() {
      // var data = "";

      // if (this.filtered_doctors) {
      //   this.sellReports = this.sellReports.filter(sell => {
      //     return sell.doctor.id === this.filtered_doctors;
      //   });
      // }

      // if (this.visibility == "all") data = this.sellReports;
      // else if (this.visibility == "today") {
      //   data = this.sellReports.filter(sell => {
      //     var today = new Date();
      //     var dd = today.getDate();
      //     var mm = today.getMonth() + 1; //January is 0!

      //     var yyyy = today.getFullYear();
      //     if (dd < 10) {
      //       dd = "0" + dd;
      //     }
      //     if (mm < 10) {
      //       mm = "0" + mm;
      //     }
      //     var today = `${dd}/${mm}/${yyyy}`;

      //     return sell.date.match(today);
      //   });
      // } else if (this.visibility == "dateRange") {
      //   data = this.sellReports.filter(sell => {
      //     return (
      //       new Date(sell.date).getTime() >= this.fromTimeStamp &&
      //       new Date(sell.date).getTime() <= this.toTimeStamp
      //     );
      //   });
      // }
      // return data;

      if (this.filtered_test_id) {
        return this.sellReports
          .filter(report => {
            let time = Number(report.date);
            return report.product_id == this.filtered_test_id;
          })
          .reverse();
      }

      if (this.fromDate && this.toDate) {
        return this.sellReports
          .filter(report => {
            let time = Number(report.date);
            return this.fromDate <= time && this.toDate >= time;
          })
          .reverse();
      }

      if (this.fromDate && this.toDate && this.filtered_test_id) {
        return this.sellReports
          .filter(report => {
            let time = Number(report.date);
            return (
              this.fromDate <= time &&
              this.toDate >= time &&
              report.product_id == this.filtered_test_id
            );
          })
          .reverse();
      }

      return this.sellReports;
    },
    totalSell() {
      return [...this.filteredSells].reduce(
        (total, current) => (total += Number(current.price)),
        0
      );
    }
  },
  methods: {
    renderTime(time) {
      let date = new Date(Number(time));
      return moment(date).format("Do MMMM YYYY");
    },
    fillDateFilter(e) {
      this[e.target.dataset.dateFilterType] = new Date(
        e.target.value
      ).getTime();
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
