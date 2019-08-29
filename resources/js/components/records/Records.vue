<template>
  <div>
    <div class="row">
      <div class="form-group col-4 mg-t-0">
        <label class="tx-12">Búsqueda rápida</label>
        <input type="search" class="form-control form-control-sm" v-model="recordSearch" />
      </div>
      <div class="form-group col-4 mg-t-0">
        <label class="tx-12">Ordenar por</label>
        <select
          class="form-control form-control-sm"
          v-model="recordOrder"
          @change="orderByRecord(recordOrder)"
        >
          <option value="number">Número</option>
          <option value="datetime">Fecha más reciente</option>
          <option value="document_type">Tipo de documento</option>
          <option value="status">Estado</option>
          <option value="name">Tercero</option>
        </select>
      </div>
    </div>
    <table class="table table-responsive table-valign-middle mg-b-0" v-if="records.length">
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
    <p class="tx-medium" v-else>No existen registros actualmente.</p>
  </div>
</template>

<script>
import Record from "./Record";
import RecordSorter from "./RecordSorter"
export default {
  components: {
    Record
  },
  data() {
    return {
      records: [],
      originalRecords: [],
      dependencies: [],
      thirdParties: [],
      employees: [],
      totalOutRecords: 0,
      recordSearch: "",
      recordOrder: "datetime"
    };
  },
  created() {
    this.getRecords();
  },
  methods: {
    getRecords() {
      axios.get("/records").then(records => {
        this.records = records.data;
        this.originalRecords = records.data;
        this.setTotalInRecords(records.data);
        this.setTotalOutRecords(records.data);
        this.setTotalUnregisterRecords(records.data);
        this.setTotalTodayRecords(records.data);
        this.$emit("quantity", records.data.length);
      });
    },
    passRecordToMain(record) {
      this.$emit("selectedRecord", record);
    },
    setTotalInRecords(records = []) {
      let totalInRecords = records.filter(record => {
        return record.type === "Entrada";
      });
      this.$emit("inRecords", totalInRecords.length);
    },
    setTotalOutRecords(records = []) {
      let totalOutRecords = records.filter(record => {
        return record.type === "Salida";
      });
      this.$emit("outRecords", totalOutRecords.length);
    },
    setTotalUnregisterRecords(records = []) {
      let totalunregisteredRecords = records.filter(record => {
        return record.status === "Creado";
      });
      this.$emit("unregisteredRecords", totalunregisteredRecords.length);
    },
    setTotalTodayRecords(records = []) {
      let recordDate,
        currentDate = null;
      let todayRecords = records.filter(record => {
        recordDate = moment(record.datetime).format("YYYY-MM-DD");
        currentDate = moment().format("YYYY-MM-DD");
        return recordDate === currentDate;
      });
      this.$emit("todayRecords", todayRecords.length);
    },
    /** Order records filtering by datetime, number (default from DB laravel), document_type or status - Using RecordSorter class */
    orderByRecord(field) {
      if (field === "datetime") {
        this.records = RecordSorter.sortByDate(this.records)
      } else if (field === "document_type") {
        this.records =  RecordSorter.sortByStringField(this.records,"document_type")
      } else if (field === "status") {
        this.records =  RecordSorter.sortByStringField(this.records,"status")
      } else if (field === "name") {
        this.records =   RecordSorter.sortByObjectNameField(this.records,"third_party")
      }
       else {
        this.records = RecordSorter.sortByCharAndNumber(this.records)
      }
    },
  },
  watch: {
    /** Search a record for type, status, number, datetime or document_type property */
     recordSearch() {
      if (this.recordSearch.length) {
        this.records = this.originalRecords.filter(record => {
          return (
            record.type.toLowerCase().indexOf(this.recordSearch.toLowerCase()) > -1 ||
            record.status.toLowerCase().indexOf(this.recordSearch.toLowerCase()) > -1 ||
            record.number.toLowerCase().indexOf(this.recordSearch.toLowerCase()) > -1 ||
            moment(record.datetime)
              .format("MM/DD/YYYY")
              .indexOf(this.recordSearch) > -1 ||
            record.document_type.toLowerCase().indexOf(this.recordSearch.toLowerCase()) > -1
          );
        });
      } else {
        this.records = this.originalRecords;
      }
    },
   
  }
};
</script>
