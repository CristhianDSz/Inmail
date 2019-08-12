<template>
  <div>
    <table class="table table-valign-middle mg-b-0">
      <thead>
        <tr>
          <th>Número</th>
          <th>Tipo</th>
          <th>Fecha</th>
          <th>Tipo de documento</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <record
          v-for="record in records"
          :key="record.id"
          :data="record"
          :dependenciesData="dependencies"
          :employeesData="employees"
          :thirdPartiesData="thirdParties"
          @deleted="getRecords"
          @recordClick="passRecordToMain"
        ></record>
      </tbody>
    </table>
  </div>
</template>

<script>
import Record from "./Record";
export default {
  components: {
    Record
  },
  data() {
    return {
      records: [],
      dependencies: [],
      thirdParties: [],
      employees: []
    };
  },
  created() {
    this.getRecords();
    // dependenciesEmitter.$on("dependencies", data => {
    //   this.dependencies = data;
    // });
  },
  methods: {
    getRecords() {
      axios.get("/records").then(records => {
        this.records = records.data;
        this.$emit("quantity", records.data.length);
      });
    },
    passRecordToMain(record) {
      this.$emit("selectedRecord", record);
    }
  }
};
</script>
