<template>
  <tr>
    <td class="pd-l-0-force tx-semibold">{{data.number}}</td>
    <td class="tx-medium">{{data.type}}</td>
    <td class="tx-medium">{{datetimeFormat}}</td>
    <td class="tx-medium">{{data.document_type}}</td>
    <td class="tx-medium">
      <span class="square-8 mg-r-5 rounded-circle" :class="statusColors[data.status]"></span>
      {{data.status}}
    </td>
    <!-- <td>{{data.third_party.name}}</td>
    <td>
      <h6 class="tx-inverse tx-14 mg-b-0">{{data.employee.name}}</h6>
      <span class="tx-12">{{data.dependency.name}}</span>
    </td>-->
    <td>
      <a href="#" @click.prevent="$emit('recordClick', record)">
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
      editForm: false,
      statusColors: {
        Creado: "bg-danger",
        Registrado: "bg-warning",
        Entregado: "bg-success"
      }
    };
  },
  created() {
    this.record = this.data;
  },
  methods: {
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
        confirmButtonColor: "#00b297",
        cancelButtonText: "Cancelar"
      });
    }
  },
  computed: {
    datetimeFormat() {
      return moment(this.data.datetime).format("MM/DD/YYYY HH:mm");
    }
  }
};
</script>
<style scoped>
.action-icon {
  color: #00b297;
}
</style>