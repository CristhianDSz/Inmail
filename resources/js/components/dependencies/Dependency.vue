<template>
  <tr v-if="!editForm" @dblclick="editForm = true">
    <td>{{data.name}}</td>
    <td>{{data.code}}</td>
    <td>
      <a href="#" @click.prevent="editForm = true">
        <i class="icon ion-edit tx-22 p-2 action-icon"></i>
      </a>

      <a href="#" @click.prevent="deleteDependency">
        <i class="icon ion-trash-a tx-22 p-2 action-icon"></i>
      </a>
    </td>
  </tr>
  <tr v-else>
    <td>
      <input type="text" v-model="dependency.name" class="form-control">
    </td>
    <td>
      <input type="text" v-model="dependency.code" class="form-control">
    </td>
    <td>
      <a href="#" @click.prevent="editDependency">
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
  props: ["data"],
  data() {
    return {
      dependency: {},
      editForm: false
    };
  },
  created() {
    this.dependency = this.data;
  },
  methods: {
    editDependency() {
      this.putDependency();
    },
    putDependency() {
      axios
        .put(`/dependencies/${this.dependency.id}`, this.dependency)
        .then(response => {
          console.log(response.data);
          this.editForm = false;
        });
    },
    deleteDependency() {
      this.askingBeforeDelete().then(result => {
        if (result.value) {
          axios.delete(`/dependencies/${this.dependency.id}`).then(response => {
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
        text:
          "Verifique antes de continuar y cambie los funcionarios de dependencia, de lo contrario serán eliminados!",
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