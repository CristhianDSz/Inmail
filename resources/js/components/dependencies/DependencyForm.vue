<template>
  <form @submit.prevent="postDependency" class="form-layout form-layout-2">
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
            name="firstname"
            v-model="dependency.name"
            placeholder="Ingrese el nombre"
          >
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
            name="lastname"
            v-model="dependency.code"
            placeholder="Ingrese el código"
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
      dependency: {
        name: "",
        code: ""
      }
    };
  },
  methods: {
    postDependency() {
      axios.post("/dependencies", this.dependency).then(response => {
        console.log(response.data);
        this.$emit("success");
        this.resetForm();
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
