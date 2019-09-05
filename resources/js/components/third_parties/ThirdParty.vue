<template>
  <tr v-if="!editForm" @dblclick="editForm=true">
    <td>{{data.identification}}</td>
    <td class="text-center">{{data.name}}</td>
    <td class="text-center">{{data.address}}</td>
    <td class="text-center">{{data.telephone}}</td>
    <td class="text-center">{{data.city}}</td>
    <td class="text-center">{{data.email_contact}}</td>
    <td class="text-center">
      <a href="#" @click.prevent="showEditForm">
        <i class="icon ion-edit tx-22 p-2 action-icon"></i>
      </a>

      <a href="#" @click.prevent="deleteThirdParty">
        <i class="icon ion-trash-a tx-22 p-2 action-icon"></i>
      </a>
    </td>
  </tr>
  <tr v-else>
    <td>
      <input type="text" name="identification" v-validate="'required|min:6'" data-vv-as="Identificación" v-model="thirdParty.identification" class="form-control" />
      <small class="text-danger" v-if="errors.has('identification')">{{errors.first('identification')}}</small>
    </td>
    <td>
      <input type="text" name="name" v-validate="'required|min:3'" data-vv-as="Nombre" v-model="thirdParty.name" class="form-control" />
      <small class="text-danger" v-if="errors.has('name')">{{errors.first('name')}}</small>
    </td>
    <td>
      <input type="text" name="address" v-validate="'required|min:3'" data-vv-as="Dirección" v-model="thirdParty.address" class="form-control" />
      <small class="text-danger" v-if="errors.has('address')">{{errors.first('address')}}</small>
    </td>
    <td>
      <input type="text" name="telephone" v-validate="'required|min:7|numeric'"
      data-vv-as="Teléfono" v-model="thirdParty.telephone" class="form-control" />
      <small class="text-danger" v-if="errors.has('telephone')">{{errors.first('telephone')}}</small>
    </td>
    <td>
       <multiselect name="city" v-validate="'required'" data-vv-as="Ciudad" :selectLabel="''" :deselectLabel="''" :maxHeight="200" v-model="thirdPartyCity" :options="cities" label="municipio" placeholder="Seleccione"></multiselect>
      <small class="text-danger" v-if="errors.has('city')">{{errors.first('city')}}</small>
    </td>
    <td>
      <input type="text" name="email_contact" v-validate="'email'" data-vv-as="Correo" v-model="thirdParty.email_contact" class="form-control" />
      <small class="text-danger" v-if="errors.has('email_contact')">{{errors.first('email_contact')}}</small>
    </td>
    
    <td>
      <a href="#" @click.prevent="validateForm">
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
      editForm: false,
      //Multiselect
      thirdPartyCity:""
    };
  },
  created() {
    this.thirdParty = this.data;
    citiesEmitter.$on("cities", cities => {
      this.cities = cities;
    });
  },
  methods: {
    showEditForm() {
      this.getCurrentCity()
      this.editForm = true
    },
    getCurrentCity() {
      this.thirdPartyCity = this.cities.find(city => {
        return city.municipio === this.data.city
      })
    },
     async validateForm() {
      let valid = await this.$validator.validateAll();
      if (valid) {
        this.editThirdParty();
        return;
      }
      this.$swal(
        "Error!",
        "Debe corregir los errores antes de continuar",
        "error"
      );
    },
    editThirdParty() {
      this.putThirdParty();
    },
    putThirdParty() {
      this.thirdParty.city = this.thirdPartyCity.municipio
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
