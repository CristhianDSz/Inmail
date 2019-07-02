<template>
  <form @submit.prevent="postThirdParty" class="form-layout form-layout-2">
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
            v-model="thirdParty.identification"
            placeholder="Cédula de ciudadanía o NIT"
          >
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
            v-model="thirdParty.name"
            placeholder="Ingrese los nombres"
          >
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
            name="lastname"
            v-model="thirdParty.address"
            placeholder="Ingrese la dirección"
          >
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
            v-model="thirdParty.telephone"
            class="form-control"
            placeholder="Ingrese el teléfono"
          >
        </div>
      </div>

      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Ciudad:
            <span class="tx-danger">*</span>
          </label>
          <select v-model="thirdParty.city" class="select2-container form-control">
            <option
              v-for="city in cities"
              :key="city.c_digo_dane_del_municipio"
              :value="city.municipio"
            >{{city.municipio}}, {{city.departamento}}</option>
          </select>
        </div>
      </div>

      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Correo de contacto:
            <span class="tx-danger">*</span>
          </label>
          <input
            type="text"
            v-model="thirdParty.email_contact"
            class="form-control"
            placeholder="Ingrese el correo de contacto"
          >
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
      cities: []
    };
  },
  created() {
    this.getCities();
  },
  methods: {
    getCities() {
      axios.get("/app/cities").then(cities => {
        this.cities = cities.data;
        citiesEmitter.$emit("cities", cities.data);
      });
    },
    postThirdParty() {
      axios.post("/third-parties", this.thirdParty).then(response => {
        console.log(response.data);
        this.$emit("success");
        this.resetForm();
      });
    },
    resetForm() {
      for (let prop in this.thirdParty) {
        this.thirdParty[prop] = "";
      }
    }
  }
};
</script>
