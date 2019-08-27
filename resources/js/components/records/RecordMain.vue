<template>
  <div class="row row-sm">
    <card title="Entrada" :text="totalInRecords" color="teal"></card>
    <card title="Salida" :text="totalOutRecords" color="danger"></card>
    <card title="Sin registrar" :text="totalUnregisteredRecords" color="primary"></card>
    <card title="Hoy" :text="totalTodayRecords" color="br-primary"></card>

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
        <div class="pd-10 rounded mg-t-5">
          <div class="content-tabs">
            <records ref="records" 
            @selectedRecord="passRecordEditForm"
            @detailRecord="passRecordDetail"
            @quantity="totalRecords = $event"
            @inRecords="totalInRecords = $event"
            @outRecords="totalOutRecords = $event"
            @unregisteredRecords="totalUnregisteredRecords = $event"
            @todayRecords = "totalTodayRecords = $event"
            ></records>
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
              v-if="showEdit"
              @dependencies="passDependenciesToRecords"
              @thirdParties="passThirdPartiesToRecords"
              @employees="passEmployeesToRecords"
              @success="getRecords"
              :record="currentRecord"
            ></record-edit-form>
          </template>
        </modal>
        <modal ref="recordDetailModal" name="recordDetailModal">
          <template slot="title">Detalle de registro</template>
          <template slot="body">
            <record-detail :record="currentRecord" v-if="showDetail"></record-detail>
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
import RecordDetail from "./RecordDetail"
import Records from "./Records";
export default {
  components: { Modal, Card, RecordForm, RecordEditForm, RecordDetail, Records },
  data() {
    return {
      records: [],
      typeRecordsTabs: ["Entrada", "Salida"],
      selectedTab: "Entrada",
      showEdit: false,
      showDetail:false,
      currentRecord: "",
      totalRecords: 0,
      totalInRecords: 0,
      totalOutRecords: 0,
      totalUnregisteredRecords:0,
      totalTodayRecords:0
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
      this.showEdit = true;
      this.$refs.recordEditModal.showModal();
    },
    passRecordDetail(record) {
      this.currentRecord = record
      this.showDetail = true
      this.$refs.recordDetailModal.showModal()
    }
  }
};
</script>
