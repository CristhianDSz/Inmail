<template>
  <form @submit.prevent="validateForm" class="form-layout form-layout-2">
    <div class="row no-gutters">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">
            Nit o cédula:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="identification"
            v-validate="'required|min:6'"
            data-vv-as="Identificación"
            v-model="thirdParty.identification"
            placeholder="Cédula de ciudadanía o NIT"
          />
          <small
            class="text-danger"
            v-if="errors.has('identification')"
          >{{errors.first('identification')}}</small>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">
            Nombre:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="name"
            v-validate="'required|min:3'"
            data-vv-as="Nombre"
            v-model="thirdParty.name"
            placeholder="Ingrese los nombres"
          />
          <small class="text-danger" v-if="errors.has('name')">{{errors.first('name')}}</small>
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Dirección:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="address"
            v-validate="'required|min:5'"
            data-vv-as="Dirección"
            v-model="thirdParty.address"
            placeholder="Ingrese la dirección"
          />
          <small class="text-danger" v-if="errors.has('address')">{{errors.first('address')}}</small>
        </div>
      </div>
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Teléfono:
            <span class="tx-danger">*</span>
          </label>
          <input
            type="text"
            name="telephone"
            v-validate="'required|min:7|numeric'"
            v-model="thirdParty.telephone"
            class="form-control"
            placeholder="Ingrese el teléfono"
          />
          <small class="text-danger" v-if="errors.has('telephone')">{{errors.first('telephone')}}</small>
        </div>
      </div>

      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Ciudad:
            <span class="tx-danger">*</span>
          </label>
          <multiselect class="form-control" name="city" v-validate="'required'" data-vv-as="Ciudad" :selectLabel="''" :deselectLabel="''" :maxHeight="200" v-model="thirdPartyCity" :options="this.cities" placeholder="Seleccione"></multiselect>
          <small class="text-danger" v-if="errors.has('city')">{{errors.first('city')}}</small>
        </div>
      </div>

      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">Correo de contacto:</label>
          <input
            type="text"
            name="email_contact"
            v-validate="'email'"
            data-vv-as="Correo de contacto"
            v-model="thirdParty.email_contact"
            class="form-control"
            placeholder="Ingrese el correo de contacto"
          />
          <small
            class="text-danger"
            v-if="errors.has('email_contact')"
          >{{errors.first('email_contact')}}</small>
        </div>
      </div>
      <!-- col-4 -->
    </div>
    <!-- row -->
    <div class="form-layout-footer bd pd-20 bd-t-0 text-right">
      <button class="btn btn-info" type="submit">Registrar</button>
    </div>
    <!-- form-group -->
  </form>
</template>

<script>
import {cities} from './colombiaCities.js'
export default {
  data() {
    return {
      thirdParty: {
        identification: "",
        name: "",
        address: "",
        telephone: "",
        city: "",
        email_contact: ""
      },
      cities: [],
      //Multiselect
      thirdPartyCity:''
    };
  },
  created() {
    this.getCities();
  },
  methods: {
    getCities() {
      cities.forEach(city => {
        city.ciudades.forEach(ciudad => {
          this.cities.push(ciudad)
        })
      })
    },
    async validateForm() {
      let valid = await this.$validator.validateAll();
      if (valid) {
        this.postThirdParty();
        return;
      }
      this.$swal(
        "Error!",
        "Debe corregir los errores antes de continuar",
        "error"
      );
    },
    postThirdParty() {
      this.thirdParty.city = this.thirdPartyCity
      axios.post("/third-parties", this.thirdParty).then(response => {
        this.$emit("success");
        this.resetForm();
        this.$validator.reset()
      }).catch(error => {
        if(error.response.data.errors.hasOwnProperty('identification')) {
          this.$swal('Error!',"Ya existe un tercero con ese Nit o cédula, ingrese uno diferente",'error')
        }
      })
    },
    resetForm() {
      for (let prop in this.thirdParty) {
        this.thirdParty[prop] = "";
      }
    }
  }
};
</script>
