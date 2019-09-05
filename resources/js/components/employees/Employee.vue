<template>
  <tr v-if="!editForm" @dblclick="editForm =  true">
    <td>{{data.identification}}</td>
    <td>{{data.firstname}}</td>
    <td>{{data.lastname}}</td>
    <td>{{data.dependency.name}}</td>
    <td>
      <a href="#" @click.prevent="showEditForm">
        <i class="icon ion-edit tx-22 p-2 tx-info"></i>
      </a>

      <a href="#" @click.prevent="deleteEmployee">
        <i class="icon ion-trash-a tx-22 p-2 tx-info"></i>
      </a>
    </td>
  </tr>
  <tr v-else @keyup.enter="editEmployee">
    <td>
      <input type="text" name="identification" v-validate="'required|min:6'" data-vv-as="Documento" v-model="employee.identification" class="form-control" />
      <small class="text-danger" v-if="errors.has('identification')">{{errors.first('identification')}}</small>
    </td>
    <td>
      <input type="text" name="firstname" v-validate="'required|min:3'" data-vv-as="Nombres" v-model="employee.firstname" class="form-control" />
      <small class="text-danger" v-if="errors.has('firstname')">{{errors.first('firstname')}}</small>
    </td>
    <td>
      <input type="text" name="lastname" v-validate="'required|min:3'" data-vv-as="Apellidos" v-model="employee.lastname" class="form-control" />
      <small class="text-danger" v-if="errors.has('lastname')">{{errors.first('lastname')}}</small>
    </td>
    <td>
      <multiselect
        name="dependency_id"
        v-validate="'required'"
        data-vv-as="Dependencia"
        :selectLabel="''"
        :deselectLabel="''"
        :maxHeight="400"
        v-model="employeeDependency"
        :options="dependenciesData"
        label="name"
        placeholder="Seleccione"
      ></multiselect>
      <small class="text-danger" v-if="errors.has('dependency_id')">{{errors.first('dependency_id')}}</small>
    </td>
    <td>
      <a href="#" @click.prevent="validateForm">
        <i class="icon ion-checkmark tx-22 p-1 tx-info"></i>
      </a>

      <a href="#" @click.prevent="editForm = false">
        <i class="icon ion-close tx-22 p-1 tx-info"></i>
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
      editForm: false,
      employeeDependency: ""
    };
  },
  created() {
    this.employee = this.data;
  },
  methods: {
    showEditForm() {
      this.editForm = true;
      this.getCurrentDependency();
    },
    getCurrentDependency() {
      this.employeeDependency = this.dependenciesData.find(dependency => {
        return dependency.id === this.data.dependency_id;
      });
    },
     async validateForm() {
      let valid = await this.$validator.validateAll();
      if (valid) {
        this.editEmployee();
        return;
      }
      this.$swal(
        "Error",
        "Debe corregir los errores antes de continuar",
        "error"
      );
     },
    editEmployee() {
      this.putEmployee();
    },
    putEmployee() {
      this.employee.dependency_id = this.employeeDependency.id
      axios
        .put(`/employees/${this.employee.id}`, this.employee)
        .then(response => {
          this.editForm = false;
        });
    },
    deleteEmployee() {
      this.askingBeforeDelete().then(result => {
        if (result.value) {
          axios.delete(`/employees/${this.employee.id}`).then(response => {
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