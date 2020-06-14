<template>
  <form @submit.prevent="validateForm" class="form-layout form-layout-2">
    <div class="row no-gutters">
      <div class="col-md-8">
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
            v-model="dependency.name"
            placeholder="Ingrese el nombre"
          >
           <small class="text-danger" v-if="errors.has('name')">{{errors.first('name')}}</small>
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Código:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="code"
            v-validate="'required|min:2'"
            v-model="dependency.code"
            placeholder="Ingrese el código"
          >
           <small class="text-danger" v-if="errors.has('code')">{{errors.first('code')}}</small>
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
      dependency: {
        name: "",
        code: ""
      }
    };
  },
  methods: {
     async validateForm() {
      let valid = await this.$validator.validateAll();
      if (valid) {
        this.postDependency();
        return;
      }
      this.$swal(
        "Error",
        "Debe corregir los errores antes de continuar",
        "error"
      );
     },
    postDependency() {
      axios.post("/dependencies", this.dependency).then(response => {
        this.$emit("success");
        this.resetForm();
        this.$validator.reset()
      });
    },

    resetForm() {
      this.dependency.name = "";
      this.dependency.code = "";
    }
  }
};
</script>

<style>
</style>
