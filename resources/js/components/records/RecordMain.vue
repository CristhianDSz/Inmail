<template>
  <div class="row row-sm">
    <card title="Entrada" text="0" color="teal"></card>
    <card title="Salida" text="0" color="danger"></card>
    <card title="Sin registrar" text="0" color="primary"></card>
    <card title="Hoy" text="0" color="br-primary"></card>

    <div class="card col-12 mt-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="text-left">
            <small class="font-weight-bold">Total radicados: {{totalRecords}}</small>
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
            <records ref="records" @selectedRecord="passRecordEditForm" @quantity="setTotalRecords"></records>
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
        <modal ref="recordEditModal" name="recordEditModal">
          <template slot="title">Editar registro</template>
          <template slot="body">
            <record-edit-form
              v-if="editForm"
              @dependencies="passDependenciesToRecords"
              @thirdParties="passThirdPartiesToRecords"
              @employees="passEmployeesToRecords"
              @success="getRecords"
              :record="currentRecord"
            ></record-edit-form>
          </template>
        </modal>
      </div>
    </div>
  </div>
</template>

<script>
import Modal from "../utils/Modal";
import Card from "./Card";
import RecordForm from "./RecordForm";
import RecordEditForm from "./RecordEditForm";
import Records from "./Records";
export default {
  components: { Modal, Card, RecordForm, RecordEditForm, Records },
  data() {
    return {
      records: [],
      typeRecordsTabs: ["Entrada", "Salida"],
      selectedTab: "Entrada",
      editForm: false,
      currentRecord: "",
      totalRecords: 0
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
      modalEmitter.$emit("close");
    },
    passRecordEditForm(record) {
      this.currentRecord = record;
      this.editForm = true;
      this.$refs.recordEditModal.showModal();
    },
    setTotalRecords(records) {
      this.totalRecords = records;
    }
  }
};
</script>
