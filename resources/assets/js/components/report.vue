<template>
  <div class="container-fluid pt-5">
    <div class="row">
      <div class="col-md-6">
        <h5>Total Bills: {{ TotalBills }}</h5>
        <h5>TotalDiscounts: {{ TotalDiscounts }}</h5>
        <h5>TotalNetBills: {{ TotalNetBills }}</h5>
        <h5>Count: {{ count }}</h5>
      </div>
      <div class="col-md-6">
        <div class="filter-method">
          <h5>Filter Mode</h5>
          <label class="mr-3">
            <input type="radio" name="filter_mode" v-model="filter_mode" value="date" /> Date
          </label>
          <label class="mr-3">
            <input type="radio" name="filter_mode" v-model="filter_mode" value="doctor" /> Doctor
          </label>
          <label class="mr-3">
            <input type="radio" name="filter_mode" v-model="filter_mode" value="doctor_and_date" /> Doctor & Date
          </label>
        </div>
        <div class="d-flex">
          <div class="filter date-filter">
            <div class="form-group">
              <input
                class="form-control"
                type="date"
                @change="fillDateFilter"
                data-date-filter-type="filterDateStart"
              />
            </div>
            <div class="form-group">
              <input
                class="form-control"
                type="date"
                @change="fillDateFilter"
                data-date-filter-type="filterDateEnd"
              />
            </div>
          </div>
          <div class="filter test-filter form-group ml-2 w-100">
            <label for="doctor">Doctor</label>
            <select class="form-control" id="doctor" v-model="filtered_doctor_id">
              <option
                v-for="doctor in doctors"
                :value="doctor.doctor_id"
                :key="doctor.id"
              >{{doctor.name}}</option>
            </select>
            <button @click="filtered_doctor_id = null">x</button>
          </div>
        </div>
      </div>
    </div>

    <h1 v-if="reports.length == 0">Please Wait</h1>

    <div v-else class="row">
      <div class="col-md-12">
        <table id="datatable" class="table table-hover">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Time</th>
              <th>Patient</th>
              <th>Refered Doctor</th>
              <th>Discount</th>
              <th>Bill</th>
              <th>Net Bill</th>
              <th>Payment Slip</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="report in filteredReports" :key="report.id">
              <td v-html="report.id"></td>
              <td>{{renderTime(report.bill_date)}}</td>
              <td v-html="report.customer_name"></td>

              <td v-if="report.doctor">
                <a
                  target="_blank"
                  :href="`${$POS.url}/doctors/${report.doctor.id}`"
                >{{report.doctor.name}}</a>
              </td>
              <td v-else>No ref</td>

              <td v-html="report.discount"></td>
              <td v-html="report.bills"></td>
              <td v-html="report.net_bills"></td>
              <td>
                <a :href="`${$POS.url}/slip/${report.id}`">View Slip</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
// import moment from "moment";
import moment from "moment";
export default {
  async created() {
    /**
     * Reports
     */
    const {
      data: { data: reports }
    } = await axios.get(`${AppRootPath}/apirequest/sells/report`);
    this.reports = reports;

    /**
     * Doctors
     */
    const {
      data: { data: doctors }
    } = await axios.get(`${AppRootPath}/apirequest/doctors/index`);
    this.doctors = doctors;

    /**
     * Tests
     */
    const {
      data: { data: tests }
    } = await axios.get(`${AppRootPath}/apirequest/products/index`);
    this.tests = tests;
  },
  data() {
    return {
      reports: [],
      tests: [],
      doctors: [],
      filter_mode: "doctor",
      filtered_doctor_id: undefined,
      filtered_test_id: undefined,
      filterDateStart: undefined,
      filterDateEnd: undefined,
      name: ""
    };
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
  },
  computed: {
    TotalBills() {
      return this.filteredReports.reduce(
        (total, current) => (total += current.bills),
        0
      );
    },
    TotalDiscounts() {
      return this.filteredReports.reduce((total, current) => {
        return (total += Number(current.discount));
      }, 0);
    },
    TotalNetBills() {
      return this.filteredReports.reduce(
        (total, current) => (total += current.net_bills),
        0
      );
    },
    count() {
      return this.filteredReports.length;
    },
    filteredReports() {
      if (
        this.filterDateEnd &&
        this.filterDateStart &&
        this.filter_mode == "date"
      ) {
        return this.reports
          .filter(report => {
            let time = Number(report.bill_date);
            return this.filterDateStart <= time && this.filterDateEnd >= time;
          })
          .reverse();
      }

      if (
        this.filterDateEnd &&
        this.filterDateStart &&
        this.filtered_doctor_id &&
        this.filter_mode == "doctor_and_date"
      ) {
        return this.reports.filter(report => {
          let time = Number(report.bill_date);
          return (
            this.filterDateStart <= time &&
            this.filterDateEnd >= time &&
            report.doctor.id == this.filtered_doctor_id
          );
        });
      }

      /**
       * Doctor Filter
       */
      if (this.filtered_doctor_id && this.filter_mode == "doctor") {
        let filter = this.reports
          .filter(report => {
            return (
              report.doctor && report.doctor.id === this.filtered_doctor_id
            );
          })
          .reverse();
        return filter;
      }
      return this.reports;
    }
  }
};
</script>

