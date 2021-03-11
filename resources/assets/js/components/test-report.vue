<template>
  <div>
    <div class="buttons pb-2 statics">
      <div class="filter-method">
        <h5>Filter Mode</h5>
        <label class="mr-3">
          <input type="radio" name="filter_mode" v-model="filter_mode" value="date"/> Date
        </label>
        <label class="mr-3">
          <input type="radio" name="filter_mode" v-model="filter_mode" value="test"/> Test
        </label>
        <label class="mr-3">
          <input type="radio" name="filter_mode" v-model="filter_mode" value="test_and_date"/> Date and Test
        </label>
      </div>

      <b>From:&nbsp;</b>
      <input
          type="date"
          v-model="fromDate"
          placeholder="from Date"
          class="date-filter"
      />
      &nbsp;
      <b>To:&nbsp;</b>
      <input
          type="date"
          v-model="toDate"
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
          >{{ test.name }}
          </option>
        </select>
        <button @click="filtered_test_id = null">x</button>
      </div>

      <div class="pt-3">
        <table>
          <tr>
            <td>
              <h4>Total sells:</h4>
            </td>
            <td>
              <h4>{{ totalsales }}</h4>
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

        <button class="btn btn-primary" @click="onSubmit">Submit</button>
      </div>
    </div>

    <h1 class="my-5" v-if="sellReports.length == 0">Please Wait</h1>
    <table v-else class="table">
      <tr>
        <th>Sell ID</th>
        <th>Time</th>
        <th>Test Name</th>
        <th>Price</th>
      </tr>
      <tr v-for="s in sellReports" :key="s.sell_id">
        <td>{{ s.sell_id }}</td>
        <td>{{ s.date }}</td>
        <td>{{ s.product_name }}</td>
        <td>{{ s.price }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import moment from "moment";
import querystring from 'querystring'

export default {
  props: ['sells', 'totalsales'],
  async created() {
    // const {
    //   data: { data: sellReports }
    // } = await axios.get(`${AppRootPath}/apirequest/sells/index`);
    this.sellReports = this.sells.data;
    this.filtered_test_id = new URLSearchParams(location.search).get('test');
    this.fromDate = new URLSearchParams(location.search).get('from_date');
    this.toDate = new URLSearchParams(location.search).get('to_date');
    this.filter_mode = new URLSearchParams(location.search).get('mode') ? new URLSearchParams(location.search).get('mode') : 'date';

    console.log(this.sells)
    const {
      data: {data: tests}
    } = await axios.get(`${AppRootPath}/apirequest/products/index`);
    this.tests = tests;
  },
  data() {
    return {
      sellReports: [],
      visibility: "all",
      fromDate: null,
      toDate: null,
      tests: [],
      filter_mode: "date",
      filtered_test_id: null
    };
  },

  computed: {
    count() {
      return this.sells.total;
    },

  },
  methods: {
    onSubmit() {
      let query = this.filtered_test_id ? {test: this.filtered_test_id} : null
      if ((this.fromDate && this.toDate)) {
        query = {...query, from_date: this.fromDate, to_date: this.toDate}
        // from_date=${this.fromDate}&to_date=${this.toDate}`
      }

      if (query) {
        query = {...query, mode: this.filter_mode}
        window.location.href = `${location.origin}/sells?${querystring.stringify(query)}`

      } else {
        window.swal('Please enter date range or test type', '', 'error')
      }
    },
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
