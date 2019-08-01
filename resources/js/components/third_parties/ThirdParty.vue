<template>
  <tr v-if="!editForm" @dblclick="editForm=true">
    <td>{{data.identification}}</td>
    <td class="text-center">{{data.name}}</td>
    <td class="text-center">{{data.address}}</td>
    <td class="text-center">{{data.telephone}}</td>
    <td class="text-center">{{data.city}}</td>
    <td class="text-center">{{data.email_contact}}</td>
    <td class="text-center">
      <a href="#" @click.prevent="editForm = true">
        <i class="icon ion-edit tx-22 p-2 action-icon"></i>
      </a>

      <a href="#" @click.prevent="deleteThirdParty">
        <i class="icon ion-trash-a tx-22 p-2 action-icon"></i>
      </a>
    </td>
  </tr>
  <tr v-else>
    <td>
      <input type="text" v-model="thirdParty.identification" class="form-control" />
    </td>
    <td>
      <input type="text" v-model="thirdParty.name" class="form-control" />
    </td>
    <td>
      <input type="text" v-model="thirdParty.address" class="form-control" />
    </td>
    <td>
      <input type="text" v-model="thirdParty.telephone" class="form-control" />
    </td>
    <td>
      <select v-model="thirdParty.city" class="form-control">
        <option
          v-for="city in cities"
          :key="city.c_digo_dane_del_municipio"
          :value="city.municipio"
        >{{city.municipio}}, {{city.departamento}}</option>
      </select>
    </td>
    <td>
      <input type="text" v-model="thirdParty.email_contact" class="form-control" />
    </td>
    <td>
      <a href="#" @click.prevent="editThirdParty">
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
      thirdParty: {},
      cities: [],
      editForm: false
    };
  },
  created() {
    this.thirdParty = this.data;
    citiesEmitter.$on("cities", cities => {
      this.cities = cities;
    });
  },
  methods: {
    editThirdParty() {
      this.putThirdParty();
    },
    putThirdParty() {
      axios
        .put(`/third-parties/${this.thirdParty.id}`, this.thirdParty)
        .then(response => {
          console.log(response.data);
          this.editForm = false;
        });
    },
    deleteThirdParty() {
      this.askingBeforeDelete().then(result => {
        if (result.value) {
          axios
            .delete(`/third-parties/${this.thirdParty.id}`)
            .then(response => {
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
