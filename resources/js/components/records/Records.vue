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
          @recordDetailsClick="passRecordDetailToMain"
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
      employees: [],
      totalOutRecords:0
    };
  },
  created() {
    this.getRecords();
  },
  methods: {
    getRecords() {
      axios.get("/records").then(records => {
        this.records = records.data;
        this.setTotalInRecords(records.data)
        this.setTotalOutRecords(records.data)
        this.setTotalUnregisterRecords(records.data)
        this.setTotalTodayRecords(records.data)
        this.$emit("quantity", records.data.length);
      });
    },
    passRecordToMain(record) {
      this.$emit("selectedRecord", record);
    },
    passRecordDetailToMain(record) {
      this.$emit('detailRecord',record)
    },
    setTotalInRecords(records = []) {
      let totalInRecords = records.filter(record => {
        return record.type === 'Entrada'
      })
     this.$emit('inRecords', totalInRecords.length)
    },
    setTotalOutRecords(records = []) {
      let totalOutRecords = records.filter(record => {
        return record.type === 'Salida'
      })
     this.$emit('outRecords', totalOutRecords.length)
    },
    setTotalUnregisterRecords(records = []) {
      let totalunregisteredRecords = records.filter(record => {
        return record.status === 'Creado'
      })
     this.$emit('unregisteredRecords', totalunregisteredRecords.length)
    },
    setTotalTodayRecords(records = []) {
      let recordDate, currentDate = null
      let todayRecords = records.filter(record => {
        recordDate = moment(record.datetime).format('YYYY-MM-DD')
        currentDate = moment().format('YYYY-MM-DD')
        return recordDate === currentDate
      })
     this.$emit('todayRecords',todayRecords.length)
    }
  }
};
</script>
