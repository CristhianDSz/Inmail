<template>
  <tr v-if="!editForm">
    <td>{{data.name}}</td>
    <td>{{data.code}}</td>
    <td>
      <a href="#" @click.prevent="editForm = true">Editar</a>

      <a href="#" @click.prevent="deleteDependency">Eliminar</a>
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
      <a href="#" @click.prevent="editDependency">Guardar</a>

      <a href="#" @click.prevent="editForm = false">Cancelar</a>
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