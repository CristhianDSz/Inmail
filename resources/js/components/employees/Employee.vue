<template>
  <tr v-if="!editForm" @dblclick="editForm =  true">
    <td>{{data.identification}}</td>
    <td>{{data.firstname}}</td>
    <td>{{data.lastname}}</td>
    <td>{{data.dependency.name}}</td>
    <td>
      <a href="#" @click.prevent="editForm = true">
        <i class="icon ion-edit tx-22 p-2 action-icon"></i>
      </a>

      <a href="#" @click.prevent="deleteEmployee">
        <i class="icon ion-trash-a tx-22 p-2 action-icon"></i>
      </a>
    </td>
  </tr>
  <tr v-else @keyup.enter="editEmployee">
    <td>
      <input type="text" v-model="employee.identification" class="form-control">
    </td>
    <td>
      <input type="text" v-model="employee.firstname" class="form-control">
    </td>
    <td>
      <input type="text" v-model="employee.lastname" class="form-control">
    </td>
    <td>
      <select v-model="employee.dependency_id" class="form-control">
        <option
          v-for="dependency in dependenciesData"
          :key="dependency.id"
          :value="dependency.id"
        >{{dependency.name}}</option>
      </select>
    </td>
    <td>
      <a href="#" @click.prevent="editEmployee">
        <i class="icon ion-checkmark tx-22 p-1 action-icon"></i>
      </a>

      <a href="#" @click.prevent="editForm = false">
        <i class="icon ion-close tx-22 p-1 action-icon"></i>
      </a>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["data", "dependenciesData"],
  data() {
    return {
      employee: {},
      editForm: false
    };
  },
  created() {
    this.employee = this.data;
  },
  methods: {
    editEmployee() {
      this.putEmployee();
    },
    putEmployee() {
      axios
        .put(`/employees/${this.employee.id}`, this.employee)
        .then(response => {
          console.log(response.data);
          this.editForm = false;
        });
    },
    deleteEmployee() {
      this.askingBeforeDelete().then(result => {
        if (result.value) {
          axios.delete(`/employees/${this.employee.id}`).then(response => {
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
  color: #00b297;
}
</style>