<template>
  <div class="container mt-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="text-left">
            <small class="font-weight-bold">Total radicados: 10</small>
          </div>
          <div class="text-right">
            <small class="font-weight-bold">Crear nuevo registro</small>
            <a
              href="#"
              class="btn btn-info btn-icon rounded-circle mg-r-5 mg-b-10 bd-4"
              @click.prevent="showModal"
            >
              <div>
                <i class="icon ion-plus"></i>
              </div>
            </a>
          </div>
        </div>
        <div class="pd-10 rounded mg-t-10">
          <div class="content-tabs">
            <records ref="records"></records>
          </div>
        </div>
        <modal ref="recordModal" name="recordModal">
          <template slot="title">Crear nuevo registro</template>
          <template slot="body">
            <record-form
              @dependencies="passDependenciesToRecords"
              @thirdParties="passThirdPartiesToRecords"
              @employees="passEmployeesToRecords"
              @success="getRecords"
            ></record-form>
          </template>
        </modal>
      </div>
    </div>
  </div>
</template>

<script>
import Modal from "../utils/Modal";
import RecordForm from "./RecordForm";
import Records from "./Records";
export default {
  components: { Modal, RecordForm, Records },
  data() {
    return {
      records: [],
      typeRecordsTabs: ["Entrada", "Salida"],
      selectedTab: "Entrada"
    };
  },
  created() {},
  methods: {
    showModal() {
      this.$refs.recordModal.showModal();
    },
    passDependenciesToRecords(dependencies = []) {
      this.$refs.records.dependencies = dependencies;
    },
    passThirdPartiesToRecords(thirdParties = []) {
      this.$refs.records.thirdParties = thirdParties;
    },
    passEmployeesToRecords(employees = []) {
      this.$refs.records.employees = employees;
    },
    getRecords() {
      this.$refs.records.getRecords();
    }
  }
};
</script>
