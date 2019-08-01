<template>
  <tr v-if="!editForm" @dblclick="editForm = true">
    <td class="pd-l-0-force">{{data.number}}</td>
    <td>{{data.type}}</td>
    <td>{{data.datetime}}</td>
    <td>{{data.document_type}}</td>
    <td>{{data.status}}</td>
    <!-- <td>{{data.third_party.name}}</td>
    <td>
      <h6 class="tx-inverse tx-14 mg-b-0">{{data.employee.name}}</h6>
      <span class="tx-12">{{data.dependency.name}}</span>
    </td>-->
    <td>
      <a href="#" @click.prevent="editForm = true">
        <i class="icon ion-edit tx-22 p-2 action-icon"></i>
      </a>

      <a href="#" @click.prevent="deleteRecord">
        <i class="icon ion-trash-a tx-22 p-2 action-icon"></i>
      </a>
    </td>
  </tr>

  <!-- <td>
      <select v-model="record.dependency_id" class="form-control">
        <option
          v-for="third_party in thirdPartiesData"
          :key="third_party.id"
          :value="third_party.id"
        >{{third_party.name}}</option>
      </select>
    </td>
    <td>
      <select v-model="record.dependency_id" class="form-control">
        <option
          v-for="dependency in dependenciesData"
          :key="dependency.id"
          :value="dependency.id"
        >{{dependency.name}}</option>
      </select>
    </td>
    <td>
      <select v-model="record.employee_id" class="form-control">
        <option
          v-for="employee in employeesData"
          :key="employee.id"
          :value="employee.id"
        >{{employee.name}}</option>
      </select>
  </td>-->
</template>

<script>
import Modal from "../utils/Modal";
export default {
  components: { Modal },
  props: ["data", "dependenciesData", "thirdPartiesData", "employeesData"],
  data() {
    return {
      record: {},
      editForm: false
    };
  },
  created() {
    this.record = this.data;
  },
  methods: {
    editRecord() {
      this.putRecord();
    },
    putRecord() {
      axios.put(`/records/${this.record.id}`, this.record).then(response => {
        console.log(response.data);
        this.editForm = false;
      });
    },
    deleteRecord() {
      this.askingBeforeDelete().then(result => {
        if (result.value) {
          axios.delete(`/records/${this.record.id}`).then(response => {
            console.log(response.data);
            this.$emit("deleted");
            this.$swal("Eliminado", response.data.message, "success");
          });
        }
      });
    },
    askingBeforeDelete() {
      return this.$swal({
        title: "Está seguro (a)?",
        text: "Verifique antes de continuar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
      });
    }
  }
};
</script>
<style scoped>
.action-icon {
  color: #17a2b8;
}
</style>